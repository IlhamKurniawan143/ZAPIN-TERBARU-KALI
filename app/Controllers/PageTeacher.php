<?php

namespace App\Controllers;

use App\Models\ClassModel;

class PageTeacher extends BaseController
{
    public function Index()
    {
        $session = session();

        // cek apakah user sudah login dan memiliki role 'pengajar
        if (!$session->get('is_login') || $session->get('role') !== 'pengajar') {
            return redirect()->to('/login');
        }

        // mengambil id pengajar dari sesi
        $pengajar_id = $session->get('user_id');

        // mengambil data kelas dari database berdasarkan id pengajar
        $classModel = new ClassModel();
        $classes = $classModel->getClassesByPengajarId($pengajar_id);

        // mengirim data kelas ke view
        return view('pages-teacher/dashboard_pengajar', ['classes' => $classes]);

        return view('pages-teacher/dashboard_pengajar');
    }

    public function GabungKelas()
    {
        $session = session();

        // cek apakah user sudah login dan memiliki role 'pengajar' ataupun 'pegawai'
        if (!$session->get('is_login') || $session->get('role') !== 'pengajar' && $session->get('role') !== 'pegawai') {
            return redirect()->to('/login');
        }
    }
}
