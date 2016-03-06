<!-- HERO -->
<?php include 'hero/pages.php'; ?>

<div class="container contactUs">
	<div class="row">

		<div class="col-md-12">
			<h1><?php the_title(); ?></h1>
		</div>

		<div class="col-md-6">
			<?php
				$contactForm = '[contact-form-7 id="160" title="Contact Us" html_id="ContactUsForm"]';
				echo do_shortcode($contactForm);
			?>
		</div>

		<div class="col-md-6">
			<?php the_content(); ?>
		</div>
	</div>
</div>

<!-- PROPERTY LOCATIONS -->
<?php include 'home-sections/property-locations.php'; ?>