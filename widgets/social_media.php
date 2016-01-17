<?php
/**
 * @file
 * Contains the class of the custom 'Social Media' widget.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Social_Media_Widget
 */
class Clanpress_Social_Media_Widget extends Clanpress_Widget {
  /**
   * @inheritdoc
   */
  protected function template_elements($instance = array()) {
    $elements = array();

    $elements['links'] = array();
    foreach ($this->form_elements() as $key => $element) {
      if ( !empty($instance[ $key ]) && $key !== 'title' ) {
        $elements['links'][ $key ] = array(
          'href' => esc_attr( $instance[ $key ] ),
          'title' => $element['label'],
        );
      }
    }

    return $elements;
  }

  /**
   * @inheritdoc
   */
  protected function form_elements() {
    return array(
      'title' => array(
        'type' => 'text',
        'label' => __( 'Title', 'clanpress' ),
        'default' => $this->name(),
      ),
      'facebook' => array(
        'type' => 'text',
        'label' => __( 'Facebook', 'clanpress' ),
        'pattern' => '^https:\/\/.*\.facebook.com\/.+$',
      ),
      'twitter' => array(
        'type' => 'text',
        'label' => __( 'Twitter', 'clanpress' ),
        'pattern' => '^https:\/\/twitter\.com\/.+$',
      ),
      'instagram' => array(
        'type' => 'text',
        'label' => __( 'Instagram', 'clanpress' ),
        'pattern' => '^https:\/\/www\.instagram\.com/.+$',
      ),
      'twitch' => array(
        'type' => 'text',
        'label' => __( 'Twitch', 'clanpress' ),
        'pattern' => '^http:\/\/www\.twitch\.tv\/.+$',
      ),
      'youtube' => array(
        'type' => 'text',
        'label' => __( 'Youtube', 'clanpress' ),
        'pattern' => '^https:\/\/www\.youtube\.com\/channel\/.+$',
      ),
      'esl' => array(
        'type' => 'text',
        'label' => __( 'ESL Profile', 'clanpress' ),
        'pattern' => '^http:\/\/www\.esl\.eu/[a-z]+\/player\/.+$',
      ),
      'pinterest' => array(
        'type' => 'text',
        'label' => __( 'Pinterest', 'clanpress' ),
        'pattern' => '^https:\/\/www\.pinterest\.com.+$',
      ),
    );
  }

  /**
   * @inheritdoc
   */
  protected function name() {
    return __( 'Social Media', 'clanpress' );
  }

  /**
   * @inheritdoc
   */
  protected function description() {
    return __( 'Displays social media links.', 'clanpress' );
  }
}
