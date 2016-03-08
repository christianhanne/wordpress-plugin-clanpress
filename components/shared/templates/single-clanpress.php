<?php
/**
 * Template for single clanpress posts.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Shared\Templates
 * @filesource
 */

get_header();

while ( have_posts() ) : the_post();
  clanpress_content_template( 'single' );
  if ( comments_open() || get_comments_number() ) {
  	comments_template();
  }
endwhile;

get_sidebar();
get_footer();
