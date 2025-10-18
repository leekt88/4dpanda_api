<?php
// app/Controllers/CategoryController.php
namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }
        $model = new CategoryModel();
        $data['categories'] = $model->findAll();
        return view('backend/category/index', $data);
    }

    public function create()
    {
        return view('backend/category/create');
    }

    public function store()
    {
        $model = new CategoryModel();
        $model->save([
            'name' => $this->request->getVar('name'),
            'slug' => url_title($this->request->getVar('name'), '-', TRUE),
            'description' => $this->request->getVar('description')
        ]);
        return redirect()->to('/admin/categories');
    }

    public function edit($id)
    {
        $model = new CategoryModel();
        $data['category'] = $model->find($id);
        return view('backend/category/edit', $data);
    }

    public function update($id)
    {
        $model = new CategoryModel();
        $model->update($id, [
            'name' => $this->request->getVar('name'),
            'slug' => url_title($this->request->getVar('name'), '-', TRUE)
        ]);
        return redirect()->to('admin/categories');
    }

    public function delete($id)
    {
        $model = new CategoryModel();
        $model->delete($id);
        return redirect()->to('admin/categories');
    }
}
