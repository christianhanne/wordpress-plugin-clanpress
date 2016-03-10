<?php
/**
 * Template of the teamspeak viewer widget.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Teamspeak\Templates
 */
?>
<div class="teamspeak-viewer">
  <div class="teamspeak-viewer__element" data-ts3-address="<?php echo $address; ?>" data-ts3-port="<?php echo $port; ?>"></div>
  <a href="<?php clanpress_the_ts3_connect_url($address, $port); ?>" class="teamspeak-viewer__link">
    <?php _e( 'Connect', 'clanpress' ); ?>
  </a>
</div>
