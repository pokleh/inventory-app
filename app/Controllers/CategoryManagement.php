<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class CategoryManagement extends BaseController
{
    protected $categoryModel;
    protected $session;
    protected $validation;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->session = session();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        // Check if user is logged in (admin/manager can access)
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'title' => 'Category Management - Inventory App',
            'page_title' => 'Pengurusan Kategori',
            'categories' => $this->categoryModel->findAll()
        ];

        return view('admin/categories/index', $data);
    }

    public function create()
    {
        // Check if user is logged in (admin/manager can access)
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'title' => 'Create Category - Inventory App',
            'page_title' => 'Tambah Kategori Baru'
        ];

        return view('admin/categories/create', $data);
    }

    public function store()
    {
        // Check if user is logged in (admin/manager can access)
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        $rules = [
            'name' => 'required|min_length[2]|max_length[255]|is_unique[categories.name]',
            'description' => 'permit_empty|max_length[1000]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->categoryModel->insert($data)) {
            return redirect()->to('/admin/categories')->with('success', 'Kategori berjaya ditambah');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambah kategori');
    }

    public function show($id)
    {
        // Check if user is logged in (admin/manager can access)
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        $category = $this->categoryModel->find($id);
        if (!$category) {
            return redirect()->to('/admin/categories')->with('error', 'Kategori tidak ditemui');
        }

        $data = [
            'title' => 'View Category - Inventory App',
            'page_title' => 'Lihat Kategori',
            'category' => $category
        ];

        return view('admin/categories/show', $data);
    }

    public function edit($id)
    {
        // Check if user is logged in (admin/manager can access)
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        $category = $this->categoryModel->find($id);
        if (!$category) {
            return redirect()->to('/admin/categories')->with('error', 'Kategori tidak ditemui');
        }

        $data = [
            'title' => 'Edit Category - Inventory App',
            'page_title' => 'Edit Kategori',
            'category' => $category
        ];

        return view('admin/categories/edit', $data);
    }

    public function update($id)
    {
        // Check if user is logged in (admin/manager can access)
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        $category = $this->categoryModel->find($id);
        if (!$category) {
            return redirect()->to('/admin/categories')->with('error', 'Kategori tidak ditemui');
        }

        $rules = [
            'name' => 'required|min_length[2]|max_length[255]|is_unique[categories.name,id,' . $id . ']',
            'description' => 'permit_empty|max_length[1000]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($this->categoryModel->update($id, $data)) {
            return redirect()->to('/admin/categories')->with('success', 'Kategori berjaya dikemaskini');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal mengemaskini kategori');
    }

    public function delete($id)
    {
        // Check if user is logged in (admin/manager can access)
        if (!$this->session->get('isLoggedIn')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Akses tidak dibenarkan']);
        }

        $category = $this->categoryModel->find($id);
        if (!$category) {
            return $this->response->setJSON(['success' => false, 'message' => 'Kategori tidak ditemui']);
        }

        // Check if category has products
        $productCount = $this->categoryModel->db->table('products')->where('category_id', $id)->countAllResults();
        if ($productCount > 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tidak boleh memadam kategori yang mempunyai produk'
            ]);
        }

        if ($this->categoryModel->delete($id)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Kategori berjaya dipadam']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal memadam kategori']);
    }

    public function toggleStatus($id)
    {
        // Check if user is logged in (admin/manager can access)
        if (!$this->session->get('isLoggedIn')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Akses tidak dibenarkan']);
        }

        $category = $this->categoryModel->find($id);
        if (!$category) {
            return $this->response->setJSON(['success' => false, 'message' => 'Kategori tidak ditemui']);
        }

        $newStatus = $category['is_active'] ? 0 : 1;
        $statusText = $newStatus ? 'diaktifkan' : 'dinonaktifkan';

        if ($this->categoryModel->update($id, ['is_active' => $newStatus])) {
            return $this->response->setJSON([
                'success' => true,
                'message' => "Kategori berjaya $statusText",
                'new_status' => $newStatus
            ]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengubah status kategori']);
    }
}
