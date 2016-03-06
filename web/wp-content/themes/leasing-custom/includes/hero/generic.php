<?php

if (has_post_thumbnail()) {
	$heroImage = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
} else {
	$termId = get_queried_object()->term_id;
	$heroImageId = get_option('location_'.$termId.'_location_hero_image');

	if (isset($heroImageId) && $heroImageId != "") :
		$heroImage = wp_get_attachment_image_src($heroImageId, 'full');
	else :
		$heroImage[0] = get_template_directory_uri().'/img/dmci-leasing-lifestyle.jpg';
	endif;
}

?>

<div class="heroWrap properties" style="background: url(<?php echo $heroImage[0]; ?>) no-repeat fixed 0% 0% / cover transparent;" itemscope itemtype="http://schema.org/WebPageElement">
	<div class="overlay">
	</div>
	<div class="container" itemprop="headline">

		<div class="row col-md-12">
			<h1><?php the_title(); ?></h1>
		</div>

	</div>
</div>