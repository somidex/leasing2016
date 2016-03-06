<div class="reviewWrap">
	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<span>Exclusivity in the city</span>
				<h3>OUR PROPERTY LOCATIONS</h3>
			</div>

			<div class="col-md-12 arrowContainer">
				<img src="<?php echo get_template_directory_uri(); ?>/img/blue-arrow.png" alt="Blue Arrow" class="arrow">
			</div>

		</div>
	</div>
</div>

<div id="propertyMaps"></div>

<?php
	$args = array(
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'hide_empty' => true
	);

	$terms = get_terms('location', $args);
?>

<div class="reviewWrap">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="locationLinks">
					<?php
						foreach ($terms as $term) {
					?>
							<li>
								<a href="<?php echo get_site_url().'/'.$term->slug; ?>/"><?php echo $term->name; ?></a>
							</li>
					<?php
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>