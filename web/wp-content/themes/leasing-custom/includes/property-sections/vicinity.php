<?php
	$directions = get_post_meta(get_the_ID(), 'directions_to_property', true);
?>

<div class="vicinity">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>LOCATION AND VICINITY MAP</h2>
			</div>

			<div class="col-md-12 arrowContainer">
				<img src="<?php echo get_template_directory_uri(); ?>/img/blue-arrow.png" alt="" class="arrow">
			</div>
		</div>
	</div>
</div>

<div id="propertyLocation"></div>

<div class="vicinity">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>DIRECTIONS</h3>
				<?php echo $directions; ?>
			</div>
			
		</div>
	</div>
</div>