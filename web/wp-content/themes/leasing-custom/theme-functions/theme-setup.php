<?php

/*
** All setups needed for the Theme - Menu, Widgets, etc.
*/

include 'wp_bootstrap_navwalker.php';

function leasing_setup() {

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support('automatic-feed-links');

	// Enable support for Post Thumbnails. Declare other sizes below
	add_theme_support('post-thumbnails');
	add_image_size('brand-logo', 150, 60, true);
	add_image_size('hero-image', 1250, 715, true);
	add_image_size('image-text', 420, 385, true);
	add_image_size('feat-property', 780, 520, true);
	add_image_size('hook-bg', 2088, 1438, true);
	add_image_size('results', 525, 300, true);

	register_nav_menus( 
		array(
			'primary'   => __( 'Header Navigation', 'propelrr' ),
			'footer' => __( 'Footer Navigation', 'propelrr' ),
			'mobile'	=> __( 'Mobile Navigation', 'propelrr' )
		)
	);

	// Add theme support for HTML5 markup
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	));
}

add_action('after_setup_theme', 'leasing_setup');

function leasing_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	$mimes['pdf'] = 'application/pdf';
	return $mimes;
}
add_filter( 'upload_mimes', 'leasing_mime_types' );
?>