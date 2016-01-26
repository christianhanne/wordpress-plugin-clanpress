<?php
/**
 * @file
 * Contains a helper class for form elements.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Form
 */
class Clanpress_Form {
  /**
   * Returns a form element of the given type.
   *
   * @param array $element
   *   Contains the form element definition as an associative array. The
   *   following fields will be processed (optional fields are marked as such):
   *   - type:
   *     Defines the form element's type.
   *     Allowed values: input, number, checkbox, select
   *   - field_id:
   *     The form element's id as defined by wordpress.
   *   - field_name:
   *     The form element's name as defined by wordpress.
   *   - pattern: (optional)
   *     Will be used for validation if defined. Should contain a valid regex.
   *   - label: (optional)
   *     Will create a label element with the given value as the content
   *     above the actual form element.
   *   - description: (optional)
   *     Will create a description which will be displayed below the form
   *     element.
   *   - template: (optional)
   *     Elements may define an own template. $field, $label and $description
   *     can be used as placeholders in the markup.
   *   - options:
   *     This is only required for elements with options (like select). Should
   *     contain an array of option values and labels. Eg. foo => bar will
   *     output <option="foo">bar</option> for selects.
   *   - value: (optional)
   *     The form element's current value.
   *   - default: (optional)
   *     The form element's default value. If the element does not have a value
   *     the value of this field will be used instead.
   *   - attributes:
   *     An associative array of html attributes. Should be defined as
   *     attribute => value (will output <* attribute="value">) or
   *     attribute => bool (will output <* attribute>).
   *
   * @return string
   *   Html markup of a form element.
   */
  public static function element($element) {
    if ( empty( $element['value'] ) ) {
      $element['value'] = isset( $element['default'] ) ? $element['default'] : '';
    }

    if ( is_array( $element['value'] ) ) {
      array_walk( $element['value'], 'esc_attr' );
    } else {
      $element['value'] = esc_attr( $element['value'] );
    }

    $label = '';
    if ( isset( $element['label'] ) ) {
      $label = self::label( $element['field_id'], $element['label'] );
    }

    $description = '';
    if ( isset( $element['description'] ) ) {
      $description = '<p class="description">' . $element['description'] . '</p>';
    }

    $element['options'] = isset( $element['options'] ) ? (array) $element['options'] : array();
    $element['attributes'] = isset( $element['attributes'] ) ? (array) $element['attributes'] : array();

    switch ($element['type']) {
      case 'select':
        $element['attributes']['class'] = 'widefat';

        $field = self::select($element);
        $template = '<div>$label$field$description</div>';
        break;

      case 'checkbox':
        $element['attributes']['class'] = 'widefat';

        $field = self::checkbox($element);
        $template = '<div>$field$label$description</div>';
        break;

      case 'checkboxes':
        $element['attributes']['class'] = 'widefat';

        $field = self::checkboxes($element);
        $template = '<div>$label$field$description</div>';
        break;

      case 'number':
        $element['attributes']['class'] = 'tiny-text';

        $field = self::input($element);
        $template = '<div>$label $field$description</div>';
        break;

      case 'text':
        $element['attributes']['class'] = 'widefat';

        $field = self::input($element);
        $template = '<div>$field$label$description</div>';
        break;
    }

    if ( !empty( $element['template'] ) ) {
      $template = $element['template'];
    }

    $pattern = array('$label', '$field', '$description');
    $replace = array($label, $field, $description);
    return str_replace($pattern, $replace, $template);
  }

  /**
   * Returns an array with numbers with the given range.
   *
   * @param int $min
   *   Minimum number in the array
   * @param int $max
   *   Maximum number in the array
   *
   * @return array
   *   Array with numbers range
   */
  public static function range($min, $max) {
     $options = array();
     for ($i = $min; $i <= $max; $i++) {
       $options[$i] = $i;
     }

     return $options;
  }

  /**
   * Returns if the given value is valid for the given element.
   *
   * @param array $element
   *   Form element
   * @param mixed $value
   *   Value of the form element
   *
   *  @return bool
   *    True, if value is valid.
   */
  public static function is_valid($element, $value) {
    $value = trim( strip_tags( $value ) );
    if ( isset( $element['options'] ) ) {
      return isset( $value, $element['options'] );
    }
    else if (!isset( $element['pattern'] )) {
      return TRUE;
    }
    else {
      return !!preg_match( "/$element[pattern]/", "$value" );
    }
  }

  /**
   * Returns if the given element is a multi-value element.
   *
   * @param array $element
   *   Form element
   *
   * @return bool
   *   True, if this is a multi-value element.
   */
  public static function is_multi_value($element) {
    return $element['type'] === 'checkboxes' || is_array( $element['default'] );
  }

