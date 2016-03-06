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

<div class="eventComment">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-md-offset-1 commentBox" id="inquiryContainer">
				<h3>DO YOU HAVE QUESTIONS? HIT THE FORM BELOW.</h3>
				<div class="row">
					<div class="wpcf7" id="wpcf7-f137-p135-o1" dir="ltr" lang="en-US">
						<div class="screen-reader-response"></div>
						<form name="" action="/commercial/town-center-acacia-estates/#wpcf7-f137-p135-o1" method="post" class="wpcf7-form" novalidate="novalidate">
							<div style="display: none;">
								<input name="_wpcf7" value="137" type="hidden">
								<input name="_wpcf7_version" value="4.1.1" type="hidden">
								<input name="_wpcf7_locale" value="en_US" type="hidden">
								<input name="_wpcf7_unit_tag" value="wpcf7-f137-p135-o1" type="hidden">
								<input name="_wpnonce" value="715fc56071" type="hidden">
								<input name="property" value="<?php echo get_the_title(); ?>" type="hidden">
								<input name="propertyType" value="commercial" type="hidden">
							</div>
							
							<div class="col-md-6">
								<div class="form-group ">
									<span class="wpcf7-form-control-wrap fname">
										<input name="fname" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" id="fname" aria-required="true" aria-invalid="false" placeholder="First Name" type="text">
									</span>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<span class="wpcf7-form-control-wrap lname">
										<input name="lname" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" id="lname" aria-required="true" aria-invalid="false" placeholder="Last Name" type="text">
									</span>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<span class="wpcf7-form-control-wrap contact">
										<input name="contact" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel form-control" id="contact" aria-required="true" aria-invalid="false" placeholder="Contact Number (e.g. 09171234567)" type="tel">
									</span>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group ">
									<span class="wpcf7-form-control-wrap email">
										<input name="email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email form-control" id="email" aria-required="true" aria-invalid="false" placeholder="Email" type="email">
									</span>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group ">
									<span class="wpcf7-form-control-wrap message">
										<textarea name="message" cols="40" rows="3" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required form-control" id="message" aria-required="true" aria-invalid="false" placeholder="Message"></textarea>
									</span>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<input value="SUBMIT" class="wpcf7-form-control wpcf7-submit btn btn-primary" id="submit" type="submit">

									<div class="wpcf7-response-output wpcf7-display-none"></div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
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