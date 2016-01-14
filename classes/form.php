<?php
/**
 * @file
 * TODO
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Form
 */
class Clanpress_Form {

  /**
   * TODO
   */
  public static function input($id, $name, $type = 'text', $value, $attributes = array()) {
    $attributes['id'] = $id;
    $attributes['name'] = $name;
    $attributes['type'] = $type;
    $attributes['value'] = $value;

    return sprintf('<input%s />', self::attributes($attributes));
  }

  /**
   * TODO
   */
  public static function checkbox($id, $name, $checked, $attributes = array()) {
    $attributes['class'] = 'checkbox';
    if ($checked) {
      $attributes['checked'] = 'checked';
    }

    return self::input($id, $name, 'checkbox', '1', $attributes);
  }

  /**
   * TODO
   */
  public static function select($id, $name, $value, $options, $attributes = array()) {
    $attributes['id'] = $id;
    $attributes['name'] = $name;

    if (is_array($value)) {
      $attributes['multiple'] = 'multiple';
    }

    return vsprintf('<select%s>%s</select>', array(
      self::attributes($attributes),
      self::options($options, $value),
    ));
  }

  /**
   * TODO
   */
  public static function label($id, $title) {
    return sprintf('<label for="%s">%s:</label>', $id, $title);
  }

  /**
   * TODO
   */
  public static function element($element) {
    $element_value = isset( $element['default'] ) ? $element['default'] : '';
    if ( !empty( $element['value'] ) ) {
      $element_value = esc_attr( $element['value'] );
    }

    $element_label = '';
    if ( isset( $element['label'] ) ) {
      $element_label = self::label( $element['field_id'], $element['label'] );
    }

    $element_options = isset( $element['options'] ) ? (array) $element['options'] : array();
    $element_attributes = isset( $element['attributes'] ) ? (array) $element['attributes'] : array();

    switch ($element['type']) {
      case 'select':
        $element_attributes['class'] = 'widefat';

        return vsprintf('<p>%s%s</p>', array(
          $element_label,
          self::select(
            $element['field_id'],
            $element['field_name'],
            $element_value,
            $element_options,
            $element_attributes
          ),
        ));

      case 'checkbox':
        $element_attributes['class'] = 'widefat';

        return vsprintf('<p>%s%s</p>', array(
          self::checkbox(
            $element['field_id'],
            $element['field_name'],
            $element_value,
            $element_attributes
          ),
          $element_label,
        ));

      case 'number':
        $element_attributes['class'] = 'tiny-text';

        return vsprintf('<p>%s %s</p>', array(
          $element_label,
          self::input(
            $element['field_id'],
            $element['field_name'],
            $element['type'],
            $element_value,
            $element_attributes
          ),
        ));

      case 'text':
        $element_attributes['class'] = 'widefat';

        return vsprintf('<p>%s%s</p>', array(
          $element_label,
          self::input(
            $element['field_id'],
            $element['field_name'],
            $element['type'],
            $element_value,
            $element_attributes
          ),
        ));

      default:
        return '';
    }
  }

  /**
   * TODO
   */
  private static function attributes($attributes = array()) {
    $output = '';
    foreach ($attributes as $attr_name => $attr_value) {
      if ($attr_value === TRUE) {
        $output .= ' ' . $attr_name;
      }
      else {
        $output .= ' ' . $attr_name . '="' . $attr_value . '"';
      }
    }

    return $output;
  }

  /**
   * TODO
   */
  private static function options($options, $value) {
    $output = '';
    foreach ($options as $opt_value => $opt_label) {
      if (is_array($value)) {
        $opt_selected = in_array($opt_value, $value) ? ' selected="selected"' : '';
      } else {
        $opt_selected = $opt_value === $value ? ' selected="selected"' : '';
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
