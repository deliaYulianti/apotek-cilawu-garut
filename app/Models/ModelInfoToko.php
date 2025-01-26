<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelInfoToko extends Model
{
    public function AllData(){
        return $this->db->table('tbl_infotoko')
        ->join('tbl_toko', 'tbl_toko.id_merek = tbl_infotoko.id_merek')
        ->join('tbl_provinsi', 'tbl_provinsi.id_provinsi = tbl_infotoko.id_provinsi')
        ->join('tbl_kabupaten', 'tbl_kabupaten.id_kabupaten = tbl_infotoko.id_kabupaten')
        ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan = tbl_infotoko.id_kecamatan')
        ->get()->getResultArray();
    }

    public function AllDataPerWilayah($id_wilayah)
    {
        return $this->db->table('tbl_infotoko')
            ->join('tbl_toko', 'tbl_toko.id_merek = tbl_infotoko.id_merek', 'left')
            ->where('id_wilayah', $id_wilayah)
            ->get()->getResultArray();
    }

    public function AllDataPerToko($id_merek)
    {
        return $this->db->table('tbl_infotoko')
            ->join('tbl_toko', 'tbl_toko.id_merek = tbl_infotoko.id_merek', 'left')
            ->where('tbl_infotoko.id_merek', $id_merek)
            ->get()->getResultArray();
    }

    public function InsertData($data){
        $this->db->table('tbl_infotoko')->insert($data);
    }

    public function DetailData($id_toko){
        return $this->db->table('tbl_infotoko')
        ->join('tbl_toko', 'tbl_toko.id_merek = tbl_infotoko.id_merek')
        ->join('tbl_provinsi', 'tbl_provinsi.id_provinsi = tbl_infotoko.id_provinsi')
        ->join('tbl_kabupaten', 'tbl_kabupaten.id_kabupaten = tbl_infotoko.id_kabupaten')
        ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan = tbl_infotoko.id_kecamatan')
        ->join('tbl_wilayah', 'tbl_wilayah.id_wilayah = tbl_infotoko.id_wilayah')
        ->where('id_toko', $id_toko)
        ->get()->getRowArray();
    }

    public function UpdateData($data){
        $this->db->table('tbl_infotoko')
        ->where('id_toko',$data['id_toko'])
        ->update($data);
    }

    public function DeleteData($data){
        $this->db->table('tbl_infotoko')
        ->where('id_toko',$data['id_toko'])
        ->delete($data);
    }

    public function allProvinsi(){
        return $this->db->table('tbl_provinsi')
        ->orderBy('id_provinsi' , 'ASC')
        ->get()->getResultArray();
    }

    public function allKabupaten($id_provinsi){
        return $this->db->table('tbl_kabupaten')
        ->where('id_provinsi' , $id_provinsi)
        ->get()->getResultArray();
    }

    public function allKecamatan($id_kabupaten){
        return $this->db->table('tbl_kecamatan')
        ->where('id_kabupaten' , $id_kabupaten)
        ->get()->getResultArray();
    }

    
}
