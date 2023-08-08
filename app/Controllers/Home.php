<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Debug\VarDump;


class Home extends BaseController
{
    // Di dalam controller
    public function index()
    {
        $bidangData = $this->getBidang();
        // $db = \Config\Database::connect();
        
        // $query = $db->query("SELECT distinct kd_kegiatan FROM tbl_pagu WHERE bidang = ? AND kd_program = ?", ["SKKI","CD"]);
        // var_dump($query);
        return view('dashboard', ['bidangData' => $bidangData]);
    }

    public function getPrograms()
    {
        $selectedBidang = $this->request->getGet('bidang');

        $db = \Config\Database::connect();
        $query = $db->query("SELECT distinct kd_program FROM tbl_pagu WHERE bidang = ?", [$selectedBidang]);
        $programs = $query->getResultArray();

        return $this->response->setJSON($programs);
    }

    public function getKegiatan()
    {
        // $selectedBidang = $this->request->getGet('bidang');
        $selectedProgram = $this->request->getGet('program');

        $db = \Config\Database::connect();
        
        $query = $db->query("SELECT distinct kd_kegiatan FROM tbl_pagu WHERE bidang = ? AND kd_program = ?", ["SKKI",$selectedProgram]);
        $programs = $query->getResultArray();

        return $this->response->setJSON($programs);
    }

    public function getKRO()
    {
        $selectedKegiatan = $this->request->getGet('kegiatan');

        $db = \Config\Database::connect();
        $query = $db->query("SELECT distinct kd_kro FROM tbl_pagu WHERE kd_kegiatan = ?", [$selectedKegiatan]);
        $programs = $query->getResultArray();

        return $this->response->setJSON($programs);
    }

    public function getRO()
    {
        $selectedKRO = $this->request->getGet('kro');

        $db = \Config\Database::connect();
        $query = $db->query("SELECT distinct kd_ro FROM tbl_pagu WHERE kd_kro = ?", [$selectedKRO]);
        $programs = $query->getResultArray();

        return $this->response->setJSON($programs);
    }

    public function getKomponen()
    {
        $selectedRO = $this->request->getGet('ro');

        $db = \Config\Database::connect();
        $query = $db->query("SELECT distinct kd_komponen FROM tbl_pagu WHERE kd_ro = ?", [$selectedRO]);
        $programs = $query->getResultArray();

        return $this->response->setJSON($programs);
    }

    public function getSubKomponen()
    {
        $selectedKomponen = $this->request->getGet('komponen');

        $db = \Config\Database::connect();
        $query = $db->query("SELECT distinct kd_sub_komponen FROM tbl_pagu WHERE kd_komponen = ?", [$selectedKomponen]);
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

