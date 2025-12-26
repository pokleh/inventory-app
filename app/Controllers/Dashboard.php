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
            'page_title' => 'Dashboard',
            'total_products' => 0, // Temporarily hardcoded for testing
            'total_categories' => 0, // Temporarily hardcoded for testing
            'low_stock_products' => 0, // Temporarily hardcoded for testing
            'user' => [
                'name' => $this->session->get('name') ?? 'Test User',
                'role' => $this->session->get('role') ?? 'user'
            ]
        ];

        return view('dashboard/index', $data);
    }
}
