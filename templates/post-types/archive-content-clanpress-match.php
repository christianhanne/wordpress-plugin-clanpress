<?php
/**
 * @file
 * Displays an archive representation of a match post.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */
?>
<article class="clanpress_post clanpress_post--archive clanpress_post--match">
  <h2 class="clanpress_post__title">
    <a href="<?php the_permalink(); ?>">
      <?php the_title(); ?>
    </a>
  </h2>
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
</article>
