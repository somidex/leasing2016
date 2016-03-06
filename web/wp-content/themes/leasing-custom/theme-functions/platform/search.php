<?php

function searchProperty($qLoc, $qPrice, $qType, $qFeat)
{
	$location = '';
	$type = '';
	$price = '';
	$br = '';
	$dressUp = '';
	$result = array();
	
	//GET LOCATION TO BE SEARCHED
	if ($qLoc) {
		$tmpLoc = explode('-', $qLoc);
		$location = $tmpLoc[1];
	}

	//GET PROPERTY TYPE TO BE SEARCHED
	if ($qType) {
		$tmpType = explode('-', $qType);
		$type = $tmpType[1];
	}

	//GET PRICE TO BE SEARCHED
	if ($qPrice) {
		if (strpos($qPrice, 'let') !== false) :
			$tmpPrice = explode('-', $qPrice);

			if ($tmpPrice[2]) {
				$price = $tmpPrice[1].'-'.$tmpPrice[2];
			} else {
				$price = $tmpPrice[1];
			}
		else :
			$price = $qPrice;
		endif;
	}

	//GET FEATURES TO BE SEARCHED
	if ($qFeat) {
		$tmpFeat = explode('-', $qFeat);

		if (strpos($qFeat, '4-bedroom') !== false) :
			$br = '4BR';
			$dressUp = $tmpFeat[3];
		elseif (strpos($qFeat, '6-bedroom') !== false) :
			$br = '6BR';
			$dressUp = $tmpFeat[3];
		else :
			$br = $tmpFeat[1];
			$dressUp = $tmpFeat[3];
		endif;
	}

	$ch = curl_init();
	$tmpUrl = get_site_url().'/secured/property/search';

	$fields = array(
		'web_service_key' => '36cc3e3b641fae24903a0558b12f057c0210a0c9104b2fc0221656050acf76b3c4ad2364ba8a87e253c671d1a5cafb4547dbe0164cd70f06a804ca583d203bd7',
		'location' => $location,
		'price' => $price,
		'type' => $type,
		'br' => $br,
		'dressUp' => $dressUp
	);

	$fields_string = '';

	foreach($fields as $key => $value) {
		$fields_string .= $key.'='.$value.'&';
	}

	rtrim($fields_string, '&');

	$url = $tmpUrl.'?'.$fields_string;

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);

	//execute post
	$response = curl_exec($ch);

	//close connection
	curl_close($ch);

	$results = json_decode($response);

	return $results ? $results : array();
}

function otherSuggestions($qLoc, $qPrice, $qType)
{
	$location = '';
	$type = '';
	$price = '';
	$br = '';
	$dressUp = '';
	$result = array();
	
	//GET LOCATION TO BE SEARCHED
	if ($qLoc) {
		$tmpLoc = explode('-', $qLoc);
		$location = $tmpLoc[1];
	}

	//GET PROPERTY TYPE TO BE SEARCHED
	if ($qType) {
		$tmpType = explode('-', $qType);
		$type = $tmpType[1];
	}

	//GET PRICE TO BE SEARCHED
	if ($qPrice) {
		if (strpos($qPrice, 'let') !== false) :
			$tmpPrice = explode('-', $qPrice);

			if ($tmpPrice[2]) {
				$price = $tmpPrice[1].'-'.$tmpPrice[2];
			} else {
				$price = $tmpPrice[1];
			}
		else :
			$price = $qPrice;
		endif;
	}

	$ch = curl_init();
	$tmpUrl = get_site_url().'/secured/property/search';

	$fields = array(
		'web_service_key' => '36cc3e3b641fae24903a0558b12f057c0210a0c9104b2fc0221656050acf76b3c4ad2364ba8a87e253c671d1a5cafb4547dbe0164cd70f06a804ca583d203bd7',
		'location' => $location,
		'price' => $price,
		'type' => $type,
		'br' => $br,
		'dressUp' => $dressUp
	);

	$fields_string = '';

	foreach($fields as $key => $value) {
		$fields_string .= $key.'='.$value.'&';
	}

	rtrim($fields_string, '&');

	$url = $tmpUrl.'?'.$fields_string;

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);

	//execute post
	$response = curl_exec($ch);

	//close connection
	curl_close($ch);

	$results = json_decode($response);

	return $results ? $results : array();
}

?>