<?php

/*
** Template Name: Available Spaces
*/

get_header();

if (have_posts()) :
	while (have_posts()) : the_post();

		get_template_part('includes/content', 'commercial-others');

	endwhile;
endif;

get_footer();
?>