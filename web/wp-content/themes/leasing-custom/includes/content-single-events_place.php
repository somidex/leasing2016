<?php
	$short = get_post_meta(get_the_ID(), 'events_short_address', true);
	$full = get_post_meta(get_the_ID(), 'events_full_address', true);
	$contact = get_post_meta(get_the_ID(), 'events_contact_number', true);
	$email = get_post_meta(get_the_ID(), 'events_email_address', true);

	if (has_post_thumbnail()) {
		$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
	} else {
		$image[0] = get_template_directory_uri().'/img/casareal.jpg';
	}

	$galleryIds = get_post_meta(get_the_ID(), '_pods_events_place_gallery', true);

	$termArgs = array(
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'hide_empty' => true
	);

	$terms = get_terms('location', $termArgs);

	$file1 = get_post_meta(get_the_ID(), 'upload_file_1', true);
	$file2 = get_post_meta(get_the_ID(), 'upload_file_2', true);
	$file3 = get_post_meta(get_the_ID(), 'upload_file_3', true);

	$amenities = get_post_meta(get_the_ID(), '_pods_add_amenities', true);
	$cfTitle = get_post_meta(get_the_ID(), 'custom_field_title', true);
	$cf = get_post_meta(get_the_ID(), 'custom_field', true);

	$detect = new Mobile_Detect();
?>

<div class="container propertyPage commercial">
	<p id="breadcrumbs">
		<?php nonResidentialBreadcrumbs(); ?>
	</p>
	<div class="row">
		<div class="col-md-6">
			<!--<h1><?php the_title(); ?></h1>
			<?php //if (isset($short) && $short != "") : ?>
				<span><i class="fa fa-map-marker"></i> <?php //echo $short; ?></span>
			<?php //endif; ?>-->
			<?php the_content(); ?>

			<!-- Full Address -->
			<?php if (isset($full) && $full != "") : ?>
				<label for="">Address:</label>
				<span><i class="fa fa-map-marker"></i> <?php echo $full; ?></span>
			<?php endif; ?>

			<!-- Contact Number -->
			<?php if (isset($contact) && $contact != "") : ?>
				<label for="">Contact Number:</label>
				<span>
					<?php if ($detect->isMobile()) : ?>
						<a href="tel:<?php echo $contact; ?>" id="callMobile"><?php echo $contact; ?></a>
					<?php else : ?>
						<?php echo $contact; ?>
					<?php endif; ?>
				</span>
			<?php endif; ?>

			<!-- Email Address -->
			<?php if (isset($email) && $email != "") : ?>
				<label for="">Email Address:</label>
				<span><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></span>
			<?php endif; ?>

			<?php if ($file1) : ?>
				<a href="<?php echo $file1['guid']; ?>" class="pdfLink" target="_blank"><?php echo $file1['post_title']; ?></a>
			<?php endif; ?>

			<?php if ($file2) : ?>
				<a href="<?php echo $file2['guid']; ?>" class="pdfLink" target="_blank"><?php echo $file2['post_title']; ?></a>
			<?php endif; ?>

			<?php if ($file3) : ?>
				<a href="<?php echo $file3['guid']; ?>" class="pdfLink" target="_blank"><?php echo $file3['post_title']; ?></a>
			<?php endif; ?>
		</div>

		<div class="col-md-6" id="hideOnMobile">
			<img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(); ?>">
			<div class="eventCtaBtns">
				<a href="#" id="inquireNow">INQUIRE NOW</a>
				<a href="#" id="reserveNow">RESERVE NOW</a>
			</div>
		</div>
	</div>
</div>


<?php if ($galleryIds) : ?>
	<div class="eventsGallery">
		<div class="container propertyFeatures">
			<div class="row">
				<div class="col-md-12 gallery">
					<h2>GALLERY</h2>

					<?php if (!$detect->isMobile()) : ?>
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
							        <div style="background: url(<?php echo $galleryImg[0]; ?>) no-repeat top left / cover;" class="imageContainer" data-toggle="modal" data-target="#myModal" id="clickToExpand"></div>
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
					<?php else : ?>

						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					        <div class="carousel-inner" role="listbox">
					          <?php
					            $i = 0;
					            foreach ($galleryIds as $galleryId) {
					              $galleryImg = wp_get_attachment_image_src($galleryId, 'full');
					          ?>
					                <div class="item <?php if ($i == 0) : echo 'active'; endif; ?>">
					                  <div style="background: url(<?php echo $galleryImg[0]; ?>) no-repeat top left / cover;" class="imageContainer" data-toggle="modal" data-target="#myModal" id="clickToExpand"></div>
					                </div>
					          <?php
					              $i++;
					            }
					          ?>
					          <ol class="carousel-indicators">
					            <?php
					              $j = 0;
					              foreach ($galleryIds as $galleryId) {
					            ?>
					              <li data-target="#carousel-example-generic" data-slide-to="<?php echo $j; ?>" class="<?php if ($j == 0): echo 'active'; endif; ?>"></li>
					            <?php
					                $j++;
					              }
					            ?>
					          </ol>
					        </div>
					    </div>

					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<?php if ($amenities) : ?>
	<div class="ratesInfo">
		<div class="container">
			<?php
				foreach ($amenities as $amenity) {
					if (has_post_thumbnail()) {
						$tbn = wp_get_attachment_image_src(get_post_thumbnail_id($amenity), 'full');
					}
			?>
					<div class="row">
						<div class="col-md-5">
							<img src="<?php echo $tbn[0]; ?>" alt="<?php echo get_the_title($amenity); ?>" data-toggle="modal" data-target="#myModal" id="expandAmenity" style="cursor: pointer;">
						</div>
						<div class="col-md-7">
							<h3><?php echo get_the_title($amenity); ?></h3>
							<?php echo get_the_content_by_id($amenity); ?>
						</div>
					</div>
			<?php
				}
			?>
		</div>
	</div>
