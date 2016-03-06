<?php

/*
** Template Name: Payment Page
*/

get_header();

if (have_posts()) :
	while (have_posts()) : the_post();
		get_template_part('includes/content','payment');
	endwhile;
endif;

get_footer('no-others');
?>