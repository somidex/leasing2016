<?php
/*
** Default template.
*/

get_header();

include 'includes/hero/pages.php';

if (have_posts()) :
?>
	<div class="container blog">
		<?php if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		} ?>
		<div class="row">
			<div class="col-md-9">
				<h1>BLOG BY DMCI LEASING</h1>
				<?php
					while (have_posts()) : the_post();
						get_template_part('includes/content');
					endwhile;
				?>
				<section class="pagination">
					<?php leasing_paging_nav(); ?>
				</section>
			</div>
			<?php include 'includes/blog/sidebar.php'; ?>
		</div>
	</div>
<?php
endif;

get_footer();
?>