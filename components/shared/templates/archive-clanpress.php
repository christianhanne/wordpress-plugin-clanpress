<?php
/**
 * Template for clanpress post archives.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

get_header();

?><h1><?php post_type_archive_title(); ?></h1><?php

if (have_posts()) :
  while(have_posts()) : the_post();
    clanpress_content_template( 'archive' );
  endwhile;
endif;

get_sidebar();
get_footer();
