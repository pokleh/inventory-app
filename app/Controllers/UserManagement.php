<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserManagement extends BaseController
{
    protected $userModel;
    protected $session;
    protected $validation;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        // Check if user is admin
        if (!$this->session->get('isLoggedIn') || !in_array($this->session->get('role'), ['admin'])) {
            return redirect()->to('/dashboard')->with('error', 'Akses tidak dibenarkan');
        }

        $data = [
            'title' => 'User Management - Inventory App',
            'page_title' => 'Pengurusan Pengguna',
            'users' => $this->userModel->findAll()
        ];

        return view('admin/users/index', $data);
    }

    public function create()
    {
        // Check if user is admin
        if (!$this->session->get('isLoggedIn') || !in_array($this->session->get('role'), ['admin'])) {
            return redirect()->to('/dashboard')->with('error', 'Akses tidak dibenarkan');
        }

        $data = [
            'title' => 'Create User - Inventory App',
            'page_title' => 'Tambah Pengguna Baru'
        ];

        return view('admin/users/create', $data);
    }

    public function store()
    {
        // Check if user is admin
        if (!$this->session->get('isLoggedIn') || !in_array($this->session->get('role'), ['admin'])) {
            return redirect()->to('/dashboard')->with('error', 'Akses tidak dibenarkan');
        }

        $rules = [
            'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
            'name' => 'required|min_length[2]|max_length[255]',
            'role' => 'required|in_list[admin,manager,user]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'name' => $this->request->getPost('name'),
            'role' => $this->request->getPost('role'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->userModel->insert($data)) {
            return redirect()->to('/admin/users')->with('success', 'Pengguna berjaya ditambah');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambah pengguna');
    }

    public function show($id)
    {
        // Check if user is admin
        if (!$this->session->get('isLoggedIn') || !in_array($this->session->get('role'), ['admin'])) {
            return redirect()->to('/dashboard')->with('error', 'Akses tidak dibenarkan');
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'Pengguna tidak ditemui');
        }

        $data = [
            'title' => 'View User - Inventory App',
            'page_title' => 'Lihat Pengguna',
            'user' => $user
        ];

        return view('admin/users/show', $data);
    }

    public function edit($id)
    {
        // Check if user is admin
        if (!$this->session->get('isLoggedIn') || !in_array($this->session->get('role'), ['admin'])) {
            return redirect()->to('/dashboard')->with('error', 'Akses tidak dibenarkan');
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'Pengguna tidak ditemui');
        }

        $data = [
            'title' => 'Edit User - Inventory App',
            'page_title' => 'Edit Pengguna',
            'user' => $user
        ];

        return view('admin/users/edit', $data);
    }

    public function update($id)
    {
        // Check if user is admin
        if (!$this->session->get('isLoggedIn') || !in_array($this->session->get('role'), ['admin'])) {
            return redirect()->to('/dashboard')->with('error', 'Akses tidak dibenarkan');
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'Pengguna tidak ditemui');
        }

        $rules = [
            'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username,id,' . $id . ']',
            'email' => 'required|valid_email|is_unique[users.email,id,' . $id . ']',
            'name' => 'required|min_length[2]|max_length[255]',
            'role' => 'required|in_list[admin,manager,user]'
        ];

        // Only validate password if it's being changed
        if ($this->request->getPost('password')) {
            $rules['password'] = 'required|min_length[6]';
            $rules['password_confirm'] = 'required|matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'name' => $this->request->getPost('name'),
            'role' => $this->request->getPost('role'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Only update password if provided
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        if ($this->userModel->update($id, $data)) {
            return redirect()->to('/admin/users')->with('success', 'Pengguna berjaya dikemaskini');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal mengemaskini pengguna');
    }

    public function delete($id)
    {
        // Check if user is admin
        if (!$this->session->get('isLoggedIn') || !in_array($this->session->get('role'), ['admin'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Akses tidak dibenarkan']);
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return $this->response->setJSON(['success' => false, 'message' => 'Pengguna tidak ditemui']);
        }

        // Prevent deleting own account
        if ($user['id'] == $this->session->get('user_id')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak boleh memadam akaun sendiri']);
        }

        if ($this->userModel->delete($id)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Pengguna berjaya dipadam']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal memadam pengguna']);
    }

    public function toggleStatus($id)
    {
        // Check if user is admin
        if (!$this->session->get('isLoggedIn') || !in_array($this->session->get('role'), ['admin'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Akses tidak dibenarkan']);
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return $this->response->setJSON(['success' => false, 'message' => 'Pengguna tidak ditemui']);
        }

        $newStatus = $user['is_active'] ? 0 : 1;
        $statusText = $newStatus ? 'diaktifkan' : 'dinonaktifkan';

        if ($this->userModel->update($id, ['is_active' => $newStatus])) {
            return $this->response->setJSON([
                'success' => true,
                'message' => "Pengguna berjaya $statusText",
                'new_status' => $newStatus
            ]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengubah status pengguna']);
    }
}
