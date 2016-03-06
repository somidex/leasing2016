<?php

/*
** Template Name: Contact Us
*/

get_header();

if (have_posts()) :
	while (have_posts()) : the_post();

		get_template_part('includes/content', 'contact');

	endwhile;
endif;

get_footer();
?>