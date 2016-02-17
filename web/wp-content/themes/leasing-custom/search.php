<?php

get_header();

include 'includes/hero/pages.php';
?>

<div class="container blog">
	<div class="row">
		<div class="col-md-9">
			<?php
				if (have_posts()) :
			?>
					<h1>Search Results</h1>
					<?php
						while (have_posts()) : the_post();
					?>
							<?php
								if (has_post_thumbnail()) {
									$tb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
								} else {
									$tb[0] = get_site_url().'/img/blog.jpg';
								}

								$price = get_post_meta(get_the_ID(), 'price_range', true);
							?>

							<div class="row blogList">
								<div class="col-md-4">
									<img src="<?php echo $tb[0] ?>" alt="<?php echo get_the_title(); ?>">
								</div>
								<div class="col-md-8">
									<h2><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<span id="priceInSearch"><?php if ($price) : echo 'Price Range: PHP '.$price; endif; ?></span>
									<?php the_excerpt(); ?>
								</div>
							</div>
					<?php
						endwhile;
					?>
			<?php
				else :
			?>
				<h1>No Results Found.</h1>
			<?php
				endif;
			?>
			<section class="pagination">
				<?php leasing_paging_nav(); ?>
			</section>
		</div>
		<?php include 'includes/blog/sidebar.php'; ?>
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