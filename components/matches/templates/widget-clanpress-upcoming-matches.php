<?php
/**
 * Template of the upcoming matches widget.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Matches\Templates
 */
?>
<?php if ( have_posts() ): ?>
  <ul class="clanpress_widget__items">
    <?php while(have_posts()) : the_post(); ?>
      <li class="clanpress_widget__item">
        <span class="clanpress_widget__versus">
          <?php clanpress_the_match_squad_thumbnail( 'thumbnail' ); ?>
          vs
          <?php clanpress_the_match_opponent_thumbnail( 'thumbnail' ); ?>
        </span>
        <span class="clanpress_widget__date">
          <?php clanpress_the_match_game(); ?>
        </span>
        &ndash;
        <span class="clanpress_widget__date">
          <?php echo get_the_date(); ?>
        </span>
        <a class="clanpress_widget__result" href="<?php the_permalink(); ?>">
          <?php clanpress_the_match_result(); ?>
        </a>
      </li>
    <?php endwhile; ?>
  </ul>
<?php else: ?>
  <?php _e( 'No matches found.', 'clanpress' ); ?>
<?php endif; ?>
