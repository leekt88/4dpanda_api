<?php
// app/Controllers/UserController.php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('backend/user/index', $data);
    }

    public function create()
    {
        return view('backend/user/create');
    }

    public function store()
    {
        $model = new UserModel();
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'email' => $this->request->getVar('email')
        ];
        $model->save($data);
        return redirect()->to('/admin/users');
    }

    public function edit($id)
    {
        $model = new UserModel();
        $data['user'] = $model->find($id);
        return view('backend/user/edit', $data);
    }

    public function update($id)
    {
        $session = session();
        $model = new UserModel();
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'email' => $this->request->getVar('email')
        ];
        $model->update($id, $data);
        $session->setFlashdata('msg', 'Account update successfully.');
        return redirect()->to('/admin//users');
    }

    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);
        return redirect()->to('/admin/users');
    }
}
