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
    <h2 class="clanpress_post__title">
      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?> (<?php echo $squad_type; ?>)
      </a>
    </h2>
    <div class="clanpress_post__games">
      <?php echo _e('Squad is playing the following <strong>games</strong>:', 'clanpress'); ?>
      <?php echo $squad_games_short; ?>
    </div>
    <div class="clanpress_post__members_count">
      <strong><?php _e( 'Number of members:', 'clanpress' ); ?></strong>
      <?php echo $squad_members_count; ?>
    </div>
    <div class="clanpress_post__excerpt">
      <h3><?php _e( 'Description:', 'clanpress' ); ?></h3>
      <?php the_excerpt(); ?>
    </div>
    <ul class="clanpress_post__links">
      <li class="clanpress_post__link">
        <a href="<?php echo $squad_link_awards; ?>">
          <?php _e( 'Squad awards', 'clanpress' ); ?>
        </a>
      </li>
      <li class="clanpress_post__link">
        <a href="<?php echo $squad_link_matches; ?>">
          <?php _e( 'Squad matches', 'clanpress' ); ?>
        </a>
      </li>
    </ul>
  </div>
  <?php foreach ( $squad_members as $member ): ?>
    <div class="clanpress_post__member">
      <div class="clanpress_post__member_image">
        <?php echo bp_core_fetch_avatar(array( 'item_id' => $member->ID, 'type' => 'full' )); ?>
      </div>
      <div class="clanpress_post__member_description">
        <strong><?php echo bp_core_get_userlink( $member->ID ); ?></strong><br />
        <?php _e( 'Role:', 'clanpress' ); ?>
        <?php if ( $member->is_admin || $member->is_mod ): ?>
          <?php _e( 'Leader', 'clanpress' ); ?>
        <?php else: ?>
          <?php _e( 'Member', 'clanpress' ); ?>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>
</article>
