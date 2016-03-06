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

	$tempPrice = $_GET['property_pricerange'];
	$tempLocation = $_GET['property_location'];
	$tempFeatures = $_GET['property_features'];
	$tempType = $_GET['property_type'];
?>

<div class="heroWrap properties" style="background: url(<?php echo $heroImage[0]; ?>) no-repeat fixed 0% 0% / cover transparent;" itemscope itemtype="http://schema.org/WebPageElement">
	<div class="overlay">
	</div>
	<div class="container" itemprop="headline">

		<div class="row col-md-12">
			<?php if (is_archive()) : ?>
				<?php if (is_tax('location')) : ?>
					<h1>PROPERTIES FOR RENT IN <?php single_cat_title(); ?></h1>
				<?php else : ?>
					<h1><?php single_cat_title(); ?></h1>
				<?php endif; ?>
			<?php else : ?>
				<?php if (!$tempPrice && !$tempLocation && !$tempFeatures && !$tempType) : ?>
					<h1><?php the_title(); ?></h1>
				<?php else : ?>
					<?php
						if ($tempType == 'rent-commercial') :
							echo "<h1>COMMERCIAL SPACES FOR LEASE</h1>";
						elseif ($tempType == 'rent-events') :
							echo "<h1>EVENTS PLACES FOR RENT</h1>";
						else :
							echo "<h1>PROPERTIES FOR LEASE BY DMCI HOMES LEASING</h1>";
						endif;
					?>
				<?php endif; ?>
			<?php endif; ?>
		</div>

	</div>
</div>