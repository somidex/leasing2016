<?php
/*
** Single Article template.
*/

get_header();

if (have_posts()) :
	while (have_posts()) : the_post();
		
		get_template_part('includes/content', 'single');
		
	endwhile;
endif;

get_footer();
?>