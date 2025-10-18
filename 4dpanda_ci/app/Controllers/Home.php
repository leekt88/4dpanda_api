<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PostModel;
use App\Models\LotteryModel;
use App\Models\SettingsModel;
class Home extends Controller
{
    protected $settingModel;

    public function __construct()
    {
        $this->settingModel = new SettingsModel();
    }
    public function index()
    {
        //$metadataModel = new MetadataModel();
        //$data['metadata'] = $metadataModel->first();
        $data = $this->fetchAll();
        $recentNews = $this->homepageRecentNews();
        $uri = $this->getUri();
        $meta = $this->getMetaData($uri);
        $seo = $this->getSEOContent($uri);
        $ads = $this->getAdsLists();
        $headings = $this->getHeadingLists($uri);
        $special_draws = $this->settingModel->getSpecialDraw();
        return view('frontend/home', ["region"=> 0, "results"=>$data, "news"=> $recentNews, "meta"=> $meta,"seo_content"=> $seo,"ads"=>$ads, "headings"=>$headings, "special_draws"=> $special_draws]);
    }
    private function fetchAll()
    {
        $model = new LotteryModel();
        $names = [
            //'M' => 'Magnum 4D',
            'M4D' => "Magnum 4D", //MP
            'DMC4D' => 'Damacai 1+3D', //MP
            'DMC6D' => 'Damacai 3+3D', //MP
            //'T' => 'Toto 4D',
            'TT' => "Toto 4D 5D 6D", //MP
            //'S' => 'Singapore 4D',
            //ST' => 'Singapore Toto',
            'STC' => 'Sandakan 4D', //MP
            'SB' => 'Sabah 4D',
            'SBLT' => 'Sabah Lotto',
            //'SW' => 'Sandakan 4D',
            'SCS' => 'Special Cash Sweep', //MP
            //'SGT' => 'Singapore Grand Toto', 
            'SGP4D' => 'Singapore Pools 4D', //MP
            'SGPTT' => 'SingaporePools Toto', //MP
            //'MJG' => 'Magnum Gold',
            'M4DJG' => 'Magnum 4D Jackpot Gold',//MP
            'GD' => 'Grand Dragon 4D 6D', //MP
            'H4D6D1' => 'Lucky Hari Hari 4D 15:30', //MP
            'H4D6D2' => 'Lucky Hari Hari 4D 15:30', //MP
            //'H' => 'Horse Racing',
            'P4D1' => 'Perdana 4D 15:30:00', //MP
            'P4D2' => 'Perdana 4D 19:30:00', //MP
            'LMC' => 'Lottery Macao 19:30:00', //MP
            'LMC1' => 'Lottery Macao 15:30:00', //MP
            'MTH' => 'Matahari 20:30:00', //MP
            'NLT' => '9 Loto 19:30:00', //MP
        ];
        foreach ($names as $type=> $value){
            $data[$type] = $model->getLotteryDataByType($type);
            $respone[$type] = json_decode($data[$type]['data'], true);
        }
        //var_dump($respone);
        //return view('frontend/home');//, $data);
        return json_encode($respone);
    }
    private function fetchByType($types)
    {
        $model = new LotteryModel();
        foreach ($types as $type){
            $data[$type] = $model->getLotteryDataByType($type);
            $respone[$type] = json_decode($data[$type]['data'], true);
        }
        return json_encode($respone);
    }
    private function fetchPastByType($types){
        $model = new LotteryModel();
        foreach ($types as $key=>$type){
            $data[$type] = $model->getLotteryPastDataByType($type);
        }
        foreach ($types as $key=>$type){
            $res[0][$type] = json_decode($data[$type][1]['data'], true);
            $res[0]['date'] = $data[$type][1]['date'];
            $res[1][$type] = json_decode($data[$type][2]['data'], true);
            $res[1]['date'] = $data[$type][2]['date'];
        }
        $res[0] = json_encode($res[0]);
        $res[1] = json_encode($res[1]);
        //exit();
        return $res;//json_encode($respone);
    }
    public function myresultsindex($type = NULL){

        $uri = $this->getUri();
        $meta = $this->getMetaData($uri);
        $seo = $this->getSEOContent($uri);
        $ads = $this->getAdsLists();
        $headings = $this->getHeadingLists($uri);
        $param = ["region"=> 1, "meta"=> $meta, "seo_content"=> $seo,"ads"=>$ads, "headings"=>$headings];
        if(!$type)
            $data = $this->fetchAll();
        else{
            switch ($type){
                case 'magnum':
                    $types = ["M4D", "M4DJG"];
                    $data = $this->fetchByType($types);
                    $past = $this->fetchPastByType($types);
                    $param['past_results'] = $past;
                    break;
                case 'damacai':
                    $types = ["DMC4D", "DMC6D"];
                    $data = $this->fetchByType($types);
                    $past = $this->fetchPastByType($types);
                    $param['past_results'] = $past;
                    break;
                case 'toto':
                    $types = ["TT"];
                    $data = $this->fetchByType($types);
                    $past = $this->fetchPastByType($types);
                    $param['past_results'] = $past;
                    break;   
                default:
                    $data = $this->fetchAll();
                    break;
            }
        }
        $param["results"]=$data;
        return view('frontend/home', $param);
    }
    public function westmyresultsindex($type = NULL){
        $uri = $this->getUri();
        $meta = $this->getMetaData($uri);
        $seo = $this->getSEOContent($uri);
        $ads = $this->getAdsLists();
        $headings = $this->getHeadingLists($uri);
        $param = ["region"=> 2, "meta" => $meta, "seo_content"=> $seo,"ads"=>$ads, "headings"=>$headings];
        if(!$type)
            $data = $this->fetchAll();
        else {
            switch ($type){
                case 'sabah':
                    $types = ["SB", "SBLT"];
                    $data = $this->fetchByType($types);
                    $past = $this->fetchPastByType($types);
                    $param['past_results'] = $past;
                    break;   
                case 'sandakan':
                    $types = ["STC"];
                    $data = $this->fetchByType($types);
                    $past = $this->fetchPastByType($types);
                    $param['past_results'] = $past;
                    break;
                case 'sarawak':
                    $types = ["SCS"];
                    $data = $this->fetchByType($types);
                    $past = $this->fetchPastByType($types);
                    $param['past_results'] = $past;
                    break;
                default:
                    $data = $this->fetchAll();
                    break;
            }
        }
        $param["results"]=$data;
        return view('frontend/home', $param );
    }  
    public function singaporeresultsindex($type = NULL){
        $uri = $this->getUri();
        $meta = $this->getMetaData($uri);
        $seo = $this->getSEOContent($uri);
        $ads = $this->getAdsLists();
        $headings = $this->getHeadingLists($uri);
        $param = ["region"=> 3, "meta"=> $meta, "seo_content"=> $seo, "ads"=>$ads, "headings"=>$headings];

        if(!$type)
            $data = $this->fetchAll();
        else {
            switch ($type){
                case 'singapore-pools':
                    $types = ["SGPTT", "SGP4D"];
                    $data = $this->fetchByType($types);
                    $past = $this->fetchPastByType($types);
                    $param['past_results'] = $past;
                    break;   
                default:
                    $data = $this->fetchAll();
                    break;
            }
        }
        $param["results"] = $data;
        return view('frontend/home', $param );
    }
    public function cambodiaresultsindex($type = NULL){
        $uri = $this->getUri();
        $meta = $this->getMetaData($uri);
        $seo = $this->getSEOContent($uri);
        $ads = $this->getAdsLists();
        $headings = $this->getHeadingLists($uri);
        $param = ["region"=> 4, "meta" =>$meta, "seo_content"=> $seo,"ads"=>$ads, "headings"=>$headings];
        if(!$type)
            $data = $this->fetchAll();
        else {
            switch ($type){
                case 'gd':
                    $types = ["GD"];
                    $data = $this->fetchByType($types);
                    $past = $this->fetchPastByType($types);
                    $param['past_results'] = $past;
                    break;   
                case 'perdana':
                    $types = ["P4D1", "P4D2"];
                    $data = $this->fetchByType($types);
                    $past = $this->fetchPastByType($types);
                    $param['past_results'] = $past;
                    break;  
                case 'lucky':
                    $types = ["H4D6D1", "H4D6D2"];
                    $data = $this->fetchByType($types);
                    $past = $this->fetchPastByType($types);
                    $param['past_results'] = $past;
                    break; 
                case 'nlt':
                    $types = ["NLT"];
                    $data = $this->fetchByType($types);
                    $past = $this->fetchPastByType($types);
                    $param['past_results'] = $past;
                    break;                     
                default:
                    $data = $this->fetchAll();
                    break;     
            }
        }
        $param["results"] = $data;
        return view('frontend/home', $param);
    } 
    public function othersresultsindex($type = NULL){
        $uri = $this->getUri();
        $meta = $this->getMetaData($uri);
        $seo = $this->getSEOContent($uri);
        $ads = $this->getAdsLists();
        $headings = $this->getHeadingLists($uri);
        $param = ["region"=> 5, "meta" => $meta, "seo_content"=> $seo,"ads"=>$ads, "headings"=>$headings];
        if(!$type)
            $data = $this->fetchAll();
        else {
            switch ($type){
                case 'lmc':
                    $types = ["LMC1", "LMC"];
                    $data = $this->fetchByType($types);
                    $past = $this->fetchPastByType($types);
                    $param['past_results'] = $past;
                    break;  
                case 'mth':
                    $types = ["MTH"];
                    $data = $this->fetchByType($types);
                    $past = $this->fetchPastByType($types);
                    $param['past_results'] = $past;
                    break;                     
                default:
                    $data = $this->fetchAll();
                    break;     
            }
        }
        $param["results"] = $data;
        return view('frontend/home', $param);
    }     
    public function estimatedJackpotsIndex(){
        $types = ["M4D", "DMC4D","DMC6D", "TT"];
        $data = $this->fetchByType($types);
        $uri = $this->getUri();
        $meta = $this->getMetaData($uri);
        $seo = $this->getSEOContent($uri);
        $h1 = $this->getH1Title($uri);
        return view('frontend/home', ["region"=> "estimated-jackpots", "results"=>$data, "seo_content"=>$seo, "meta"=> $meta,"h1"=>$h1]);
    }
    public function apiEstimatedJackpots(){
        $types = ["M4D", "DMC4D","DMC6D", "TT"];
        $data = $this->fetchByType($types);
        return $this->response->setJSON($data);
    }
    public function specialDrawIndex(){
        $data = $this->settingModel->getSpecialDraw();
        $uri = $this->getUri();
        $meta = $this->getMetaData($uri);
        $seo = $this->getSEOContent($uri);
        $h1 = $this->getH1Title($uri);
        return view('frontend/home', ["region"=> "special-draw", "results"=>$data, "seo_content"=>$seo, "meta"=> $meta,"h1"=>$h1]);
    }    
    private function homepageRecentNews(){
        $model = new PostModel();
        $data['posts'] = $model->get_latest_posts_by_cat(6, 1);
        return $data;
    }   
    private function getMetaData($uri){
        return ($this->settingModel->getSiteMeta($uri));
    }  
    private function getSEOContent($uri){

        return ($this->settingModel->getSEOContent($uri));
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
