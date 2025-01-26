<?php

namespace App\Controllers;

use App\Models\ModelSetting;
use App\Models\ModelAdmin;
use App\Models\ModelToko;
class Admin extends BaseController
{
    protected $ModelSetting;
    protected $ModelAdmin;
    protected $ModelToko;
    
public function __construct() {
    $this->ModelSetting = new ModelSetting();
    $this->ModelAdmin = new ModelAdmin();
    $this->ModelToko = new ModelToko();
}

    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'menu' => 'dashboard',
            'page' => 'v_dashboard',
            'web' => $this->ModelSetting->DataWeb(),
            'jmlinfotoko' => $this->ModelAdmin->JmlInfoToko(),
            'jmlwilayah' => $this->ModelAdmin->JmlWilayah(),
            'toko' => $this->ModelToko->AllData(),
        ];
        return view('v_template_back_end',$data);
    }

    public function Setting()
    {
        $data = [
            'judul' => 'Setting',
            'menu' => 'setting',
            'page' => 'v_setting',
            'web' => $this->ModelSetting->DataWeb(),
            
        ];
        return view('v_template_back_end',$data);
    }

    public function UpdateSetting()
{
    // Mendapatkan data gambar lama
    $oldLogo = $this->ModelSetting->DataWeb()['logo']; // Ambil elemen 'logo' dari array

    // Proses upload gambar baru
    $newLogo = $this->request->getFile('logo');
    if ($newLogo->isValid() && !$newLogo->hasMoved()) {
        // Generate nama unik untuk gambar baru
        $newName = $newLogo->getRandomName();

        // Pindahkan gambar baru ke folder penyimpanan
        $newLogo->move(ROOTPATH . 'public/AdminLTE/dist/img/', $newName);

        // Hapus gambar lama jika ada
        if (!empty($oldLogo)) {
            unlink(ROOTPATH . 'public/AdminLTE/dist/img/' . $oldLogo);
        }
    }

    // Data untuk update
    $data = [
        'id' => 1,
        'nama_web' => $this->request->getPost('nama_web'),
        'koordinat_wilayah' => $this->request->getPost('koordinat_wilayah'),
        'zoom_view' => $this->request->getPost('zoom_view'),
        'zoom_marker' => $this->request->getPost('zoom_marker'),
        'jarakpasar' => $this->request->getPost('jarakpasar'),
        'jarakminimarket' => $this->request->getPost('jarakminimarket'),
        'title' => $this->request->getPost('title'),
        'informasi' => $this->request->getPost('informasi'),
        'logo' => $newName ?? $oldLogo, // Gunakan nama baru jika ada, jika tidak gunakan yang lama
    ];

    // Update data
    $this->ModelSetting->UpdateData($data);

    session()->setFlashdata('pesan', 'Update berhasil');

    return redirect()->to('Admin/Setting');
}

public function UpdateEmail()
{
   
    // Data untuk update
    $data = [
        'id' => 1,
        
        'email' => $this->request->getPost('email'),
        'name' => $this->request->getPost('name'),
        'apppassword' => $this->request->getPost('apppassword'),
        'SMTPHost' => $this->request->getPost('SMTPHost'),
        'SMTPPort' => $this->request->getPost('SMTPPort'),
        'SMTPCrypto' => $this->request->getPost('SMTPCrypto'),
    ];

    // Update data
    $this->ModelSetting->UpdateData($data);

    session()->setFlashdata('email', 'Update berhasil');

    return redirect()->to('Admin/Setting');
}


}
