<?php

namespace App\Controllers;

use App\Models\LotteryModel;
use CodeIgniter\Controller;
use App\Models\SettingsModel;

class ApiController extends Controller
{
    protected $format    = 'json';
    public function __construct()
    {
        $this->settingModel = new SettingsModel();
    }
    public function apiViewIndex(){

    }
    public function fetchAll()
    {
        $model = new LotteryModel();
        $names = [
            //'M' => 'Magnum 4D',
            'M4D' => 'Magnum 4D', //New
            'DMC4D' => 'Damacai 1+3D', //new
            'DMC6D' => 'Damacai 3+3D', //new
            //'T' => 'Toto 4D',
            'TT' => 'Toto 4D 5D 6D', //new
            //'S' => 'Singapore 4D', 
            //'ST' => 'Singapore Toto',
            'STC' => 'Sandakan 4D', //new
            'SB' => 'Sabah 4D',
            'SBLT' => 'Sabah Lotto',
            //'SW' => 'Sandakan 4D',
            'SCS' => 'Special Cash Sweep', //new
            //'SGT' => 'Singapore Grand Toto',
            'SGP4D' => 'Singapore Pools 4D', //new
            'SGPTT' => 'Singapore Pools Toto', //new
            'MJG' => 'Magnum Gold',
            'GD' => 'Grand Lotto', //new
            'H4D6D1' => 'Lucky Hari Hari 4D 15:30', //new
            'H4D6D2' => 'Lucky Hari Hari 4D 19:30', //new
            //'H' => 'Horse Racing',
            'P4D2' => 'Perdana 4D 19:30:00', //new
            'P4D1' => 'Perdana 4D 15:30:00', //new
            'LMC' => 'Lottery Macao 19:30:00', //new
            'LMC1' => 'Lottery Macao 15:30:00', //new
            'MTH'   => 'Matahari 20:30:00', //new
            'NLT' => '9 Loto 19:30:00', //new
        ];
        foreach ($names as $type=> $value){
            $data[$type] = $model->getLotteryDataByType($type);
            $respone[$type] = json_decode($data[$type]['data'], true);
        }
        return json_encode($respone);
    }
    public function apiIndex(){
        // Lấy giá trị của param1
        $request = \Config\Services::request();
        $param = $request->getGet('region');
        $data  = $this->fetchAll();
        switch ($param){
            case 'home':
                $region = 0;
                break;
            case 'malaysia':
                $region = 1;
                break;
            case 'singapore':
                $region = 3;
                break;
            case 'west-malaysia':
                $region = 2;
                break;
            case 'cambodia':
                $region = 4;
                break;
            default:
                $region = 0;
            break;
        }
        $uri = $this->getUri();
        $meta = $this->getMetaData($uri);
        $h1 = $this->getH1Title($uri);
        return view('frontend/api', ["region"=> $region, "results"=>$data,  "meta"=> $meta, "h1"=>$h1, "api"=>true]);
    }
    private function getMetaData($uri){
        return ($this->settingModel->getSiteMeta($uri));
    }  
    private function getAdsLists(){

        return ($this->settingModel->getAdsLists());
    }
    private function getHeadingLists($uri){
        return ($this->settingModel->getHeadingLists($uri));
    }
    private function getH1Title($uri){
        return ($this->settingModel->getH1Title($uri));
    }
    private function getUri(){
        // Lấy đối tượng request
        $request = \Config\Services::request();
        // Lấy toàn bộ URL
        $fullUrl = $request->getUri();
        return str_replace("/","-",substr($fullUrl->getPath(),1));
    }
}
?>
