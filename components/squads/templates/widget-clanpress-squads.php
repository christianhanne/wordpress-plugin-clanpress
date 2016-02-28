<?php
/**
 * Template of the squads widget.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */
?>
<?php if ( have_posts() ): ?>
  <ul class="clanpress_widget__items">
    <?php while(have_posts()) : the_post(); ?>
      <li class="clanpress_widget__item">
        <span class="clanpress_widget__thumbnail">
          <?php the_post_thumbnail( 'thumbnail' ); ?>
        </span>
        <h4 class="clanpress_widget__title">
          <?php the_title(); ?>
        </h4>
        <a href="<?php the_permalink(); ?>">
          <?php _e( 'View Squad', 'clanpress_the_award_placement' ); ?>
        </a>
      </li>
    <?php endwhile; ?>
  </ul>
<?php else: ?>
  <?php _e( 'No squads found.', 'clanpress' ); ?>
<?php endif; ?>
