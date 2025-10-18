<?php
namespace App\Controllers;

use App\Models\NumberHistoryModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\SettingsModel;

class SearchController extends Controller {
    protected $historyResults;
    protected $settingModel;

    public function __construct() {
        $this->historyResults = new NumberHistoryModel();
        $this->settingModel = new SettingsModel();
    }

    public function index() {
        $uri = $this->getUri();
        $meta = $this->getMetaData($uri);
        $seo = $this->getSEOContent($uri);
        $h1 = $this->getH1Title($uri);
        return view('frontend/search',["type"=>0,"meta"=>$meta, "seo_content"=>$seo, "h1"=>$h1]);
    }
    public function numberIndex($number) {
        if(isset($number)){
            $results = $this->searchDatabase([$number]);
            $hit = json_decode($results[0]['top_hot'], true);
            $meta_desc = 
            "1ST:" . (isset($hit['1ST']) ? $hit['1ST'] : "0") .
            " 2ND:" . (isset($hit['2ND']) ? $hit['2ND'] : "0") .
            " 3RD:" . (isset($hit['3RD']) ? $hit['3RD'] : "0") .
            " SP:" . (isset($hit['SP']) ? $hit['SP'] : "0") .
            " CON:" . (isset($hit['CON']) ? $hit['CON'] : "0");   
            //var_dump($meta_desc);
     
        }
        $uri = $this->getUri();
        $meta = $this->getMetaData($uri);
        $seo = $this->getSEOContent($uri);
        $h1 = $this->getH1Title($uri);
                    
        // For initial data
        $results = $this->searchDatabase([$number]);
        $meanings = $results;//$this->removeDuplicateMeanings($results);
        $validOperators = ['magnum4d', 'damacai', 'sportstoto', 'singapore4d', 'cashsweep', 'sabah88', 'stc4d'];
        $data = $this->filterByUserOptions($results, $validOperators);

        $html_result = view('frontend/template_parts/history_number_content', ["number" => $number, "type"=>0, "results"=> $data, 'meanings'=>$meanings, "meta"=>$meta, "seo_content"=>$seo, "h1"=>$h1]);
        //var_dump($html_result);die();
        return view('frontend/search',["type"=>0,"meta"=>$meta, "seo_content"=>$seo, "h1"=>$h1, "number"=>$number, 'meta_desc'=>isset($meta_desc)?$meta_desc:'','result_html'=>$html_result]);
    }
    public function meaningIndex() {
        $uri = $this->getUri();
        $meta = $this->getMetaData($uri);
        $seo = $this->getSEOContent($uri);
        $h1 = $this->getH1Title($uri);
        return view('frontend/search',["type"=>1,"meta"=>$meta, "seo_content"=>$seo, "h1"=>$h1]);
    }
    public function wordIndex($word) {
        $str = str_replace("-"," ", $word);
        $uri = $this->getUri();
        $meta = $this->getMetaData($uri);
        $seo = $this->getSEOContent($uri);
        $h1 = $this->getH1Title($uri);
        // Check if input is numeric or string
        if (is_numeric($word)) {
            $numbers = [$word];
                //$numbers = $this->generatePermutations($number);
            // Fetch data from database for all permutations
            $meanings = $this->searchDatabase($numbers);
        } else {
            // Fetch data from database by meaning
            $meanings = $this->searchByMeaning($str);
        }
        
        $meta_desc ='';
        //if(is_array($meanings))
        foreach ($meanings as $meaning){
            $mns = json_decode($meaning['meaning'], true);
            foreach($mns as $mn){
                $meta_desc .= '-'. $mn['meaning'];
            }
        }
       
        $html_result = view('frontend/template_parts/history_number_content', ["number" => $word, "type"=>1, "results"=> '', 'meanings'=>$meanings, "meta"=>$meta, "seo_content"=>$seo, "h1"=>$h1]);
        return view('frontend/search',["type"=>1,"meta"=>$meta, "seo_content"=>$seo, "h1"=>$h1, 'word'=>$str, 'meta_desc'=>$meta_desc, 'result_html'=> $html_result]);
    }
    public function hotnumberIndex() {
        $uri = $this->getUri();
        $meta = $this->getMetaData($uri);
        $seo = $this->getSEOContent($uri);
        $h1 = $this->getH1Title($uri);
        $validOperators = ['magnum4d', 'damacai', 'sportstoto', 'singapore4d', 'cashsweep', 'sabah88', 'stc4d'];
        foreach ($validOperators as $operator){
            $data[$operator] = $this->historyResults->getTop15($operator);
        }
        return view('frontend/search',["type"=>2,"results"=>$data, "meta"=>$meta, "seo_content"=>$seo, "h1"=>$h1]);
    }
    /*
    * Fetch Number History
     - Type = 0: Number History
     - Type = 1: Number and Word meaning
    */

