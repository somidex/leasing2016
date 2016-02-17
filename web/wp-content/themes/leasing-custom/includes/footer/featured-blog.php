<div class="col-md-8">
	<div class="row">
		<div class="col-md-12">
			<h3>FEATURED BLOG BY DMCI LEASING</h3>
		</div>

		<?php
			$recent_posts = wp_get_recent_posts(array('numberposts' => 1, 'orderby' => 'post_date', 'order' => 'DESC'));

			$recentArgs = array(
				'post_type' => 'post',
				'posts_per_page' => 1,
				'order' => DESC
			);

			$recent = new WP_Query($recentArgs);

			if ($recent->have_posts()) :
				while ($recent->have_posts()) : $recent->the_post(); 

					if (has_post_thumbnail()) {
						$tb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
					}
		?>
					<div class="col-md-6">
						<?php if ($tb[0]) : ?>
							<img src="<?php echo $tb[0] ?>" alt="<?php echo get_the_title(); ?>">
						<?php else : ?>
							<?php getImage(1); ?>
						<?php endif; ?>
						<a href="<?php echo get_permalink(get_the_ID()); ?>"><h4><?php the_title(); ?></h4></a>
						<p><?php
							$trimmed_content = wp_trim_words(get_the_content_by_id(get_the_ID()), 25, '<a href="'. get_permalink() .'"> ...Read More</a>');
							echo $trimmed_content;
						?><p>
					</div>
		<?php
				endwhile;
			else :
		?>
				<div class="col-md-6">
					<p>No Featured Blog Posts Yet.</p>
				</div>
		<?php
			endif;
			wp_reset_postdata();
		?>
		

		<div class="col-md-6 footerBlogList">
			<?php
				$articles = wp_get_recent_posts(array('numberposts' => 4, 'offset' => 3, 'orderby' => 'post_date', 'order' => 'DESC'));

				if (!empty($articles)) :
					echo '<ul>';
						foreach ($articles as $article) {
			?>
							<li>
								<a href="<?php echo get_the_permalink($article['ID']); ?>"><h4><?php echo $article['post_title'] ?></h4></a>
							</li>
			<?php
						}
			?>

			<?php
					echo '</ul>';
				else :
					echo '<p>No Other Recent Posts to Show.</p>';
				endif;
			?>
		</div>

	</div>	
</div>