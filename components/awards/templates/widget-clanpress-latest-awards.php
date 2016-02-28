<?php
/**
 * Template of the latest awards widget.
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
        <div class="clanpress_widget__post">
          <h4 class="clanpress_widget__title">
            <a href="<?php the_permalink(); ?>">
              <?php the_title(); ?>
            </a>
          </h4>
          <div class="clanpress_widget__date">
            <?php the_date(); ?>
          </div>
          <div class="clanpress_widget__comments">
            <a href="<?php comments_link(); ?>">
              <?php comments_number(); ?>
            </a>
          </div>
          <div class="clanpress_widget__ranking">
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
