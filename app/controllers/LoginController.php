<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: LoginController
 * 
 * Automatically generated via CLI.
 */
class LoginController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('LoginModel');
    }

    public function index()
    {
        $this->call->view('login/index');
    }

    public function authenticate()
    {
        $username = $this->io->post('username');
        $password = $this->io->post('password');

        // Fetch a single record
        $user = $this->LoginModel->get_admin_by_username($username);

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['authenticated'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_username'] = $user['username'];

            redirect('products');

        } else {

            $_SESSION['login_error'] = 'Invalid username or password.';

            redirect('login');
        }
    }

    public function logout()
    {
        session_destroy();

        redirect('login');
    }
}