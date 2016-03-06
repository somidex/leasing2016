<!-- Hero Image -->
<?php include 'hero/properties.php'; ?>

<div class="container propertyPage">

	<p id="breadcrumbs"><?php propertyBreadcrumbs(); ?></p>

	<!-- PROPERTY DETAILS -->
	<?php include 'property-sections/details.php'; ?>

	<!-- UNITS -->
	<?php include 'property-sections/units.php'; ?>
</div>

<!-- AMENITIES -->
<?php include 'property-sections/amenities.php'; ?>

<!-- VICINITY -->
<?php include 'property-sections/vicinity.php'; ?>

<!-- FEATURED PROPERTIES -->
<div class="container">
	<div class="row">
		<?php include 'home-sections/featured-properties.php'; ?>
	</div>
</div>

<!-- PROPERTY LOCATIONS -->
<?php include 'property-sections/locations.php'; ?>

<?php
	global $wpdb;

	$heroImageId = get_option('website_general_settings_hero_image');
	$heroImage = wp_get_attachment_image_src($heroImageId[0], 'hero-image');

	$textImageId = get_option('website_general_settings_text_image');
	$textImage = wp_get_attachment_image_src($textImageId[0], 'image-text');

	$heroText = get_option('website_general_settings_hero_image_text');

	$data = array();

	$wpdb->query("
		SELECT `meta_value`
		FROM $wpdb->postmeta
		WHERE `meta_key` = 'price_range'
	");

	foreach($wpdb->last_result as $v){
		array_push($data, $v->meta_value);
	};

	$priceRange = array_unique($data);
	asort($priceRange);

	$wpdb->query("
		SELECT `term_id`
		FROM $wpdb->term_taxonomy
		WHERE `taxonomy` = 'location'
	");

	$terms = array();

	foreach ($wpdb->last_result as $v) {
		$term = get_term_by('id', $v->term_id, 'location', ARRAY_A);
		array_push($terms, $term['name']);
	}
?>

<div class="eventComment">
	<div class="container">
		<div class="row">
			<div class="col-md-12 propSearch">
				<h3>PROPERTY SEARCH</h3>

				<form id="propertySearch" role="search" method="get" class="search-form" action="<?php echo get_site_url(); ?>">	
					<div class="form-group">
						<label for="">SELECT PRICE RANGE</label>
						<select class="form-control" id="price">
							<option value="">---</option>
							<option value="let-10k-19k">10k - 19k</option>
							<option value="let-20k-30k">20k - 30k</option>
							<option value="let-31k-40k">31k - 40k</option>
							<option value="let-41k">41k+</option>
							<option value="65k">65k</option>
							<option value="90k">90k</option>
						</select>
					</div>

					<div class="form-group">
						<label for="">SELECT LOCATION</label>
						<select class="form-control" id="location">
							<option value="">---</option>
							<?php
								foreach ($terms as $term) {
							?>
									<option value="rent-<?php echo strtolower($term); ?>"><?php echo $term; ?></option>
							<?php
								}
							?>
						</select>
					</div>

					<div class="form-group">
						<label for="">SELECT PROPERTY TYPE</label>
						<select class="form-control" id="propType">
							<option value="">---</option>
							<option value="rent-condominium">Condominium</option>
							<option value="rent-subdivision">Subdivision</option>
							<option value="rent-commercial">Commercial</option>
							<option value="rent-events">Events Place</option>
						</select>
					</div>

					<div class="form-group" id="brCondoSub">
						<label for="">SELECT NUMBER OF BEDROOMS</label>
						<select class="form-control" id="br">
							<option value="">---</option>
							<option value="rent-studio">Studio</option>
							<option value="rent-1br">1 Bedroom</option>
							<option value="let-2br">2 Bedrooms</option>
							<option value="lease-3brtandem">3 Bedrooms</option>
							<option value="4-bedroom">4 Bedrooms</option>
							<option value="6-bedroom">6 Bedrooms</option>
						</select>
					</div>

					<div class="form-group" id="featCondoSub">
						<label for="">SELECT PROPERTY FEATURE</label>
						<select class="form-control" id="feature">
							<option value="">---</option>
							<option value="rent-bare">Bare</option>
							<option value="lease-full">Semi-Furnished</option>
							<option value="let-semi">Fully Furnished</option>
						</select>
					</div>
				  
					<button type="submit" class="btn btn-default" id="submitSearch">SEARCH NOW</button>  

				</form>
			</div>
		</div>
	</div>
</div>