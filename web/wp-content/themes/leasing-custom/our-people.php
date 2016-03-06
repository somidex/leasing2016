<?php

/*
** Template Name: Our People
*/

get_header();

$detect = new Mobile_Detect();

if (have_posts()) :

$termArgs = array(
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'hide_empty' => true
);

$terms = get_terms('location', $termArgs);

	while (have_posts()) : the_post();
?>

	<?php include 'includes/hero/pages.php'; ?>

	<div class="container propertyFeatures">
		<div class="row">
			<div class="col-md-12">
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</div>
		</div>

		<?php
			$peopleArgs = array(
				'post_type' => 'member',
				'posts_per_page' => -1,
				'orderby' => 'menu_order',
				'order' => 'ASC'
			);

			$people = new WP_Query($peopleArgs);

			if ($people->have_posts()) :
		?>
				<div class="row">
					<?php
						while ($people->have_posts()) : $people->the_post();
							if (has_post_thumbnail()) {
								$img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
							} else {
								$img[0] = get_template_directory_uri().'/img/no-pic.jpg';
							}
							$position = get_post_meta($post->ID, 'position', true);
					?>
						<div class="col-md-3 memberPhoto">
							<img src="<?php echo $img[0]; ?>" alt="<?php echo get_the_title(); ?>">
							<span class="name"><?php the_title(); ?></span>
							<span class="position"><?php echo $position; ?></span>
						</div>
					<?php endwhile; ?>
				</div>
		<?php
			endif;
			wp_reset_postdata();
		?>
	</div>

	<div class="reviewWrap">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="locationLinks">
						<?php
							for ($i = 0; $i < count($terms); $i++) {
								$slug = get_term_by('name', $terms[$i], 'location', ARRAY_A);
						?>
								<li>
									<a href="<?php echo get_site_url().'/'.$slug['slug']; ?>/"><?php echo $terms[$i]; ?></a>
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
	endwhile;
endif;

get_footer();
?>