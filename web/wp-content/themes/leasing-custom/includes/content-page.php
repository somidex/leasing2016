<?php

$termArgs = array(
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'hide_empty' => true
);

$terms = get_terms('location', $termArgs);
?>

<?php include 'hero/pages.php'; ?>

<div class="container propertyPage">
	<div class="row">
		<div class="col-md-12">
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</div>
	</div>
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