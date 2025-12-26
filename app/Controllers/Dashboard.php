<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    protected $userModel;
    protected $productModel;
    protected $categoryModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->session = session();
    }

    public function index()
    {
        // Check if user is logged in
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        // Get dashboard statistics
        $data = [
            'title' => 'Dashboard - Inventory App',
            'total_products' => $this->productModel->where('is_active', 1)->countAllResults(),
            'total_categories' => $this->categoryModel->where('is_active', 1)->countAllResults(),
            'low_stock_products' => $this->productModel->where('stock_quantity <= min_stock_level')->where('is_active', 1)->countAllResults(),
            'user' => [
                'name' => $this->session->get('name'),
                'role' => $this->session->get('role')
            ]
        ];

        return view('dashboard/index', $data);
    }
}
