<?php

/*
** Template Name: Enroll Unit
*/

get_header();

$detect = new Mobile_Detect();

if (have_posts()) :

$termArgs = array(
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'hide_empty' => true
);

$terms = get_terms('location', $termArgs);

	while (have_posts()) : the_post();
?>

	<?php include 'includes/hero/pages.php'; ?>

	<div class="container propertyFeatures">
		<div class="row">

			<div class="col-md-12">
				<h1><?php the_title(); ?></h1>
			</div>

			<div class="col-md-12 gallery" id="processCarousel">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

					<?php if (!$detect->isMobile()) : ?>

						<div class="carousel-inner" role="listbox">

							<div class="item active">
								<div class="col-md-4 col-sm-4">
									<span>Step 1</span>
									<img src="<?php echo get_template_directory_uri(); ?>/img/process/step-1.png" alt="Contact Leasing Services Department">
									<h2>CONTACT</h2>
									<p>Unit owner contacts Leasing Department (+632-403-7368) to enlist their unit under Leasing Program.</p>
								</div>
								<div class="col-md-4 col-sm-4">
									<span>Step 2</span>
									<img src="<?php echo get_template_directory_uri(); ?>/img/process/step-2.png" alt="Fill out forms">
									<h2>FILL OUT</h2>
									<p>Unit owner fills out and transmits the enrolment forms. (see buttons below)</p>
								</div>
								<div class="col-md-4 col-sm-4">
									<span>Step 3</span>
									<img src="<?php echo get_template_directory_uri(); ?>/img/process/step-3.png" alt="Inspect Units">
									<h2>INSPECTION</h2>
									<p>Leasing conducts an inspection and inventory checking of the unit.*</p>
								</div>
							</div>
						</div>

					<?php else : ?>

						<div class="carousel-inner" role="listbox">
							<div class="item active">
								<span>Step 1</span>
								<img src="<?php echo get_template_directory_uri(); ?>/img/process/step-1.png" alt="Contact Leasing Services Department">
								<h2>CONTACT</h2>
								<p>Unit owner contacts Leasing Department to enlist their unit under Leasing Program.</p>
							</div>

							<div class="item">
								<span>Step 2</span>
								<img src="<?php echo get_template_directory_uri(); ?>/img/process/step-2.png" alt="Fill out forms">
								<h2>FILL OUT</h2>
								<p>Unit owner fills out and transmits the enrolment forms. (see buttons below)</p>
							</div>

							<div class="item">
								<span>Step 3</span>
								<img src="<?php echo get_template_directory_uri(); ?>/img/process/step-3.png" alt="Inspect Units">
								<h2>INSPECTION</h2>
								<p>Leasing conducts an inspection and inventory checking of the unit.*</p>
							</div>
						</div>

					<?php endif; ?>
				</div>
			</div>

			<div class="col-md-12" id="leaseDLlinks">
				<a class="pdfLink" href="http://leasing.dmcihomes.com/wp-content/uploads/7-LESSOR-INFORMATION-SHEET-FINAL-6-2-2015.pdf" target="_blank">Lessor Information Sheet</a> <a class="pdfLink" href="http://leasing.dmcihomes.com/wp-content/uploads/12-AUTHORITY-TO-LEASE-ATL-FINAL-6-2-2015.pdf" target="_blank">Authority to Lease</a>
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

<?php
	endwhile;
endif;

get_footer();
?>