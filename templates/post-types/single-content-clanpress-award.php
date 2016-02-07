<?php
/**
 * @file
 * Displays a single page representation of an award post.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */
?>
<article class="clanpress_post clanpress_post--single clanpress_post--award">
  <h1 class="clanpress_post__title">
    <?php _e( 'Award:', 'clanpress' ); ?> <?php the_title(); ?>
  </h1>
  <div class="clanpress_post__image">
    <?php the_post_thumbnail( 'medium' ); ?>
  </div>
  <div class="clanpress_post__description">
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
        <a href="<?php comments_link(); ?>">
          <?php comments_number(); ?>
        </a>
      </li>
    </ul>
  </div>
  <div class="clanpress_post__content">
    <?php the_content(); ?>
  </div>
</article>
