<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;
use App\Models\ModelInfoToko;
use App\Models\ModelToko;

class InfoToko extends BaseController
{
    protected $ModelSetting;
    protected $ModelWilayah;
    protected $ModelInfoToko;
    protected $ModelToko;
    
    public function __construct() {
        $this->ModelWilayah = new ModelWilayah();
        $this->ModelSetting = new ModelSetting();
        $this->ModelInfoToko = new ModelInfoToko();
        $this->ModelToko = new ModelToko();
    }

    private function encrypt($string) {
        return base64_encode($string);
    }

    // Fungsi dekripsi
    private function decrypt($string) {
        return base64_decode($string);
    }

    public function index()
    {
        $data = [
            'judul' => 'Detail Apotek',
            'menu' => 'infotoko',
            'page' => 'infotoko/v_index',
            'web' => $this->ModelSetting->DataWeb(),
            'infotoko' => $this->ModelInfoToko->AllData(),
        ];
        return view('v_template_back_end', $data);
    }

    public function Input()
    {
        $data = [
            'judul' => 'Add Detail Apotek',
            'menu' => 'infotoko',
            'page' => 'infotoko/v_input',
            'web' => $this->ModelSetting->DataWeb(),
            'provinsi' => $this->ModelInfoToko->allProvinsi(),
            'wilayah' => $this->ModelWilayah->AllData(),
            'toko' => $this->ModelToko->AllData(),
        ];
        return view('v_template_back_end', $data);
    }

    public function InsertData()
    {
        // Validasi
        if ($this->validate([
            'nama_pemohon' => 'required',
            'nama_perusahaan' => 'required',
            'nomor_izin' => 'required',
            'tanggal_izin' => 'required',
            'koordinat' => 'required',
            'id_provinsi' => 'required',
            'id_kabupaten' => 'required',
            'id_kecamatan' => 'required',
            'alamat' => 'required',
            'id_wilayah' => 'required',
            'id_merek' => 'required',
            'foto' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/gif]|max_size[foto,2048]',
        ])) {
            $foto = $this->request->getFile('foto');

            if ($foto->isValid() && !$foto->hasMoved()) {
                $foto->move(ROOTPATH . 'public/foto', $foto->getRandomName());
            }

            $data = [
                'nama_pemohon' => strtoupper($this->request->getPost('nama_pemohon')),
                'nama_perusahaan' => strtoupper($this->request->getPost('nama_perusahaan')),
                'nomor_izin' => $this->request->getPost('nomor_izin'),
                'tanggal_izin' => $this->request->getPost('tanggal_izin'),
                'koordinat' => $this->request->getPost('koordinat'),
                'id_merek' => $this->request->getPost('id_merek'),
                'id_provinsi' => $this->request->getPost('id_provinsi'),
                'id_kabupaten' => $this->request->getPost('id_kabupaten'),
                'id_kecamatan' => $this->request->getPost('id_kecamatan'),
                'alamat' => $this->request->getPost('alamat'),
                'id_wilayah' => $this->request->getPost('id_wilayah'),
                'foto' => $foto->getName(),
            ];

            $this->ModelInfoToko->InsertData($data);
            session()->setFlashdata('insert', 'Data Successfully Created');
            return redirect()->to('InfoToko');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('InfoToko/Input')->withInput();
        }
    }

    public function Edit($encrypted_id)
    {
        $id_toko = $this->decrypt($encrypted_id);
        $data = [
            'judul' => 'Edit Detail Apotek',
            'menu' => 'infotoko',
            'page' => 'infotoko/v_edit',
            'web' => $this->ModelSetting->DataWeb(),
            'provinsi' => $this->ModelInfoToko->allProvinsi(),
            'wilayah' => $this->ModelWilayah->AllData(),
            'toko' => $this->ModelToko->AllData(),
            'infotoko' => $this->ModelInfoToko->DetailData($id_toko),
        ];
        return view('v_template_back_end', $data);
    }

    public function UpdateData($id_toko)
    {
        // Validasi
        if ($this->validate([
            'nama_pemohon' => 'required',
            'nama_perusahaan' => 'required',
            'nomor_izin' => 'required',
            'tanggal_izin' => 'required',
            'koordinat' => 'required',
            'id_provinsi' => 'required',
            'id_kabupaten' => 'required',
            'id_kecamatan' => 'required',
            'alamat' => 'required',
            'id_wilayah' => 'required',
            'id_merek' => 'required',
            'foto' => 'mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,2048]',
        ])) {
            $infotoko = $this->ModelInfoToko->DetailData($id_toko);
            $foto = $this->request->getFile('foto');
            if ($foto->getError() == 4) {
                $nama_file = $infotoko['foto'];
            } else {
                $foto->move(ROOTPATH . 'public/foto', $foto->getRandomName());
                $nama_file = $foto->getName();
            }

            $data = [
                'id_toko' => $id_toko,
                'nama_pemohon' => strtoupper($this->request->getPost('nama_pemohon')),
                'nama_perusahaan' => strtoupper($this->request->getPost('nama_perusahaan')),
                'nomor_izin' => $this->request->getPost('nomor_izin'),
                'tanggal_izin' => $this->request->getPost('tanggal_izin'),
                'koordinat' => $this->request->getPost('koordinat'),
                'id_merek' => $this->request->getPost('id_merek'),
                'id_provinsi' => $this->request->getPost('id_provinsi'),
                'id_kabupaten' => $this->request->getPost('id_kabupaten'),
                'id_kecamatan' => $this->request->getPost('id_kecamatan'),
                'alamat' => $this->request->getPost('alamat'),
                'id_wilayah' => $this->request->getPost('id_wilayah'),
                'foto' => $nama_file,
            ];

            $this->ModelInfoToko->UpdateData($data);
session()->setFlashdata('insert', 'Data Successfully Updated');
return redirect()->to('InfoToko');
} else {
session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
return redirect()->to('InfoToko/Edit/'. $id_toko)->withInput();
}
}public function Detail($encrypted_id){
    $id_toko = $this->decrypt($encrypted_id);
    $data = [
        'judul' => 'Viwe Detail Apotek',
        'menu' => 'infotoko',
        'page' => 'infotoko/v_detail',
        'web' => $this->ModelSetting->DataWeb(),
        'infotoko' => $this->ModelInfoToko->DetailData($id_toko),
    ];
    return view('v_template_back_end', $data);
}

