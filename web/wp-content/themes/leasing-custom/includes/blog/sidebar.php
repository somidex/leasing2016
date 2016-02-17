<?php
	$args = array(
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'hide_empty' => true
	);

	$terms = get_terms('category', $args);
?>

<div class="col-md-3 side">
	<section>
		<h3>SEARCH</h3>
		<form role="search" method="get" class="search-form" action="<?php echo get_site_url(); ?>">
			<input class="search-field form-control" placeholder="Article, Page or Property" value="" name="s" type="search">
			<input class="search-submit searchBtn" value="FIND NOW" type="submit">
		</form>
	</section>

	<section>
		<h3>RECENT POSTS</h3>
		<?php
			$recent_posts = wp_get_recent_posts(array('numberposts' => 5, 'offset' => 2, 'orderby' => 'post_date', 'order' => 'DESC'));
			foreach($recent_posts as $recent) {
		?>
				<li>
					<a href="<?php echo get_permalink($recent["ID"]); ?>"><?php echo $recent["post_title"]; ?></a>
				</li>
		<?php
			}
		?>
	</section>

	<section>
		<h3>CATEGORIES</h3>
		<ul>
			<?php
				foreach ($terms as $term) {
					if ($term->name != 'Uncategorized') : 
			?>
						<li>
							<a href="<?php echo get_site_url().'/category/'.$term->slug; ?>/"><?php echo $term->name; ?></a>
						</li>
			<?php
					endif;
				}
			?>
		</ul>
	</section>
</div>