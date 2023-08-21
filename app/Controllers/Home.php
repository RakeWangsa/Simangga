<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Debug\VarDump;
use CodeIgniter\I18n\Time;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\UserModel;
use CodeIgniter\Session\Session;




class Home extends BaseController
{
    // Di dalam controller
    protected $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }
        $bidangData = $this->getBidang();
        // $db = \Config\Database::connect();
        
        // $query = $db->query("SELECT distinct kd_kegiatan FROM tbl_pagu WHERE bidang = ? AND kd_program = ?", ["SKKI","CD"]);
        // var_dump($query);
        return view('dashboard', ['bidangData' => $bidangData]);
    }

    public function login()
    {
        return view('login');
    }

    public function cek()
    {
        
        // $nama = $this->request->getPost('nama');
        $nama = $this->request->getPost('nama');
        $nip = $this->request->getPost('nip');
        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // var_dump($nama,$email,$password,$hashedPassword);
        $userModel = new UserModel();
        $user = $userModel->where('Nama_Pegawai', $nama)->first();
        if(isset($user)){
            if ($user['NIP_Pegawai']==$nip) {
                $this->session->set('logged_in', true);
                // $this->session->set('nama', $nama);
                return redirect()->to('/');
            } else {
                $data['error'] = 'Login gagal, Nama dan NIP tidak sesuai.';
                return redirect()->to('/login')->with('error', $data['error']);
            }
        }else{
            $data['error'] = 'Login gagal, Nama dan NIP tidak sesuai.';
            return redirect()->to('/login')->with('error', $data['error']);
        }
    }

    public function logout()
    {
        $this->session->destroy(); // Menghapus semua data session
        return redirect()->to('/login');
    }


    public function register()
    {
        return view('register');
    }

    public function registerSubmit()
    {
        
        $nama = $this->request->getPost('nama');
        $nip = $this->request->getPost('nip');


        $userModel = new UserModel();
        $user = $userModel->where('Nama_Pegawai', $nama)->first();
        if(isset($user)){
            $data['error'] = 'Registrasi Gagal, Nama sudah terdaftar.';
            return redirect()->to('/register')->with('error', $data['error']);
        }else{
            $data = [
                'Nama_Pegawai' => $nama,
                'NIP_Pegawai' => $nip,
            ];
            $userModel->insert($data);
            $data['success'] = 'Registrasi berhasil, Silahkan login.';
            return redirect()->to('/login')->with('success', $data['success']);
        }
    }

    public function filter()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $selectedBidang = $this->request->getPost('bidang');
        $selectedProgram = $this->request->getPost('program');
        $selectedKegiatan = $this->request->getPost('kegiatan');
        $selectedKro = $this->request->getPost('kro');
        $selectedRo = $this->request->getPost('ro');
        $selectedKomponen = $this->request->getPost('komponen');
        $selectedSubkomponen = $this->request->getPost('subkomponen');
        $selectedKdAkun = $this->request->getPost('kdakun');

        $db = \Config\Database::connect();

        $query = "SELECT * FROM tbl_pagu WHERE";

        $conditions = array(
            'bidang' => $selectedBidang,
            'kd_program' => $selectedProgram,
            'kd_kegiatan' => $selectedKegiatan,
            'kd_kro' => $selectedKro,
            'kd_ro' => $selectedRo,
            'kd_komponen' => $selectedKomponen,
            'kd_sub_komponen' => $selectedSubkomponen,
            'kd_akun' => $selectedKdAkun,
        );

        $whereClause = "";

        foreach ($conditions as $field => $value) {
            if ($value !== '') {
                $whereClause .= " $field = '$value' AND";
            } else {
                break; // Stop when an empty value is encountered
            }
        }

        // Remove trailing "AND" if it exists
        $whereClause = rtrim($whereClause, " AND");

        // Append the constructed WHERE clause to the query
        $query .= $whereClause;

        $result = $db->query($query)->getResultArray();

        return view('dashboard', [
            'selectedBidang' => $selectedBidang,
            'selectedProgram' => $selectedProgram,
            'selectedKegiatan' => $selectedKegiatan,
            'selectedKro' => $selectedKro,
            'selectedRo' => $selectedRo,
            'selectedKomponen' => $selectedKomponen,
            'selectedSubkomponen' => $selectedSubkomponen,
            'selectedKdAkun' => $selectedKdAkun,
            'result' => $result
        ]);
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

    public function getKdAkun()
    {
        $selectedBidang = $this->request->getGet('bidang');
        $selectedProgram = $this->request->getGet('program');
        $selectedKegiatan = $this->request->getGet('kegiatan');
        $selectedKRO = $this->request->getGet('kro');
        $selectedRO = $this->request->getGet('ro');
        $selectedKomponen = $this->request->getGet('komponen');
        $selectedSubKomponen = $this->request->getGet('subkomponen');

        $db = \Config\Database::connect();
        // $query = $db->query("SELECT distinct kd_sub_komponen FROM tbl_pagu WHERE kd_komponen = ?", [$selectedKomponen]);
        $query = $db->query("SELECT distinct kd_akun FROM tbl_pagu WHERE bidang = ? AND kd_program = ? AND kd_kegiatan = ? AND kd_kro = ? AND kd_ro = ? AND kd_komponen = ? AND kd_sub_komponen = ?", [$selectedBidang,$selectedProgram,$selectedKegiatan,$selectedKRO,$selectedRO,$selectedKomponen,$selectedSubKomponen]);
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

