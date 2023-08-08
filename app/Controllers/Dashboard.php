<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Google\Client as GoogleClient;
use Google\Service\Sheets;

class Dashboard extends Controller
{
    public function index()
    {
        $programData = $this->getProgram();
        $bidangData = $this->getBidang();
        //$tableData = $this->getDataTabel();

       // return view('dashboard', ['programData' => $programData,'kegiatanData' => $kegiatanData,'tableData' => $tableData]);
       return view('dashboard', ['programData' => $programData, 'bidangData' => $bidangData]);
    }

    private function getProgram()
    {
        // Inisialisasi Google API Client
        $client = new GoogleClient();
        $client->setAuthConfig(ROOTPATH . 'app/Config/google_api.json');
        $client->setScopes([Sheets::SPREADSHEETS_READONLY]);
        $client->setDeveloperKey('AIzaSyALKvo5xLRfkdd9do7zikNLRHvZCFp3LSs'); // Ganti dengan API key Anda yang valid
        $service = new Sheets($client);

        // ID spreadsheet Anda
        $spreadsheetId = '16sBbHroAVuS1kj5jvz6MqIstVxezo_SJ68snP_Fjl1k'; // Ganti dengan ID spreadsheet Anda

        $range = 'drop down!A3:A4';

        // Memanggil API untuk mendapatkan data
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();
        $programData = [];
        if (!empty($values[0])) {
            $programData['CD'] = isset($values[0][0]) ? $values[0][0] : '';
            $programData['WA'] = isset($values[1][0]) ? $values[1][0] : '';
        }
        
        return $programData;
    }
    
    private function getBidang()
    {
    // Inisialisasi Google API Client
    $client = new GoogleClient();
    $client->setAuthConfig(ROOTPATH . 'app/Config/google_api.json');
    $client->setScopes([Sheets::SPREADSHEETS_READONLY]);
    $client->setDeveloperKey('AIzaSyALKvo5xLRfkdd9do7zikNLRHvZCFp3LSs'); // Ganti dengan API key Anda yang valid
    $service = new Sheets($client);

    // ID spreadsheet Anda
    $spreadsheetId = '1j6V68MEy5F78cqOtQlQmpIa0RzgmVCKwkISjy0_h7dY'; // Ganti dengan ID spreadsheet Anda

    $range = 'DATABASE!A3:A';

    // Memanggil API untuk mendapatkan data dari kolom A
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();

    // Menggunakan array asosiatif untuk menyimpan data unik
    $uniqueValues = [];

    // Mengisi array asosiatif dengan data unik dari kolom A
    foreach ($values as $row) {
        if (!empty($row[0])) {
            $uniqueValues[$row[0]] = true;
        }
    }

    // Mengambil kunci dari array asosiatif sebagai data unik
    $bidangData = array_keys($uniqueValues);

    return $bidangData;
    }

    // private function getKegiatan()
    // {
    //     // Inisialisasi Google API Client
    //     $client = new GoogleClient();
    //     $client->setAuthConfig(ROOTPATH . 'app/Config/google_api.json');
    //     $client->setScopes([Sheets::SPREADSHEETS_READONLY]);
    //     $client->setDeveloperKey('AIzaSyALKvo5xLRfkdd9do7zikNLRHvZCFp3LSs'); // Ganti dengan API key Anda yang valid
    //     $service = new Sheets($client);
        
    //     // ID spreadsheet Anda
    //     $spreadsheetId = '178U19eBIKshTNApuXQknR1JkkrQd5P3MrhpZxW1OjkY'; // Ganti dengan ID spreadsheet Anda

    //     // Mengambil data dari sel
    //     $range = 'drop down!D1'; // Ganti dengan range yang sesuai di sheet 'nama'
    //     $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    //     $values = $response->getValues();
    //     $searchValue = isset($values[0][0]) ? $values[0][0] : 'Data tidak ditemukan';
        
    //     $range = 'nama!A2:AO'; // Ganti dengan range yang sesuai di sheet 'nama'
        
    //     // Eksekusi rumus menggunakan Google Sheets API
    //     $response = $service->spreadsheets_values->get($spreadsheetId, $range, array(
                
    //         'valueRenderOption' => 'FORMULA'
    //     ));
    //     $values = $response->getValues();
        
    //     // Proses hasil query untuk mendapatkan data unik
    //     $kegiatanData = array();
    //     if (!empty($values)) {
    //         foreach ($values as $row) {
    //             if (!empty($row[0]) && !empty($row[7]) && $row[34] == 7 && strpos($row[35], $searchValue) !== false) {
    //                 $kegiatanData[] = $row[0];
    //             }
    //         }
    //     }
    //     return $kegiatanData;
    // }

    // private function getDataTabel()
    // {
    //     // Inisialisasi Google API Client
    //     $client = new GoogleClient();
    //     $client->setAuthConfig(ROOTPATH . 'app/Config/google_api.json');
    //     $client->setScopes([Sheets::SPREADSHEETS_READONLY]);
    //     $client->setDeveloperKey('AIzaSyALKvo5xLRfkdd9do7zikNLRHvZCFp3LSs'); // Ganti dengan API key Anda yang valid
    //     $service = new Sheets($client);

    //     // ID spreadsheet Anda
    //     $spreadsheetId = '178U19eBIKshTNApuXQknR1JkkrQd5P3MrhpZxW1OjkY'; // Ganti dengan ID spreadsheet Anda

    //     // Nama sheet di spreadsheet Anda
    //     $sheetName = 'Dashboard'; // Ganti dengan nama sheet Anda

    //     // Range sel yang ingin diambil
    //     $range = $sheetName . '!A13:D13';

    //     // Memanggil API untuk mendapatkan data
    //     $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    //     $values = $response->getValues();
    //     $tableData = [];
    //     if (!empty($values[0])) {
    //         $tableData['Pagu'] = isset($values[0][0]) ? $values[0][0] : '';
    //         $tableData['Realisasi'] = isset($values[0][1]) ? $values[0][1] : '';
    //         $tableData['Sisa_Pagu'] = isset($values[0][2]) ? $values[0][2] : '';
    //         $tableData['Persentase'] = isset($values[0][3]) ? $values[0][3] : '';
    //     }
       
    //     return $tableData;
    // }
}