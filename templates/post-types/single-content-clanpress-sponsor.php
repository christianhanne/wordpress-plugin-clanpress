<?php
/**
 * @file
 * Displays an archive representation of a sponsor post.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */
?>
<article class="clanpress_post clanpress_post--archive clanpress_post--sponsor">
  <h1 class="clanpress_post__title">
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
  </h1>
  <div class="clanpress_post__image">
    <?php the_post_thumbnail( 'full' ); ?>
  </div>
  <div class="clanpress_post__description">
    <?php the_content(); ?>
  </div>
  <ul class="clanpress_post__links">
    <li class="clanpress_post__link">
      <a href="<?php echo $sponsor_link; ?>">
        <?php _e( 'To the sponsor', 'clanpress' ); ?>
      </a>
    </li>
  </ul>
</article>
