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

    public function filter()
    {
        $selectedBidang = $this->request->getPost('bidang');
        $selectedProgram = $this->request->getPost('program');
        $selectedKegiatan = $this->request->getPost('kegiatan');
        $selectedKro = $this->request->getPost('kro');
        $selectedRo = $this->request->getPost('ro');
        $selectedKomponen = $this->request->getPost('komponen');
        $selectedSubkomponen = $this->request->getPost('subkomponen');
        // var_dump($selectedBidang,$selectedProgram,$selectedKegiatan,$selectedKro,$selectedRo,$selectedKomponen,$selectedSubkomponen);
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM tbl_pagu WHERE bidang = ? AND kd_program = ? AND kd_kegiatan = ? AND kd_kro = ? AND kd_ro = ? AND kd_komponen = ? AND kd_sub_komponen = ?", [$selectedBidang,$selectedProgram,$selectedKegiatan,$selectedKro,$selectedRo,$selectedKomponen,$selectedSubkomponen]);
        $result = $query->getResultArray();
        // var_dump($result);
        return view('dashboard', ['selectedBidang' => $selectedBidang, 'selectedProgram' => $selectedProgram, 'selectedKegiatan' => $selectedKegiatan, 'selectedKro' => $selectedKro, 'selectedRo' => $selectedRo, 'selectedKomponen' =>  $selectedKomponen, 'selectedSubkomponen' => $selectedSubkomponen, 'result' => $result]);
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
        $selectedBidang = $this->request->getGet('bidang');
        $selectedProgram = $this->request->getGet('program');

        $db = \Config\Database::connect();
        
        $query = $db->query("SELECT distinct kd_kegiatan FROM tbl_pagu WHERE bidang = ? AND kd_program = ?", [$selectedBidang,$selectedProgram]);
        $programs = $query->getResultArray();

        return $this->response->setJSON($programs);
    }

    public function getKRO()
    {
        $selectedBidang = $this->request->getGet('bidang');
        $selectedProgram = $this->request->getGet('program');
        $selectedKegiatan = $this->request->getGet('kegiatan');

        $db = \Config\Database::connect();
        // $query = $db->query("SELECT distinct kd_kro FROM tbl_pagu WHERE kd_kegiatan = ?", [$selectedKegiatan]);
        $query = $db->query("SELECT distinct kd_kro FROM tbl_pagu WHERE bidang = ? AND kd_program = ? AND kd_kegiatan = ?", [$selectedBidang,$selectedProgram,$selectedKegiatan]);
        $programs = $query->getResultArray();

        return $this->response->setJSON($programs);
    }

    public function getRO()
    {
        $selectedBidang = $this->request->getGet('bidang');
        $selectedProgram = $this->request->getGet('program');
        $selectedKegiatan = $this->request->getGet('kegiatan');
        $selectedKRO = $this->request->getGet('kro');

        $db = \Config\Database::connect();
        // $query = $db->query("SELECT distinct kd_ro FROM tbl_pagu WHERE kd_kro = ?", [$selectedKRO]);
        $query = $db->query("SELECT distinct kd_ro FROM tbl_pagu WHERE bidang = ? AND kd_program = ? AND kd_kegiatan = ? AND kd_kro = ?", [$selectedBidang,$selectedProgram,$selectedKegiatan,$selectedKRO]);
        $programs = $query->getResultArray();

        return $this->response->setJSON($programs);
    }

    public function getKomponen()
    {
        $selectedBidang = $this->request->getGet('bidang');
        $selectedProgram = $this->request->getGet('program');
        $selectedKegiatan = $this->request->getGet('kegiatan');
        $selectedKRO = $this->request->getGet('kro');
        $selectedRO = $this->request->getGet('ro');

        $db = \Config\Database::connect();
        // $query = $db->query("SELECT distinct kd_komponen FROM tbl_pagu WHERE kd_ro = ?", [$selectedRO]);
        $query = $db->query("SELECT distinct kd_komponen FROM tbl_pagu WHERE bidang = ? AND kd_program = ? AND kd_kegiatan = ? AND kd_kro = ? AND kd_ro = ?", [$selectedBidang,$selectedProgram,$selectedKegiatan,$selectedKRO,$selectedRO]);
        $programs = $query->getResultArray();

        return $this->response->setJSON($programs);
    }

    public function getSubKomponen()
    {
        $selectedBidang = $this->request->getGet('bidang');
        $selectedProgram = $this->request->getGet('program');
        $selectedKegiatan = $this->request->getGet('kegiatan');
        $selectedKRO = $this->request->getGet('kro');
        $selectedRO = $this->request->getGet('ro');
        $selectedKomponen = $this->request->getGet('komponen');

        $db = \Config\Database::connect();
        // $query = $db->query("SELECT distinct kd_sub_komponen FROM tbl_pagu WHERE kd_komponen = ?", [$selectedKomponen]);
        $query = $db->query("SELECT distinct kd_sub_komponen FROM tbl_pagu WHERE bidang = ? AND kd_program = ? AND kd_kegiatan = ? AND kd_kro = ? AND kd_ro = ? AND kd_komponen = ?", [$selectedBidang,$selectedProgram,$selectedKegiatan,$selectedKRO,$selectedRO,$selectedKomponen]);
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

