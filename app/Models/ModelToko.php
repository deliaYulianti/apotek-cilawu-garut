<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelToko extends Model
{
    public function AllData(){
        return $this->db->table('tbl_toko')
        ->get()->getResultArray();
    }

    public function InsertData($data){
        $this->db->table('tbl_toko')->insert($data);
    }

    public function DetailData($id_merek){
        return $this->db->table('tbl_toko')
        ->where('id_merek', $id_merek)
        ->get()->getRowArray();
    }

    public function UpdateData($data){
        $this->db->table('tbl_toko')
        ->where('id_merek',$data['id_merek'])
        ->update($data);
    }

    public function DeleteData($data){
        $this->db->table('tbl_toko')
        ->where('id_merek',$data['id_merek'])
        ->delete($data);
    }
}
