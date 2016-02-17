<?php
	$location = get_post_meta(get_the_ID(), 'location', true);
	$propType = get_post_meta(get_the_ID(), 'property_type', true);
	$priceRange = get_post_meta(get_the_ID(), 'price_range', true);
	$calendar = get_post_meta(get_the_ID(), 'property_calendar', true);

	$start = get_post_meta($calendar['ID'], 'availability_start', true);
	$end = get_post_meta($calendar['ID'], 'availability_end', true);
	$dates = getDatesFromRange($start, $end);

	$galleryIds = get_post_meta(get_the_ID(), '_pods_property_unit_gallery', true);
	$features = get_post_meta(get_the_ID(), 'unit_features', true);

	$floorPlans = get_post_meta(get_the_ID(), '_pods_unit_floorplans', true);
	$leaseType = get_post_meta(get_the_ID(), '_pods_lease_type', true);
	$unitsLeft = get_post_meta(get_the_ID(), 'units_available', true);

	$temp = getAllBookings($calendar['ID']);

	$i = 0;
	foreach ($temp as $t) {
		$bookedDates[$i] = getDatesFromRange($t['start'], $t['end']);
		$i++;
	}

	$temp2 = array();

	if ($bookedDates) {
		foreach ($bookedDates as $bd) {
			foreach ($bd as $b) {
				array_push($temp2, $b);
			}
		}
	}

	if ($temp2) {
		foreach (array_count_values($temp2) as $key => $val) {
			$temp3[$key] = $unitsLeft - $val;
		}
	}
?>

<?php include 'hero/properties.php'; ?>

<div class="container propertyPage">
	<p id="breadcrumbs"><?php unitBreadcrumbs(); ?></p>
	<div class="row unitIntro">

		<div class="col-md-7">
			<?php the_content(); ?>
		</div>

		<div class="col-md-5 propertySpecs">
			<input type="hidden" name="postId" id="postId" value="<?php echo get_the_ID(); ?>">
			<label for="">LOCATION: <span><?php echo $location['name']; ?></span></label>
			<label for="">TYPE: <span><?php echo $propType; ?></span></label>
			<label for="">PRICE: <span><?php echo $priceRange; ?></span></label>
			<label for="">LEASE TYPE: <span>Long-Term</span>
				<?php /* ?>
				<select name="leaseTypeSelect" id="leaseTypeSelect" class="form-control">
					<?php
						if ($leaseType) :
							foreach ($leaseType as $lt) {
					?>
								<option value="<?php echo $lt; ?>">
									<?php echo ucwords(str_replace('-', ' ', $lt)); ?>
								</option>
					<?php
							}
						endif;
					?>
				</select>
				<p id="stNote">Note: Short-term Lease: 1-3 Months; Long-term Lease: More than 4 months.</p>
				<?php */ ?>
			</label>
		</div>

	</div>

</div>

<!-- CALENDAR -->

