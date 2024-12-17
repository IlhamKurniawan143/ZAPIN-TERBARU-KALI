<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassModel extends Model
{
    protected $table = 'classes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['class_name', 'class_description'];

    public function getClassesByPegawaiId($pegawai_id)
    {
        return $this->select('classes.*')
            ->join('class_members', 'classes.id = class_members.class_id')
            ->where('class_members.pegawai_id', $pegawai_id)
            ->findAll();
    }

    public function getClassesByPengajarId($pengajar_id)
    {
        return $this->select('classes.*')
            ->where('pengajar_id', $pengajar_id)
            ->findAll();
    }


    public function gabungkelas($user_id, $class_code, $role)
    {
        // periksa apakah kelas itu ada
        $class = $this->where('class_code', $class_code)->first();

        if (!$class) {
            return ['status' => false, 'message' => 'Kode kelas tidak valid!'];
        }

        $class_id = $class['id'];

        // periksa apakah user sudah terdaftar di kelas ini
        $db = \Config\Database::connect();
        $builder = $db->table('class_members');
        $existingMember = $builder->where([
            'class_id' => $class_id,
            'pegawai_id' => $user_id,
            'role' => $role
        ])->get()->getRow();

        if ($existingMember) {
            return ['status' => false, 'message' => 'Anda sudah terdaftar di kelas ini!'];
        }

        // $builder->where('class_id', $class_id);
        // $builder->where('pegawai_id', $user_id);
        // $builder->where('role', $role);
        // $builder->select('id');
        // $result = $builder->get()->getRow();

        // if ($result) {
        // }
        
        // jika tidak ada, tambahkan user ke kelas / menambahkan pengguna ke tabel class_members
        $builder->insert([
            'class_id' => $class_id,   
            'pegawai_id' => $user_id,
            'role' => $role
        ]);

        return ['status' => true, 'message' => 'Berhasil bergabung ke kelas!'];
    }
}
