<?php

namespace App\Controllers;
use App\Models\ModelSetting;
use App\Controllers\BaseController;
use App\Models\ModelUser;
use \Myth\Auth\Entities\User;
use \Myth\Auth\Authorization\GroupModel;
use \Myth\Auth\Config\Auth as AuthConfig;
use \Myth\Auth\Models\UserModel;

class UserControll extends BaseController
{
    protected $ModelUser;
    protected $ModelSetting;
    protected $auth;
    protected $config;
    protected $UserModel;
    protected $GroupModel;
    
    public function __construct() {
        $this->ModelSetting = new ModelSetting();
        $this->ModelUser = new ModelUser;
        $this->UserModel = new UserModel;
        $this->GroupModel = new GroupModel;
        $this->config = config('Auth');
        $this->auth = service('authentication');
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
            'judul' => 'User',
            'menu' => 'user',
            'page' => 'user/v_index',
            'web' => $this->ModelSetting->DataWeb(),
            'user' => $this->ModelUser-> AllData(),
        ];
        return view('v_template_back_end',$data);
    }
public function profil()
{
    $user_id = user()->id; // Mengambil ID pengguna yang sedang login
    $user = $this->ModelUser->DetailData($user_id); // Mendapatkan data pengguna berdasarkan ID yang diambil
    
    $data = [
        'judul' => 'User Profile',
        'menu' => 'profil',
        'page' => 'user/v_profil',
        'web' => $this->ModelSetting->DataWeb(),
        'user' => $user, // Mengirimkan data pengguna yang sesuai
    ];

    return view('v_template_back_end', $data);
}


    public function Input()
    {
        $data = [
            'judul' => 'Add User',
            'menu' => 'user',
            'page' => 'user/v_input',
            'config' => $this->config,
            'web' => $this->ModelSetting->DataWeb(),
        ];
        return view('v_template_back_end',$data);
    }

    public function InsertData()
{
    $users = model(UserModel::class);
 
    // Validasi data pengguna
    $rules = [
        'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|strong_password',
        'pass_confirm' => 'required|matches[password]',
        'role' => 'required|in_list[user,admin,superadmin]' // Tambahkan validasi untuk role
    ];
 
    if (! $this->validate($rules))
    {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
 
    // Membuat instansi User
    $allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
    $user = new User($this->request->getPost($allowedPostFields));

    // Mengaktifkan pengguna atau menghasilkan hash aktivasi
    $this->config->requireActivation === null ? $user->activate() : $user->generateActivateHash();
 
    // Menambahkan pengguna ke grup default jika ada
    if (! empty($this->config->defaultUserGroup)) {
        $users = $users->withGroup($this->config->defaultUserGroup);
    }

    // Menambahkan pengguna ke grup yang dipilih
    $role = $this->request->getPost('role');
    if (!empty($role)) {
        $users = $users->withGroup($role);
    }
 
    // Menyimpan pengguna
    if (! $users->save($user))
    {
        return redirect()->back()->withInput()->with('errors', $users->errors());
    }
 
    if ($this->config->requireActivation !== null)
    {
        $activator = service('activator');
        $sent = $activator->send($user);
 
        if (! $sent)
        {
            return redirect()->back()->withInput()->with('error', $activator->error() ?? lang('Auth.unknownError'));
        }
 
        // Jika berhasil, tampilkan pesan sukses
        session()->setFlashdata('insert', 'Data Successfully Created');
        return redirect()->to('UserControll');
    }
   
    // Jika tidak memerlukan aktivasi, arahkan kembali ke halaman sebelumnya
    return redirect()->back();
}


public function Edit($encrypted_id)
{
    $id = $this->decrypt($encrypted_id);
    $data = [
        'judul' => 'Edit User',
        'menu' => 'user',
        'page' => 'user/v_edit',
        'web' => $this->ModelSetting->DataWeb(),
        'user' => $this->ModelUser->getUserWithRole($id), // Gunakan method getUserWithRole
    ];
    return view('v_template_back_end', $data);
}

public function UpdateData($id)
{
    if ($this->validate([
        'fullname' => [
            'label' => 'Fullname',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Wajib Diisi!'
            ]
        ],
        'username' => [
            'label' => 'Username',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Wajib Diisi!'
            ]
        ],
        'email' => [
            'label' => 'E-mail',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Wajib Diisi!'
            ]
        ],
        'foto' => [
            'label' => 'Foto',
            'rules' => 'mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,2048]',
            'errors' => [
                'mime_in' => 'File {field} harus berupa file gambar (JPG, JPEG, PNG).',
                'max_size' => 'Ukuran file {field} tidak boleh melebihi 2 MB.'
            ]
        ],
    ])) {
        $foto = $this->request->getFile('foto');
        $user = $this->ModelUser->DetailData($id);
        $role = $this->request->getPost('role'); // Ambil role dari form

        if ($foto->getError() == 4) {
            $nama_file_foto = $user['foto'];
        } else {
            if ($user['foto'] !== 'avatar4.png' && file_exists(FCPATH . 'foto/' . $user['foto'])) {
                unlink(FCPATH . 'foto/' . $user['foto']);
            }
            $nama_file_foto = $foto->getRandomName();
            $foto->move('foto', $nama_file_foto);
        }

        $data = [
            'id' => $id,
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'foto' => $nama_file_foto,
        ];

        $this->ModelUser->UpdateData($data);

        $groupModel = new GroupModel();
        $groupId = ($role == 'admin') ? 1 : (($role == 'user') ? 2 : 3);
        $groupModel->removeUserFromAllGroups($id);
        $groupModel->addUserToGroup($id, $groupId);

        session()->setFlashdata('update', 'Data Successfully Updated');
        return redirect()->to('UserControll');
    } else {
        session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
        return redirect()->to('UserControll/Edit/'.$id)->withInput();
    }
}

    public function Delete($id){
        $user = $this->ModelUser->DetailData($id);
        if ($user['foto'] && $user['foto'] !== 'avatar4.png') {
           unlink('foto/'.$user['foto']);
        }
        $data = [
            'id' => $id,
        ];
        $this->ModelUser->DeleteData($data);
            session()->setFlashdata('delete', 'Data Successfully Deleted');
            return redirect()->to('UserControll');
    }
    
    
}