<div class="calendarWrap">
	<div class="container">
		<div class="row">

			<!--<div id="selectNotif">
				<h3>Please select a lease type above first before booking a property or setting an appointment with any of our agents.</h3>
			</div>-->

			<div id="shortTermLease">
				<div class="col-md-6 col-sm-6 calendarStatus">
					<?php if ($leaseType && in_array('short-term', $leaseType)) : ?>
						<div id="shortTermBookings" class="responsive-calendar">
							<div class="controls">
								<a class="pull-left" data-go="prev"><div class="btn"><i class="glyphicon glyphicon-chevron-left"></i></div></a>
								<h4><span data-head-year></span> <span data-head-month></span></h4>
								<a class="pull-right" data-go="next"><div class="btn"><i class="glyphicon glyphicon-chevron-right"></i></div></a>
							</div>

							<div class="day-headers">
								<div class="day header">Mon</div>
								<div class="day header">Tue</div>
								<div class="day header">Wed</div>
								<div class="day header">Thu</div>
								<div class="day header">Fri</div>
								<div class="day header">Sat</div>
								<div class="day header">Sun</div>
							</div>

							<div class="days" data-group="days">

							</div>
						</div>
					<?php endif; ?>
					<p>Note: Numbers displayed on the dates indicate number of units left on that day.</p>
					<p>
						<span id="booked"></span> - <label for="">Booked but has available units</label>
						<span id="full"></span> - <label for="">Fully booked</label>
					</p>
				</div>
				
				<?php /* ?>
				<div class="col-md-6 col-sm-6 bookProperty">
					<h3>BOOK THIS UNIT NOW!</h3>

					<form action="" data-abide="" novalidate="novalidate" id="reserveForm" method="post" enctype="multipart/form-data">
						<div class="input-daterange input-group" id="datepicker">
							<p id="shortTermText">Book for a short-term lease of this property. Hit the form below.</p>
							<div class="datePicker">
								<span>Move-in Date:</span>
								<input type="text" class="input-sm form-control" id="start" name="start" />
							</div>
										
							<div class="datePicker">
								<span>Move-out Date:</span>
								<input type="text" class="input-sm form-control" id="end" name="end" />
							</div>
						</div>

						<a href="#" id="reserveUnitBook" class="reserveBtn">RESERVE NOW</a>

						<div class="input-group" id="formDetails">
							<div class="row">
								<div class="inputHalf col-sm-6">
									<span>First Name:</span>
									<input class="input-sm form-control" name="fname" id="fname" />
								</div>

								<div class="inputHalf col-sm-6">
									<span>Last Name:</span>
									<input class="input-sm form-control" name="lname" id="lname" />
								</div>
							</div>

							<div class="row">
								<div class="inputHalf col-sm-6">
									<span>Contact Number:</span>
									<input class="input-sm form-control" name="contact" id="contact" />
								</div>

								<div class="inputHalf col-sm-6">
									<span>Email Address:</span>
									<input class="input-sm form-control" name="email" id="email" />
								</div>
							</div>

							<div class="row">
								<div class="inputHalf col-sm-6">
									<span>Present Country:</span>
									<select name="country" id="country" class="input-sm form-control">
										<option value="">Select Country</option>
										<?php include 'property-sections/countries.php'; ?>
									</select>
								</div>

								<div class="inputHalf col-sm-6">
									<span>Nationality:</span>
									<select name="nationality" id="nationality" class="input-sm form-control">
										<option value="">Select Nationality</option>
										<?php include 'property-sections/nationalities.php'; ?>
									</select>
								</div>
							</div>

							<div class="row">
								<div class="inputHalf col-sm-12">
									<span>Additional Notes:</span>
									<textarea class="input-sm form-control" name="notes" id="notes"></textarea>
								</div>
								<div class="col-sm-12">
									<input type="hidden" name="clientIp" id="clientIp" value="<?php echo getClientIp(); ?>" />
									<a href="#" id="changeDates" class="backBtn">BACK</a>
									<a href="#" id="submitBooking" class="reserveBtn">SUBMIT</a>
								</div>
							</div>
						</div>

						<div class="input-group" id="formNotif">
							<div id="setNewBooking">
								<p id="success">Thank you! Your booking is now being processed. We'll get back to you ASAP.</p>
								<p id="error">We're very sorry. Something went wrong with the processing of your booking request.</p>
								<a href="#" id="resetBookingForm" class="reserveBtn">SET NEW BOOKING</a>
							</div>
						</div>
					</form>

					<div id="floatingBarsG">
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
				<?php */ ?>
			</div>

			<div id="longTermLease">
				<div class="col-md-9 col-md-offset-1 commentBox bookProperty">

					<h3 id="longTermHeading">INTERESTED? SET AN APPOINTMENT NOW!</h3>

					<form action="" data-abide="" novalidate="novalidate" id="appointmentForm" method="post" enctype="multipart/form-data">
						<div id="formDetails">
							<p id="longTermText">Set an appointment to view this property.</p>
							<div class="row">
								<div class="col-md-6">
									<span>Preferred Viewing Date:</span>
									<input type="text" class="input-sm form-control" id="preferred" name="preferred" />
								</div>
								<div class="col-md-6">
									<span>Preferred Time:</span>
									<select type="text" class="input-sm form-control" id="time" name="time">
										<option value="">Select One</option>
										<option value="8:00 am">8:00 am</option>
										<option value="9:00 am">9:00 am</option>
										<option value="10:00 am">10:00 am</option>
										<option value="11:00 am">11:00 am</option>
										<option value="12:00 pm">12:00 pm</option>
										<option value="1:00 pm">1:00 pm</option>
										<option value="2:00 pm">2:00 pm</option>
										<option value="3:00 pm">3:00 pm</option>
										<option value="4:00 pm">4:00 pm</option>
										<option value="5:00 pm">5:00 pm</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="inputHalf col-md-6">
									<span>First Name:</span>
									<input class="input-sm form-control" name="fname" id="fname" />
								</div>

								<div class="inputHalf col-md-6">
									<span>Last Name:</span>
									<input class="input-sm form-control" name="lname" id="lname" />
								</div>
							</div>

							<div class="row">
								<div class="inputHalf col-md-6">
									<span>Contact Number:</span>
									<input class="input-sm form-control" name="contact" id="contact" />
								</div>

								<div class="inputHalf col-md-6">
									<span>Email Address:</span>
									<input class="input-sm form-control" name="email" id="email" />
								</div>
							</div>

							<div class="row">
								<div class="inputHalf col-md-6">
									<span>Present Country:</span>
									<select name="country" id="country" class="input-sm form-control">
										<option value="">Select Country</option>
										<?php include 'property-sections/countries.php'; ?>
									</select>
								</div>

								<div class="inputHalf col-md-6">
									<span>Nationality:</span>
									<select name="nationality" id="nationality" class="input-sm form-control">
										<option value="">Select Nationality</option>
										<?php include 'property-sections/nationalities.php'; ?>
									</select>
								</div>
							</div>

							<div class="row">
								<div class="inputHalf col-md-6">
									<span>Where did you learn about DMCI Leasing?</span>
									<select name="firstHeard" id="firstHeard" class="form-control">
										<option value="">Please select one</option>
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
								<div class="inputHalf col-md-6">
									<span>Additional Notes:</span>
									<textarea class="input-sm form-control" name="notes" id="notes"></textarea>
								</div>
								<div class="col-md-12">
									<input type="hidden" name="clientIp" id="clientIp" value="<?php echo getClientIp(); ?>" />
									<a href="#" id="submitAppointment" class="reserveBtn">SUBMIT</a>
								</div>
							</div>
						</div>

						<div class="input-group" id="formNotif">
							<div id="setNewAppoint">
								<p id="success">Thank you! Your request for an appointment is now being processed. We'll get back to you ASAP.</p>
								<p id="error">We're very sorry. Something went wrong with the processing of your appointment request.</p>
								<a href="#" id="resetAppointForm" class="reserveBtn">SET NEW APPOINTMENT</a>
							</div>
						</div>
					</form>

					<div id="floatingBarsG">
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

		</div>
	</div>
