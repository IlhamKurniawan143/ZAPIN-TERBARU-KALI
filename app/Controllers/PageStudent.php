<?php 
namespace App\Controllers;

use App\Models\ClassModel;

class PageStudent extends BaseController
{
    public function index() 
    {
        $session = session();

        // cek apakah user sudah login dan memiliki role 'pegawai'
        if (!$session->get('is_login') || $session->get('role') !== 'pegawai') {
            return redirect()->to('/login');
        }

        // mengambil id pegawai dari sesi
        $pegawai_id = $session->get('user_id');

        // mengambil data kelas dari database berdasarkan id pegawai
        $classModel = new ClassModel();
        $classes = $classModel->getClassesByPegawaiId($pegawai_id);

        // mengirim data kelas ke view
        return view('pages-student/dashboard_pegawai', ['classes' => $classes]);

        // $db = \Config\Database::connect();
        // $sql = "SELECT classes.* FROM classes 
        //         JOIN class_members ON classes.id = class_members.class_id 
        //         WHERE class_members.pegawai_id = $pegawai_id";
        // $result = $db->query($sql);
        // $classes = [];
        // if ($result->getNumRows() > 0) {
        //     $classes = $result->getResultArray();
        // }
    }
}

?>