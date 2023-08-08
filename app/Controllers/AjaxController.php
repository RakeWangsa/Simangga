<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AjaxController extends BaseController
{
    // Di dalam controller
    public function index()
    {
        $bidangData = $this->getBidang();
     
        return view('dashboard', ['bidangData' => $bidangData]);
    }

    public function getPrograms()
    {
        $selectedBidang = $this->request->getGet('bidang');

        $db = \Config\Database::connect();
        $query = $db->query("SELECT kd_program FROM tbl_pagu WHERE bidang = ?", [$selectedBidang]);
        $programs = $query->getResultArray();
        
        return $this->response->setJSON($programs);
    }

    private function getBidang()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT distinct bidang FROM tbl_pagu");
        $result = $query->getResultArray();
        return $result;
    }

}

