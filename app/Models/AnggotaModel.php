<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table = 'class_members';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pegawai_id', 'class_id', 'role'];

    public function getMembersByClassId($class_id)
    {
        return $this->select('users.username, users.role')
            ->join('users', 'users.id = class_members.pegawai_id')
            ->where('class_members.class_id', $class_id)
            ->findAll();
    }

    public function isMemberOfClass($userId, $classId, $role)
    {
        return $this->where([
            'pegawai_id' => $userId,
            'class_id' => $classId,
            'role' => $role
        ])->countAllResults() > 0;
    }
}