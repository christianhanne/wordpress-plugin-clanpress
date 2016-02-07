<?php
/**
 * @file
 * Displays a single page representation of a squad post.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */
?>
<article class="clanpress_post clanpress_post--single clanpress_post--squad">
  <div class="clanpress_post__image">
    <?php the_post_thumbnail( 'medium' ); ?>
  </div>
  <div class="clanpress_post__description">
    <h1 class="clanpress_post__title">
      <?php the_title(); ?> (<?php clanpress_the_squad_type(); ?>)
    </h1>
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
  <?php if (clanpress_have_squad_members()) : ?>
    <?php while(clanpress_have_squad_members()) : clanpress_the_squad_member(); ?>
      <div class="clanpress_post__member">
        <div class="clanpress_post__member_image">
          <?php clanpress_the_squad_member_avatar(); ?>
        </div>
        <div class="clanpress_post__member_description">
          <strong><?php clanpress_the_squad_member_link(); ?></strong><br />
          <?php _e( 'Role:', 'clanpress' ); ?>
          <?php clanpress_the_squad_member_role(); ?>
        </div>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>
</article>
