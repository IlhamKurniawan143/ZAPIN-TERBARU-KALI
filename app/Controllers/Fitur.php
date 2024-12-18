<?php

namespace App\Controllers;

use App\Models\ClassModel;
use App\Models\KelasModel;
use App\Models\AnggotaModel;
use App\Models\TugasModel;
use App\Models\UserModel;

class Fitur extends BaseController
{
    protected $session;
    protected $classesModel;
    protected $classMembersModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->classesModel = new ClassModel();
        $this->classMembersModel = new AnggotaModel();
    }
    public function nampilKelas()
    {
        // Check if user is logged in and has appropriate role
        if (!$this->session->get('is_login') || 
            !in_array($this->session->get('role'), ['pegawai', 'pengajar'])) {
            return redirect()->to('login');
        }

        return view('fitur/gabung_kelas', [
            'join_message' => $this->session->getFlashdata('join_message') ?? ''
        ]);
    }
    
    public function gabungKelas()
    {
        // Validate CSRF token
        if (!$this->request->is('post')) {
            return redirect()->back()->with('join_message', 'Invalid request method');
        }

        // Check if user is logged in
        $userId = $this->session->get('user_id');
        $userRole = $this->session->get('role');

        if (!$userId || !in_array($userRole, ['pegawai', 'pengajar'])) {
            return redirect()->to('login')->with('join_message', 'Silakan login kembali');
        }

        // Validate class code
        $classCode = $this->request->getPost('class_code');
        if (empty($classCode)) {
            return redirect()->back()->with('join_message', 'Kode kelas tidak boleh kosong');
        }

        // Find the class
        $classData = $this->classesModel->findByClassCode($classCode);
        if (!$classData) {
            return redirect()->back()->with('join_message', 'Kode kelas tidak valid');
        }

        // Check if already a member
        if ($this->classMembersModel->isMemberOfClass($userId, $classData['id'], $userRole)) {
            return redirect()->back()->with('join_message', 'Anda sudah tergabung di kelas ini');
        }

        // Add user to class members
        $memberData = [
            'pegawai_id' => $userId,
            'class_id' => $classData['id'],
            'role' => $userRole
        ];

        try {
            $this->classMembersModel->insert($memberData);
            return redirect()->back()->with('join_message', 'Berhasil bergabung ke kelas!');
        } catch (\Exception $e) {
            // Log error if needed
            return redirect()->back()->with('join_message', 'Gagal bergabung ke kelas: ' . $e->getMessage());
        }
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
