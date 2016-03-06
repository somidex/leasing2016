<?php
	$cats = wp_get_post_categories(get_the_ID());

	foreach($cats as $c){
		$cat = get_category( $c );
		$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug, 'parentId' => $cat->parent, 'catId' => $cat->cat_ID );
	}

	$authorId = get_the_author_meta('ID');
?>

<div class="container blog" itemscope itemtype="https://schema.org/Article">
	<?php if ( function_exists('yoast_breadcrumb') ) {
	yoast_breadcrumb('<p id="breadcrumbs">','</p>');
	} ?>
	<div class="row">
		<div class="col-md-9">
			<div class="row">

				<div class="col-md-12 article" itemprop="articleBody">
					<h1 itemprop="headline"><?php the_title(); ?></h1>
					<p id="articleMeta">
						by <a href="<?php echo get_author_posts_url($authorId); ?>">
							<span class="author" itemprop="author"><?php the_author(); ?></span>
						</a>
						on <span class="date" itemprop="datePublished"><?php echo get_the_date(); ?></span> | 
						<?php if (!empty($cats)) : ?>
							Categories: 
							<?php for ($i = 0; $i < count($cats); $i++) { ?>
								<a href="<?php echo get_category_link($cats[$i]['catId']); ?>"><?php echo $cats[$i]['name']; ?></a><?php if ($i < count($cats) - 1 && $cats[$i]['name'] ) { echo ', '; } ?>
							<?php } ?>
						<?php endif; ?>
					</p>
					
					<?php the_content(); ?>

					<?php leasing_post_nav(); ?>
				</div>

				<div class="col-md-12 blogComments" itemprop="comment">
					<h2>COMMENTS</h2>

					<div class="row">
						<div class="col-md-6">
							<?php 
								$fields = array(
									'author' => '<div class="form-group"><label for="name">Name</label><input type="text" class="form-control" id="author" placeholder="" name="author" aria-required="true"></div>',
									'email' => '<div class="form-group"><label for="name">Name</label><input type="text" class="form-control" id="email" placeholder="" name="email" aria-required="true"></div>'
								);
								$args = array(
									'class_submit' => 'commentBtn',
									'comment_field' => '<div class="form-group"><textarea class="form-control" rows="3" placeholder="Leave us a message..." id="comment" name="comment" aria-required="true"></textarea></div>',
									'fields' => $fields,
									'label_submit' => __( 'SUBMIT' ),
									'title_reply' => ''
								);
								comment_form($args);
							?>
						</div>
					</div>
				</div>

			</div>
		</div>

		<?php include 'blog/sidebar.php'; ?>
	</div>
</div>