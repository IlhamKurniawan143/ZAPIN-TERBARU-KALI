<?php

namespace App\Controllers;

use App\Models\ClassModel;
use App\Models\KelasModel;
use App\Models\AnggotaModel;
use App\Models\TugasModel;
use App\Models\UserModel;

class Fitur extends BaseController
{
    public function nampilKelas()
    {
        return view('fitur/gabung_kelas');
    }
    
    public function gabungKelas()
{
    $session = session();

    // Cek apakah user sudah login dan memiliki role 'pengajar' atau 'pegawai'
    if (!$session->get('is_login') || !in_array($session->get('role'), ['pengajar', 'pegawai'])) {
        return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu.');
    }

    $joinMessage = '';
    $messageType = 'error'; // Default to error, will change to success if operation succeeds

    if ($this->request->getMethod() === 'post') {
        // Ambil id user dari session
        $userId = $session->get('user_id');
        $role = $session->get('role');
        $classCode = $this->request->getPost('class_code');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'class_code' => 'required|min_length[5]|max_length[10]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal
            $joinMessage = $validation->getErrors()['class_code'] ?? 'Kode kelas tidak valid';
            return redirect()->back()->with('error', $joinMessage);
        }

        // Inisialisasi model
        $classModel = new ClassModel();
        $classMemberModel = new AnggotaModel();
        $userModel = new UserModel();

        try {
            // Cek apakah kelas ada berdasarkan kode kelas
            $class = $classModel->where('class_code', $classCode)->first();

            // Jika kelas tidak ditemukan
            if (!$class) {
                return redirect()->back()->with('error', 'Kode kelas tidak ditemukan.');
            }

            // Cek apakah user sudah terdaftar
            $user = $userModel->find($userId);
            if (!$user) {
                return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
            }

            // Cek apakah user sudah bergabung dengan kelas ini
            $existingMembership = $classMemberModel->where('pegawai_id', $userId)
                ->where('class_id', $class['id'])
                ->where('role', $role)
                ->first();

            if ($existingMembership) {
                return redirect()->back()->with('warning', 'Anda sudah tergabung di kelas ini.');
            }

            // Tambahkan user ke kelas
            $result = $classMemberModel->insert([
                'pegawai_id' => $userId,
                'class_id' => $class['id'],
                'role' => $role,
            ]);

            // Cek apakah insert berhasil
            if ($result) {
                return redirect()->back()->with('success', 'Berhasil bergabung ke kelas!');
            } else {
                return redirect()->back()->with('error', 'Gagal bergabung ke kelas. Silakan coba lagi.');
            }

        } catch (\Exception $e) {
            // Tangani kesalahan yang tidak terduga
            log_message('error', 'Gabung Kelas Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem. Silakan hubungi administrator.');
        }
    }

