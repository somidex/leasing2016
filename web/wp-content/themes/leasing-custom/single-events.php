<?php

get_header();

include 'includes/hero/properties.php';

if (have_posts()) :
	while(have_posts()) : the_post();
		get_template_part('includes/content', 'single-events_place');
	endwhile;
endif;

get_footer();
?>