<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelWilayah extends Model
{
    public function AllData(){
        return $this->db->table('tbl_wilayah')
        ->get()->getResultArray();
    }

    public function InsertData($data){
        $this->db->table('tbl_wilayah')->insert($data);
    }

    public function DetailData($id_wilayah){
        return $this->db->table('tbl_wilayah')
        ->where('id_wilayah', $id_wilayah)
        ->get()->getRowArray();
    }

    public function UpdateData($data){
        $this->db->table('tbl_wilayah')
        ->where('id_wilayah',$data['id_wilayah'])
        ->update($data);
    }

    public function DeleteData($data){
        $this->db->table('tbl_wilayah')
        ->where('id_wilayah',$data['id_wilayah'])
        ->delete($data);
    }
}
