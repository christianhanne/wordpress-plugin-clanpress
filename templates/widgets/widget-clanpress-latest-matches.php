<?php
/**
 * @file
 * Template of the latest matches widget.
 *
 * @author Christian Hanne <support @aureola.codes>
 * @package Clanpress
 */
?>
<?php if ( have_posts() ): ?>
  <ul class="widget_clanpress__items">
    <?php while(have_posts()) : the_post(); ?>
      <li class="widget_clanpress__item">
        <div class="widget_clanpress__versus">
          <?php clanpress_the_match_squad_thumbnail( 'thumbnail' ); ?>
          vs
          <?php clanpress_the_match_opponent_thumbnail( 'thumbnail' ); ?>
        </div>
        <span class="widget_clanpress__date">
          <?php clanpress_the_match_game(); ?>
        </span>
        &ndash;
        <span class="widget_clanpress__date">
          <?php the_date(); ?>
        </div>
        <a class="widget_clanpress__result" href="<?php the_permalink(); ?>">
          <?php clanpress_the_match_result(); ?>
        </a>
      </li>
    <?php endwhile; ?>
  </ul>
<?php else: ?>
  <?php _e( 'No matches found.', 'clanpress' ); ?>
<?php endif; ?>
