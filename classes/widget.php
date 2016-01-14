<?php
/**
 * @file
 * TODO
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Widget
 */
class Clanpress_Widget extends WP_Widget {

  /**
   * TODO
   */
  public function __construct() {
    parent::__construct( $this->id(), $this->name(), array(
      'description' => $this->description(),
    ));
  }

  /**
   * TODO
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
        $value = trim( strip_tags( $new_instance[ $id ] ) );
        if (!isset( $element['pattern'] )) {
          $instance[ $id ] = $value;
        }
        else if ( preg_match( "/$element[pattern]/", "$value" ) ) {
          $instance[ $id ] = $value;
        }
        else {
          $instance[ $id ] = $old_instance[ $id ];
        }
      }
    }

    return $instance;
  }

  /**
   * TODO
   *
   * @return array
   *   TODO
   *
   * @see Clanpress_Form::element()
   */
  protected function form_elements() {
    return array();
  }

  /**
   * TODO
   *
   * @param array $instance
   *
   * @return array
   *   TODO
   */
  protected function template_elements($instance = array()) {
    return array();
  }

  /**
   * TODO
   */
  protected function name() {
    return __( 'No name found.', 'clanpress' );
  }

  /**
   * TODO
   */
  protected function description() {
    return __( 'No description found.', 'clanpress' );
  }

  /**
   * TODO
   */
  private function template_name() {
    $search = array( '_', 'clanpress-' );
    $replace = array( '-', '' );
    return str_replace( $search, $replace,  $this->id() ) . '.php';
  }

  /**
   * TODO
   */
  private function load_template($params = array()) {
    foreach ($params as $key => $value) {
      set_query_var( $key, $value );
    }

    $template_name = $this->template_name();
    if ( $overridden_template = locate_template( $template_name ) ) {
      load_template( $overridden_template );
    } else {
      load_template( CLANPRESS_PLUGIN_PATH . 'templates/widgets/' . $template_name );
    }
  }

  /**
   * TODO
   */
  private function id() {
    return strtolower( get_class( $this ) );
  }
}
