<?php

get_header();
?>

<div class="container">
	<div class="row">
		<div class="col-md-12 error">
			<h1>404</h1>
			<p>PAGE NOT FOUND</p>
			<a href="<?php echo get_site_url(); ?>">RETURN TO HOMEPAGE</a>
		</div>
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
								<a href="<?php echo get_site_url().'/'.$term->slug; ?>"><?php echo $term->name; ?></a>
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