<?php
/**
 * Template of the games widget.
 *
 * @var array $terms
 *   Array of terms of the game taxonomy.
 * @var bool $display_name
 *   Whether or not to display the game term's name.
 * @var bool $display_slug
 *   Whether or not to display the game term's slug.
 * @var bool $display_icon
 *   Whether or not to display the game term's icon.
 * @var bool $display_image
 *   Whether or not to display the game term's image.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Games\Templates
 */
?>
<ul class="clanpress_widget__items">
  <?php foreach ( $terms as $term ): ?>
    <li class="clanpress_widget__item">
      <?php if ( $display_name ): ?>
        <span class="clanpress_widget__game_name">
          <?php echo esc_html( $term->name ); ?>
        </span>
      <?php endif; ?>

      <?php if ( $display_slug ): ?>
        <span class="clanpress_widget__game_slug">
          <?php echo esc_html( $term->slug ); ?>
        </span>
      <?php endif; ?>

      <?php if ( $display_icon ): ?>
        <span class="clanpress_widget__game_icon">
          <?php clanpress_the_game_icon( $term->term_id ); ?>
        </span>
      <?php endif; ?>

      <?php if ( $display_image ): ?>
        <span class="clanpress_widget__game_image">
          <?php clanpress_the_game_image( $term->term_id ); ?>
        </span>
      <?php endif; ?>
    </li>

  <?php endforeach; ?>
</ul>