<?php endif; ?>

<?php if ($cf && $cfTitle) : ?>

<div class="ratesInfo">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3><?php echo $cfTitle; ?></h3>
				<?php echo $cf; ?>
			</div>
		</div>
	</div>
</div>

<?php endif; ?>

<div class="eventComment" id="eventInquiries">
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
								<input name="propertyType" value="events" type="hidden">
								<input type="hidden" name="clientIp" id="clientIp" value="<?php echo getClientIp(); ?>" />
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

<div class="eventComment" id="eventBookings">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-md-offset-1 commentBox" id="inquiryContainer">
				<h3>INTERESTED? RESERVE THIS EVENT VENUE NOW.</h3>

				<form action="" id="reserveEventForm" role="form">
					<div class="hidden">
						<input type="hidden" name="client_ip" id="client_id" value="<?php echo getClientIp(); ?>" />
					</div>
					<hr style="border-color: #333333;">

					<h4>Event Details</h4>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="eventDate" id="eventDate" class="form-control" readonly placeholder="Event Date">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<select name="eventTimeFrom" id="eventTimeFrom" class="form-control">
									<option value="">Event Start Time</option>
									<option value="8:00AM">8:00 am</option>
		                            <option value="9:00AM">9:00 am</option>
									<option value="10:00AM">10:00 am</option>
		                            <option value="11:00AM">11:00 am</option>
		                            <option value="12:00PM">12:00 pm</option>
		                            <option value="1:00PM">1:00 pm</option>
		                            <option value="2:00PM">2:00 pm</option>
		                            <option value="3:00PM">3:00 pm</option>
		                            <option value="4:00PM">4:00 pm</option>
		                            <option value="5:00PM">5:00 pm</option>
		                            <option value="6:00PM">6:00 pm</option>
		                            <option value="7:00PM">7:00 pm</option>
		                            <option value="8:00PM">8:00 pm</option>
								</select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<select name="eventTimeTo" id="eventTimeTo" class="form-control">
									<option value="">Event End Time</option>
		                            <option value="9:00AM">9:00 am</option>
									<option value="10:00AM">10:00 am</option>
		                            <option value="11:00AM">11:00 am</option>
		                            <option value="12:00PM">12:00 pm</option>
		                            <option value="1:00PM">1:00 pm</option>
		                            <option value="2:00PM">2:00 pm</option>
		                            <option value="3:00PM">3:00 pm</option>
		                            <option value="4:00PM">4:00 pm</option>
		                            <option value="5:00PM">5:00 pm</option>
		                            <option value="6:00PM">6:00 pm</option>
		                            <option value="7:00PM">7:00 pm</option>
		                            <option value="8:00PM">8:00 pm</option>
		                            <option value="9:00PM">9:00 pm</option>
		                            <option value="10:00PM">10:00 pm</option>
								</select>
							</div>
						</div>
					</div>

					<?php if (get_the_ID() == 148) : ?>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<select name="event_place_specific" id="event_place_specific" class="form-control">
										<option value="">Select Casa Real Hall</option>
										<option value="Solariega Hall">Solariega Hall</option>
										<option value="Cuadrilla Hall">Cuadrilla Hall</option>
									</select>
								</div>
							</div>
						</div>

					<?php elseif (get_the_ID() == 1056) : ?>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<select name="event_place_specific" id="event_place_specific" class="form-control">
										<option value="">Select The Tent Hall</option>
										<option value="Hall A">Hall A</option>
										<option value="Hall B">Hall B</option>
										<option value="Full">Full</option>
									</select>
								</div>
							</div>
						</div>

					<?php else : ?>

						<input type="hidden" name="event_place_specific" id="event_place_specific" value="" />

					<?php endif; ?>

					<h4>Personal Details</h4>
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

					<hr style="border-color: #333333;">

					<h4>Contact Information</h4>

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

					<hr style="border-color: #333333;">

					<h2>You’re almost done!</h2>
					<p>Just upload the PDF or JPEG copy of the required documents here. Here’s a list of documents we’re looking for:</p>
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-4">
							<ul>
								<li>Digitized SSS ID</li>
								<li>Driver’s License</li>
								<li>GSIS E-card</li>
							</ul>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<ul>
								<li>PRC ID</li>
								<li>IBP ID</li>
								<li>Digitized BIR ID</li>
							</ul>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<ul>
								<li>OWWA ID</li>
								<li>Senior Citizen’s ID</li>
								<li>Unified Multi-Purpose ID</li>
							</ul>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
			                    <!--<input id="file-1" type="file" multiple class="file" data-show-upload="false" data-overwrite-initial="false" data-min-file-count="2">-->
			                    <input id="uploadEventDocs" type="file" name="documents[]" multiple class="file" data-show-upload="false">
			                </div>
						</div>

						<div class="row">
							<div class="col-md-12" id="submitWrap">
								<a href="" class="btn btn-lg ctaOrange" id="submitEventBooking">SUBMIT</a>
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

