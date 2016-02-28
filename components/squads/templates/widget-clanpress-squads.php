<?php
/**
 * Template of the squads widget.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */
?>
<?php if ( bp_has_groups( 'type=alphabetical&max=' . $num_items ) ): ?>
  <ul class="clanpress_widget__items">
    <?php while(bp_groups()) : bp_the_group(); ?>
      <li class="clanpress_widget__item">
        <span class="clanpress_widget__thumbnail">
          <?php bp_group_avatar( 'type=thumb&width=100&height=100' ) ?>
        </span>
        <h4 class="clanpress_widget__title">
          <?php bp_group_name(); ?>
        </h4>
        <a href="<?php bp_group_permalink(); ?>">
          <?php _e( 'View Squad', 'clanpress' ); ?>
        </a>
      </li>
    <?php endwhile; ?>
  </ul>
<?php else: ?>
  <?php _e( 'No squads found.', 'clanpress' ); ?>
<?php endif; ?>
