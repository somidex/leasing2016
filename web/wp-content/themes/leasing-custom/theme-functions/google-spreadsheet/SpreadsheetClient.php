<?php

set_include_path(get_include_path() . PATH_SEPARATOR . '/src');
require_once 'src/Google/autoload.php';
require_once 'src/Spreadsheet/DefaultServiceRequest.php';
require_once 'src/Spreadsheet/ServiceRequestFactory.php';
require_once 'src/Spreadsheet/SpreadsheetService.php';

use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
use Google\Spreadsheet\SpreadsheetService;

class SpreadsheetClient
{
    public $token;
    private $spreadsheet;
    private $worksheet;
    private $spreadsheetid;
    private $worksheetid;
    
    private $clientId = "879755663466-d5c4vcgpqkfjqrc7fb6defj343teqd55.apps.googleusercontent.com";
    private $email = "879755663466-d5c4vcgpqkfjqrc7fb6defj343teqd55@developer.gserviceaccount.com";
    private $scope = "https://spreadsheets.google.com/feeds";
    private $path = "";
    private $spreadsheetId  = "";
    private $tabTitle = "";
    private $privateKey = "";
    
    public function __construct($spreadsheetId, $tabTitle)
    {
        $this->path = __DIR__.DIRECTORY_SEPARATOR."Spreadsheet Master-4bb095fd5e19.p12";
        $this->spreadsheetId = $spreadsheetId;
        $this->tabTitle = $tabTitle;
        
        $this->authenticate();
    }
    
    public function authenticate()
    {
        $client = new Google_Client();
        $client->setClientId($this->clientId);
        $client_email = $this->email;
        $privateKey = file_get_contents($this->path);
        
        $credentials = new Google_Auth_AssertionCredentials(
            $this->email,
            array($this->scope),
            $privateKey
        );
        
        $client->setAssertionCredentials($credentials);
        
        if ($client->getAuth()->isAccessTokenExpired()) {
            $client->getAuth()->refreshTokenWithAssertion($credentials);
        }
        $tok = json_decode($client->getAccessToken());
        
        $this->token = $tok->access_token;
    }
    
    public function addEntry($lead)
    {
        $serviceRequest = new DefaultServiceRequest($this->token);
        ServiceRequestFactory::setInstance($serviceRequest);
        
        $spreadsheetService = new SpreadsheetService();
        $spreadsheetFeed = $spreadsheetService->getSpreadsheetById($this->spreadsheetId);
        $worksheetFeed = $spreadsheetFeed->getWorksheets();
        $worksheet = $worksheetFeed->getByTitle($this->tabTitle);
        $listFeed = $worksheet->getListFeed();
        
        $result = $listFeed->insert($lead);
        
        return $result;
    }
}