public function Delete($id_toko){
    $infotoko = $this->ModelInfoToko->DetailData($id_toko);
    if ($infotoko['foto'] <> '') {
        unlink(ROOTPATH . 'public/foto/' . $infotoko['foto']);
    }
    $data = [
        'id_toko' => $id_toko,
    ];
    $this->ModelInfoToko->DeleteData($data);
    session()->setFlashdata('delete', 'Data Successfully Deleted');
    return redirect()->to('InfoToko');
}

public function Kabupaten(){
    $id_provinsi = $this->request->getPost('id_provinsi');
    $kab = $this->ModelInfoToko->allKabupaten($id_provinsi);
    echo ' <option value="">-- Pilih Kabupaten --</option>';
    foreach ($kab as $key => $value) {
        echo '<option value='.$value['id_kabupaten'].'>'.$value['nama_kabupaten'].'</option>';
    }
}

public function Kecamatan(){
    $id_kabupaten = $this->request->getPost('id_kabupaten');
    $kec = $this->ModelInfoToko->allKecamatan($id_kabupaten);
    echo ' <option value="">-- Pilih Kecamatan --</option>';
    foreach ($kec as $key => $value) {
        echo '<option value='.$value['id_kecamatan'].'>'.$value['nama_kecamatan'].'</option>';
    }
}
// File: app/Controllers/Infotoko.php

public function getMinimarketCoords($id_merek)
{
    $minimarketCoords = $this->YourModel->getMinimarketCoordsById($id_merek);
    return $minimarketCoords;
}

}