    // Jika bukan metode POST
    return redirect()->back()->with('error', 'Metode permintaan tidak valid.');
}

    


    public function detailKelas($class_id)
    {
        $session = session();

        // Periksa apakah user sudah login
        if (!$session->get('is_login')) {
            return redirect()->to('/login');
        }

        $kelasModel = new ClassModel();
        $anggotaModel = new AnggotaModel();
        $tugasModel = new TugasModel();

        $user_role = $session->get('role');
        $user_id = $session->get('user_id');

        // Ambil data detail kelas
        $class_data = $kelasModel->getClassDetail($class_id);

        // Ambil data anggota kelas
        $members = $anggotaModel->getMembersByClassId($class_id);

        // Ambil data tugas kelas
        $tasks = $tugasModel->getTasksByClassId($class_id);

        // Render view dengan data
        return view('fitur/detail_kelas', [
            'class_data' => $class_data,
            'members' => $members,
            'tasks' => $tasks,
            'user_role' => $user_role,
            'class_id' => $class_id
        ]);
    }

    public function createTask($class_id)
    {
        $session = session();

        // Periksa role user
        if ($session->get('role') !== 'pengajar') {
            return redirect()->to("/kelas/$class_id");
        }

        $tugasModel = new TugasModel();

        $task_name = $this->request->getPost('task_name');
        $task_description = $this->request->getPost('task_description');
        $attachment = $this->request->getFile('attachment');
        $attachment_path = null;

        // Proses upload file jika ada
        if ($attachment && $attachment->isValid() && !$attachment->hasMoved()) {
            // Tentukan folder tempat menyimpan file di public/uploads/
            $path = FCPATH . 'uploads/' . date('Ymd'); // Folder berdasarkan tanggal di dalam public/uploads/
            if (!is_dir($path)) {
                mkdir($path, 0777, true); // Membuat folder jika belum ada
            }

            // Pindahkan file ke folder yang ditentukan
            $attachment_path = 'uploads/' . date('Ymd') . '/' . $attachment->getClientName(); // Path relatif

            // Pindahkan file yang diupload ke path yang sudah ditentukan
            $attachment->move($path, $attachment->getClientName());
        }

        // Simpan tugas ke database
        $tugasModel->saveTask($class_id, $task_name, $task_description, $attachment_path);

        return redirect()->to("/dashboard_pengajar/detailkelas/$class_id")->with('message', 'Tugas berhasil dibuat!');
    }

    public function profile()
    {
        // Memeriksa apakah pengguna sudah login
        if (!session()->has('is_login')) {
            return redirect()->to('login'); // Mengarahkan ke halaman login jika belum login
        }

        // Mengambil data session jika ada
        $data = [
            'username' => session()->get('username') ?? 'Tidak diketahui',
            'email' => session()->get('email') ?? 'Tidak diketahui',
            'role' => session()->get('role') ?? 'Tidak diketahui',
        ];

        return view('fitur/profil', $data);
    }
    public function logout()
    {
        session()->destroy(); // Menghapus semua data sesi
        return redirect()->to('/'); // Mengarahkan pengguna ke halaman login
    }

    public function buatKelas()
    {
        // Check if the user is logged in and is a pengajar
        if (!session()->get('is_login') || session()->get('role') != 'pengajar') {
            return redirect()->to('login');
        }

        // Display the form with any potential messages
        return view('fitur/buat_kelas', [
            'create_message' => session()->getFlashdata('create_message')
        ]);
    }

    public function createKelas()
    {
        // Validate input
        $class_name = $this->request->getPost('class_name');
        $class_description = $this->request->getPost('class_description');
        $pengajar_id = session()->get('user_id');

        // Generate a unique class code
        $class_code = substr(md5(uniqid(rand(), true)), 0, 8);

        // Check if fields are not empty
        if (!empty($class_name) && !empty($class_description)) {
            // Load model
            $classModel = new ClassModel();

            // Prepare data
            $data = [
                'class_name' => $class_name,
                'class_description' => $class_description,
                'pengajar_id' => $pengajar_id,
                'class_code' => $class_code
            ];

            // Insert into the database
            if ($classModel->insert($data)) {
                session()->setFlashdata('create_message', "Kelas berhasil dibuat! Kode Kelas: $class_code");
            } else {
                session()->setFlashdata('create_message', "Gagal membuat kelas.");
            }

            // Redirect back to the create class page
            return redirect()->to('/dashboard-pengajar/buatkelas');
        } else {
            session()->setFlashdata('create_message', "Nama kelas dan deskripsi harus diisi!");
            return redirect()->to('/dashboard-pengajar/buatkelas');
        }
    }

    public function edittugaskelas($task_id)
    {
        $tugasModel = new \App\Models\TugasModel();
        $task = $tugasModel->find($task_id);

        if (!$task) {
            return redirect()->back()->with('error', 'Tugas tidak ditemukan.');
        }

        return view('fitur/edit_tugas', [
            'task' => $task,
        ]);
    }

    public function updateTask($task_id)
    {
        $session = session();
        $tugasModel = new \App\Models\TugasModel();

        // Periksa role user
        if ($session->get('role') !== 'pengajar') {
            return redirect()->to('/dashboard_pengajar')->with('error', 'Akses ditolak.');
        }

        // Validasi input
        $validationRules = [
            'task_name' => 'required',
            'task_description' => 'required',
            'attachment' => [
                'rules' => 'permit_empty|uploaded[attachment]|mime_in[attachment,application/pdf,image/png,image/jpeg]|max_size[attachment,2048]',
                'errors' => [
                    'uploaded' => 'File lampiran harus diunggah.',
                    'mime_in' => 'Jenis file yang diunggah tidak valid (hanya PDF, PNG, atau JPEG).',
                    'max_size' => 'Ukuran file maksimal adalah 2MB.',
                ],
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data tugas dari form
        $data = [
            'task_name' => $this->request->getPost('task_name'),
            'task_description' => $this->request->getPost('task_description'),
        ];

        $file = $this->request->getFile('attachment');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Hapus file lama jika ada
            $existingTask = $tugasModel->find($task_id);
            if ($existingTask && !empty($existingTask['attachment_path']) && file_exists(FCPATH . $existingTask['attachment_path'])) {
                unlink(FCPATH . $existingTask['attachment_path']);
            }

            // Simpan file baru
            $uploadPath = FCPATH . 'uploads/' . date('Ymd');
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $fileName = $file->getClientName();
            $file->move($uploadPath, $fileName);

            $data['attachment_path'] = 'uploads/' . date('Ymd') . '/' . $fileName;
        }

        // Update tugas ke database
        if ($tugasModel->update($task_id, $data)) {
            return redirect()->to('/dashboard_pengajar')
                ->with('success', 'Tugas berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui tugas. Coba lagi.');
    }
}
