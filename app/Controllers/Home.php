<?php

namespace App\Controllers;
use App\Models\ModelSetting;
use App\Models\ModelWilayah;
use App\Models\ModelInfoToko;
use App\Models\ModelToko;

class Home extends BaseController
{
    protected $ModelSetting;
    protected $ModelWilayah;
    protected $ModelInfoToko;
    protected $ModelToko;

    public function __construct() {
        $this->ModelSetting = new ModelSetting();
        $this->ModelWilayah = new ModelWilayah();
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
            'judul' => 'Peta investasi Apotek Cilawu',
            'page' => 'v_home',
            'web' => $this->ModelSetting->DataWeb(),
            'wilayah' => $this->ModelWilayah->AllData(),
            'infotoko' => $this->ModelInfoToko->AllData(),
            'toko' => $this->ModelToko->AllData(),
        ];
        return view('v_template_front_end',$data);
    }

    public function WilayahToko($id_wilayah = null, $id_merek = null)
{
    // Initialize data array
    $data = [
        'web' => $this->ModelSetting->DataWeb(),
        'toko' => $this->ModelToko->AllData(),
    ];

    // Check if ID wilayah is not null and set it to session
    if (!is_null($id_wilayah)) {
        session()->set('selected_wilayah', $id_wilayah);
    } else {
        // If ID wilayah is null, try to get it from the session
        $id_wilayah = session()->get('selected_wilayah');
    }

    // Get all wilayah data
    $data['wilayah'] = $this->ModelWilayah->AllData();

    // Check if ID wilayah is not null and set it to session
    if (!is_null($id_wilayah)) {
        // Get detail wilayah
        $dw = $this->ModelWilayah->DetailData($id_wilayah);

        // Clear all marker data from session when refreshing page or changing the wilayah
        session()->remove('markers');

        $data += [
           'judul' => $dw['nama_wilayah'],// Judul sesuaikan dengan nama wilayah yang dipilih
            'page' => 'v_detail_wilayah',
            'web' => $this->ModelSetting->DataWeb(),
            'detailwilayah' => $this->ModelWilayah->DetailData($id_wilayah),
            'infotoko' => $this->ModelInfoToko->AllDataPerWilayah($id_wilayah),
            'selected_merek_id' => $id_merek, // Kirim ID minimarket yang dipilih ke tampilan
        ];
    }

    // If ID merek is not null, add filtered minimarket data based on both wilayah and merek to the data
    if (!is_null($id_merek)) {
        $dj = $this->ModelToko->DetailData($id_merek);
        $id_wilayah = $dw['id_wilayah'];
        
        // If wilayah data is not set previously, get it based on the ID retrieved from the selected merek
        if (is_null($data['wilayah'])) {
            $data['wilayah'] = $this->ModelWilayah->DetailData($id_wilayah);
        }

        // Clear all marker data from session when refreshing page or changing the wilayah
        session()->remove('markers');

        $data += [
            'judul' => $dw['nama_wilayah'], // Judul sesuaikan dengan merek yang dipilih
            'page' => 'v_detail_wilayah',
            'web' => $this->ModelSetting->DataWeb(),
            'detailwilayah' => $this->ModelWilayah->DetailData($id_wilayah),
            'infotoko' => $this->ModelInfoToko->AllDataPerToko($id_merek),
        ];
    }

    return view('v_template_front_end', $data);
}

    public function Toko($id_merek)
    {
        $dj = $this->ModelToko->DetailData($id_merek);
        
        $data = [
            'judul' => $dj['merek'],
            'page' => 'v_infotoko_per_toko',
            'web' => $this->ModelSetting->DataWeb(),
            'wilayah' => $this->ModelWilayah->AllData(),
            'toko' => $this->ModelToko->AllData(),
            'infotoko' => $this->ModelInfoToko->AllDataPerToko($id_merek),

        ];
        return view('v_template_front_end', $data);
    }
    
    public function DetailInfoToko($encrypted_id_toko)
{
    // Dekripsi ID toko yang diterima dari URL
    $id_toko = base64_decode(urldecode($encrypted_id_toko));

    // Mendapatkan informasi toko dari model berdasarkan ID yang sudah didekripsi
    $infotoko = $this->ModelInfoToko->DetailData($id_toko);

    // Menyiapkan data untuk dikirimkan ke view
    $data = [
        'judul' => $infotoko['merek'],
        'page' => 'v_detail_infotoko',
        'web' => $this->ModelSetting->DataWeb(),
        'wilayah' => $this->ModelWilayah->AllData(),
        'toko' => $this->ModelToko->AllData(),
        'infotoko' => $infotoko, // Menggunakan data yang sudah diambil
    ];

    // Menampilkan view dengan data yang sudah disiapkan
    return view('v_detail_infotoko', $data);
}

}