<?php
	global $wpdb;

	$heroImageId = get_option('website_general_settings_hero_image');
	$heroImage = wp_get_attachment_image_src($heroImageId[0], 'hero-image');

	$textImageId = get_option('website_general_settings_text_image');
	$textImage = wp_get_attachment_image_src($textImageId[0], 'image-text');

	$heroText = get_option('website_general_settings_hero_image_text');

	$data = array();

	$wpdb->query("
		SELECT `meta_value`
		FROM $wpdb->postmeta
		WHERE `meta_key` = 'price_range'
	");

	foreach($wpdb->last_result as $v){
		array_push($data, $v->meta_value);
	};

	$priceRange = array_unique($data);
	asort($priceRange);

	$wpdb->query("
		SELECT `term_id`
		FROM $wpdb->term_taxonomy
		WHERE `taxonomy` = 'location'
	");

	$terms = array();

	foreach ($wpdb->last_result as $v) {
		$term = get_term_by('id', $v->term_id, 'location', ARRAY_A);
		array_push($terms, $term['name']);
	}
?>

<div class="eventComment">
	<div class="container">
		<div class="row">
			<div class="col-md-12 propSearch">
				<h3>PROPERTY SEARCH</h3>

				<form id="propertySearch" role="search" method="get" class="search-form" action="<?php echo get_site_url(); ?>">	
					<div class="form-group">
						<label for="">SELECT PRICE RANGE</label>
						<select class="form-control" id="price">
							<option value="">---</option>
							<option value="let-10k-19k">10k - 19k</option>
							<option value="let-20k-30k">20k - 30k</option>
							<option value="let-31k-40k">31k - 40k</option>
							<option value="let-41k">41k+</option>
							<option value="65k">65k</option>
							<option value="90k">90k</option>
						</select>
					</div>

					<div class="form-group">
						<label for="">SELECT LOCATION</label>
						<select class="form-control" id="location">
							<option value="">---</option>
							<?php
								foreach ($terms as $term) {
							?>
									<option value="rent-<?php echo strtolower($term); ?>"><?php echo $term; ?></option>
							<?php
								}
							?>
						</select>
					</div>

					<div class="form-group">
						<label for="">SELECT PROPERTY TYPE</label>
						<select class="form-control" id="propType">
							<option value="">---</option>
							<option value="rent-condominium">Condominium</option>
							<option value="rent-subdivision">Subdivision</option>
							<option value="rent-commercial">Commercial</option>
							<option value="rent-events">Events Place</option>
						</select>
					</div>

					<div class="form-group" id="brCondoSub">
						<label for="">SELECT NUMBER OF BEDROOMS</label>
						<select class="form-control" id="br">
							<option value="">---</option>
							<option value="rent-studio">Studio</option>
							<option value="rent-1br">1 Bedroom</option>
							<option value="let-2br">2 Bedrooms</option>
							<option value="lease-3brtandem">3 Bedrooms</option>
							<option value="4-bedroom">4 Bedrooms</option>
							<option value="6-bedroom">6 Bedrooms</option>
						</select>
					</div>

					<div class="form-group" id="featCondoSub">
						<label for="">SELECT PROPERTY FEATURE</label>
						<select class="form-control" id="feature">
							<option value="">---</option>
							<option value="rent-bare">Bare</option>
							<option value="lease-full">Semi-Furnished</option>
							<option value="let-semi">Fully Furnished</option>
						</select>
					</div>
				  
					<button type="submit" class="btn btn-default" id="submitSearch">SEARCH NOW</button>  

				</form>
			</div>
		</div>
	</div>
</div>