<?php

// include 'Spreadsheet.php';
include_once (__DIR__."/../google-spreadsheet/SpreadsheetClient.php");

class SpreadsheetHandler
{
    private $spreadsheetId = "1RtVlnzL1Vw0RVTF86q5WY1hZwtwACa8mtaPqg4p-JjQ";
    private $bookingTab = "Bookings";
    private $appointmentTab = "Appointments";
    private $inquiryTab = "Inquiries";
    private $contactTab = "ContactUs";
    
	public function addContactLeadToDocs($data)
	{
        /*
		$now = date('Y-m-d H:i:s');

		$leadArr = array(
			"Name" => $data['fname'].' '.$data['lname'],
			"Contact Number" => $data['contact'],
			"Email" => $data['email'],
			"Property Type" => $data['type'],
			"Property" => $data['property'],
			"Message" => $data['message'],
			"Date Submitted" => $now
		);

		$spr = new Spreadsheet("dexter.loor@searchoptmedia.com", "dexterloorbe2010a");

		$spr->setSpreadsheet("Leasing Leads")->
		setWorksheet("Inquiries")->
		add($leadArr);
        */
        $spr = new SpreadsheetClient($this->spreadsheetId, $this->inquiryTab);
        $res = $spr->addEntry($data);

		if (isset($spr) && !empty($spr->token)) {
			return true;
		} else {
			return false;
		}
	}

	public function addContactFormLead($data)
	{
        $now = date('Y-m-d H:i:s');
        /*
		$leadArr = array(
			"Name" => $data['fname'].' '.$data['lname'],
			"Contact Number" => $data['contact'],
			"Email" => $data['email'],
			"Page Converted" => $data['type'],
			"Date" => $now,
			"Message" => $data['message'],
		);

		$spr = new Spreadsheet("dexter.loor@searchoptmedia.com", "dexterloorbe2010a");
		$spr->setSpreadsheet("Leasing Leads")->
		setWorksheet("ContactUs")->
		add($leadArr);
        */

		$leadArr = array(
			"name" => $data['name'],
            "contactnumber" => $data['contact'],
			"email" => $data['email'],
			"pageconverted" => $data['page_converted'],
			"date" => $now,
			"message" => $data['message'],
		);

        $spr = new SpreadsheetClient($this->spreadsheetId, $this->contactTab);
        $res = $spr->addEntry($leadArr);

		if (isset($spr) && !empty($spr->token)) {
			return true;
		} else {
			return false;
		}
	}

	public function addBookingLeads($data)
	{
        $now = date('Y-m-d H:i:s');
        /*
		$leadArr = array(
			"First Name" => $data['fname'],
			"Last Name" => $data['lname'],
			"Contact Number" => $data['contact'],
			"Email" => $data['email'],
			"Country" => $data['country'],
			"Nationality" => $data['nationality'],
			"Unit" => $data['unit'],
			"Location" => $data['unitLocation'],
			"Price Range" => $data['priceRange'],
			"Date Submitted" => $now
		);

		$spr = new Spreadsheet("dexter.loor@searchoptmedia.com", "dexterloorbe2010a");
		$spr->setSpreadsheet("Leasing Leads")->
		setWorksheet("Bookings")->
		add($leadArr);
        */
		$leadArr = array(
			"firstname" => $data['fname'],
			"lastname" => $data['lname'],
			"contactnumber" => $data['contact'],
			"email" => $data['email'],
			"country" => $data['country'],
			"nationality" => $data['nationality'],
			"unit" => $data['unit'],
            'unittype' => $data['unitType'],
			"location" => $data['unitLocation'],
			"pricerange" => $data['priceRange'],
			"datesubmitted" => $now,
            "ipaddress" => $data['clientIp'],
            "startdate" => $data['start'],
            "enddate" => $data['end'],
            "notes" => $data['notes'],
		);
        $spr = new SpreadsheetClient($this->spreadsheetId, $this->bookingTab);
        $res = $spr->addEntry($leadArr);
        
		if (isset($spr) && !empty($spr->token)) {
			return true;
		} else {
			return false;
		}
	}

	public function addAppointmentLeads($data)
	{
        $now = date('Y-m-d H:i:s');
        /*
		$leadArr = array(
			"First Name" => $data['fname'],
			"Last Name" => $data['lname'],
			"Contact Number" => $data['contact'],
			"Email" => $data['email'],
			"Country" => $data['country'],
			"Nationality" => $data['nationality'],
			"Unit" => $data['unit'],
			"Location" => $data['unitLocation'],
			"Price Range" => $data['priceRange'],
			"Date Submitted" => $now
		);

		$spr = new Spreadsheet("dexter.loor@searchoptmedia.com", "dexterloorbe2010a");
		$spr->setSpreadsheet("Leasing Leads")->
		setWorksheet("Appointments")->
		add($leadArr);
        */

		$leadArr = array(
			"firstname" => $data['fname'],
			"lastname" => $data['lname'],
			"contactnumber" => $data['contact'],
			"email" => $data['email'],
			"country" => $data['country'],
			"nationality" => $data['nationality'],
			"unit" => $data['unit'],
            "unittype" => $data['unitType'],
			"location" => $data['unitLocation'],
			"pricerange" => $data['priceRange'],
			"datesubmitted" => $now,
            "notes" => $data['notes'],
            "ipaddress" => $data['clientIp'],
            "preferreddate" => $data['date'],
            "preferredtime" => $data['time'],
		);
        
        $spr = new SpreadsheetClient($this->spreadsheetId, $this->appointmentTab);
        $res = $spr->addEntry($leadArr);

		if (isset($spr) && !empty($spr->token)) {
			return true;
		} else {
			return false;
		}
	}
}
