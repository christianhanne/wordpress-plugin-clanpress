<?php
/**
 * Displays an archive representation of a sponsor post.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Sponsors\Templates
 */
?>
<article class="clanpress_post clanpress_post--archive clanpress_post--sponsor">
  <h2 class="clanpress_post__title">
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
  </h2>
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