  /**
   * Returns the html markup of an input form element.
   *
   * @param array $element
   *   Contains the form element definition as an associative array.
   *   Please check the linked method for further details.
   *
   * @return string
   *   Html markup of an input form element.
   *
   * @see Clanpress_Form::element()
   */
  private static function input($element) {
    $attributes = isset( $element['attributes'] ) ? $element['attributes'] : array();
    $attributes['id'] = $element['field_id'];
    $attributes['name'] = $element['field_name'];
    $attributes['type'] = $element['type'];

    if ( !isset( $attributes['value'] ) ) {
      $attributes['value'] = $element['value'];
    }

    return sprintf('<input%s />', self::attributes($attributes));
  }

  /**
   * Returns the html markup of a checkbox form element.
   *
   * @param array $element
   *   Contains the form element definition as an associative array.
   *   Please check the linked method for further details.
   *
   * @return string
   *   Html markup of a checkbox form element.
   *
   * @see Clanpress_Form::input()
   * @see Clanpress_Form::element()
   */
  private static function checkbox($element) {
    $element['attributes']['value'] = 1;
    $element['attributes']['class'] = 'checkbox';
    if ($element['value'] == $element['attributes']['value']) {
      $element['attributes']['checked'] = 'checked';
    }

    return self::input($element);
  }

  /**
   * Returns the html markup of a select form element.
   *
   * @param array $element
   *   Contains the form element definition as an associative array.
   *   Please check the linked method for further details.
   *
   * @return string
   *   Html markup of a select form element.
   *
   * @see Clanpress_Form::element()
   */
  private static function select($element) {
    $element['attributes']['id'] = $element['field_id'];
    $element['attributes']['name'] = $element['field_name'];

    if (is_array($element['value'])) {
      $element['attributes']['multiple'] = 'multiple';
    }

    return vsprintf('<select%s>%s</select>', array(
      self::attributes($element['attributes']),
      self::options($element['options'], $element['value']),
    ));
  }

  /**
   * Returns the html markup of multiple checkboxes.
   *
   * @param array $element
   *   Contains the form element definition as an associative array.
   *   Please check the linked method for further details.
   *
   * @return string
   *   Html markup of a checkboxes form element.
   *
   * @see Clanpress_Form::element()
   */
  private static function checkboxes($element) {
    $value = isset( $element['value'] ) ? $element['value'] : $element['default'];

    $element['attributes']['id'] = $element['field_id'];
    $element['attributes']['name'] = $element['field_name'];

    $output = '';
    foreach ($element['options'] as $key => $label) {
      $checkbox = $element;

      $checkbox['label'] = $label;
      $checkbox['type'] = 'checkbox';
      $checkbox['value'] = isset( $value[ $key ] ) ?  $value[ $key ] : NULL;
      $checkbox['default'] = $checkbox['value'];

      $checkbox['field_id'] = $checkbox['field_id'] . '[' . $key . ']';
      $checkbox['field_name'] = $checkbox['field_id'];
      $checkbox['attributes']['id'] = $checkbox['field_id'];
      $checkbox['attributes']['name'] = $checkbox['field_id'];

      $output .= self::element($checkbox);
    }

    return $output;
  }

  /**
   * Returns the html markup of a label element.
   *
   * @param string $id
   *   Html id of the label's form field.
   * @param string $title
   *   The title this label contain.
   *
   * @return string
   *   Html markup of a label element.
   */
  private static function label($id, $title) {
    return sprintf('<label for="%s">%s</label>', $id, $title);
  }

  /**
   * Returns an attributes string for use in html elements.
   *
   * @param array $attributes
   *   An associative array of html attributes. Should be defined as
   *   attribute => value (will output <* attribute="value">) or
   *   attribute => bool (will output <* attribute>).
   *
   * @return string
   *   Html attributes string.
   */
  private static function attributes($attributes = array()) {
    $output = '';
    foreach ( $attributes as $attr_name => $attr_value ) {
      if ( $attr_value === true ) {
        $output .= ' ' . $attr_name;
      }
      else {
        $output .= ' ' . $attr_name . '="' . $attr_value . '"';
      }
    }

    return $output;
  }

  /**
   * Returns a select options string for an array of options.
   *
   * @param array $options
   *   Should contain an array of option values and labels. Eg. foo => bar will
   *   output <option="foo">bar</option> for selects.
   * @param string|array $value
   *   The value of the corresponding form element. Will be used to
   *   mark options as selected.
   *
   * @return string
   *   Html output of select options.
   *
   * @see Clanpress::select()
   */
  private static function options($options, $value) {
    $output = '';
    foreach ($options as $opt_value => $opt_label) {
      if (is_array($value)) {
        $opt_selected = in_array($opt_value, $value) ? ' selected="selected"' : '';
      } else {
        $opt_selected = $opt_value == $value ? ' selected="selected"' : '';
      }

      $output .= vsprintf('<option value="%s"%s>%s</option>', array(
        $opt_value,
        $opt_selected,
        $opt_label,
      ));
    }

    return $output;
  }
}
