<?php if (have_posts()) : ?>
		<div class="container locationProperties">
			<div class="row propertyList">

			<?php
				$i = 0;
				while (have_posts()): the_post();
					if (has_post_thumbnail()) {
						$heroImage = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
					} else {
						$heroImage[0] = get_template_directory_uri().'/img/avb-view.jpg';
					}
			?>

			<?php if ($i > 0) : ?>
				<div class="row propertyList">
			<?php endif; ?>

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
<?php endif;?>