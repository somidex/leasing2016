<?php
	$appointText = get_post_meta(get_the_ID(), 'appointment_text', true);
	$appointUrl = get_post_meta(get_the_ID(), 'appointment_page_url', true);
?>

<div class="row">
	<div class="col-md-12 setAppointment">
		<p><?php echo $appointText; ?></p>
		<a href="<?php echo $appointUrl; ?>">SET AN APPONTMENT</a>
	</div>
</div>