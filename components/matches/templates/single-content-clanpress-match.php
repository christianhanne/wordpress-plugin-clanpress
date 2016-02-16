<?php
/**
 * @file
 * Displays a single plage representation of a match post.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */
?>
<article class="clanpress_post clanpress_post--single clanpress_post--match">
  <h1 class="clanpress_post__title">
    <a href="<?php the_permalink(); ?>">
      <?php the_title(); ?>
    </a>
  </h1>
  <div class="clanpress_post__versus">
    <?php clanpress_the_match_squad_thumbnail( 'thumbnail' ); ?>
    <?php clanpress_the_match_squad(); ?>
    <?php clanpress_the_match_opponent_thumbnail( 'thumbnail' ); ?>
    <?php clanpress_the_match_opponent(); ?>
  </div>
  <div class="clanpress_post__game">
    <?php clanpress_the_match_game(); ?>
  </div>
  <div class="clanpress_post__result">
    <?php clanpress_the_match_result(); ?>
  </div>
  <div class="clanpress_post__date">
    <?php the_date(); ?>
  </div>
  <ul class="clanpress_post__links">
    <li class="clanpress_post__link">
      <?php clanpress_the_match_link(); ?>
    </li>
  </ul>
  <div class="clanpress_post__content">
    <?php the_content(); ?>
  </div>
</article>
