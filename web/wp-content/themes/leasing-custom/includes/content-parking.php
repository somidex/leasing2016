<?php include 'hero/generic.php'; ?>

<?php
	$args = array(
		'post_type' => 'page',
		'posts_per_page' => -1,
		'orderby' => 'ID',
		'order' => 'ASC',
		'meta_key' => '_wp_page_template',
		'meta_value' => 'property.php',
		'meta_compare' => '=='
	);

	$props = new WP_Query($args);

	/*$uArgs = array(
		'post_type' => 'property',
		'posts_per_page' => -1,
		'orderby' => 'ID',
		'order' => 'ASC'
	);

	$units = new WP_Query($uArgs); */
?>

<div>
	<div class="container">

		<div class="row inquiryForm">
			<div class="col-md-10 col-md-offset-1">
				<h1>RESERVE A PARKING SPACE</h1>

				<p>DMCI Leasing showcases quality parking rental spaces across its community. Worry about your condo parking problems no more with our new, fast and easy to fill-out application form below.</p>

				<form action="<?php echo get_site_url(); ?>/secured/property/parking-application" id="parkingForm" method="post" role="form">
					<div class="row">

						<div class="col-md-3">
							<div class="form-group">
								<select name="property" id="property" class="form-control">
									<option value="">Select Property</option>
									<?php
										if ($props->have_posts()) :
											while ($props->have_posts()) : $props->the_post();
												$title = get_the_title();
									?>
										<option value="<?php echo $title; ?>"><?php echo $title; ?></option>
									<?php
											endwhile;
										endif;
										wp_reset_postdata();
									?>
								</select>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<input type="text" name="unit" id="unit" class="form-control" placeholder="Building, Unit No.">
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group">
								<select name="slots" id="slots" class="form-control">
									<option value="">Slots</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
								</select>
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group">
								<select name="terms" id="terms" class="form-control">
									<option value="">Period</option>
									<option value="6 Months">6 Months</option>
									<option value="12 Months">12 Months</option>
									<option value="18 Months">18 Months</option>
								</select>
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group">
								<select name="paymentType" id="paymentType" class="form-control">
									<option value="">Payment</option>
									<option value="1">Straight</option>
									<option value="2">Monthly</option>
								</select>
							</div>
						</div>

					</div>

					<hr>

					<h2>Pesonal Information</h2>

					<div class="row">

						<div class="col-md-2">
							<div class="form-group">
								<select name="salutation" id="salutation" class="form-control">
									<option value="Mr">Mr</option>
									<option value="Ms">Ms</option>
									<option value="Atty">Atty</option>
									<option value="Dr">Dr</option>
									<option value="Engr">Engr</option>
								</select>
							</div>
						</div>

						<div class="col-md-5">
							<div class="form-group">
								<input class="form-control" id="fname" name="fname" placeholder="First Name">
							</div>
						</div>

						<div class="col-md-5">
							<div class="form-group">
								<input class="form-control" id="lname" name="lname" placeholder="Last Name">
							</div>
						</div>

					</div>

					<div class="row">

						<div class="col-md-2">
							<select name="gender" id="gender" class="form-control">
								<option value="">Gender</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>

						<div class="col-md-3">
							<input type="text" name="birthdate" id="birthdate" class="form-control" readonly placeholder="Birthdate">
						</div>

						<div class="col-md-2">
							<input type="text" name="age" id="age" class="form-control" readonly placeholder="Age">
						</div>

						<div class="col-md-5">
							<select name="firstHeard" id="firstHeard" class="form-control">
								<option value="">Where did you hear about us?</option>
								<option value="Website">Website</option>
								<option value="Google">Google</option>
								<option value="Facebook">Facebook</option>
								<option value="Twitter">Twitter</option>
								<option value="Pinterest">Pinterest</option>
								<option value="Instagram">Instagram</option>
								<option value="Newspaper">Newspaper</option>
								<option value="Television">Television</option>
								<option value="Magazine">Magazine</option>
								<option value="Friends">Friends</option>
								<option value="Other Websites">Other Websites</option>
							</select>
						</div>

					</div>

					<hr>

					<h2>Contact Information</h2>

					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="mobile" class="form-control" id="mobile" placeholder="Mobile" />
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="email" class="form-control" id="email" placeholder="Email" />
							</div>
						</div>

					</div>

					<hr>

					<h2>You’re almost done!</h2>
					<p>Just upload the PDF or JPEG copy of the required documents here. Here’s a list of documents we’re looking for:</p>
					<div class="row">
						<div class="col-md-3 col-sm-3 col-xs-6">
							<ul>
								<li>OR or CR from DMCI Homes</li>
								<li>Digitized SSS ID</li>
							</ul>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-6">
							<ul>
								<li>Driver’s License</li>
								<li>GSIS E-card</li>
								<li>PRC ID</li>
							</ul>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-6">
							<ul>
								<li>IBP ID</li>
								<li>OWWA ID</li>
								<li>Digitized BIR ID</li>
							</ul>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-6">
							<ul>
								<li>Senior Citizen’s ID</li>
								<li>Unified Multi-Purpose ID</li>
							</ul>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
			                    <!--<input id="file-1" type="file" multiple class="file" data-show-upload="false" data-overwrite-initial="false" data-min-file-count="2">-->
			                    <input id="file-1" type="file" name="documents[]" multiple class="file" data-show-upload="false">
			                </div>
						</div>

						<div class="row">
							<div class="col-md-12" id="submitWrap">
								<a href="" class="btn btn-lg ctaOrange" id="submitParking">SUBMIT</a>
							</div>
							<div class="col-md-6 col-md-offset-6" id="floatingBarsG">
								<div class="blockG" id="rotateG_01"></div>
								<div class="blockG" id="rotateG_02"></div>
								<div class="blockG" id="rotateG_03"></div>
								<div class="blockG" id="rotateG_04"></div>
								<div class="blockG" id="rotateG_05"></div>
								<div class="blockG" id="rotateG_06"></div>
								<div class="blockG" id="rotateG_07"></div>
								<div class="blockG" id="rotateG_08"></div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>

<?php include 'property-sections/locations.php'; ?>