<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
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
        return redirect()->to('/auth/login');
    }

    public function login()
    {
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'title' => 'Login - Inventory App'
        ];

        return view('auth/login', $data);
    }

    public function attemptLogin()
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[100]',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah');
        }

        if (!$user['is_active']) {
            return redirect()->back()->withInput()->with('error', 'Akun anda tidak aktif');
        }

        // Set session data
        $this->session->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'isLoggedIn' => true
        ]);

        return redirect()->to('/dashboard')->with('success', 'Selamat datang, ' . $user['name']);
    }

    public function register()
    {
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'title' => 'Register - Inventory App'
        ];

        return view('auth/register', $data);
    }

    public function attemptRegister()
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
            'name' => 'required|min_length[2]|max_length[255]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'name' => $this->request->getPost('name'),
            'role' => 'user', // Default role
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->userModel->insert($data)) {
            return redirect()->to('/auth/login')->with('success', 'Pendaftaran berjaya! Sila log masuk.');
        }

        return redirect()->back()->withInput()->with('error', 'Pendaftaran gagal. Sila cuba lagi.');
    }

    public function forgotPassword()
    {
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'title' => 'Forgot Password - Inventory App'
        ];

        return view('auth/forgot_password', $data);
    }

    public function attemptForgotPassword()
    {
        $rules = [
            'email' => 'required|valid_email'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemui dalam sistem kami.');
        }

        // Generate reset token (simplified - in production, send email)
        $resetToken = bin2hex(random_bytes(32));
        $this->userModel->update($user['id'], ['reset_token' => $resetToken]);

        // For now, just show the token. In production, send via email
        return redirect()->back()->with('info', 'Reset token telah dihantar ke email anda. Token: ' . $resetToken);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/auth/login')->with('success', 'Anda telah log keluar.');
    }
}
