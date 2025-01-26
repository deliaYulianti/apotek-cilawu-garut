<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelToko;
use App\Models\ModelSetting;
use CodeIgniter\Files\File;

class Toko extends BaseController
{
    protected $ModelSetting;
    protected $ModelToko;
    
    
    public function __construct() {
        $this->ModelSetting = new ModelSetting();
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
            'judul' => 'Tipe Apotek',
            'menu' => 'toko',
            'page' => 'toko/v_index',
            'web' => $this->ModelSetting->DataWeb(),
            'toko' => $this->ModelToko->AllData(),
        ];
        return view('v_template_back_end', $data);
    }

    public function Input()
    {
        $data = [
            'judul' => 'Add Tipe Apotek',
            'menu' => 'toko',
            'web' => $this->ModelSetting->DataWeb(),
            'page' => 'toko/v_input',
            
        ];
        return view('v_template_back_end', $data);
    }

    public function InsertData()
{
    // Validasi
    if ($this->validate([
        'merek' => [
            'label' => 'Tipe Apotek',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Wajib Diisi!'
            ]
        ],
        'marker' => [
            'label' => 'Marker Apotek',
            'rules' => 'uploaded[marker]|is_image[marker]|mime_in[marker,image/png]|max_size[marker,1024]',
            'errors' => [
                'required' => '{field} Wajib Diisi!',
                'is_image' => 'Hanya file gambar yang diizinkan (format PNG).',
                'mime_in' => 'Hanya file gambar PNG yang diizinkan.',
                'max_size' => 'Ukuran file tidak boleh melebihi 1 MB.'
            ]
        ],
        'logo' => [
            'label' => 'Logo Apotek',
            'rules' => 'uploaded[logo]|is_image[logo]|mime_in[logo,image/png]|max_size[logo,1024]',
            'errors' => [
                'is_image' => 'Hanya file gambar yang diizinkan (format PNG).',
                'mime_in' => 'Hanya file gambar PNG yang diizinkan.',
                'max_size' => 'Ukuran file tidak boleh melebihi 1 MB.'
            ]
        ],
    ])) {
        // Inisialisasi data
        $merek = strtoupper($this->request->getPost('merek'));
        $marker = $this->request->getFile('marker')->getRandomName();
        $logo = $this->request->getFile('logo')->getRandomName();

        // Proses penyimpanan gambar
        $markerFile = $this->request->getFile('marker');
        $logoFile = $this->request->getFile('logo');
        $markerFile->move(ROOTPATH . 'public/marker', $marker);
        $logoFile->move(ROOTPATH . 'public/icon', $logo);

        // Simpan data ke database
        $data = [
            'merek' => $merek,
            'marker' => $marker,
            'logo' => $logo,
        ];
        $this->ModelToko->InsertData($data);
        session()->setFlashdata('insert', 'Data Successfully Created');
        return redirect()->to('Toko');
    } else {
        session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
        return redirect()->to('Toko/Input')->withInput('validations', \Config\Services::validation());
    }
}




    public function Edit($encrypted_id)
    {
        $id_merek = $this->decrypt($encrypted_id);
        $data = [
            'judul' => 'Edit Tipe Apotek',
            'menu' => 'toko',
            'page' => 'toko/v_edit',
            'web' => $this->ModelSetting->DataWeb(),
            'toko' => $this->ModelToko->DetailData($id_merek),

        ];
        return view('v_template_back_end', $data);
    }

    public function UpdateData($id_merek)
{
    // Validasi
    if ($this->validate([
        'merek' => [
            'label' => 'Tipe Apotek',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Wajib Diisi!'
            ]
        ],
        'marker' => [
            'label' => 'Marker Apotek',
            'rules' => 'is_image[marker]|mime_in[marker,image/png]|max_size[marker,1024]',
            'errors' => [
                'is_image' => 'Hanya file gambar yang diizinkan (format PNG).',
                'mime_in' => 'Hanya file gambar PNG yang diizinkan.',
                'max_size' => 'Ukuran file tidak boleh melebihi 1 MB.'
            ]
        ],
        'logo' => [
            'label' => 'Logo Apotek',
            'rules' => 'is_image[logo]|mime_in[logo,image/png]|max_size[logo,1024]',
            'errors' => [
                'is_image' => 'Hanya file gambar yang diizinkan (format PNG).',
                'mime_in' => 'Hanya file gambar PNG yang diizinkan.',
                'max_size' => 'Ukuran file tidak boleh melebihi 1 MB.'
            ]
        ],
    ])) {
        // Ambil data lama dari database
        $data_lama = $this->ModelToko->DetailData($id_merek);

        // Inisialisasi data baru
        $data = [
            'id_merek' => $id_merek,
            'merek' => strtoupper($this->request->getPost('merek')), // Mengubah menjadi huruf besar semua
            'marker' => $data_lama['marker'], // Tetapkan nama file lama sebagai default
            'logo' => $data_lama['logo'], // Tetapkan nama file lama sebagai default
        ];

        // Proses penyimpanan gambar jika ada perubahan
        $markerBaru = $this->request->getFile('marker');
        if ($markerBaru->isValid() && !$markerBaru->hasMoved()) {
            // Hapus file lama jika ada
            if (!empty($data_lama['marker']) && file_exists(ROOTPATH . 'public/marker/' . $data_lama['marker'])) {
                unlink(ROOTPATH . 'public/marker/' . $data_lama['marker']);
            }

            // Tentukan nama file baru
            $namaFileBaruMarker = $markerBaru->getRandomName();

            // Pindahkan file ke folder yang sesuai
            $markerBaru->move(ROOTPATH . 'public/marker', $namaFileBaruMarker);

            $data['marker'] = $namaFileBaruMarker; // Gunakan nama file baru untuk disimpan di database
        }

        // Proses penyimpanan logo jika ada perubahan
        $logoBaru = $this->request->getFile('logo');
        if ($logoBaru->isValid() && !$logoBaru->hasMoved()) {
            // Hapus file lama jika ada
            if (!empty($data_lama['logo']) && file_exists(ROOTPATH . 'public/logo/' . $data_lama['logo'])) {
                unlink(ROOTPATH . 'public/icon/' . $data_lama['logo']);
            }

            // Tentukan nama file baru
            $namaFileBaruLogo = $logoBaru->getRandomName();

            // Pindahkan file ke folder yang sesuai
            $logoBaru->move(ROOTPATH . 'public/icon', $namaFileBaruLogo);

            $data['logo'] = $namaFileBaruLogo; // Gunakan nama file baru untuk disimpan di database
        }

        // Simpan data ke database
        $this->ModelToko->UpdateData($data);
        session()->setFlashdata('update', 'Data Successfully Updated');
        
        return redirect()->to('Toko');
    } else {
        // Jika validasi gagal, tampilkan pesan error
        session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
        return redirect()->to('Toko/Edit/'.$id_merek)->withInput('validations', \Config\Services::validation());
    }
}

