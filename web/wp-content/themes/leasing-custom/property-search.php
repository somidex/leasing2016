<?php

/*
** Template Name: Property Search
*/

get_header();

global $wpdb;

$tempPrice = $_GET['property_price'];
$location = $_GET['property_location'];
$type = $_GET['property_type'];
$feature = $_GET['property_feature'];
$result = array();

$priceUnits = array();
if (isset($tempPrice)) {
	$temp = explode('-', $tempPrice);
	$price['min'] = $temp[0];
	$price['max'] = $temp[1];

	$wpdb->query("
		SELECT `post_id`
		FROM $wpdb->postmeta
		WHERE `meta_key` = 'price_range';
	");
	
	foreach($wpdb->last_result as $v){
		$prRange = str_replace('K/mo', '', get_post_meta($v->post_id, 'price_range', true));

		if (($prRange*1000) >= $price['min'] && ($prRange*1000) <= $price['max']) {
			array_push($priceUnits, $v->post_id);
		}
	};

	$result = $priceUnits;
}

$locUnits = array();
if (isset($location)) {

	$wpdb->query("
		SELECT `term_id`
		FROM $wpdb->terms
		WHERE `name` = '".$location."';
	");

	$lR = $wpdb->last_result;
	$locId = $lR[0]->term_id;

	$wpdb->query("
		SELECT `post_id`
		FROM $wpdb->postmeta
		WHERE `meta_key` = 'location'
		AND `meta_value` LIKE '%".$locId."%';
	");
	foreach($wpdb->last_result as $v){
		array_push($locUnits, $v->post_id);
	};
	
	if (!empty($result)) {
		$result = array_intersect($result, $locUnits);
	} else {
		if (!isset($price)) {
			$result = $locUnits;
		}
	}
}

$typeUnits = array();
if (isset($type)) {
	$wpdb->query("
		SELECT `id`
		FROM $wpdb->posts
		WHERE `post_title` LIKE '%".$type."%'
		AND `post_type` = 'property_unit'
		AND `post_status` = 'publish';
	");
	foreach($wpdb->last_result as $v){
		array_push($typeUnits, $v->id);
	};
	
	if (!empty($result)) {
		$result = array_intersect($result, $typeUnits);
	} else {
		if (!isset($price) && !isset($location)) {
			$result = $typeUnits;
		}
	}
}

$featureUnits = array();
if (isset($feature)) {
	$wpdb->query("
		SELECT `id`
		FROM $wpdb->posts
		WHERE `post_title` LIKE '%".$feature."%'
		AND `post_type` = 'property_unit'
		AND `post_status` = 'publish';
	");
	foreach($wpdb->last_result as $v){
		array_push($featureUnits, $v->id);
	};
	
	if (!empty($result)) {
		$result = array_intersect($result, $featureUnits);
	} else {
		if (!isset($price) && !isset($location) && !isset($type)) {
			$result = $featureUnits;
		}
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
				<h1>No Results Found.</h1>
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
							<option value="10000-20000">10-20K</option>
							<option value="21000-30000">21-30K</option>
							<option value="31000-20000">31-40K</option>
							<option value="41000-20000">41-70K</option>
							<option value="71000">71K+</option>
						</select>
					</div>

					<div class="form-group">
						<label for="">SELECT LOCATION</label>
						<select class="form-control" id="location">
							<option value="">---</option>
							<?php
								foreach ($terms as $term) {
							?>
									<option value="<?php echo $term; ?>"><?php echo $term; ?></option>
							<?php
								}
							?>
						</select>
					</div>

					<div class="form-group">
						<label for="">SELECT UNIT TYPE</label>
						<select class="form-control" id="type">
							<option value="">---</option>
							<option value="Studio">Studio</option>
							<option value="1 Bedroom">1 Bedroom</option>
							<option value="2 Bedrooms">2 Bedrooms</option>
							<option value="3 Bedrooms">3 Bedrooms</option>
							<option value="4 Bedrooms">4 Bedrooms</option>
							<option value="6 Bedrooms">6 Bedrooms</option>
						</select>
					</div>

					<div class="form-group">
						<label for="">SELECT PROPERTY FEATURE</label>
						<select class="form-control" id="feature">
							<option value="">---</option>
							<option value="Bare">Bare</option>
							<option value="Semi-Furnished">Semi-Furnished</option>
							<option value="Fully Furnished">Fully Furnished</option>
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
								<a href="<?php echo get_site_url().'/location/'.$term->slug; ?>"><?php echo $term->name; ?></a>
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

get_footer();
?>