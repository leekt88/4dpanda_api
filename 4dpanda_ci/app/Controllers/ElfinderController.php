<?php
namespace App\Controllers;

use FM\Elfinder\Elfinder;
use FM\Elfinder\PathNormalizer;

class ElfinderController extends BaseController
{
    public function connector()
    {
        echo "hello"; die();
        $roots = [
            [
                'driver' => 'LocalFileSystem',
                'path'   => WRITEPATH . 'uploads',
                'URL'    => base_url('uploads'),
                'accessControl' => 'access',
                'uploadAllow' => ['image/png', 'image/jpeg', 'image/gif'],
                'uploadDeny' => ['all'],
                'uploadOrder' => ['allow', 'deny'],
            ],
        ];

        $opts = ['roots' => $roots];
        $connector = new Elfinder($opts);

        return $connector->run();
    }

    public function access($attr, $path, $data, $volume, $isDir, $relpath)
    {
        $basename = basename($path);
        return $basename[0] === '.'                  // if file/folder begins with '.' (dot)
            && strlen($relpath) !== 1                // but with out volume root
            ? !($attr == 'read' || $attr == 'write') // set read+write to false, other (locked+hidden) set to true
            :  null;                                 // else elFinder decide it itself
    }

    public function upload(){
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }
        return view('backend/elfinder.php');
    }
}
