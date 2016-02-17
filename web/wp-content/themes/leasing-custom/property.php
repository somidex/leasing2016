<?php
/*
** Template Name: Property Page
*/

get_header();

if (have_posts()) :
	while (have_posts()) : the_post();

		get_template_part('includes/content', 'single-property');

	endwhile;
endif;

get_footer();
?>