<?php

class DBHandler
{
	private $host = '205.186.138.226';
    private $db = 'leasing_leads';
    private $user = 'leasingLeadsProd';
    private $pwd = 'leads$$123%%';
    private $port = '3306';
    private $pdo;
    
    public function __construct($host = null, $db = null, $user = null, $pwd = null, $port = null)
    {
        $this->host = $host ? $host : $this->host;
        $this->db = $db ? $db : $this->db;
        $this->user = $user ? $user : $this->user;
        $this->pwd = $pwd ? $pwd : $this->pwd;
        $this->port = $port ? $port : $this->port;
    }
    
    public function getConnection()
    {
        return $this->pdo;
    }
    
    public function connect()
    {
        $this->pdo = new PDO(
            'mysql:host='.$this->host.';port='.$this->port.';dbname='.$this->db,
            $this->user,
            $this->pwd,
            array(
                PDO::ATTR_PERSISTENT => false
            )
        );
        
        if (!$this->pdo) {
            die ("Could not connect to database!\n");
        } else {
            // echo 'Connected';
        }
    }
    
    public function isConnected()
    {
        if ($this->pdo) {
            return true;
        } else {
            return false;
        }
    }

    public function insertBookingLead($data)
    {
    	if ($data) {
    		$start = $data['start'];
			$end = $data['end'];
			$fname = $data['fname'];
			$lname = $data['lname'];
			$contact = $data['contact'];
			$email = $data['email'];
			$country = $data['country'];
			$nationality = $data['nationality'];
			$notes = $data['notes'];
			$unit = $data['unit'];
			$unitType = $data['unitType'];
			$unitLocation = $data['unitLocation'];
			$priceRange = $data['priceRange'];
            $calendarId = $data['calendarId'];
			$now = date('Y-m-d H:i:s');
			$status = 0;
            $client_ip = $data['clientIp'];

			$sql = "INSERT INTO `unit_bookings` (fname, lname, email, contact, country, nationality, check_in, check_out, unit, unit_type, unit_location, price_range, calendar_id, date_added, client_ip, status)
					VALUES (:fname, :lname, :email, :contact, :country, :nationality, :check_in, :check_out, :unit, :unit_type, :unit_location, :price_range, :calendar_id, :date_added, :client_ip, :status);";

			$query = $this->pdo->prepare($sql);

			$result = $query->execute(array(
				":fname" => $fname,
				":lname" => $lname,
				":email" => $email,
				":contact" => $contact,
				":country" => $country,
				":nationality" => $nationality,
				":check_in" => $start,
				":check_out" => $end,
				":unit" => $unit,
				":unit_type" => $unitType,
				":unit_location" => $unitLocation,
				":price_range" => $priceRange,
                ":calendar_id" => $calendarId,
				":date_added" => $now,
                ":client_ip" => $client_ip,
				":status" => $status,
			));

			return $result;
    	} else {
    		return false;
    	}
    }

    public function insertAppointmentLead($data)
    {
        if ($data) {
            $preferred = $data['date'];
            $time = $data['time'];
            $fname = $data['fname'];
            $lname = $data['lname'];
            $contact = $data['contact'];
            $email = $data['email'];
            $country = $data['country'];
            $nationality = $data['nationality'];
            $notes = $data['notes'];
            $unit = $data['unit'];
            $unitType = $data['unitType'];
            $unitLocation = $data['unitLocation'];
            $priceRange = $data['priceRange'];
            $calendarId = $data['calendarId'];
			$now = date('Y-m-d H:i:s');
            $status = 0;
            $client_ip = $data['clientIp'];

            $sql = "INSERT INTO `unit_appointments` (fname, lname, email, contact, country, nationality, preferred_date, preferred_time, unit, unit_type, unit_location, price_range, date_added, client_ip, calendar_id, status)
                    VALUES (:fname, :lname, :email, :contact, :country, :nationality, :preferred_date, :preferred_time, :unit, :unit_type, :unit_location, :price_range, :date_added, :client_ip, :calendar_id, :status);";

            $query = $this->pdo->prepare($sql);
            $result = $query->execute(array(
                ":fname" => $fname,
                ":lname" => $lname,
                ":email" => $email,
                ":contact" => $contact,
                ":country" => $country,
                ":nationality" => $nationality,
                ":preferred_date" => $preferred,
                ":preferred_time" => $time,
                ":unit" => $unit,
                ":unit_type" => $unitType,
                ":unit_location" => $unitLocation,
                ":price_range" => $priceRange,
                ":date_added" => $now,
                ":client_ip" => $client_ip,
                ":calendar_id" => $calendarId,
                ":status" => $status,
            ));

            return $result;
        } else {
            return false;
        }
    }

    public function getAllApprovedBookings($id)
    {
    	$query = "SELECT * FROM `unit_bookings` WHERE `status` = '1' AND `calendar_id` = ".$id.";";
        $sql = $this->pdo->prepare($query);
        $sql->execute();
        $data = $sql->fetchall(PDO::FETCH_ASSOC);
        
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function getAllAppointmentsApproved($id)
    {
        $query = "SELECT * FROM `unit_appointments` WHERE `status` = '1' AND `calendar_id` = ".$id.";";
        $sql = $this->pdo->prepare($query);
        $sql->execute();
        $data = $sql->fetchall(PDO::FETCH_ASSOC);
        
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }
}

?>