    public function fetchhistoryresultsIndex() {
        $request = service('request');
        $number = $request->getPost('number');
        $type = $request->getPost('type');
        $uri = $this->getUri();
        $meta = $this->getMetaData($uri);
        $seo = $this->getSEOContent($uri);
        $h1 = $this->getH1Title($uri);
        if($type == 0){
            $permutation = $request->getPost('permutation');
            $operators = $request->getPost('operators'); // array of operators
            $ops=[];
            foreach( $operators as $key=>$op){
                if($op == "true"){
                    $ops[] =  $key;
                }
            }
            //var_dump($permutation);exit();
            // Nếu Permutation được bật, tạo ra tất cả các hoán vị của số 4D
            if (strtolower($permutation) === 'on') {
                $numbers = $this->generatePermutations($number);
            } else {
                $numbers = [$number];
            }
            // Thực hiện truy vấn tìm kiếm với danh sách số
            $results = $this->searchDatabase($numbers);
            // Process results to remove duplicate meanings by number
            $meanings = $results;//$this->removeDuplicateMeanings($results);

            $data = $this->filterByUserOptions($results, $ops);

            return view('frontend/template_parts/history_number_content', ["number" => $number, "type" => $type, "results"=> $data, 'meanings'=>$meanings, "meta"=>$meta, "seo_content"=>$seo, "h1"=>$h1]);
        }
        if($type == 1){
            // Check if input is numeric or string
            if (is_numeric($number)) {
                $numbers = [$number];
                    //$numbers = $this->generatePermutations($number);
                // Fetch data from database for all permutations
                $meanings = $this->searchDatabase($numbers);
            } else {
                // Fetch data from database by meaning
                $meanings = $this->searchByMeaning($number);
            }
            return view('frontend/template_parts/history_number_content', ["number" => $number, "type"=>$type, "results"=> '', 'meanings'=>$meanings, "meta"=>$meta, "seo_content"=>$seo, "h1"=>$h1]);
        }
    }
    /*
    * Mobile API Number History
    */

    public function apiNumberHistory() {
        $request = service('request');
        $number = $request->getPost('number');
        $permutation = $request->getPost('permutation');
        $operators = $request->getPost('operators'); // array of operators
        $ops=[];
        $operators = explode(",", $operators);
        foreach( $operators as $key=>$op){
                $ops[] =  $op;
        }
            //var_dump($permutation);exit();
            // Nếu Permutation được bật, tạo ra tất cả các hoán vị của số 4D
        if (strtolower($permutation) === 'on') {
            $numbers = $this->generatePermutations($number);
        } else {
            $numbers = [$number];
        }
        // Thực hiện truy vấn tìm kiếm với danh sách số
        $results = $this->searchDatabase($numbers);
            // Process results to remove duplicate meanings by number
        $meanings = $results;//$this->removeDuplicateMeanings($results);

        $data = $this->filterByUserOptions($results, $ops);
        $respone = $data;
        return $this->response->setJSON($respone);
    }
    /*
    * Mobile Hot Number API
    */

    public function apiHotNumbers() {
        $validOperators = ['magnum4d', 'damacai', 'sportstoto', 'singapore4d', 'cashsweep', 'sabah88', 'stc4d'];
        foreach ($validOperators as $operator){
            $data[$operator] = $this->historyResults->getTop15($operator);
        }
        return $this->response->setJSON($data);
    }
    /*
    * 4D Dictionary Mobile API
    */
    public function api4DDictionary($word) {
        $str = str_replace("-"," ", $word);
        // Check if input is numeric or string
        if (is_numeric($word)) {
            $numbers = [$word];
                //$numbers = $this->generatePermutations($number);
            // Fetch data from database for all permutations
            $meanings = $this->searchDatabase($numbers);
        } else {
            // Fetch data from database by meaning
            $meanings = $this->searchByMeaning($str);
        }
        //$data = ["word"=>$word, "meaning"=>$meanings];
        return $this->response->setJSON($meanings);
    }
    // Hàm tạo ra tất cả các hoán vị của một số
    private function generatePermutations($number) {
        $permutations = [];
        $digits = str_split($number);
        $this->permute($digits, 0, count($digits) - 1, $permutations);
        
        // Thêm số gốc vào đầu mảng hoán vị
        array_unshift($permutations, $number);
        
        return array_unique($permutations);
    }

    // Hàm hỗ trợ để tạo ra các hoán vị của một mảng
    private function permute(&$items, $left, $right, &$permutations) {
        if ($left == $right) {
            $permutations[] = implode('', $items);
        } else {
            for ($i = $left; $i <= $right; $i++) {
                $this->swap($items, $left, $i);
                $this->permute($items, $left + 1, $right, $permutations);
                $this->swap($items, $left, $i); // Hoàn nguyên hoán đổi
            }
        }
    }

    // Hàm hoán đổi hai phần tử trong một mảng
    private function swap(&$items, $i, $j) {
        $temp = $items[$i];
        $items[$i] = $items[$j];
        $items[$j] = $temp;
    }

    // Hàm tìm kiếm trong cơ sở dữ liệu
    private function searchDatabase($numbers) {
        return $this->historyResults->getResultsByNumbers($numbers);
    }
    private function searchByMeaning($meaning)
    {
        return $this->historyResults->getResultsByMeaning($meaning);
    }
    private function filterByUserOptions($results, $operators)
    {
        $uniqueResults = [];

        foreach ($results as $result) {
            $data = json_decode($result['data'], true);
            $filteredData = $this->filterByOperators($data, $operators);

            if (!empty($filteredData)) {
                $result['data'] = json_encode($filteredData);
                $uniqueResults[] = $result;
            }
        }

        return $uniqueResults;
    }
    private function filterByOperators($data, $operators)
    {
        return array_filter($data, function ($entry) use ($operators) {
            return in_array($entry['type'], $operators);
        });
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
