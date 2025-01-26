<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;

class Wilayah extends BaseController

{
    protected $ModelSetting;
    protected $ModelWilayah;
    
    public function __construct() {
        $this->ModelWilayah = new ModelWilayah();
        $this->ModelSetting = new ModelSetting();
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
            'judul' => 'Wilayah',
            'menu' => 'wilayah',
            'page' => 'wilayah/v_index',
            'wilayah' => $this->ModelWilayah->AllData(),
            'web' => $this->ModelSetting->DataWeb(),
        ];
        return view('v_template_back_end',$data);
    }

    public function Input()
    {
        $data = [
            'judul' => 'Add Wilayah',
            'menu' => 'wilayah',
            'page' => 'wilayah/v_input',
            'web' => $this->ModelSetting->DataWeb(),
            
        ];
        return view('v_template_back_end',$data);
    }

    public function InsertData()
    {
        // Validasi
        if ($this->validate([
            'nama_wilayah' => [
                'label' => 'Nama Wilayah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'warna' => [
                'label' => 'Warna Wilayah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
        ])) {
            // Inisialisasi data
            $data = [
                'nama_wilayah' => $this->request->getPost('nama_wilayah'),
                'warna' => $this->request->getPost('warna'),
            ];
    
            // Proses normalisasi nama wilayah
            $namaWilayah = strtoupper($data['nama_wilayah']);
    
            // Menghapus kata "KEC" dari awal nama wilayah
            $namaWilayah = preg_replace('/^KEC\s/i', '', $namaWilayah);
    
            // Periksa apakah nama wilayah sudah mengandung "KECAMATAN", jika tidak tambahkan
            if (strpos($namaWilayah, 'KECAMATAN') === false) {
                $namaWilayah = 'KECAMATAN ' . $namaWilayah;
            }
    
            $data['nama_wilayah'] = $namaWilayah;
    
            // Jika ada file geojson yang diunggah
            if (!empty($_FILES['geojson_file']['name'])) {
                // Handle file upload
                $file = $this->request->getFile('geojson_file');
                if ($file->isValid() && !$file->hasMoved()) {
                    // Read the file content
                    $geojsonContent = file_get_contents($file->getTempName());
    
                    // Assign the content to the data array
                    $data['geojson'] = $geojsonContent;
                }
            } else { // Jika file geojson tidak diunggah
                // Periksa apakah textarea geojson diisi
                if (empty($this->request->getPost('geojson'))) {
                    session()->setFlashdata('errors', ['geojson' => 'File GeoJSON atau GeoJSON di textarea harus diisi salah satu.']);
                    return redirect()->to('Wilayah/Input')->withInput();
                } else { // Jika textarea geojson diisi
                    $data['geojson'] = $this->request->getPost('geojson');
                }
            }
    
            // Simpan data ke database
            $this->ModelWilayah->InsertData($data);
            session()->setFlashdata('insert', 'Data Successfully Created');
            return redirect()->to('Wilayah');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('Wilayah/Input')->withInput('validations', \Config\Services::validation());
        }
    }

    public function Edit($encrypted_id)
    {
        $id_wilayah = $this->decrypt($encrypted_id);

        $data = [
            'judul' => 'Edit Wilayah',
            'menu' => 'wilayah',
            'page' => 'wilayah/v_edit',
            'wilayah' => $this->ModelWilayah->DetailData($id_wilayah),
            'web' => $this->ModelSetting->DataWeb(),

        ];
        return view('v_template_back_end',$data);
    }
    
    public function UpdateData($id_wilayah)
    {
        // Validasi
        if ($this->validate([
            'nama_wilayah' => [
                'label' => 'Nama Wilayah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'warna' => [
                'label' => 'Warna Wilayah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
        ])) {
            // Inisialisasi data
            $data = [
                'id_wilayah' => $id_wilayah,
                'nama_wilayah' => $this->request->getPost('nama_wilayah'),
                'warna' => $this->request->getPost('warna'),
            ];
    
            // Proses normalisasi nama wilayah
            $namaWilayah = strtoupper($data['nama_wilayah']);
    
            // Menghapus kata "KEC" dari awal nama wilayah
            $namaWilayah = preg_replace('/^KEC\s/i', '', $namaWilayah);
    
            // Periksa apakah nama wilayah sudah mengandung "KECAMATAN", jika tidak tambahkan
            if (strpos($namaWilayah, 'KECAMATAN') === false) {
                $namaWilayah = 'KECAMATAN ' . $namaWilayah;
            }
    
            $data['nama_wilayah'] = $namaWilayah;
    
            // Jika ada file geojson yang diunggah
            if (!empty($_FILES['geojson_file']['name'])) {
                // Handle file upload
                $file = $this->request->getFile('geojson_file');
                if ($file->isValid() && !$file->hasMoved()) {
                    // Read the file content
                    $geojsonContent = file_get_contents($file->getTempName());
    
                    // Assign the content to the data array
                    $data['geojson'] = $geojsonContent;
                }
            } else { // Jika file geojson tidak diunggah
                // Periksa apakah textarea geojson diisi
                if (empty($this->request->getPost('geojson'))) {
                    session()->setFlashdata('errors', ['geojson' => 'File GeoJSON atau GeoJSON di textarea harus diisi salah satu.']);
                    return redirect()->to('Wilayah/Input')->withInput();
                } else { // Jika textarea geojson diisi
                    $data['geojson'] = $this->request->getPost('geojson');
                }
            }
    
            // Simpan data ke database
            $this->ModelWilayah->UpdateData($data);
            session()->setFlashdata('update', 'Data Successfully Updated');
            return redirect()->to('Wilayah');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('Wilayah/Input')->withInput('validations', \Config\Services::validation());
        }
    }
    
    public function Delete($id_wilayah){
        $data = [
            'id_wilayah' => $id_wilayah,
        ];
        $this->ModelWilayah->DeleteData($data);
        session()->setFlashdata('delete', 'Data Successfully Deleted');
        return redirect()->to('Wilayah');
    }
}
