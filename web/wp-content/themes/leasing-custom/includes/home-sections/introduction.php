<?php
	$phone = get_option('website_general_settings_phone_number');
	$detect = new Mobile_Detect();
?>

<div class="row">
	<div class="col-md-12 introText">

		<?php the_content(); ?>

		<a href="tel:+6324037368">CALL US AT (02) 403-7368</a>
	</div>
</div>