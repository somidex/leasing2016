<?php
	if (has_post_thumbnail()) {
		$tb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
	}

	$authorId = get_the_author_meta('ID');
?>

<div class="row blogList">
	<div class="col-md-4">
		<?php if ($tb[0]) : ?>
			<img src="<?php echo $tb[0] ?>" alt="<?php echo get_the_title(); ?>">
		<?php else : ?>
			<?php getImage(1); ?>
		<?php endif; ?>
	</div>
	<div class="col-md-8">
		<h2><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p id="articleMeta">
			by <a href="<?php echo get_author_posts_url($authorId); ?>">
				<span class="author" itemprop="author"><?php the_author(); ?></span>
			</a>
			on <span class="date" itemprop="datePublished"><?php echo get_the_date(); ?></span>
		</p>
		<?php the_excerpt(); ?>
	</div>
</div>