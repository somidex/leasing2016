<?php
/*
** Template Name: Thank You Page
*/
session_start();

//if (isset($_SESSION) && $_SESSION['thank-you'] != "") :

get_header();

if (have_posts()) :
	while (have_posts()) : the_post();
?>
		<div class="container">
			<div class="row">
				<div class="col-md-12 error">
					<p><?php the_title(); ?>!<br /><?php echo get_the_content(); ?></p>
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
	endwhile;
endif;
get_footer();

/*else :
	$loc = "Location: ".get_site_url();
	header($loc);
endif;

session_destroy();*/
?>