<?php
/*
** Template Name: Home Page
*/

get_header();

$qPrice = $_GET['property_pricerange'];
$qLoc = $_GET['property_location'];
$qFeat = $_GET['property_features'];
$qType = $_GET['property_type'];

if (!$qPrice && !$qLoc && !$qFeat && !$qType) :

	if (have_posts()) :
		while (have_posts()) : the_post();

			get_template_part('includes/content', 'home-page');

		endwhile;
	endif;

else :

	$result = searchProperty($qLoc, $qPrice, $qType, $qFeat);

	if (empty($result)) {
		$suggest = otherSuggestions($qLoc, $qPrice, $qType);

		if (empty($suggest)) {
			$suggest = otherSuggestions($qLoc, null, $qType);
		}

		if (empty($suggest) && $qType != 'rent-events') {
			$suggest = otherSuggestions($qLoc, null, null);
		} elseif (empty($suggest) && $qType == 'rent-events') {
			$suggest = otherSuggestions(null, null, $qType);
		}
	}

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

	<!-- HERO IMAGE -->
<?php include 'includes/hero/properties.php'; ?>

<div class="container blog">
	<div class="row">
		<div class="col-md-9">
			<?php
				if ($result) :
					foreach ($result as $res) {
						if (has_post_thumbnail($res)) {
							$image = wp_get_attachment_image_src(get_post_thumbnail_id($res), 'results');
						}
						$priceRange = get_post_meta($res, 'price_range', true);
			?>
						<div class="row blogList" id="searchList">
							<div class="col-md-4">
								<img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title($res); ?>">
							</div>
							<div class="col-md-8">
								<h2><a href="<?php echo get_the_permalink($res); ?>"><?php echo get_the_title($res); ?></a></h2>
								<span id="priceInSearch"><?php if ($priceRange) : echo 'Price: PHP '.$priceRange; endif; ?></span>
								<p><?php echo get_the_content_by_id($res); ?></p>
								<a href="<?php echo get_the_permalink($res); ?>" class="viewBtn">VIEW PROPERTY</a>
							</div>
						</div>
			<?php
					}
				else :
			?>
				<h2>What you’re looking for may not be available yet.</h2>
				<h3>You may want to try looking through these properties:</h3>
				<hr>
			<?php
					foreach ($suggest as $su) {
						if (has_post_thumbnail($su)) {
							$image = wp_get_attachment_image_src(get_post_thumbnail_id($su), 'results');
						}
						$priceRange = get_post_meta($su, 'price_range', true);
				?>
						<div class="row blogList" id="searchList">
							<div class="col-md-4">
								<img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title($su); ?>">
							</div>
							<div class="col-md-8">
								<h2><a href="<?php echo get_the_permalink($su); ?>"><?php echo get_the_title($su); ?></a></h2>
								<span id="priceInSearch"><?php if ($priceRange) : echo 'Price: PHP '.$priceRange; endif; ?></span>
								<p><?php echo get_the_content_by_id($su); ?></p>
								<a href="<?php echo get_the_permalink($su); ?>" class="viewBtn">VIEW PROPERTY</a>
							</div>
						</div>
				<?php
					}
				?>
			<?php
				endif;
			?>
		</div>

		<div class="col-md-3 searchPage">
			<section class="propertySearch">
					    		
    			<h2>PROPERTY SEARCH</h2>
    			
    			<form id="propertySearch" role="search" method="get" class="search-form" action="<?php echo get_site_url(); ?>">	
					<div class="form-group">
						<label for="">SELECT PRICE RANGE</label>
						<select class="form-control" id="price">
							<option value="">---</option>
							<option value="let-10k-19k" <?php if (isset($tempPrice) && $tempPrice == 'let-10k-19k') : echo 'selected'; endif; ?>>10k - 19k</option>
							<option value="let-20k-30k" <?php if (isset($tempPrice) && $tempPrice == 'let-20k-30k') : echo 'selected'; endif; ?>>20k - 30k</option>
							<option value="let-31k-40k" <?php if (isset($tempPrice) && $tempPrice == 'let-31k-40k') : echo 'selected'; endif; ?>>31k - 40k</option>
							<option value="let-41k" <?php if (isset($tempPrice) && $tempPrice == 'let-41k') : echo 'selected'; endif; ?>>41k+</option>
							<option value="65k" <?php if (isset($tempPrice) && $tempPrice == '65k') : echo 'selected'; endif; ?>>65k</option>
							<option value="90k" <?php if (isset($tempPrice) && $tempPrice == '90k') : echo 'selected'; endif; ?>>90k</option>
						</select>
					</div>

					<div class="form-group">
						<label for="">SELECT LOCATION</label>
						<select class="form-control" id="location">
							<option value="">---</option>
							<?php
								foreach ($terms as $term) {
							?>
									<option value="rent-<?php echo strtolower($term); ?>" <?php if (isset($tempLocation) && $tempLocation == 'rent-'.strtolower($term)) : echo 'selected'; endif; ?> ><?php echo $term; ?></option>
							<?php
								}
							?>
						</select>
					</div>

					<div class="form-group">
						<label for="">SELECT PROPERTY TYPE</label>
						<select class="form-control" id="propType">
							<option value="">---</option>
							<option value="rent-condominium" <?php if (isset($tempType) && $tempType == 'rent-condominium') : echo 'selected'; endif; ?>>Condominium</option>
							<option value="rent-subdivision" <?php if (isset($tempType) && $tempType == 'rent-subdivision') : echo 'selected'; endif; ?>>Subdivision</option>
							<option value="rent-commercial" <?php if (isset($tempType) && $tempType == 'rent-commercial') : echo 'selected'; endif; ?>>Commercial</option>
							<option value="rent-events" <?php if (isset($tempType) && $tempType == 'rent-events') : echo 'selected'; endif; ?>>Events Place</option>
						</select>
					</div>

					<div class="form-group" id="brCondoSub" <?php if (isset($tempType) && ($tempType == 'rent-condominium' || $tempType == 'rent-subdivision')) : echo 'style="display: block;"'; endif; ?>>
						<label for="">SELECT NUMBER OF BEDROOMS</label>
						<select class="form-control" id="br">
							<option value="">---</option>
							<option value="rent-studio" <?php if (isset($tempFeatures) && strpos($tempFeatures, 'rent-studio') !== false) : echo 'selected'; endif; ?>>Studio</option>
							<option value="rent-1br" <?php if (isset($tempFeatures) && strpos($tempFeatures, 'rent-1br') !== false) : echo 'selected'; endif; ?>>1 Bedroom</option>
							<option value="let-2br" <?php if (isset($tempFeatures) && strpos($tempFeatures, 'let-2br') !== false) : echo 'selected'; endif; ?>>2 Bedrooms</option>
							<option value="lease-3brtandem" <?php if (isset($tempFeatures) && strpos($tempFeatures, 'lease-3brtandem') !== false) : echo 'selected'; endif; ?>>3 Bedrooms</option>
							<option value="4-bedroom" <?php if (isset($tempFeatures) && strpos($tempFeatures, '4-bedroom') !== false) : echo 'selected'; endif; ?>>4 Bedrooms</option>
							<option value="6-bedroom" <?php if (isset($tempFeatures) && strpos($tempFeatures, '6-bedroom') !== false) : echo 'selected'; endif; ?>>6 Bedrooms</option>
						</select>
					</div>

					<div class="form-group" id="featCondoSub" <?php if (isset($tempType) && ($tempType == 'rent-condominium' || $tempType == 'rent-subdivision')) : echo 'style="display: block;"'; endif; ?>>
						<label for="">SELECT PROPERTY FEATURE</label>
						<select class="form-control" id="feature">
							<option value="">---</option>
							<option value="rent-bare" <?php if (isset($tempFeatures) && strpos($tempFeatures, 'rent-bare') !== false) : echo 'selected'; endif; ?>>Bare</option>
							<option value="let-semi" <?php if (isset($tempFeatures) && strpos($tempFeatures, 'let-semi') !== false) : echo 'selected'; endif; ?>>Semi-Furnished</option>
							<option value="lease-full" <?php if (isset($tempFeatures) && strpos($tempFeatures, 'lease-full') !== false) : echo 'selected'; endif; ?>>Fully Furnished</option>
						</select>
					</div>
				  
					<button type="submit" class="btn btn-default" id="submitSearch">SEARCH NOW</button>  

				</form>

			</section>
		</div>
	</div>
</div>

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

<?php

endif;
get_footer();
?>