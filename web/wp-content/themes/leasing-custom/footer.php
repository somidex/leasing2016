	<?php if (!is_home() && !is_singular('post')) : ?>
		<div class="container">
			<div class="row subFooter">
				<!-- FEATURED BLOG -->
				<?php include 'includes/footer/featured-blog.php'; ?>

				<div class="col-md-4">

					<!-- SOCIAL MEDIA LINKS -->
					<?php include 'includes/footer/social-media.php'; ?>

					<!-- NEWSLETTER -->
					<?php include 'includes/footer/newsletter.php'; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
	
	<!-- FOOTER TEXT -->
	<?php include 'includes/footer/footer-text.php'; ?>
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery1.11.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>	
	<script src="<?php echo get_template_directory_uri(); ?>/js/jasny-bootstrap.js"></script>
	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/holder.js"></script>
	<!--<script src="<?php //echo get_template_directory_uri(); ?>/js/bootstrap-datepicker.js"></script>-->
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/glDatePicker.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/fileinput.js"></script>

	<script src="<?php echo get_template_directory_uri(); ?>/js/responsive-calendar.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/browser.js"></script>

	<!-- Date Picker -->
    <script>
    	$('#start').datepicker({
		    format: 'yyyy-mm-dd',
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            onClose: function(selectedDate) {
                var date2 = $('#start').datepicker('getDate');
                date2.setDate(date2.getDate() + 30);
                $('#end').datepicker('option', 'minDate', date2);
                $('#end').datepicker('setDate', date2);
            }
		});

		$('#end').datepicker({
            format: 'yyyy-mm-dd',
            minDate: 1,
            changeMonth: true,
            changeYear: true
        });

        $('#eventDate').datepicker({
            format: 'yyyy-mm-dd',
            minDate: 1,
            changeMonth: true,
            changeYear: true
        });

        $('#preferred').datepicker({
        	format: 'yyyy-mm-dd',
            minDate: 0,
            changeMonth: true,
            changeYear: true
        });

        $('#birthdate').datepicker({
        	format: 'yy-mm-dd',
        	yearRange: '1900:2015',
            changeMonth: true,
            changeYear: true,
            onClose: function(selectedDate) {
            	var today = new Date();
            	var bdate = $('#birthdate').datepicker('getDate');
            	var thisYear = 0;

            	if (today.getMonth() < bdate.getMonth()) {
			        thisYear = 1;
			    } else if ((today.getMonth() == bdate.getMonth()) && today.getDate() < bdate.getDate()) {
			        thisYear = 1;
			    }
			    var age = today.getFullYear() - bdate.getFullYear() - thisYear;

			    $('#age').val(age);
            }
        });

        $('.carousel-indicators li').click(function() {
        	$('.carousel-indicators li').each(function() {
        		$(this).removeClass('active');
        	});

        	$(this).addClass('active');
        });

        $('#backToTop').click(function() {
        	$('html, body').animate({
	          scrollTop: 0
	        }, 1000);
        });

        $(window).scroll(function() {
        	var offSet = $(window).scrollTop();
	        var threshold = $(document).height() * 0.25;

			if (offSet > threshold) {
				$('#backToTop').show();
			} else {
				$('#backToTop').hide();
			}
        });

        $('div[id=clickToExpand]').click(function() {
        	var bg = $(this).css('background-image');
        	img = bg.replace('url(','').replace(')','');

        	if (jQuery.browser.name == 'Firefox') {
        		img = img.replace(/"/g, '');
        	}

        	$('#myModal .modal-body').html('<img src="'+img+'" class="modal-img" alt="" />');
        });

        $('#expandAmenity').click(function() {
        	var	img = $(this).attr('src');

        	$('#myModal .modal-body').html('<img src="'+img+'" class="modal-img" alt="" />');
        });

        $('#inquireNow').click(function(e) {
        	e.preventDefault();
        	$('#eventBookings').hide();
        	$('#eventInquiries').show();

        	var target = $('#inquiryContainer').offset().top;

        	$('html, body').animate({
        		scrollTop: target
        	}, 1000);
        });

        $('#reserveNow').click(function(e) {
        	e.preventDefault();
        	$('#eventBookings').show();
        	$('#eventInquiries').hide();

        	var target = $('#eventBookings').offset().top;

        	$('html, body').animate({
        		scrollTop: target
        	}, 1000);
        });
    </script>

    <!--<script>

		$(window).load(function() {
            $('#mydate').glDatePicker(
            	{
            		showAlways: true,
            		selectableDateRange: [
				        { from: new Date(2015, 2, 23),
				            to: new Date(2015, 2, 24) },
				        { from: new Date(2015, 2, 27),
				            to: new Date(2015, 2, 28) },
				    ],
            	}
            );
        });
	</script>-->

	<!-- Property Map Coordinates -->
	<script type="text/javascript">
	    var locations = [
	      ['Bonifacio Heights Condominium, Taguig City', 14.534746,121.0381633, 1],
	      ['Cedar Crest, Taguig City', 14.5845507,121.0762222, 2],
	      ['Cypress Towers, Taguig City', 14.526586,121.0560275, 3],
	      ['Rosewood Pointe, Taguig City', 14.527258,121.063387, 4],
	      ['Royal Palm Residences, Taguig City', 14.5265271,121.0633238, 5],
	      ['Dansalan Garden Condominium, Mandaluyong City', 14.5752975,121.0437315, 6],
	      ['Tivoli Garden Residences, Mandaluyong City', 14.572188, 121.029725, 7],
	      ['East Ortigas Mansions, Pasig City', 14.586163,121.102831, 8],
	      ['East Raya Residences, Pasig City', 14.568009,121.09334, 9],
	      ['Mayfield Park Residences, Pasig City', 14.59326,121.107636, 10],
	      ['Riverfront Residences, Pasig City', 14.573013,121.076863, 11],
	      ['Palm Grove, Paranaque City', 14.477192,121.026164, 12],
	      ['Raya Garden, Paranaque City', 14.505966,121.034233, 13],
	      ['Siena Park, Paranaque City', 14.4881383,121.0398881, 14],
	      ['Magnolia Place, Quezon City', 14.679903,121.02351, 14],
	      ['The Redwoods, Quezon City', 14.735935,121.060664, 15],
	      ['Accolade Place, Quezon City', 14.615232,121.045118, 16],
	      ['Ohana Place, Las Pinas City', 14.430754,121.018996, 17],
	      ['Maricielo Villas, Las Pinas City', 14.468269,120.970287, 18],
	      ['Hampstead Gardens, Las Pinas City', 14.597395,121.022426, 19],
	      ['Illumina Residences, Las Pinas City', 14.5936692,121.0149625, 20],
	      ['Rhapsody Residences, Muntinlupa City', 14.444842,121.048302, 21]
	    ];

	    var map = new google.maps.Map(document.getElementById('propertyMaps'), {
	      zoom: 10,
	      scaleControl: false,
  		  scrollwheel: false,
  		  disableDoubleClickZoom: true,
  		  zoomControlOptions: {
		      style:google.maps.ZoomControlStyle.LARGE
		    },
	      center: new google.maps.LatLng(14.6112504,121.0028602),
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    });

	    var infowindow = new google.maps.InfoWindow();

	    var marker, i;

	    for (i = 0; i < locations.length; i++) {  
	      marker = new google.maps.Marker({
	        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
	        map: map
	      });

	      google.maps.event.addListener(marker, 'click', (function(marker, i) {
	        return function() {
	          infowindow.setContent(locations[i][0]);
	          infowindow.open(map, marker);
	        }
	      })(marker, i));
	    }

	    google.maps.event.addDomListener(window, 'resize', function() {
		    map.setCenter(center);
		});
  	</script>

  	<script>
  		<?php
  			$propertyCoords = get_post_meta(get_the_ID(), 'property_coordinates', true);
  			$propertyTitle = get_the_title();
  		?>
		function initialize() {
		  var myLatlng = new google.maps.LatLng(<?php echo $propertyCoords; ?>);
		  
		  var mapOptions = {
		    zoom: 15,
		    scaleControl: false,
  			scrollwheel: false,
  			disableDoubleClickZoom: true,
  			zoomControlOptions: {
		      style:google.maps.ZoomControlStyle.LARGE
		    },
		    center: myLatlng
		  }
		  var map = new google.maps.Map(document.getElementById('propertyLocation'), mapOptions);

		  var marker = new google.maps.Marker({
		      position: myLatlng,
		      map: map,
		      title: '<?php echo $propertyTitle; ?>'
		  });
		}

		google.maps.event.addDomListener(window, 'load', initialize);
	</script>

  	<!-- Carousel Transition Speed -->
    <script>
	  $('.carousel').carousel({
		  interval: 1000 * 8
		});
  	</script>

  	<!-- Calendar 
  	<script>
		$(window).load(function() {
            $('#mydate1').glDatePicker(
            	{
            		showAlways: true
            	}
            );
        });
	</script>-->

	<script type="text/javascript">

		$('#propType').change(function() {
			if ($('#propType option:selected').val() == 'rent-condominium' || $('#propType option:selected').val() == 'rent-subdivision') {
				$('#brCondoSub, #featCondoSub').show();
			} else {
				$('#brCondoSub, #featCondoSub').hide();
			}
		});

		$("#submitSearch").click(function(e) {
			e.preventDefault();
			$("span[id=errorNotif]").remove();
			var errors = 0;

			$('#propertySearch select').each(function() {
				if ($(this).val() == '') {
					errors++;
				}
			});

			if (errors >= 5) {
				$('#submitSearch').parent().append('<span id="errorNotif">At least one of the filters should be supplied.</span>');
			} else {

				var query = "";

				if ($("#price").val() != "") {
					query += 'property_pricerange=';
					query += $("#price").val();
				}

				if ($('#propType').val() != "") {
					if ($("#price").val() != "") {
						if ($('#propType').val() =='rent-commercial' || $('#propType').val() =='rent-events') {
							query = "";
						} else {
							query += "&";
						}
					}
					query += "property_type=";
					query += $('#propType').val();
				}

				if ($("#location").val() != "") {
					if ($("#price").val() != "") {
						query += "&";
					} else if ($('#propType').val() != "") {
						query += "&";
					}
					query += 'property_location=';
					query += $("#location").val()
				}

				if ($("#br").val() != "") {
					if ($("#price").val() != "") {
						query += "&";
					} else if ($("#location").val() != "") {
						query += "&";
					} else if ($('#propType').val() != "") {
						query += "&";
					}
					query += "property_features=";
					query += $("#br").val();
				}

				if ($("#feature").val() != "") {

					if ($("#br").val() != "") {
						query += "-";
						query += $("#feature").val();
					} else {
						if ($("#price").val() != "") {
							query += "&";
						} else if ($("#location").val() != "") {
							query += "&";
						} else if ($('#propType').val() != "") {
							query += "&";
						}

						query += "property_features=";
						query += $("#feature").val();
					}
				}

				window.location.href = "<?php echo get_site_url(); ?>/?"+query;
			}
		});

		$('#reserveUnitBook, #reserveUnitAppoint').click(function(e) {
			e.preventDefault();
			var hasError = false;

			$('span[id=errorNotif]').remove();

			if ($('#leaseTypeSelect option:selected').val() == 'short-term') {

				if ($('#start').val() == '') {
					$('#start').parent().append('<span id="errorNotif">Date is required.</span>');
					hasError = true;
				}

				if ($('#end').val() == '') {
					$('#end').parent().append('<span id="errorNotif">Date is required.</span>');
					hasError = true;
				}

			} else if ($('#leaseTypeSelect option:selected').val() == 'long-term') {

				if ($('#preferred').val() == '') {
					$('#preferred').parent().append('<span id="errorNotif">Date is required.</span>');
					hasError = true;
				}

				if ($('#time').val() == '') {
					$('#time').parent().append('<span id="errorNotif">Time is required.</span>');
					hasError = true;
				}

			}

			if (!hasError) {
				$('#datepicker, #reserveUnitBook, #reserveUnitAppoint').hide();
				$('#formDetails').show();
			}
		});

		$('#changeDates').click(function(e) {
			e.preventDefault();

			$('#datepicker, #reserveUnitBook, #reserveUnitAppoint').show();
			$('#formDetails').hide();
		});

		/*$('#leaseTypeSelect').change(function() {
			if ($('#leaseTypeSelect option:selected').val() == 'short-term') {
				$('#selectNotif').hide();
				$('#longTermLease, #formDetails').hide();
				$("#shortTermLease").show();
			} else if ($('#leaseTypeSelect option:selected').val() == 'long-term') {
				$('#selectNotif').hide();
				$('#shortTermLease').hide();
				$("#longTermLease, #formDetails").show();
			} else {
				$('#shortTermLease').hide();
				$("#longTermLease, #formDetails").hide();
				$('#selectNotif').show();
			}
		});*/

		$('#resetBookingForm').click(function(e) {
			e.preventDefault();

			$('#shortTermLease input, #shortTermLease textarea').each(function() {
				$(this).val('');
			});

			$('#shortTermLease #formNotif').hide();
			$('#shortTermLease #error').hide();
			$('#shortTermLease #success').hide();
			$('#shortTermLease #datepicker, #shortTermLease #reserveUnitBook').show();
		});

		$("#resetAppointForm").click(function(e) {
			e.preventDefault();

			$('#longTermLease input, #longTermLease textarea').each(function() {
				$(this).val('');
			});

			$('#longTermLease #formNotif').hide();
			$('#longTermLease #error').hide();
			$('#longTermLease #success').hide();
			$('#longTermLease #formDetails').show();
		});

		$('#submitBooking').click(function(e) {
			$("#shortTermLease #floatingBarsG").show();
			$('#submitBooking, #changeDates').hide();
			$('span[id=errorNotif]').remove();

			e.preventDefault();
			var hasError = false;

			$('#shortTermLease #formDetails .form-control').each(function() {
				if ($(this).val() == '') {
					$(this).parent().append('<span id="errorNotif">This information is required.</span>');
					hasError = true;
				}
			});

			if (!hasError) {
				var _start = $('#shortTermLease #start').val();
				var _end = $('#shortTermLease #end').val();
				var _fname = $('#shortTermLease #fname').val();
				var _lname = $('#shortTermLease #lname').val();
				var _contact = $('#shortTermLease #contact').val();
				var _email = $('#shortTermLease #email').val();
				var _country = $('#shortTermLease #country').val();
				var _nationality = $('#shortTermLease #nationality').val();
				var _notes = $('#shortTermLease #notes').val();
				var _unit = "<?php echo get_the_title(); ?>";
				var _unitType = "<?php echo get_post_meta(get_the_ID(), 'property_type', true); ?>";
				var _unitLocation = "<?php $location = get_post_meta(get_the_ID(), 'location', true); if ($location) : echo $location['name']; endif; ?>";
				var _priceRange = "<?php echo get_post_meta(get_the_ID(), 'price_range', true); ?>";
				var	_calendarId = "<?php $calendarId = get_post_meta(get_the_ID(), 'property_calendar', true); if ($calendarId) : echo $calendarId['ID']; endif; ?>";
				var _leaseType = $('#leaseTypeSelect option:selected').val();
				var _clientIp = $('#shortTermLease #clientIp').val();

				$.ajax({
					//url: "<?php echo get_template_directory_uri(); ?>/theme-functions/book-set.php",
					url: "<?php echo get_site_url(); ?>/secured/property/appointment-request",
					type: "POST",
					data: {
						unitid: $('#postId').val(),
						start : _start,
						end : _end,
						fname : _fname,
						lname : _lname,
						contact : _contact,
						email : _email,
						country : _country,
						nationality : _nationality,
						notes : _notes,
						unit : _unit,
						unitType : _unitType,
						unitLocation : _unitLocation,
						priceRange : _priceRange,
						calendarId : _calendarId,
						leaseType : _leaseType,
						clientIp: _clientIp
					},
					success: function(data) {
						if (data == 1) {
							$("#shortTermLease #floatingBarsG").hide();
							$('#shortTermLease #formDetails').hide();
							$('#shortTermLease #formNotif').show();
							$('#shortTermLease #error').hide();
							$('#submitBooking, #changeDates').show();
							$('#shortTermLease #success').show();

							console.log(data);

							/*dataLayer.push({'event': 'booking-form', 'eventCategory': 'Booking Form Submit', 'eventAction': 'Submit', 'eventLabel': 'book'});

							window.location.href = "http://leasing.dmcihomes.com/thank-you";*/
						}
					}
				});
			} else {
				$("#floatingBarsG").hide();
				$('#submitBooking, #changeDates').show();
			}
		});

		$('#submitAppointment').click(function(e) {
			$('#submitAppointment').hide();
			$("#longTermLease #floatingBarsG").show();
			$('span[id=errorNotif]').remove();

			e.preventDefault();
			var hasError = false;

			$('#appointmentForm .form-control').each(function() {
				if ($(this).val() == '') {
					$(this).parent().append('<span id="errorNotif">This information is required.</span>');
					hasError = true;
				}
			});

			if (!hasError) {

				var _date = $('#preferred').val();
				var _time = $('#time').val();
				var _fname = $('#longTermLease #fname').val();
				var _lname = $('#longTermLease #lname').val();
				var _contact = $('#longTermLease #contact').val();
				var _email = $('#longTermLease #email').val();
				var _country = $('#longTermLease #country').val();
				var _nationality = $('#longTermLease #nationality').val();
				var _notes = $('#longTermLease #notes').val();
				var _unit = "<?php echo get_the_title(); ?>";
				var _unitType = "<?php echo get_post_meta(get_the_ID(), 'property_type', true); ?>";
				var _unitLocation = "<?php $location = get_post_meta(get_the_ID(), 'location', true); if ($location) : echo $location['name']; endif; ?>";
				var _priceRange = "<?php echo get_post_meta(get_the_ID(), 'price_range', true); ?>";
				var	_calendarId = "<?php $calendarId = get_post_meta(get_the_ID(), 'property_calendar', true); if ($calendarId) : echo $calendarId['ID']; endif; ?>";
				var _leaseType = $('#leaseTypeSelect option:selected').val();
				var _clientIp = $('#longTermLease #clientIp').val();
				var _firstHeard = $('#longTermLease #firstHeard').val();

				$.ajax({
					url: "<?php echo get_site_url(); ?>/secured/property/appointment-request",
					type: "POST",
					data: {
						unitid: $('#postId').val(),
						date : _date,
						time : _time,
						fname : _fname,
						lname : _lname,
						contact : _contact,
						email : _email,
						country : _country,
						nationality : _nationality,
						notes : _notes,
						unit : _unit,
						unitType : _unitType,
						unitLocation : _unitLocation,
						priceRange : _priceRange,
						calendarId : _calendarId,
						leaseType : _leaseType,
						firstHeard: _firstHeard,
						clientIp: _clientIp
					},
					success: function(data) {
						if (data == 1) {
							$("#longTermLease #floatingBarsG").hide();
							$('#longTermLease #formDetails').hide();
							$('#longTermLease #formNotif').show();
							$('#longTermLease #error').hide();
							$('#submitAppointment').show();
							$('#longTermLease #success').show();

							console.log(1);

							//dataLayer.push({'event': 'set-appointment', 'eventCategory': 'Set An Appointment Form', 'eventAction': 'Submit', 'eventLabel': 'appointment'});

							window.location.href = "http://leasing.dmcihomes.com.local/thank-you";
						}
					}
				});
			} else {
				$("#longTermLease #floatingBarsG").hide();
				$('#submitAppointment').show();
			}
		});

		$('#submitParking').click(function(e) {
			$('#submitWrap').hide();
			$('#floatingBarsG').show();

			e.preventDefault();
			var hasError = false;
			$('span[id=errorNotif]').remove();

			$('#parkingForm input.form-control, #parkingForm select.form-control').each(function() {
				if ($(this).val() == '' && $(this).is(':visible')) {

					if ($(this).hasClass('file')) {
						$(this).parents('.file-input-ajax-new').append('<span id="errorNotif">You are required to submit these documents.</span>');
					} else {
						$(this).parent().append('<span id="errorNotif">Required.</span>');
					}
					hasError = true;

					console.log($(this));
				}
			});

			if (!hasError) {
				$('#file-1').fileinput('upload');
			} else {
				$('#submitWrap').show();
				$('#floatingBarsG').hide();
			}
		});
	</script>

	<script>
		$("#file-1").fileinput({
	        uploadUrl: '<?php echo get_site_url(); ?>/secured/property/parking-application', // you must set a valid URL here else you will get an error
	        allowedFileExtensions : ['jpg', 'png','gif'],
	        overwriteInitial: false,
        	showUpload: false,
	        maxFileSize: 2097152,
	        minFileCount: 2,
	        maxFileCount: 2,
	        uploadAsync: false,
	        slugCallback: function(filename) {
	            return filename.replace('(', '_').replace(']', '_');
	        },
	        uploadExtraData: function() {
	        	return {
	        		salutation: $('#salutation').val(),
	        		fname: $('#fname').val(),
					lname: $('#lname').val(),
					gender: $('#gender').val(),
					bdate: $('#birthdate').val(),
					age: $('#age').val(),
					email: $('#email').val(),
					mobile: $('#mobile').val(),
					property: $('#property').val(),
					unit: $('#unit').val(),
					slots: $('#slots').val(),
					terms: $('#terms').val(),
					firstHeard: $('#firstHeard').val(),
					paymentType: $('#paymentType').val()
	        	};
	        }
		});

		$('#file-1').on('filebatchuploadsuccess', function(event, data, previewId, index) {
			var form = data.form, files = data.files, extra = data.extra,
			response = data.response, reader = data.reader;
			
			if (data.response != 1) {
				alert('Error uploading files. Please retry.');
			} else {
				console.log('Done.');
				window.location.href = "<?php echo get_site_url(); ?>/thank-you-parking";
			}
		});

		$("#uploadEventDocs").fileinput({
	        uploadUrl: '<?php echo get_site_url(); ?>/secured/property/reserve-event', // you must set a valid URL here else you will get an error
	        allowedFileExtensions : ['jpg', 'png','gif'],
	        overwriteInitial: false,
        	showUpload: false,
	        maxFileSize: 2097152,
	        minFileCount: 2,
	        maxFileCount: 2,
	        uploadAsync: false,
	        slugCallback: function(filename) {
	            return filename.replace('(', '_').replace(']', '_');
	        },
	        uploadExtraData: function() {
	        	return {
	        		salutation: $('#salutation').val(),
	        		fname: $('#reserveEventForm #fname').val(),
					lname: $('#reserveEventForm #lname').val(),
					gender: $('#gender').val(),
					bdate: $('#birthdate').val(),
					age: $('#age').val(),
					email: $('#reserveEventForm #email').val(),
					mobile: $('#reserveEventForm #mobile').val(),
					eventDate: $('#eventDate').val(),
					eventTimeFrom: $('#eventTimeFrom').val(),
					eventTimeTo: $('#eventTimeTo').val(),
					eventSpecific: $('#event_place_specific').val(),
					firstHeard: $('#firstHeard').val(),
					postId: "<?php echo get_the_ID(); ?>"
	        	};
	        }
		});

		$('#uploadEventDocs').on('filebatchuploadsuccess', function(event, data, previewId, index) {
			var form = data.form, files = data.files, extra = data.extra,
			response = data.response, reader = data.reader;
			
			if (data.response != 1) {
				alert('Error uploading files. Please retry.');
			} else {
				console.log('Done.');
				window.location.href = "<?php echo get_site_url(); ?>/thank-you-event";
			}
		});

		$('#submitEventBooking').click(function(e) {
			$('#submitWrap').hide();
			$('#floatingBarsG').show();
			e.preventDefault();

			var hasError = false;
			$('span[id=errorNotif]').remove();

			$('#reserveEventForm input.form-control, #reserveEventForm select.form-control').each(function() {
				if ($(this).val() == '' && $(this).is(':visible')) {
					if ($(this).hasClass('file')) {
						$(this).parents('.file-input-ajax-new').append('<span id="errorNotif">You are required to submit these documents.</span>');
					} else {
						$(this).parent().append('<span id="errorNotif">Required.</span>');
					}
					hasError = true;
				} else {
					if ($(this).attr('id') == 'email') {
		        		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

		        		if (!emailReg.test($(this).val())) {
		        			hasError = true;
		        			$(this).parent().append('<span id="errorNotif">Invalid Email Address.</span>');
		        		}

					} else if ($(this).attr('id') == 'mobile') {
						var phoneReg = /(\s*\(?0\d{4}\)?(\s*|-)\d{3}(\s*|-)\d{3}\s*)|(\s*\(?0\d{3}\)?(\s*|-)\d{3}(\s*|-)\d{4}\s*)|(\s*(7|8)(\d{7}|\d{3}(\-|\s{1})\d{4})\s*)/;

						if (!phoneReg.test($(this).val())) {
							hasError = true;
		        			$(this).parent().append('<span id="errorNotif">Invalid Mobile Number. Please follow this format: 09171234567</span>');
						}
					}
				}
			});

			if (!hasError) {
				$('#uploadEventDocs').fileinput('upload');
			} else {
				$('#submitWrap').show();
				$('#floatingBarsG').hide();
			}
		});
	</script>

	<script>
		$('#submitCredentials').click(function(e) {
			e.preventDefault();
			var hasError = false;
			$('span[id="errorNotif"]').remove();

			$('#credsForm .form-control').each(function() {
				if ($(this).val() == '') {
					hasError = true;
					$(this).parent().append('<span id="errorNotif">Required.</span>');
				}
			});

			if (!hasError) {
				$.ajax({
					url: "<?php echo get_site_url(); ?>/secured/payment/retrieve-application",
					type: "POST",
					data: {
						leadType: $('#appType').val(),
						refNum: $('#refNum').val()
					},
					success: function(data) {
						console.log(data);
					}
				});
			}
		});
	</script>

	<?php wp_footer(); ?>
</body>
</html>