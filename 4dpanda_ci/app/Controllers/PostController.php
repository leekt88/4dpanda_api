<?php
// app/Controllers/PostController.php
namespace App\Controllers;

use App\Models\PostModel;
use App\Models\CategoryModel;
use CodeIgniter\Controller;
use CodeIgniter\Files\File;
use App\Models\SettingsModel;

class PostController extends Controller
{
    protected $helpers = ['form'];
    protected $settingModel;

    public function __construct()
    {
        $this->settingModel = new SettingsModel();
    }
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }
        $model = new PostModel();
        $data['posts'] = $model->findAll();
        return view('backend/post/index', $data);
    }
    public function predictionIndex(){
        
    }
    public function create()
    {
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();
        return view('backend/post/create', $data);
    }

    public function store()
    {
        $model = new PostModel();
        $img = $this->request->getFile('image');
        $publicPath = "";
        if($img->getSize()){
            $validationRule = [
                'image' => [
                    'label' => 'Image File',
                    'rules' => [
                        'uploaded[image]',
                        'is_image[image]',
                        'mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                        'max_size[image,2048]',
                        'max_dims[image,2048,3000]',
                    ],
                ],
            ];
            if (! $this->validateData([], $validationRule)) {
                $data = ['errors' => $this->validator->getErrors()];
                return redirect()->to('/admin/posts/create');
            }
            else {
                
                if ($img->isValid() && !$img->hasMoved()) {
                    $filepath = WRITEPATH . 'uploads/' . $img->store();
                    $publicPath = str_replace(WRITEPATH,"",$filepath);
                }
            }
        }
        $data = [
            'title' => $this->request->getVar('title'),
            'content' => $this->request->getVar('content'),
            'image' => base_url($publicPath),
            'category_id' => $this->request->getVar('category_id'),
            'meta_title' => $this->request->getVar('meta_title'),
            'meta_description' => $this->request->getVar('meta_description'),
            'meta_keywords' => $this->request->getVar('meta_keywords'),
            'scripts' => $this->request->getVar('scripts'),
            'uri' => $this->request->getVar('uri')
        ];
        $model->save($data);
        return redirect()->to('/admin/posts');   
    }

    public function edit($id)
    {
        $model = new PostModel();
        $categoryModel = new CategoryModel();
        $data['post'] = $model->find($id);
        $data['categories'] = $categoryModel->findAll();
        return view('backend/post/edit', $data);
    }

    public function update($id)
    {
        $model = new PostModel();
        $data = [
            'title' => $this->request->getVar('title'),
            'content' => $this->request->getVar('content'),
            'category_id' => $this->request->getVar('category_id'),
            'meta_title' => $this->request->getVar('meta_title'),
            'meta_description' => $this->request->getVar('meta_description'),
            'meta_keywords' => $this->request->getVar('meta_keywords'),
            'scripts' => $this->request->getVar('scripts'),
            'uri' => $this->request->getVar('uri')
        ];
        $img = $this->request->getFile('image');
        //var_dump($img);
        //var_dump($img->getClientPath());
        //exit();
        if($img->getSize()){
            $validationRule = [
                'image' => [
                    'label' => 'Image File',
                    'rules' => [
                        'uploaded[image]',
                        'is_image[image]',
                        'mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                        'max_size[image,2048]',
                        'max_dims[image,2048,3000]',
                    ],
                ],
            ];
            if (! $this->validateData([], $validationRule)) {
                //$data = ['errors' => $this->validator->getErrors()];
                return redirect()->to('/admin/posts/update/'.$id);
            }
            else {
                
                if ($img->isValid() && !$img->hasMoved()) {
                    $filepath = WRITEPATH . 'uploads/' . $img->store();
                    $publicPath = str_replace(WRITEPATH,"",$filepath);
                    //echo $publicPath;
                    $data['image'] = base_url($publicPath);
                }
            }
        }
        //var_dump($data);exit();
        $model->update($id, $data);
        return redirect()->to('/admin/posts');
    }

    public function delete($id)
    {
        $model = new PostModel();
        $model->delete($id);
        return redirect()->to('/admin/posts');
    }
    /* Delete Image of a post */

    public function deleteImage()
    {
        $postModel = new PostModel();
        $postId = $this->request->getPost('post_id');
        $imagePath = $this->request->getPost('image_path');

        // Find the post
        $post = $postModel->find($postId);

        if ($post) {
            // Delete the image file
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Update the post record to remove the image path
            $postModel->update($postId, ['image' => null]);

            return $this->response->setBody('success');
        }

        return $this->response->setBody('fail');
    }
    public function view($uri)
    {
        $model = new PostModel();
        $data['post'] = $model->where('uri', $uri)->first();
        if (!$data['post']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $meta = $this->getMetaData($uri);
        return view('frontend/post/view', ["post"=>$data['post'], "meta"=> $meta]);
    }

    public function viewRecentNewsIndex(){
        $recentNews = $this->RecentNews();
        $uri = 'recent-news';//$this->getUri();
        $meta = $this->getMetaData($uri);
        $seo = $this->getSEOContent($uri);
        return view('frontend/post/category', ["news"=> $recentNews, "meta"=> $meta,"seo_content"=> $seo]);
    }
    private function RecentNews(){
        $model = new PostModel();
        $data['posts'] = $model->get_latest_posts_by_cat(30, 1);
        return $data;
    } 
    private function getMetaData($uri){
        return ($this->settingModel->getSiteMeta($uri));
    }  
    private function getSEOContent($uri){

        return ($this->settingModel->getSEOContent($uri));
    }
}
