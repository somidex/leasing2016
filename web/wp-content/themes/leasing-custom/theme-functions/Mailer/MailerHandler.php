<?php

require_once 'Swiftmailer/swift_required.php';

class MailerHandler
{
    public function sendBookingNotif($lead)
    {
    	$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
		->setUsername('dexter.loor@gmail.com')
		->setPassword('rocketman88')
		;

		$mailer = Swift_Mailer::newInstance($transport);

		$body = "Howdy! \n\n" .
		"A new property booking has been recorded. \n".
		"Below are the details: \n\n".
		"Move-in Date: ".$lead['start']."\n".
		"Move-out Date: ".$lead['end']."\n".
		"Name: ".$lead['fname']." ".$lead['lname']."\n".
		"Email: ".$lead['email']."\n".
		"Contact Number: ".$lead['contact']."\n".
		"Present Country: ".$lead['country']."\n".
		"Nationality: ".$lead['nationality']."\n".
		"Unit Booked: ".$lead['unit']."\n".
		"Notes: ".$lead['notes']."\n\n".
		"This message was generated at DMCI Leasing Website.";

		$message = Swift_Message::newInstance('New Booking from Leasing Website')
		->setFrom(array('webmail@leasing.dmcihomes.com' => 'DMCI Leasing Webmaster'))
		->setTo(array('leasing@dmcihomes.com' => 'DMCI Leasing Services'))
		->setBcc(array('dexter.loor@searchoptmedia.com', 'angelo@searchoptmedia.com', 'john.hernandez@searchoptmedia.com'))
		->setBody($body)
		;

		$result = $mailer->send($message);

		return $result;
    }

    public function sendAppointmentNotif($lead)
    {
    	$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
		->setUsername('dexter.loor@gmail.com')
		->setPassword('rocketman88')
		;

		$mailer = Swift_Mailer::newInstance($transport);

		$body = "Howdy! \n\n" .
		"A new appointment request has been recorded. \n".
		"Below are the details: \n\n".
		"Preferred Date: ".$lead['date']."\n".
		"Preferred Time: ".$lead['time']."\n".
		"Name: ".$lead['fname']." ".$lead['lname']."\n".
		"Email: ".$lead['email']."\n".
		"Contact Number: ".$lead['contact']."\n".
		"Present Country: ".$lead['country']."\n".
		"Nationality: ".$lead['nationality']."\n".
		"Unit Interested in: ".$lead['unit']."\n".
		"Notes: ".$lead['notes']."\n\n".
		"This message was generated at DMCI Leasing Website.";

		$message = Swift_Message::newInstance('New Appointment Request Submitted in Leasing Website')
		->setFrom(array('webmail@leasing.dmcihomes.com' => 'DMCI Leasing Webmaster'))
		->setTo(array('leasing@dmcihomes.com' => 'DMCI Leasing Services'))
		->setBcc(array('dexter.loor@searchoptmedia.com', 'angelo@searchoptmedia.com', 'john.hernandez@searchoptmedia.com'))
		->setBody($body)
		;

		$result = $mailer->send($message);

		return $result;
    }
}

?>