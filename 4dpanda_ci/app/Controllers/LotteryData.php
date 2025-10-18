<?php

namespace App\Controllers;

use App\Models\LotteryModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\SettingsModel;

class LotteryData extends Controller
{
    public function __construct()
    {
        $this->settingModel = new SettingsModel();
    }
    public function fetchAll()
    {
        // ============================================
        // TEMPORARY: Return sample data for testing
        // TODO: Remove this and uncomment database code below
        // ============================================
        
        $sampleData = [
            '_test_info' => [
                'server' => '4dpanda.com',
                'database' => '4dpanda_db',
                'mode' => 'SAMPLE_DATA',
                'timestamp' => date('Y-m-d H:i:s'),
                'message' => 'This is SAMPLE data from 4dpanda.com server for testing'
            ],
            'M4D' => [
                'C1' => '2417',
                'C2' => '4254',
                'P1' => '3290',
                'P2' => '2834',
                'P3' => '7976',
                'DD' => date('d-m-Y') . ' (Sample)',
                'S_T' => '19:00:00',
                'COMPLETE4D' => 1
            ],
            'DMC4D' => [
                'P1' => '6065',
                'P2' => '1114',
                'P3' => '2484',
                'DD' => date('d-m-Y') . ' (Sample)',
                'S_T' => '19:00:00',
                'COMPLETE4D' => 1
            ],
            'TT' => [
                'P1' => '3687',
                'P2' => '6722',
                'P3' => '3794',
                'DD' => date('d-m-Y') . ' (Sample)',
                'S_T' => '19:00:00',
                'COMPLETE4D' => 1
            ]
        ];
        
        return $this->response->setJSON($sampleData);
        
        /* ============================================
         * ORIGINAL DATABASE CODE (COMMENTED OUT)
         * Uncomment this when ready to use real data
         * ============================================
        
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
            //'MJG' => 'Magnum Gold',
            'M4DJG' => 'Magnum 4D Jackpot Gold',//MP
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
        //$respone['COUNT'] = 0;
        foreach ($names as $type=> $value){
            $data[$type] = $model->getLotteryDataByType($type);
            $respone[$type] = json_decode($data[$type]['data'], true);
            //$respone['COUNT'] += count($respone); // Count data 
        }
        //var_dump($respone);
        //return view('frontend/home');//, $data);
        return $this->response->setJSON($respone);
        
        ============================================ */
    }
    public function past_results_index()
    {
        $uri = $this->getUri();
        $meta = $this->getMetaData($uri);
        $seo = $this->getSEOContent($uri);
        $ads = $this->getAdsLists();
        $headings = $this->getHeadingLists($uri);
        $h1 = $this->getH1Title($uri);
        return view('frontend/past_results_page',["meta" => $meta, "seo_content"=>$seo,"ads" => $ads, "headings" => $headings, "h1" => $h1]);
    }
    public function past_results_by_date($date)
    {
        // Kiểm tra định dạng ngày hợp lệ
        if (!$this->validateDate($date)) {
            // Nếu ngày không hợp lệ, chuyển hướng đến trang lỗi hoặc trang mặc định
            return redirect()->to('/past-results/');
        }
        $_date = date('Y-m-d', strtotime($date));
        $uri = $this->getUri();
        //$uri = str_replace("-$date","",$uri);
        $meta['title'] = $date." 4D Results | Keputusan Lepas 4D | 4D Panda";
        $meta['description'] = "Check 4D past results for all Malaysia, Singapore, and Cambodia results on ".date('d-m-Y, l',strtotime($date)).". Magnum, Damacai, Toto, Singapore 4D, GD Lotto 4D, 9 Lotto and more.";
        $seo = $this->getSEOContent(str_replace("-$date","",$uri));
        $ads = $this->getAdsLists();
        $headings = $this->getHeadingLists($uri);
        $h1['option_value'] = date('d-m-Y, l',strtotime($date)) . ' - 4D Results';
        $canonical = base_url();
        if ($_date) {
            // Get the selected date from POST data

            // Perform your logic to fetch results based on $selectedDate
            // For demonstration, assume fetching results from a model or database
            $model = new LotteryModel();
            $results = $model->getLotteryDataByDate($_date);
            $uri = $this->getUri();
            $ads = $this->getAdsLists();
            $headings = $this->getHeadingLists($uri);
            //var_dump($headings);var_dump($uri);
            if(!$results) $data = null;
            else {
                foreach ($results as $value){
                    //var_dump($value['type']);
                    $data[$value['type']] = json_decode($value['data'], true);
                    //$data[$value['type']]['COUNT'] = count($data[$value['type']]);
                }
            }
            //var_dump(json_encode($data));
            // Load a view file to display results

            $view = view('frontend/template_parts/past_results_content', ['selected_date'=>$date, "past_results"=>true, "results"=> json_encode($data), "region"=> 100,"ads"=>$ads, "headings"=>$headings]);
            $canonical .='past-results/'.$date;
        } else {
            $view = null; // Handle non-AJAX requests
        }
        return view('frontend/past_results_page',["meta" => $meta, "seo_content"=>$seo,"ads" => $ads, "headings" => $headings, "h1" => $h1, 'canonical' => $canonical, 'view'=>$view]);
    }
    public function fetch_past_results() {
        // Check if the request is an AJAX request
        // Sử dụng service request của CodeIgniter 4
        $request = service('request');

        // Lấy ngày từ yêu cầu POST
        $date = $request->getPost('date');
        if ($date) {
            // Get the selected date from POST data

            // Perform your logic to fetch results based on $selectedDate
            // For demonstration, assume fetching results from a model or database
            $model = new LotteryModel();
            $results = $model->getLotteryDataByDate($date);
            $uri = $this->getUri();
            $ads = $this->getAdsLists();
            $headings = $this->getHeadingLists($uri);
            //var_dump($headings);var_dump($uri);
            if(!$results) return;
            foreach ($results as $value){
                //var_dump($value['type']);
                $data[$value['type']] = json_decode($value['data'], true);
                //$data[$value['type']]['COUNT'] = count($data[$value['type']]);
            }
            //var_dump(json_encode($data));
            // Load a view file to display results

            return view('frontend/template_parts/past_results_content', ["past_results"=>true, "results"=> json_encode($data), "region"=> 100,"ads"=>$ads, "headings"=>$headings]);
        } else {
            return "No Result"; // Handle non-AJAX requests
        }
    }  
    /*
    * Get Date for Lottery
    */
    public function getDates(){
        $model = new LotteryModel();
        $names = [
            'M4D' => 'Magnum 4D', 
            'DMC4D' => 'Damacai 1+3D',
            'DMC6D' => 'Damacai 3+3D', 
            'TT' => 'Toto 4D 5D 6D', 
            'STC' => 'Sandakan 4D',
            'SB' => 'Sabah 4D',
            'SBLT' => 'Sabah Lotto',
            'SCS' => 'Special Cash Sweep', 
            'SGP4D' => 'Singapore Pools 4D', 
            'SGPTT' => 'Singapore Pools Toto', 
            'M4DJG' => 'Magnum 4D Jackpot Gold',
            'GD' => 'Grand Lotto', 
            'H4D6D1' => 'Lucky Hari Hari 4D 15:30', 
            'H4D6D2' => 'Lucky Hari Hari 4D 19:30',
            'P4D2' => 'Perdana 4D 19:30:00', 
            'P4D1' => 'Perdana 4D 15:30:00', 
            'LMC' => 'Lottery Macao 19:30:00', 
            'LMC1' => 'Lottery Macao 15:30:00', 
            'MTH'   => 'Matahari 20:30:00', 
            'NLT' => '9 Loto 19:30:00', 
        ];
        foreach ($names as $type=> $value){
            $data[$type] = $model->getLotteryDateByType($type);
        }
        return $this->response->setJSON($data);
    }
       /*
    * Get Date for Lottery by Month, Year
    * Date format: Month-Year: 2024-08
    */
    public function getDatesByMonthYear($date){
        $model = new LotteryModel();
        $names = [
            'M4D' => 'Magnum 4D', 
            'DMC4D' => 'Damacai 1+3D',
            'DMC6D' => 'Damacai 3+3D', 
            'TT' => 'Toto 4D 5D 6D', 
            'STC' => 'Sandakan 4D',
            'SB' => 'Sabah 4D',
            'SBLT' => 'Sabah Lotto',
            'SCS' => 'Special Cash Sweep', 
            'SGP4D' => 'Singapore Pools 4D', 
            'SGPTT' => 'Singapore Pools Toto', 
            'M4DJG' => 'Magnum 4D Jackpot Gold',
            'GD' => 'Grand Lotto', 
            'H4D6D1' => 'Lucky Hari Hari 4D 15:30', 
            'H4D6D2' => 'Lucky Hari Hari 4D 19:30',
            'P4D2' => 'Perdana 4D 19:30:00', 
            'P4D1' => 'Perdana 4D 15:30:00', 
            'LMC' => 'Lottery Macao 19:30:00', 
            'LMC1' => 'Lottery Macao 15:30:00', 
            'MTH'   => 'Matahari 20:30:00', 
            'NLT' => '9 Loto 19:30:00', 
        ];
        foreach ($names as $type=> $value){
            $data[$type] = $model->getLotteryDateByTypeDate($type, $date);
        }
        return $this->response->setJSON($data);
    }
    /*
    ** Get Lottery by Date
    */
    public function getLotteryByDate($date){
        $model = new LotteryModel();
        $results = $model->getLotteryDataByDate($date);
        if(!$results) return;
        foreach ($results as $value){
            $data[$value['type']] = json_decode($value['data'], true);
        }
        return $this->response->setJSON($data);
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
    private function validateDate($date, $format = 'd-m-Y')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}
?>
