<?php

session_start();

include 'Database/DBHandler.php';
include 'Mailer/MailerHandler.php';
include 'Spreadsheet/SpreadsheetHandler.php';

if (isset($_POST) && !empty($_POST)) {

	$db = new DBHandler();
	$db->connect();

	$mail = new MailerHandler;
	$ss = new SpreadsheetHandler;

	if ($_POST['leaseType'] == 'short-term') :
		$result = $db->insertBookingLead($_POST);
		$mailRes = $mail->sendBookingNotif($_POST);
        $ssRes = $ss->addBookingLeads($_POST);
	elseif ($_POST['leaseType'] == 'long-term') :
		$result = $db->insertAppointmentLead($_POST);
		$mailRes = $mail->sendAppointmentNotif($_POST);
        $ssRes = $ss->addAppointmentLeads($_POST);
	endif;

	if ($result == 1) {
		echo json_encode(1);
	} else {
		echo json_decode(-1);
	}

	$_SESSION['thank-you'] = 1;

} else {
	header("Location: ".get_site_url());
}

?>