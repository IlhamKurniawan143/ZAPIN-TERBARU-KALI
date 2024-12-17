<?php

namespace App\Controllers;

use App\Models\UserModel;

class Page extends BaseController
{
    public function index()
    {
        return view('pages/home');
    }

    public function login()
    {
        return view('pages/login');
    }

    public function authenticate()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $hash_password = hash('sha256', $password);

        $user = $userModel->where('username', $username)
            ->where('email', $email)
            ->where('password', $hash_password)
            ->first();

            log_message('debug', 'Hasil autentikasi pengguna: ' . json_encode($user));


        if ($user) {
            // Set session variables
            $session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'email' => $email,
                'role' => $user['role'],
                'is_login' => true,
            ]);

            // Redirect based on user role
            return redirect()->to(route_to($user['role'] === 'pegawai' ? 'dashboard_pegawai' : 'dashboard_pengajar'));

        }

        // Show error message if login fails
        return view('pages/login', ['login_message' => 'Akun tidak ditemukan']);
    }

    public function register()
    {
        return view('pages/register');
    }

    public function authenticateRegister()
    {
        $session = session();
        $userModel = new UserModel();

        // Ambil data dari form
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');
        $security_question = $this->request->getPost('security_question');
        $security_answer = $this->request->getPost('security_answer');

        // Hash password dan jawaban keamanan
        $hashed_password = hash('sha256', $password);
        $hashed_security_answer = hash('sha256', $security_answer);

        // Data yang akan disimpan
        $newUser = [
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password,
            'role' => $role,
            'security_question' => $security_question,
            'security_answer' => $hashed_security_answer,
        ]; 

        //Simpan data ke database
        if($userModel->insert($newUser)) {
            $session->setFlashdata('register-message', 'Daftar akun berhasil. Silahkan Login.');
            return redirect()->to('/register');
        } else {
            $session->setFlashdata('register-message', 'Gagal mendaftar, silahkan coba lagi.');
            return redirect()->back()->withInput();
        }
    }

    
}
