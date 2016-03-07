<?php
/**
 * Contains the parent class of the plugin's custom widgets.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Widget
 */
class Clanpress_Widget extends WP_Widget {
  /**
   * Registers the custom plugin using the classes' id, name and description.
   */
  public function __construct() {
    parent::__construct( $this->id(), '(ClanPress) ' . $this->name(), array(
      'description' => $this->description(),
    ));
  }

  /**
   * Displays the widget's template.
   *
   * @param array $args
   *   Array of widget arguments.
   * @param array $instance
   *   Previously saved values from database.
   */
  public function widget( $args, $instance ) {
    extract ( $args );

    echo $before_widget;

    $title = apply_filters( 'widget_title', $instance['title'] );
    if ( !empty( $title ) ) {
      echo $before_title . $title . $after_title;
    }

    $this->load_template( $this->template_elements( $instance ) );

    echo $after_widget;

    // Make sure we won't override the main query.
    wp_reset_query();
  }

  /**
   * Creates a form of an array of form elements provided by form_settings().
   *
   * @param array $instance
   *   Previously saved values from database.
   *
   * @see WP_Widget::form()
   * @see Clanpress_Widget::form_elements()
   */
 	public function form( $instance ) {
    foreach ($this->form_elements() as $id => $element) {
      $element['id'] = $id;
      $element['field_id'] = $this->get_field_id( $id );
      $element['field_name'] = $this->get_field_name( $id );
      $element['value'] = !empty( $instance[ $id ] ) ? $instance[ $id ] : '';
      print Clanpress_Form::element( $element );
    }
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @param array $new_instance
   *   Values just sent to be saved.
   * @param array $old_instance
   *   Previously saved values from database.
   *
   * @return array
   *   Updated safe values to be saved.
   *
   * @see WP_Widget::update()
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    foreach( $this->form_elements() as $id => $element) {
      $instance[ $id ] = isset( $element['default'] ) ? $element['default'] : '';
      if (!empty( $new_instance[ $id ] )) {
        if ( Clanpress_Form::is_valid( $element, $new_instance[ $id ] ) ) {
          $instance[ $id ] = strip_tags( trim( $new_instance[ $id ] ));
        }
        else {
          $instance[ $id ] = $old_instance[ $id ];
        }
      }
    }

    return $instance;
  }

  /**
   * Returns an array of form elements.
   *
   * Should return an array of form elements for widget forms. The array
   * should consist of the form element ids as key and the element settings
   * as values. For details on element settings check the linked function.
   *
   * @return array
   *   Array of form elements for widget forms.
   *   Eg. array('title' => $element, 'num_items' => $element)
   *
   * @see Clanpress_Form::element()
   */
  protected function form_elements() {
    return array();
  }

  /**
   * Returns an array of template elements.
   *
   * Should return an associative array of template elements/variables. Every
   * element in the array will be available in the widget's template through
   * a variable with the same name as the array key.
   *
   * @param array $instance
   *   Previously saved values from database.
   *
   * @return array
   *   Array of template elements
   */
  protected function template_elements($instance = array()) {
    return array();
  }

  /**
   * Returns the widget's human-readable name.
   *
   * @return string
   *   Name of the widget
   */
  protected function name() {
    return __( 'No name found.', 'clanpress' );
  }

  /**
  * Returns a description for the custom widget.
  *
  * @return string
  *   Description of the widget
   */
  protected function description() {
    return __( 'No description found.', 'clanpress' );
  }

  /**
   * Returns the filename of the template of the custom widget.
   *
   * @return string
   *   Filename of the widget's template
   */
  final private function template_name() {
    $template_name = str_replace( array( '_', '-widget' ), array( '-', '' ),  $this->id() );
    return 'widget-' . $template_name . '.php';
  }

  /**
   * Loads the widget's template either from the theme or from the plugin.
   *
   * @param array $params
   *   Array of template elements
   *
   * @see Clanpress_Widget::template_elements()
   */
  final private function load_template($params = array()) {
    foreach ($params as $key => $value) {
      set_query_var( $key, $value );
    }

    $template_name = $this->template_name();
    
    $template_names = array(
      $template_name,
      'clanpress/' . $template_name,
    );

    if ( $overridden_template = locate_template( $template_names ) ) {
      load_template( $overridden_template );
    } else {
      $obj = new ReflectionObject($this);
      $component = Clanpress_Helper::get_component_by_path( $obj->getFileName() );
      $templates_path = Clanpress_Helper::get_templates_path( $component );
      load_template( $templates_path . $template_name );
    }
  }

  /**
  * Returns the machine-readable id of the widget.
  *
  * The id is currently equivalent to the class name in lower case. Widgets
  * extending this class should not overwrite this function.
  *
  * @return string
  *   Machine-readable id of the widget
   */
  final private function id() {
    return strtolower( get_class( $this ) );
  }
}
