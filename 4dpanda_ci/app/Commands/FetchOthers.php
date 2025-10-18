<?php

namespace App\Commands;

use App\Models\LotteryModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class FetchOthers extends BaseCommand
{
    protected $group       = 'Lottery';
    protected $name        = 'lottery:fetchothers';
    protected $description = 'Fetch and store lottery data';

    public function run(array $params){
        $type = $params[0] ?? null;
        $time = $params[1] ?? null;
        switch ($type){
            // Lotto Macao
            case 'LMC':
                if($time == '19:30:00')
                    $this->fetchLotoMacaoData();
                else 
                    $this->fetchLotoMacaoData1();
                break;
            //Matahari
            case 'MTH':
                $this->fetchMatahariData();
                break;
            // Diriwan 4D, 3D, Lotto 19:00
            case 'SB':
                $this->fetchSabahData();
                break;
            // Good 4D 6D 15:30
            case 'GO4D6D1':
                $this->fetchGoodData330();
                break;
            // Good 4D 6D 19:30
            case 'GO4D6D2':
                break;
            default:
                break;
        }
        
    }
    private function fetchLotoMacaoData()
    {
        $lotteryModel = new LotteryModel();
        $url = "https://melon3333.com/api/results";
        $json = file_get_contents($url);
        $data = json_decode($json, true);

        $lotteryData = [];
        if ($data) {
            $drawDate = $data["results"]['date'];
            $lotteryData["S_T"] = "19:30:00";
            $lotteryData["DD"] = date("d-m-Y (D)", strtotime($drawDate));
            $lotteryData["DN"] = "";
            for ($i = 1; $i < 14; $i++){
                $lotteryData["S$i"] = $data["results"]["spec$i"];
                $map[$data["results"]["spec$i"]] = "S$i";
            }
            for ($i = 1; $i < 11; $i++){
                $lotteryData["C$i"] = $data["results"]["cons$i"];
                $map[$data["results"]["spec$i"]] = "C$i";
            }
            if($lotteryData["P3"] = $data["results"]["priz3"]){
                $lotteryData[$map[$lotteryData["P3"]]] = '----';
            }
            if($lotteryData["P2"] = $data["results"]["priz2"]){
                $lotteryData[$map[$lotteryData["P2"]]] = '----';
            }
            if($lotteryData["P1"] = $data["results"]["priz1"]){
                $lotteryData[$map[$lotteryData["P1"]]] = '----';
            }

            $lotteryData['COMPLETED4D'] = $data['live']?0:1;
            $key = 'LMC';
            $lottery_data = [
                'date' => $drawDate,
                'data' => json_encode($lotteryData),
                'type' => $key,
                'name' => 'Lotto Macao',
                'display_name' => 'Lotto Macao 19:30:00',
                'draw_start' => !$lotteryData['COMPLETED4D'],
                'draw_end' => $lotteryData['COMPLETED4D'],
                'ds' => !$lotteryData['COMPLETED4D'],
                'df' => $lotteryData['COMPLETED4D'],
                'notes' => 'Note'
            ];
            // Kiểm tra xem dữ liệu đã tồn tại chưa
            $existing_data = $lotteryModel->getLotteryDataByDateAndType($drawDate, $key);
            if ($existing_data) {
                // Cập nhật dữ liệu
                $lotteryModel->updateLotteryData($drawDate, $key, $lottery_data);
                CLI::write("Data updated for $key on $drawDate.", 'yellow');
            } else {
                // Chèn dữ liệu mới
                $lotteryModel->insertLotteryData($lottery_data);
                CLI::write("Data inserted for $key on $drawDate.", 'green');
            }
        } else {
            CLI::error("Failed to fetch data.");
        }
    }
    // Draw Time :15:30:00
    private function fetchLotoMacaoData1()
    {
        $lotteryModel = new LotteryModel();
        $url = "https://msystem8.com/lotteryResult.txt";
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        //var_dump($data);exit();
        $lotteryData = [];
        $alphaData = [];
        $map = [];
        if ($data) {
            $drawDate = $data['date'];
            $lotteryData["S_T"] = "15:30:00";
            $lotteryData["DD"] = date("d-m-Y (D)", strtotime($drawDate));
            $lotteryData["DN"] = "";
            $j = 0;
            for ($i = 0; $i < 13; $i++){
                $j++;
                $lotteryData["S$j"] = $data["fourD"]["sequences"][$i]["number"];
                $alphaData[$data["fourD"]["sequences"][$i]["id"]] = $lotteryData["S$j"];
                $map[$data["fourD"]["sequences"][$i]["id"]] = "S$j";
            }
            $j = 0;
            for ($i = 13; $i < 23; $i++){
                $j++;
                $lotteryData["C$j"] = $data["fourD"]["sequences"][$i]["number"];
                $alphaData[$data["fourD"]["sequences"][$i]["id"]] = $lotteryData["C$j"];
                $map[$data["fourD"]["sequences"][$i]["id"]] = "C$j";
            }

            if($data["fourD"]["thirdPrize"]){
                $lotteryData["P3"] = $alphaData[$data["fourD"]["thirdPrize"]];
                $lotteryData[$map[$data["fourD"]["thirdPrize"]]] = "----";
            }
            else {
                $lotteryData["P3"]="----";
            }
            if($data["fourD"]["secondPrize"]){
                $lotteryData["P2"] = $alphaData[$data["fourD"]["secondPrize"]];
                $lotteryData[$map[$data["fourD"]["secondPrize"]]] = "----";
            }
            else {
                $lotteryData["P2"]="----";
            }

            if($data["fourD"]["firstPrize"]){
                $lotteryData["P1"] = $alphaData[$data["fourD"]["firstPrize"]];
                $lotteryData[$map[$data["fourD"]["firstPrize"]]] = "----";
            }
            else {
                $lotteryData["P1"]="----";
            }

            $lotteryData['COMPLETED4D'] = ($lotteryData["P1"]=="----")?0:1;

            $key = 'LMC1'; // 15:30:00
            $lottery_data = [
                'date' => $drawDate,
                'data' => json_encode($lotteryData),
                'type' => $key,
                'name' => 'Lotto Macao',
                'display_name' => 'Lotto Macao 15:30:00',
                'draw_start' => !$lotteryData['COMPLETED4D'],
                'draw_end' => $lotteryData['COMPLETED4D'],
                'ds' => !$lotteryData['COMPLETED4D'],
                'df' => $lotteryData['COMPLETED4D'],
                'notes' => 'Note'
            ];
            // Kiểm tra xem dữ liệu đã tồn tại chưa
            $existing_data = $lotteryModel->getLotteryDataByDateAndType($drawDate, $key);
            if ($existing_data) {
                // Cập nhật dữ liệu
                $lotteryModel->updateLotteryData($drawDate, $key, $lottery_data);
                CLI::write("Data updated for $key on $drawDate.", 'yellow');
            } else {
                // Chèn dữ liệu mới
                $lotteryModel->insertLotteryData($lottery_data);
                CLI::write("Data inserted for $key on $drawDate.", 'green');
            }
        } else {
            CLI::error("Failed to fetch data.");
        }
    }  
    /*
    ** Fetch Matahari 20:30 (GMT+8)
    */
    private function fetchMatahariData()
    {
        $lotteryModel = new LotteryModel();
        $url = "https://matahari.me/api/results";
        $json = file_get_contents($url);
        $data = json_decode($json, true);

        $lotteryData = [];
        $map =[];
        if ($data) {
            $drawDate = $data["results"]['date'];
            $lotteryData["S_T"] = "20:30:00";
            $lotteryData["DD"] = date("d-m-Y (D)", strtotime($drawDate));
            $lotteryData["DN"] = "";
            for ($i = 1; $i < 14; $i++){
                $lotteryData["S$i"] = $data["results"]["spec$i"];
                $map[$data["results"]["spec$i"]] = "S$i";
            }
            for ($i = 1; $i < 11; $i++){
                $lotteryData["C$i"] = $data["results"]["cons$i"];
                $map[$data["results"]["cons$i"]] = "C$i";
            }
            if($lotteryData["P3"] = $data["results"]["priz3"]){
                $lotteryData[$map[$lotteryData["P3"]]] = '----';
            }
            if($lotteryData["P2"] = $data["results"]["priz2"]){
                $lotteryData[$map[$lotteryData["P2"]]] = '----';
            }
            if($lotteryData["P1"] = $data["results"]["priz1"]){
                $lotteryData[$map[$lotteryData["P1"]]] = '----';
            }

            $lotteryData['COMPLETED4D'] = $data['live']?0:1;
            $key = 'MTH';
            $lottery_data = [
                'date' => $drawDate,
                'data' => json_encode($lotteryData),
                'type' => $key,
                'name' => 'Matahari',
                'display_name' => 'Matahari 20:30:00',
                'draw_start' => !$lotteryData['COMPLETED4D'],
                'draw_end' => $lotteryData['COMPLETED4D'],
                'ds' => !$lotteryData['COMPLETED4D'],
                'df' => $lotteryData['COMPLETED4D'],
                'notes' => 'Note'
            ];
            // Kiểm tra xem dữ liệu đã tồn tại chưa
            $existing_data = $lotteryModel->getLotteryDataByDateAndType($drawDate, $key);
            if ($existing_data) {
                // Cập nhật dữ liệu
                $lotteryModel->updateLotteryData($drawDate, $key, $lottery_data);
                CLI::write("Data updated for $key on $drawDate.", 'yellow');
            } else {
                // Chèn dữ liệu mới
                $lotteryModel->insertLotteryData($lottery_data);
                CLI::write("Data inserted for $key on $drawDate.", 'green');
            }
        } else {
            CLI::error("Failed to fetch data.");
        }
    }

    /*
    ** Fetch Good 4D 6D Data 3:30
    **
    */
    private function fetchGoodData330(){
        $lotteryModel = new LotteryModel();

        $url = "https://good4d.net/en/home";
        // Khởi tạo Guzzle client
        $client = new Client();
        // Gửi yêu cầu và nhận nội dung HTML
        $response = $client->request('GET', $url);
        $html = (string) $response->getBody();
        // Khởi tạo Crawler
        var_dump($html);exit();
        $crawler = new Crawler($html);
        if($crawler){
            $dict=[];
            $lotteryData=[];
            for ($i = 0; $i < 13; $i++){
                $j = $i+1;
                //$dict["S$j"] = "aG_P$i";
                $lotteryData["S$j"] = $crawler->filter("#aG_P$i")->text();
            }
            for ($i = 0; $i < 10; $i++){
                $j = $i+1;
                //$dict["C$j"] = "aG_C$i";
                $lotteryData["C$j"] = $crawler->filter("#aG_C$i")->text();
            }
            var_dump($lotteryData);exit();
        } else {
            CLI::error("Failed to fetch data.");
        }
    }

    /*
    ** Fetch Sabah 4D & Lotto 18:00:00
    **
    */
    private function fetchSabahData(){
        $lotteryModel = new LotteryModel();

        $url = "http://www.diriwan88.com/app88/live/V5Middle.asp";
        // Khởi tạo Guzzle client
        $client = new Client();
        // Gửi yêu cầu và nhận nội dung HTML
        $response = $client->request('GET', $url);
        if($response){
            $html = (string) $response->getBody();
            $results = [];
            // Mẫu regex để tách các giá trị từ đoạn script
            if (preg_match_all("/parent\.S\(([^,]+),\s*'([^']+)'\)/", $html, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $key = trim($match[1], "'");
                    $value = $match[2];
                    $results[$key] = $value;
                }
            }
            if (preg_match_all("/parent\.R\(([^,]+),\s*'([^']+)'\)/", $html, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $key = trim($match[1], "'");
                    $value = $match[2];
                    $results[$key] = $value;
                }
            }
            //var_dump($results);
            $fourD = [];
            $fourD["S_T"] = "18:00:00";
            $fourD["DD"] = $drawDate = isset($results['DRAWDATE'])?$results['DRAWDATE']:'';
            if($drawDate == '&nbsp;' || $drawDate =='') exit();
            $fourD["DN"] = $results['DRAWNO'];
            // CONSOLATION PRIZES
            for ($i = 1; $i< 11; $i++){
                $fourD["C$i"] = $results["C$i"."_1"].$results["C$i"."_2"].$results["C$i"."_3"].$results["C$i"."_4"];
            }
            // SPECIAL PRIZES
            for ($i = 1; $i< 14; $i++){
                $fourD["S$i"] = $results["D$i"."_1"].$results["D$i"."_2"].$results["D$i"."_3"].$results["D$i"."_4"];
            }
             // PRIZES
             for ($i = 1; $i< 4; $i++){
                $fourD["P$i"] = $results["P$i"."_1"].$results["P$i"."_2"].$results["P$i"."_3"].$results["P$i"."_4"];
            }
             // 3D PRIZES
            for ($i = 1; $i< 4; $i++){
                $fourD["P$i"."3D"] = $results["Q$i"."_1"].$results["Q$i"."_2"].$results["Q$i"."_3"];
            }
            $fourD['JP1'] = "RM ". $results['V1'];
            $fourD['JP2'] = "RM ". $results['V2'];
            $fourD["COMPLETE4D"] = $fourD["JP1"]?1:0;

            $sbltData = [];
            $sbltData["DD"] = $results['DRAWDATE'];
            $sbltData["DN"] = $results['DRAWNO'];
            $sbltData["S_T"] = "18:00:00";
            for ($i=1; $i< 8 ;$i++){
                $sbltData["LT$i"] = $results["L$i"];
            }
            $sbltData["LTJP1"] = "RM ". $results["J1"];
            $sbltData["LTJP2"] = "RM ". $results["J2"];

            //Lotto 5
            for ($i = 1; $i < 9; $i++){
                for ($j = 1; $j< 6; $j++ ){
                    $sbltData["LT5G$i$j"] = $results["L5G$i$j"];
                }
            }
            //Lotto 5 Jackpot
            for ($i = 1; $i < 9; $i++){
                $sbltData["LT5G$i"."JP"] = "RM ". $results["L5G$i"."J1"];
            }
            //Lotto 6   
            for ($i = 1; $i < 6; $i++){
                for ($j = 1; $j< 7; $j++ ){
                    $sbltData["LT6G$i$j"] = $results["L6G$i$j"];
                }
            }
            //Lotto 6 Jackpot
            for ($i = 1; $i < 6; $i++){
                $sbltData["LT6G$i"."JP"] = "RM ". $results["L6G$i"."J1"];
            }
            $sbltData["COMPLETELOTTO"] = $results["L5G1J1"]?1:0;

            $date = \DateTime::createFromFormat('d-M-Y', $drawDate);
            // Chuyển đổi sang định dạng Y-m-d
            $drawDate = $date->format('Y-m-d');
            //print_r($sbltData); exit();
            $key = "SB";
            $lottery_data = [
                'date' => $drawDate,
                'data' => json_encode($fourD),
                'type' => $key,
                'name' => 'Sabah',
                'display_name' => 'Sabah 4D 19:00',
                'draw_start' => !$fourD["COMPLETE4D"],
                'draw_end' => $fourD["COMPLETE4D"],
                'ds' => !$fourD["COMPLETE4D"],
                'df' => $fourD["COMPLETE4D"],
                'notes' => 'Note'
            ];
            // Kiểm tra xem dữ liệu đã tồn tại chưa
            $existing_data = $lotteryModel->getLotteryDataByDateAndType($drawDate, $key);
            if ($existing_data) {
                $lotteryModel->updateLotteryData($drawDate, $key, $lottery_data);
                CLI::write("Data updated for $key on $drawDate.", 'yellow');
            } else {
                $lotteryModel->insertLotteryData($lottery_data);
                CLI::write("Data inserted for $key on $drawDate.", 'green');
            }

            $key = "SBLT";
            $lottery_data = [
                'date' => $drawDate,
                'data' => json_encode($sbltData),
                'type' => $key,
                'name' => 'Sabah Lotto 19:00',
                'dipslay_name' => 'Sabah Lotto 19:00',
                'notes' => 'Note'
            ];
            // Kiểm tra xem dữ liệu đã tồn tại chưa
            $existing_data = $lotteryModel->getLotteryDataByDateAndType($drawDate, $key);
            if ($existing_data) {
                // Cập nhật dữ liệu
                $lotteryModel->updateLotteryData($drawDate, $key, $lottery_data);
                CLI::write("Data updated for $key on $drawDate.", 'yellow');
            } else {
                // Chèn dữ liệu mới
                $lotteryModel->insertLotteryData($lottery_data);
                CLI::write("Data inserted for $key on $drawDate.", 'green');
            }

        } else {
            CLI::error("Failed to fetch data.");
        }
    }
    private function formatDate($dateString)
    {
        $dateParts = explode('-', $dateString);
        $day = $dateParts[0];
        $month = $dateParts[1];
        $yearAndWeekday = explode(' ', $dateParts[2]);
        $year = $yearAndWeekday[0];

        return "$year-$month-$day"; // Định dạng YYYY-MM-DD
    }

    private function getLotteryName($type)
    {
        // Hàm này trả về tên loại xổ số dựa trên loại
        $names = [
            'M' => 'Magnum 4D',
            'D' => 'Damacai 4D',
            'D3' => 'Damacai 3D',
            'DMC4D' => 'Damacai 4D',
            'DMC6D' => 'Damacai 6D',
            'T' => 'Toto 4D',
            'TT' => 'Toto 4D 5D 6D',
            'S' => 'Singapore 4D',
            'ST' => 'Singapore Toto',
            'SB' => 'Sabah 4D',
            'SBLT' => 'Sabah Lotto',
            'SW' => 'Sandakan 4D',
            'SCS' => 'Special Cash Sweep',
            'SGT' => 'Singapore Grand Toto',
            'MJG' => 'Magnum Gold',
            'G' => 'Grand Lotto',
            'H' => 'Horse Racing',
            'H4D6D1' => 'Lucky Hari Hari 15:30:00',
            'H4D6D2' => 'Lucky Hari Hari 19:30:00',
            'P' => 'Perdana 4D',
            'P4D1' => 'Perdana 4D 6D 15:30',
            'P4D2' => 'Perdana 4D 6D 19:30'
        ];

        return isset($names[$type]) ? $names[$type] : 'Unknown';
    }

    private function generateNotes($value)
    {
        // Hàm này tạo ghi chú dựa trên dữ liệu xổ số
        return 'Notes for lottery on ' . $value['DD'];
    }
}
