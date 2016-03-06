<?php

ini_set('max_execution_time', 60);

class Spreadsheet
{
    public $token;
    private $spreadsheet;
    private $worksheet;
    private $spreadsheetid;
    private $worksheetid;
    
    public function __construct($username, $password)
    {
        $this->authenticate($username, $password);
    }
    
    public function authenticate($username, $password)
    {
        $url = "https://www.google.com/accounts/ClientLogin";
        $fields = array(
            "accountType" => "HOSTED_OR_GOOGLE",
            "Email" => $username,
            "Passwd" => $password,
            "service" => "wise",
            "source" => "pfbc"
        );
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
        $response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        
        if($status == 200) {
            if(stripos($response, "auth=") !== false) {
                preg_match("/auth=([a-z0-9_\-]+)/i", $response, $matches);
                $this->token = $matches[1];
            }
        }
    }
    
    public function setSpreadsheet($title)
    {
        $this->spreadsheet = $title;
        
        return $this;
    }
    
    public function setSpreadsheetId($id)
    {
        $this->spreadsheetid = $id;
        return $this;
    }
    
    public function setWorksheet($title)
    {
        $this->worksheet = $title;
        
        return $this;
    }
    
    public function add($data)
    {
        if(!empty($this->token)) {
            $url = $this->getPostUrl();
            
            if(!empty($url)) {
                $headers = array(
                    "Content-Type: application/atom+xml",
                    "Authorization: GoogleLogin auth=" . $this->token,
                    "GData-Version: 3.0"
                );
                
                $columnIDs = $this->getColumnIDs();
                
                if($columnIDs) {
                    $fields = '<entry xmlns="http://www.w3.org/2005/Atom" xmlns:gsx="http://schemas.google.com/spreadsheets/2006/extended">';
					foreach($data as $key => $value) {
						$key = $this->formatColumnID($key);
						if(in_array($key, $columnIDs))
							$fields .= "<gsx:$key><![CDATA[$value]]></gsx:$key>";
					}
					$fields .= '</entry>';

					$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $url);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
					$response = curl_exec($curl);
					$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
					curl_close($curl);
				}
			}
		}
	}
    
    public function edit($data)
    {
        if (!empty($this->token)) {
            $url = $this->getXMLEntryEtag($data);
            
            if (!empty($url)) {
                $headers = array(
                    "Content-Type: application/atom+xml",
                    "Authorization: GoogleLogin auth=" . $this->token,
                    "GData-Version: 3.0",
                    "If-Match: *"
                );
                
                $xml = '<?xml version="1.0"?><entry gd:etag="&quot;'.$url['etag'].'&quot;" xmlns="http://www.w3.org/2005/Atom" xmlns:gd="http://schemas.google.com/g/2005" xmlns:gsx="http://schemas.google.com/spreadsheets/2006/extended" xmlns:openSearch="http://a9.com/-/spec/opensearch/1.1/">';
                $xml .= '<id>'.$url['id'].'</id>';
                $xml .= '<updated>'.$url['updated'].'</updated>';
                $xml .= '<app:edited xmlns:app="http://www.w3.org/2007/app">'.$url['updated'].'</app:edited>';
				$xml .= '<category scheme="http://schemas.google.com/spreadsheets/2006" term="http://schemas.google.com/spreadsheets/2006#list"/>';
				$xml .= '<title>'.$data['Name'].'</title>';
				$xml .= '<content>email: '.$data['Email'].', contactnumber: '.$data['Contact Number'].', location: '.$data['Location'].', experience: '.$data['Experience'].', dateposted: '.$data['Date Posted'].', status: '.$data['Status'].'</content>';
				$xml .= '<link rel="self" type="application/atom+xml" href="'.$url['self'].'"/>';
				$xml .= '<link rel="edit" type="application/atom+xml" href="'.$url['edit'].'"/>';

				foreach ($data as $key => $value) {
					$key = $this->formatColumnID($key);
					$xml .= "<gsx:$key><![CDATA[$value]]></gsx:$key>";
				}
				$xml .= '</entry>';

				$curl = curl_init();
		        curl_setopt($curl, CURLOPT_URL, $url['edit']); //feed is obtained from spreadsheet url and id can be obtained by retrieving list feed
		        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
		        curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
		        curl_setopt($curl, CURLOPT_HEADER, false);
		        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt($curl, CURLOPT_VERBOSE, true);
		        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		        $response = curl_exec($curl);
		        $errRet = curl_error($curl);
			}
		}
	}

    public function checkDuplicate($id)
    {
        if (!empty($this->token)) {
            $tId = $this->getSpreadsheetEntry($id);

            if ($tId) {
                return true;
            }

            return false;
        }
    }
    
    private function getColumnIDs()
    {
        $url = "https://spreadsheets.google.com/feeds/cells/" . $this->spreadsheetid . "/" . $this->worksheetid . "/private/full?max-row=1";
        $headers = array(
            "Authorization: GoogleLogin auth=" . $this->token,
            "GData-Version: 3.0"
        );
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        
        if ($status == 200) {
            $columnIDs = array();
            $xml = simplexml_load_string($response);
            
            if ($xml->entry) {
                $columnSize = sizeof($xml->entry);
                
                for ($c = 0; $c < $columnSize; ++$c) {
                    $columnIDs[] = $this->formatColumnID($xml->entry[$c]->content);
                }
            }
            
            return $columnIDs;
        }
        
        return "";
    }
    
    private function getPostUrl()
    {
        if (empty($this->spreadsheetid)) {
            #find the id based on the spreadsheet name
            $url = "https://spreadsheets.google.com/feeds/spreadsheets/private/full?title=" . urlencode($this->spreadsheet);
            $headers = array(
                "Authorization: GoogleLogin auth=" . $this->token,
                "GData-Version: 3.0"
            );
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if ($status == 200) {
                $spreadsheetXml = simplexml_load_string($response);
                
                if ($spreadsheetXml->entry) {
                    $this->spreadsheetid = basename(trim($spreadsheetXml->entry[0]->id));
                    $url = "https://spreadsheets.google.com/feeds/worksheets/" . $this->spreadsheetid . "/private/full";
                    
                    if (!empty($this->worksheet)) {
                        $url .= "?title=" . $this->worksheet;
                    }
                    
                    curl_setopt($curl, CURLOPT_URL, $url);
                    $response = curl_exec($curl);
                    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    
                    if ($status == 200) {
                        $worksheetXml = simplexml_load_string($response);
                        
                        if ($worksheetXml->entry) {
                            $this->worksheetid = basename(trim($worksheetXml->entry[0]->id));
                        }
                    }
                }
            }
            curl_close($curl);
        }
        
        if (!empty($this->spreadsheetid) && !empty($this->worksheetid)) {
            return "https://spreadsheets.google.com/feeds/list/" . $this->spreadsheetid . "/" . $this->worksheetid . "/private/full";
        }
        
        return "";
    }

    private function getSpreadsheetEntry($id)
    {
        $url = $this->getPostUrl();

        if (!empty($url)) {
            $headers = array(
                "Content-Type: application/atom+xml",
                "Authorization: GoogleLogin auth=" . $this->token,
                "GData-Version: 3.0"
            );

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($status == 200) {
                $xmlFeed = simplexml_load_string($response);

                foreach ($xmlFeed->entry as $entry) {
                    if ($id == $entry->title) {
                        return $entry->title;
                    }
                }

                return false;
            }
        }
    }
    
    private function getXMLEntryEtag($data)
    {
        $url = $this->getPostUrl();
        $return = array();
        
        if (!empty($url)) {
            $headers = array(
                "Content-Type: application/atom+xml",
                "Authorization: GoogleLogin auth=" . $this->token,
                "GData-Version: 3.0"
            );
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($status == 200) {
                $xmlFeed = simplexml_load_string($response);
                
                foreach ($xmlFeed->entry as $entry) {

                    $haystack = $entry->title;
                    $needle = $data['Transaction ID'];

                    if ($needle == $haystack) {
                        $entryXML = simplexml_load_string($entry->asXML());
                    }
                }
                
                $idString = (array)$entryXML->id;
                $updatedString = (array)$entryXML->updated;
                $return['id'] = $idString[0];
                $return['updated'] = $updatedString[0];
                
                //self
                $selfAttr = array();
                foreach ($entryXML->link[0]->attributes() as $key => $value) {
                    $selfAttr[$key] = trim($value[0]);
                }
                
                //edit
                $editArr = array();
                foreach ($entryXML->link[1]->attributes() as $key => $value) {
                    $editArr[$key] = trim($value[0]);
                }
                
                $return['self'] = $selfAttr['href'];
                $return['edit'] = $editArr['href'];
                
                foreach ($entryXML->attributes() as $key => $value) {
                    if ($key == 'gd:etag') {
                        $return['etag'] = str_replace('"', '', $value);
                        
                        return $return;
                    }
                }
            }
        }
        
        return "";
    }
    
    private function formatColumnID($val)
    {
        return preg_replace("/[^a-zA-Z0-9.-]/", "", strtolower($val));
    }
}
