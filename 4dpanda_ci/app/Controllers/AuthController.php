<?php
// app/Controllers/AuthController.php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function index()
    {
        return view('backend/login');
    }

    public function authenticate()
    {
        $session = session();
        $model = new UserModel();
        $recaptchaResponse = $this->request->getPost('recaptcha_response');
        $secretKey = '6LcHxwsqAAAAAJFOdMnI21MtQhZ06eM1aCsJE08s'; // Thay YOUR_SECRET_KEY bằng khóa bí mật của bạn

        $recaptcha = new \ReCaptcha\ReCaptcha($secretKey);
        $resp = $recaptcha->setExpectedHostname($_SERVER['SERVER_NAME'])
                      ->verify($recaptchaResponse, $_SERVER['REMOTE_ADDR']);
        if ($resp->isSuccess()) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $data = $model->where('username', $username)->first();
            if ($data) {
                $pass = $data['password'];
                //var_dump(password_hash($password, PASSWORD_DEFAULT)); exit();
                $verify_pass = password_verify($password, $pass);
                if ($verify_pass) {
                    session()->set('isLoggedIn', true);
                    return redirect()->to('/admin/dashboard');
                } else {
                    $session->setFlashdata('msg', 'Password is incorrect.');
                    return redirect()->to('/admin/login');
                }
            } else {
                $session->setFlashdata('msg', 'Username does not exist.');
                return redirect()->to('/admin/login');
            }
        }
        else {
            $session->setFlashdata('msg', 'Recaptcha Verification Error.');
                return redirect()->to('/admin/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }
}
