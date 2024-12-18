<?php

namespace App\Models;

use CodeIgniter\Model;

class TugasModel extends Model
{
    protected $table = 'class_tasks';
    protected $allowedFields = ['class_id', 'task_name', 'task_description', 'attachment_path'];

    public function getTasksByClassId($class_id)
    {
        return $this->where('class_id', $class_id)->findAll();
    }

    public function saveTask($class_id, $task_name, $task_description, $attachment_path)
    {
        return $this->insert([
            'class_id' => $class_id,
            'task_name' => $task_name,
            'task_description' => $task_description,
            'attachment_path' => $attachment_path,
        ]);
    }
}