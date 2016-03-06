<?php

/*
** Template Name: Parking Application
*/

get_header();

if (have_posts()) :
	while (have_posts()) : the_post();
		get_template_part('includes/content','parking');
	endwhile;
endif;

get_footer();
?>