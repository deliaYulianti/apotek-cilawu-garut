<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fullname', 'username', 'email', 'foto'];

    public function AllData()
{
    return $this->db->table('users')
        ->select('users.*, auth_groups.name as group_name')
        ->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left')
        ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id', 'left')
        ->get()->getResultArray();
}
    public function InsertData($data)
    {
        $this->db->table($this->table)->insert($data);
    }

    public function getUserWithRole($id)
    {
        return $this->db->table($this->table)
            ->select('users.*, auth_groups.name as role')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id', 'left')
            ->where('users.id', $id)
            ->get()->getRowArray();
    }

    public function DetailData($id)
    {
        return $this->db->table($this->table)
            ->select('users.*, auth_groups.name as group_name')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id', 'left')
            ->where('users.id', $id)
            ->get()->getRowArray();
    }

    public function UpdateData($data)
    {
        $this->db->table($this->table)
            ->where('id', $data['id'])
            ->update($data);
    }

    public function DeleteData($data)
    {
        $this->db->table($this->table)
            ->where('id', $data['id'])
            ->delete($data);
    }
}
