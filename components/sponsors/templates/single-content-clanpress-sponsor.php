<?php
/**
 * Displays a single representation of a sponsor post.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */
?>
<article class="clanpress_post clanpress_post--single clanpress_post--sponsor">
  <h1 class="clanpress_post__title">
    <?php the_title(); ?>
  </h1>
  <div class="clanpress_post__image">
    <?php the_post_thumbnail( 'full' ); ?>
  </div>
  <div class="clanpress_post__description">
    <?php the_content(); ?>
  </div>
  <ul class="clanpress_post__links">
    <li class="clanpress_post__link">
      <?php clanpress_the_sponsor_link(); ?>
    </li>
  </ul>
</article>
