<?php
	$propLogoId = get_post_meta(get_the_ID(), 'property_logo', true);
	$propLogo = wp_get_attachment_image_src($propLogoId, 'full');

	if (!isset($propLogo) || $propLogo == '') {
		$propLogo[0] = get_template_directory_uri().'/img/logo.png';
	}
?>

<div class="row propertyLogoAndContent">
	<div class="col-md-3">
		<img src="<?php echo $propLogo[0]; ?>" alt="<?php echo get_the_title(); ?> property logo">
	</div>

	<div class="col-md-9">
		<?php the_content(); ?>
	</div>
</div>