<?php
/**
 * Template Name: Location Pages
**/

get_header();

if (have_posts()) :
	while (have_posts()) : the_post();
		get_template_part('includes/content', 'locations');
	endwhile;
endif;

get_footer();
?>