</div>

<script src="<?php get_site_url(); ?>/wp-admin/js/responsive-calendar.js"></script>
<script>
	jQuery(document).ready( function() {
		jQuery('#shortTermBookings').responsiveCalendar({
			activateNonCurrentMonths: true,
			allRows: false,
			events: {
				<?php
					foreach ($dates as $date) {
						echo "\"".$date."\": {},\n";
					}
				?>

				<?php
					if (isset($temp3) && !empty($temp3)) :
						foreach ($temp3 as $key => $val) {
							if ($val > 0) :
								echo "\"".$key."\": {\"number\": ".$val.", \"badgeClass\": \"badge-warning\", \"class\": \"active booked\"}, \n";
							else :
								echo "\"".$key."\": {\"number\": ".$val.", \"badgeClass\": \"badge-warning\", \"class\": \"active full\"}, \n";
							endif;
						}
					endif;
				?>
			}
		});
	});
</script>

<!-- GALLERY -->

<?php if (isset($galleryIds) && !empty($galleryIds)) : ?>

	<div class="container propertyFeatures">
		<div class="row">
			<div class="col-md-12 gallery">
				<h3>GALLERY</h3>

				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
					  <div class="item active">
					  <?php
					    $i = 1;
					    foreach ($galleryIds as $galleryId) {
					      $galleryImg = wp_get_attachment_image_src($galleryId, 'full');
					  ?>
					      <div class="col-md-4 col-sm-4">
					        <section>
					          <img src="<?php echo $galleryImg[0]; ?>" alt="<?php echo get_the_title(); ?> building view">
					        </section>
					      </div>

					<?php if ($i % 3 == 0 || $i == count($galleryIds)) : ?>
					  </div>
					<?php if ($i % 3 == 0 && $i != count($galleryIds)) : ?>
					  <div class="item">
					<?php endif; ?>
					<?php endif; ?>
					  <?php
					  		$i++;
					    }
					  ?>
					  </div>
					</div>

					<!-- Indicators -->
					<ol class="carousel-indicators">
			          <?php
			            $li = $i / 3;
			            for ($j = 0; $j < $li - 1; $j++) { 
			          ?>
			  					 <li data-target="#carousel-example-generic" data-slide-to="<?php echo $j; ?>" class="<?php if ($j == 0): echo 'active'; endif; ?>"></li>
			          <?php
			            }
			          ?>
					</ol>

				</div>
			</div>
		</div>
	</div>

<?php endif; ?>

<?php if (isset($features) && $features <> '') : ?>

	<div class="amenityHead">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3>UNIT FEATURES</h3>
				</div>
			</div>
		</div>
	</div>

	<div class="container propertyFeatures ">
		<div class="row">
			<div class="col-md-12 unitFeatures">
				<?php echo $features; ?>
			</div>

			<?php if (isset($floorPlans) && !empty($floorPlans)) : ?>
				<div class="col-md-12 floorPlans">
					<h3>FLOOR PLANS</h3>

					<div class="row">
						<div class="col-md-4 col-sm-4">
	      					<section>
	      						<img src="img/floorplan1.jpg" alt="...">
	      					</section>
	      							
	      				</div>
	      				
	      				<div class="col-md-4 col-sm-4">
	      					<section>
	      						<img src="img/floorplan2.jpg" alt="...">
	      					</section>	
	      				</div>

	      				<div class="col-md-4 col-sm-4">
	      					<section>
	      						<img src="img/floorplan3.jpg" alt="...">
	      					</section>
	      				</div>
					</div>

				</div>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>

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
								<a href="<?php echo get_site_url().'/'.$term->slug; ?>/"><?php echo $term->name; ?></a>
							</li>
					<?php
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>