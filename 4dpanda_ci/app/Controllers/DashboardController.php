<?php
// app/Controllers/DashboardController.php
namespace App\Controllers;

use CodeIgniter\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }
        return view('backend/dashboard');
    }
}
