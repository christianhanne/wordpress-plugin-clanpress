<?php
/**
 * @file
 * Template of the social media widget.
 *
 * @author Christian Hanne <support @aureola.codes>
 * @package Clanpress
 */
?>
<ul class="clanpress_widget__items">
  <?php foreach ($links as $key => $link): ?>
    <li class="clanpress_widget__item clanpress_widget__item--<?php echo $key; ?>">
      <a href="<?php echo $link['href']; ?>"><?php echo $link['title']; ?></a>
    </li>
  <?php endforeach; ?>
</ul>
