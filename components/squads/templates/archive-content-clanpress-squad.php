<?php
/**
 * Displays an archive representation of a single squad post.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */
?>
<article class="clanpress_post clanpress_post--archive clanpress_post--squad">
  <div class="clanpress_post__image">
    <?php the_post_thumbnail( 'medium' ); ?>
  </div>
  <div class="clanpress_post__description">
    <h2 class="clanpress_post__title">
      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?> (<?php echo clanpress_the_squad_type(); ?>)
      </a>
    </h2>
    <div class="clanpress_post__games">
      <?php echo _e('Squad is playing the following <strong>games</strong>:', 'clanpress'); ?>
      <?php clanpress_the_squad_games_short(); ?>
    </div>
    <div class="clanpress_post__members_count">
      <strong><?php _e( 'Number of members:', 'clanpress' ); ?></strong>
      <?php clanpress_the_squad_members_count(); ?>
    </div>
    <div class="clanpress_post__excerpt">
      <h3><?php _e( 'Description:', 'clanpress' ); ?></h3>
      <?php the_excerpt(); ?>
    </div>
    <ul class="clanpress_post__links">
      <li class="clanpress_post__link">
        <?php clanpress_the_squad_awards_link(); ?>
      </li>
      <li class="clanpress_post__link">
        <?php clanpress_the_squad_matches_link(); ?>
      </li>
    </ul>
  </div>
</article>
