<?php
/**
 * Displays an archive representation of an award post.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */
?>
<article class="clanpress_post clanpress_post--archive clanpress_post--award">
  <div class="clanpress_post__image">
    <?php the_post_thumbnail( 'medium' ); ?>
  </div>
  <div class="clanpress_post__description">
    <h2 class="clanpress_post__title">
      <a href="<?php the_permalink(); ?>">
        <?php _e( 'Award:', 'clanpress' ); ?> <?php the_title(); ?>
      </a>
    </h2>
    <div class="clanpress_post__ranking">
      <strong><?php _e( 'Ranking:', 'clanpress' ); ?></strong>
      <?php clanpress_the_award_placement(); ?>
    </div>
    <div class="clanpress_post__squad">
      <strong><?php _e( 'Squad:', 'clanpress' ); ?></strong>
      <?php clanpress_the_award_squad(); ?>
    </div>
    <div class="clanpress_post__date">
      <strong><?php _e( 'Date:', 'clanpress' ); ?></strong>
      <?php the_date(); ?>
    </div>
    <ul class="clanpress_post__links">
      <li class="clanpress_post__link">
        <a href="<?php the_permalink(); ?>">
          <?php _e( 'More info', 'clanpress' ); ?>
        </a>
      </li>
      <li class="clanpress_post__link">
        <a href="<?php comments_link(); ?>">
          <?php comments_number(); ?>
        </a>
      </li>
    </ul>
  </div>
</article>
