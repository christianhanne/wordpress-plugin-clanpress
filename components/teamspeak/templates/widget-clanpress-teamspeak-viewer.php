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
<div class="teamspeak-viewer" data-ts3-address="<?php echo $address; ?>" data-ts3-port="<?php echo $port; ?>"></div>
<?php echo clanpress_the_ts3_connect_link($address, $port); ?>
