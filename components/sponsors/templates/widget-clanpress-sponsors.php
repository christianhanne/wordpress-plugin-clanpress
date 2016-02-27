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
					<?php if ( has_post_thumbnail() ): ?>
            <?php the_post_thumbnail( 'thumbnail' ); ?>
					<?php else: ?>
            <?php the_title(); ?>
					<?php endif; ?>
        </a>
      </li>
    <?php endwhile; ?>
  </ul>
<?php else: ?>
  <?php _e( 'No sponsors found.', 'clanpress' ); ?>
<?php endif; ?>
