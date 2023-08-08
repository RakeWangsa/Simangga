<?php
namespace App\Models;

use Google_Client;
use Google_Service_Sheets;

class GoogleSheetsModel
{
    private $client;
    private $service;

    public function __construct()
    {
        // Load the credentials file and create a Google_Client instance
        $this->client = new Google_Client();
        $this->client->setApplicationName('Pagu');
        $this->client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
        $this->client->setAuthConfig('/credentialsAPI.json'); // Path to your credentials JSON file

        // Create a Google_Service_Sheets instance
        $this->service = new Google_Service_Sheets($this->client);
    }

    public function getData($spreadsheetId, $range)
    {
        try {
            // Get data from the specified range in the spreadsheet
            $response = $this->service->spreadsheets_values->get($spreadsheetId, $range);
            return $response->getValues();
        } catch (\Exception $e) {
            // Handle any errors that might occur
            return [];
        }
    }
}
