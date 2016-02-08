<?php
/**
 * @file
 * Template of the latest awards widget.
 *
 * @author Christian Hanne <support @aureola.codes>
 * @package Clanpress
 */
?>
<?php if ( have_posts() ): ?>
  <ul class="widget_clanpress__items">
    <?php while(have_posts()) : the_post(); ?>
      <li class="widget_clanpress__item">
        <div class="widget_clanpress__thumbnail">
          <?php the_post_thumbnail( 'thumbnail' ); ?>
        </div>
        <div class="widget_clanpress__post">
          <h4 class="widget_clanpress__title">
            <a href="<?php the_permalink(); ?>">
              <?php the_title(); ?>
            </a>
          </h4>
          <div class="widget_clanpress__date">
            <?php the_date(); ?>
          </div>
          <div class="widget_clanpress__comments">
            <a href="<?php comments_link(); ?>">
              <?php comments_number(); ?>
            </a>
          </div>
          <div class="widget_clanpress__ranking">
            <?php _e( 'Ranking:', 'clanpress' ); ?>
            <?php clanpress_the_award_placement(); ?>
          </div>
        </div>
      </li>
    <?php endwhile; ?>
  </ul>
<?php else: ?>
  <?php _e( 'No awards found.', 'clanpress' ); ?>
<?php endif; ?>
