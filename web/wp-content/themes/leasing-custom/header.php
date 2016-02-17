<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<?php
		$tempPrice = $_GET['property_pricerange'];
		$tempLocation = $_GET['property_location'];
		$tempFeatures = $_GET['property_features'];
		$tempType = $_GET['property_type'];

		if (!$tempPrice && !$tempLocation && !$tempFeatures && !$tempType) :
	?>
		<title><?php wp_title(); ?></title>
	<?php
		else :

			if ($tempType) {
				$tempTy = explode('-', $tempType);
				$type = $tempTy[1];

				if ($type == 'commercial') {
					$seoTitle = "Commercial Spaces";
				} else if ($type == 'events') {
					$seoTitle = "Events Places";
				} else {
					if ($tempFeatures) {
						$tempF = explode('-', $tempFeatures);

						if (count($tempF) <= 2) {
							if ($tempF[1] == 'bedroom') {
								$feature = $tempF[0].'br';
							} else {
								$feature = $tempF[1];
							}
						} else {
							if ($tempF[1] == 'bedroom') {
								$tempF[1] = $tempF[0].'br';
							}

							$feature = $tempF[1].', '.ucwords($tempF[3]);
						}

						if (strpos($feature, 'brtandem') !== false) {
							$feature = str_replace('brtandem', 'Bedroom', $feature);
						} else if (strpos($feature, '1br') !== false) {
							$feature = str_replace('1br', '1 Bedroom', $feature);
						} else if (strpos($feature, 'br') !== false) {
							$feature = str_replace('br', ' Bedrooms', $feature);
						}

						$seoTitle = ucwords($feature).' Properties';
					} else {
						$seoTitle = ucwords($type).' Properties';
					}
				}
			} else {
				$seoTitle = 'Properties';
			}

			if ($tempPrice) {
				$tempP = explode('-', $tempPrice);

				if (count($tempP) <= 1) {
					$seoTitle .= ' around '.$tempP[0];
				} else {
					if ($tempP[2] == '') {
						$tempP[2] = '64k';
					}

					$seoTitle .= ' under '.$tempP[1].'-'.$tempP[2].' price range';
				}
			}

			if ($tempLocation) {
				$tempL = explode('-', $tempLocation);
				$seoTitle .= ' in '.ucwords($tempL[1]);
			}

			if ($tempType) {
				if ($type == 'events') {
					$seoTitle .= " for rent by DMCI Homes Leasing.";
				} else {
					$seoTitle .= " for lease by DMCI Homes Leasing.";
				}
			} else {
				$seoTitle .= " for lease by DMCI Homes Leasing.";
			}
	?>
		
		<title><?php echo $seoTitle; ?></title>
	<?php endif; ?>

	<?php if ($tempPrice || $tempFeatures || $tempType == 'rent-commercial' || $tempType == 'rent-events') : ?>
		<meta name="robots" content="noindex, follow" />
	<?php endif; ?>

	<link href="http://leasing.dmcihomes.com/wp-content/uploads/2013/03/favicon1.ico" rel="shortcut icon">

	<link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri(); ?>/css/jasny-bootstrap.css" rel="stylesheet">
	<!--<link href="<?php //echo get_template_directory_uri(); ?>/css/datepicker.css" rel="stylesheet">-->
	<link href="<?php echo get_template_directory_uri(); ?>/css/fileinput.css" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri(); ?>/css/jquery-ui.css" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri(); ?>/css/calendar/responsive-calendar.css" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri(); ?>/css/fontello.css" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri(); ?>/css/preloader.css" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri(); ?>/css/appended.css" rel="stylesheet">

	<?php if (!is_singular('post')) : ?>
		<style>
			#sthoverbuttons {
				display: none; }
		</style>
	<?php endif; ?>

	<?php wp_head(); ?>

	<!-- Nav for Desktop --> 
	<?php include 'includes/navigation/desktop.php'; ?>

	<!-- Nav For Mobile -->
	<?php include 'includes/navigation/mobile.php'; ?>

	<div class="floatingIcon" id="backToTop">
		<img src="<?php echo get_template_directory_uri(); ?>/img/backtotop.png" alt="Back to Top">
	</div>