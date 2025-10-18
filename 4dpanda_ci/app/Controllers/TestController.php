<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class TestController extends Controller
{
    public function serverInfo()
    {
        $data = [
            'server_name' => '4dpanda.com',
            'server_path' => ROOTPATH,
            'database' => getenv('database.default.database') ?: '4dpanda_db',
            'current_time' => date('Y-m-d H:i:s'),
            'php_version' => phpversion(),
            'framework' => 'CodeIgniter 4',
            'status' => 'online',
            'message' => 'This is the MAIN server at 4dpanda.com'
        ];
        
        return $this->response->setJSON($data);
    }
}


