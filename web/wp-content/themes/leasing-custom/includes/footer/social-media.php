<?php
	$fb = get_option('website_general_settings_facebook_link');
	$gp = get_option('website_general_settings_google_plus_link');
	$tw = get_option('website_general_settings_twitter_link');
?>

<section>
	<h3>SOCIAL MEDIA</h3>

	<?php if (isset($fb)) : ?>
		<a href="<?php echo $fb; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/facebook.jpg" alt="Facebook"></a>
	<?php endif; ?>

	<?php if (isset($gp)) : ?>
		<a href="<?php echo $gp; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/gplus.jpg" alt="Google+"></a>
	<?php endif; ?>

	<?php if (isset($tw)) : ?>
		<a href="<?php echo $tw; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/twitter.jpg" alt="Twitter"></a>
	<?php endif; ?>
</section>