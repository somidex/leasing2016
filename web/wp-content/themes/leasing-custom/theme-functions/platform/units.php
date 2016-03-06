<?php

function save_to_platform($post_id, $post, $update) {

	$types = array('property', 'booking_calendar', 'events');

	if (in_array($post->post_type, $types)) {
		$data = array();

		if ($post->post_type == 'property') {
			$data['name'] = $post->post_title;
			//$pSlug
			$data['content'] = $_REQUEST['content'];
			$data['avail'] = $_REQUEST['pods_meta_units_available'];
			$data['price'] = $_REQUEST['pods_meta_price_range'];
			$data['type'] = $_REQUEST['pods_meta_property_type'];

			//location term id
			$tempLoc = $_REQUEST['pods_meta_location'];
			$tempLoc2 = get_term_by('id', $tempLoc, 'location', ARRAY_A);
			$data['loc'] = $tempLoc2['name'];
			$data['lease'] = json_encode($_REQUEST['pods_meta_lease_type']);
			$data['post_id'] = $post_id;

			$url = 'http://leasing.dmcihomes.com.local/secured/property/save-unit';

		} else if ($post->post_type == 'booking_calendar') {
			$data['name'] = $_REQUEST['post_title'];
			$data['availability'] = $_REQUEST['pods_meta_available_units'];
			$data['start_date'] = $_REQUEST['pods_meta_availability_start'];
			$data['end_date'] = $_REQUEST['pods_meta_availability_end'];
			$data['calendar_post_id'] = $post_id;
			$data['units'] = json_encode($_REQUEST['pods_meta_units']);

			$url = 'http://leasing.dmcihomes.com.local/secured/property/save-calendar';
		} else if ($post->post_type == 'events') {
			$data['name'] = $_REQUEST['post_title'];
			$data['post_id'] = $post_id;
			$data['content'] = $_REQUEST['content'];
			$data['short_address'] = $_REQUEST['pods_meta_events_short_address'];
			$data['full_address'] = $_REQUEST['pods_meta_events_full_address'];
			$data['contact'] = $_REQUEST['pods_meta_events_contact_number'];
			$data['email'] = $_REQUEST['pods_meta_events_email_address'];

			$url = 'http://leasing.dmcihomes.com.local/secured/property/save-event';
		}

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec($ch);
	}
}

add_action('save_post', 'save_to_platform', 10, 3);

?>