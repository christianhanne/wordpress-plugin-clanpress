<?php
/**
 * Template of the squad members widget.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Squads\Templates
 */
?>
<?php if (clanpress_have_squad_members()) : ?>
  <ul class="clanpress_widget__items">
    <?php while(clanpress_have_squad_members()) : clanpress_the_squad_member(); ?>
      <li class="clanpress_widget__item">
        <div class="clanpress_widget__member_image">
          <?php clanpress_the_squad_member_avatar(); ?>
        </div>
        <div class="clanpress_post__member_name">
          <?php clanpress_the_squad_member_link(); ?>
        </div>
      </li>
    <?php endwhile; ?>
  </ul>
<?php endif; ?>
