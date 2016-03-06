<?php
	global $wpdb;

	$title = get_the_title();
	
	$locArgs = array(
		'post_type' => 'page',
		'posts_per_page' => -1,
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => '_wp_page_template',
				'value' => 'property.php',
				'compare' => '='
			),
			array(
				'key' => 'property_location',
				'value' => $title,
				'compare' => 'LIKE'
			),
		),
		'orderby' => 'menu_order',
		'order' => 'ASC'
	);
	$loc = new WP_Query($locArgs);

	if ($loc->have_posts()) :
?>
		<div class="container locationProperties">
<?php
			while ($loc->have_posts()) : $loc->the_post();
				if (has_post_thumbnail()) {
					$heroImage = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
				} else {
					$heroImage[0] = get_template_directory_uri().'/img/avb-view.jpg';
				}
?>
			
				<div class="row propertyList">

					<div class="col-md-6">
						<img src="<?php echo $heroImage[0]; ?>" alt="<?php echo get_the_title(); ?>">
					</div>

					<div class="col-md-6">
						<h3><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php echo the_excerpt(); ?>
						<a href="<?php echo get_the_permalink(); ?>" class="viewBtn">VIEW PROPERTY</a>
					</div>
				</div>
<?php
			$i++;
			endwhile;
?>
		</div>
<?php
	endif;
	wp_reset_postdata();
?>