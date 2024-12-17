<?php 

namespace App\Controllers;

use App\Models\ClassModel;

class Fitur extends BaseController{
    public function gabungKelas(){

        $session = session();

        // cek apakah user sudah login dan memiliki role 'pengajar' ataupun 'pegawai'
        if (!$session->get('is_login') || $session->get('role') !== 'pengajar' && $session->get('role') !== 'pegawai') {
            return redirect()->to('/login');
        }

        $joinMessage = '';

        // if ($this->request->getPost('join_class')) {
        if ($this->request->getMethod() === 'post') {
            $classCode = $this->request->getPost('class_code');
            $userId = $session->get('user_id');
            $role = $session->get('role');

            $classModel = new ClassModel();
            $result = $classModel->gabungkelas($userId, $classCode, $role);

            $joinMessage = $result['message'];
        }

        return view('fitur/gabung_kelas', ['join_message' => $joinMessage]);
    }

    public function buatKelas(){
        $session = session();

        // cek apakah user sudah login dan memiliki role 'pengajar'
        if (!$session->get('is_login') || $session->get('role') === 'pengajar');
    }
}

?>