// Fungsi untuk menghasilkan nama file yang unik
// Fungsi untuk menghasilkan nama file yang unik di folder marker atau icon
private function generateUniqueFileName($folderPath, $filename) {
    $path = ROOTPATH . 'public/' . $folderPath . '/';
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $name = pathinfo($filename, PATHINFO_FILENAME);
    $i = 1;

    // Loop sampai menemukan nama file yang unik
    while (file_exists($path . $filename)) {
        $filename = $name . '_' . $i . '.' . $extension;
        $i++;
    }

    return $filename;
} 
public function Delete($id_merek)
{
    // Ambil data lama dari database
    $data_lama = $this->ModelToko->DetailData($id_merek);

    // Hapus file marker terkait jika ada
    if (!empty($data_lama['marker']) && file_exists(ROOTPATH . 'public/marker/' . $data_lama['marker'])) {
        unlink(ROOTPATH . 'public/marker/' . $data_lama['marker']);
    }

    // Hapus file logo terkait jika ada
    if (!empty($data_lama['logo']) && file_exists(ROOTPATH . 'public/icon/' . $data_lama['logo'])) {
        unlink(ROOTPATH . 'public/icon/' . $data_lama['logo']);
    }

    // Hapus data dari database
    $data = [
        'id_merek' => $id_merek,
    ];
    $this->ModelToko->DeleteData($data);
    session()->setFlashdata('delete', 'Data Successfully Deleted');
    return redirect()->to('Toko');
}

}
