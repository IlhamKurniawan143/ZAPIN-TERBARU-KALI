<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table = 'class_members';

    public function getMembersByClassId($class_id)
    {
        return $this->select('users.username, users.role')
            ->join('users', 'users.id = class_members.pegawai_id')
            ->where('class_members.class_id', $class_id)
            ->findAll();
    }
}