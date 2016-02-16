<?php
/**
 * @file
 * Template of the sponsors widget.
 *
 * @author Christian Hanne <support @aureola.codes>
 * @package Clanpress
 */
?>
<?php if ( have_posts() ): ?>
  <ul class="clanpress_widget__items">
    <?php while(have_posts()) : the_post(); ?>
      <li class="clanpress_widget__item">
        <a href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail( 'thumbnail' ); ?>
        </a>
      </li>
    <?php endwhile; ?>
  </ul>
<?php else: ?>
  <?php _e( 'No sponsors found.', 'clanpress' ); ?>
<?php endif; ?>
