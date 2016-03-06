<?php

get_header();

if (have_posts()) :
	while (have_posts()) : the_post();

		get_template_part('includes/content', 'page');

	endwhile;
endif;

get_footer();
?>