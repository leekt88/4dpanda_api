<?php

namespace App\Commands;

use App\Models\LotteryModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class FetchMagnum extends BaseCommand
{
    protected $group       = 'Lottery';
    protected $name        = 'lottery:magnum';
    protected $description = 'Fetch and store lottery Magnum data';

    public function run(array $params){
        // $type will be: M4D and 
        $type = $params[0] ?? null;
        $time = $params[1] ?? null;
        $this->fetchMagnumData($type);
        
    }
    private function fetchMagnumData($type)
    {
        $lotteryModel = new LotteryModel();
        $url = "https://magnum4d-ep02.azureedge.net/public/HomePageData.js";
        $json = file_get_contents($url);
        $json = str_replace("var HomePageData = ", "", $json);
        $data = json_decode($json, true);
        //{"C1": "4346", "C2": "5234", "C3": "1466", "C4": "7836", "C5": "9696", "C6": "2336", "C7": "3241", "C8": "1143", "C9": "8067", "DD": "30-06-2024 (Sun)", "DN": "060/24", "L1": "05", "L2": "08", "L3": "10", "L4": "16", "L5": "21", "L6": "24", "L7": "32", "L8": "33", "P1": "8669", "P2": "1371", "P3": "8217", "S1": "6546", "S2": "1251", "S3": "5237", "S4": "8432", "S5": "2056", "S6": "----", "S7": "3001", "S8": "6931", "S9": "9562", "C10": "4206", "JP1": "RM 18,291,424.63", "JP2": "RM 263,397.86", "LB1": "14", "LB2": "22", "PB1": "", "PB2": "", "S10": "----", "S11": "----", "S12": "9700", "S13": "2094", "ESTJP1": "RM 2,605,000", "ESTJP2": "RM 110,000", "JP1WON": "1.0085470085", "JP2WON": "2.2092875022", "COMPLETE4D": "1", "COMPLETELIFE": "1"}
        $dict = [
            "A" => "S01",
            "B" => "S02",
            "C" => "S03",
            "D" => "S04",
            "E" => "S05",
            "F" => "S06",
            "G" => "S07",
            "H" => "S08",
            "I" => "S09",
            "J" => "S10",
            "K" => "S11",
            "L" => "S12",
            "M" => "S13",
            "O" => "C01",
            "P" => "C02",
            "Q" => "C03",
            "R" => "C04",
            "S" => "C05",
            "T" => "C06",
            "U" => "C07",
            "V" => "C08",
            "W" => "C09",
            "X" => "C10"
        ];
        if ($data["Data"]) {
            $magnumData = [];
            $tpn ='';
            if($data["Data"]['Results']["T3"]){
                $magnumData["P3"] = $data["Data"]['Results'][$dict[$data["Data"]['Results']["T3"]]];
                $data["Data"]['Results'][$dict[$data["Data"]['Results']["T3"]]] = "----";
                $tpn = $magnumData["P3"];
            }
            else {
                $magnumData["P3"] = "----";
            }
            $spn =''; 
            if($data["Data"]['Results']["T2"]){
                $magnumData["P2"] = $data["Data"]['Results'][$dict[$data["Data"]['Results']["T2"]]];
                $data["Data"]['Results'][$dict[$data["Data"]['Results']["T2"]]] = "----";
                $spn = $magnumData["P2"];
            }
            else {
                $magnumData["P2"] = "----";
            }
            $fpn ='';
            if($data["Data"]['Results']["T1"]){
                $magnumData["P1"] = $data["Data"]['Results'][$dict[$data["Data"]['Results']["T1"]]];
                $data["Data"]['Results'][$dict[$data["Data"]['Results']["T1"]]] = "----";
                $fpn = $magnumData["P1"];
            }
            else {
                $magnumData["P1"] = "----";
            }
            for ($i = 1; $i < 11; $i++){
                $j = sprintf("%02d", $i);
                $magnumData["C$i"] = $data["Data"]["Results"]["C$j"]?$data["Data"]["Results"]["C$j"]:"----";
            }
            for ($i = 1; $i < 14; $i++){
                $j = sprintf("%02d", $i);
                $magnumData["S$i"] = $data["Data"]["Results"]["S$j"]?$data["Data"]["Results"]["S$j"]:"----";
            }
            for ($i = 1; $i < 9; $i++){
                $magnumData["L$i"] = $data["Data"]["Results"]["LifeNum$i"]?$data["Data"]["Results"]["LifeNum$i"]:"--";
            }
            $magnumData["LB1"] = $data["Data"]["Results"]["LifeBonusNum1"];
            $magnumData["LB2"] = $data["Data"]["Results"]["LifeBonusNum2"];
            $date = explode("/", $data["Data"]["Results"]["DrawDate"]);
            $drawDate = $date[2] ."-".$date[1]."-".$date[0];
            $magnumData["S_T"] = "19:00:00";
            $magnumData["DD"] = date("d-m-Y (D)", strtotime($drawDate));
            $magnumData["DN"] = $data["Data"]["Results"]["DrawID"];
            $magnumData["PB1"] = $data["JackpotAmount"]["EstimatedJackpotAmount"]["PowerballJackpot1"];
            $magnumData["PB2"] = $data["JackpotAmount"]["EstimatedJackpotAmount"]["PowerballJackpot2"];
            $magnumData["ESTJP1"] = "RM ". number_format($data["JackpotAmount"]["EstimatedJackpotAmount"]["ActJackpot1"]);
            $magnumData["ESTJP2"] = "RM ". number_format($data["JackpotAmount"]["EstimatedJackpotAmount"]["ActJackpot2"]);
            $magnumData["ESTGJP1"] = "RM ". number_format($data["JackpotAmount"]["EstimatedJackpotAmount"]["ActGoldJackpot1"]);
            $magnumData["ESTGJP2"] = "RM ". number_format($data["JackpotAmount"]["EstimatedJackpotAmount"]["ActGoldJackpot2"]);
            $magnumData["JP1"] = "";
            $magnumData["JP2"] = "";
            $magnumData["JP1WON"] = "";
            $magnumData["JP2WON"] = "";
            $magnumData["COMPLETE4D"] = $data["Data"]['Results']["T1"]?1:0;
            $magnumData["COMPLETELIFE"] = ($data["Data"]['Results']["Caption"]=="Draw closed.")?1:0;

            $goldData =[
                "S_T" => "19:00:00",
                "DD" => $magnumData["DD"], 
                "DN" =>$magnumData["DN"], 
                "P1" => "", 
                "P2" => "", 
                "P3" => "", 
                "P4" => "", 
                "P5" => "4", 
                "P6" => "", 
                "P7" => "0", 
                "P8" => "0", 
                "JP1" => $magnumData["JP1"], 
                "JP2" => $magnumData["JP2"], 
                "JP1WON" => "0.0000",
                "JP2WON" => "0.0000", 
                "COMPLETED4D" => "0"
            ];
            
            if (strlen($fpn) > 0 && strlen($spn) > 0 && strlen($tpn) > 0) {
                $goldP = substr($fpn, -2) . substr($spn, -2) . substr($tpn, -2);
                $goldPArr = str_split($goldP);
            
                $GoldBonus = '';
                if ((int)substr($fpn, 0, 1) >= 0 && (int)substr($fpn, 0, 1) <= 4) {
                    $GoldBonus = "0";
                } else {
                    $GoldBonus = "1";
                }
                $GoldBonus .= substr($fpn, 1, 1);
            
                $GoldBonusArr = str_split($GoldBonus);
                $goldData['P1'] = $goldPArr[0];
                $goldData['P2'] = $goldPArr[1];
                $goldData['P3'] = $goldPArr[2];
                $goldData['P4'] = $goldPArr[3];
                $goldData['P5'] = $goldPArr[4];
                $goldData['P6'] = $goldPArr[5];
                $goldData['P7'] = $GoldBonusArr[0];
                $goldData['P8'] = $GoldBonusArr[1];
                $goldData['COMPLETED4D'] = "1";

            }
            //
            if($magnumData["COMPLETE4D"] == 1){
                $url2 = "https://app-apdapi-prod-southeastasia-01.azurewebsites.net/results/past/between-dates/". $drawDate. "/". $drawDate. "/1";
                $json2 = file_get_contents($url2);
                //$json = str_replace("var HomePageData = ", "", $json);
                $data2 = json_decode($json2, true);
                $magnumData["JP1"] = "RM ". number_format($data2['PastResultsRange']['PastResults']['Jackpot1Amount'], 2, ".", ",");
                $magnumData["JP2"] = "RM ". number_format($data2['PastResultsRange']['PastResults']['Jackpot2Amount'], 2, ".", ",");
                $magnumData["JP1WON"] = $data2['PastResultsRange']['PastResults']['Jackpot1Winner'];
                $magnumData["JP2WON"] = $data2['PastResultsRange']['PastResults']['Jackpot2Winner'];
                $goldData["JP1"] = "RM ". number_format($data2['PastResultsRange']['PastResults']['GoldJackpot1Amount'], 2, ".", ",");
                $goldData["JP2"] = "RM ". number_format($data2['PastResultsRange']['PastResults']['GoldJackpot2Amount'], 2, ".", ",");
                $goldData["JP1WON"] = $data2['PastResultsRange']['PastResults']['GoldJackpot1Winner'];
                $goldData["JP2WON"] = $data2['PastResultsRange']['PastResults']['GoldJackpot2Winner'];
                //var_dump($data2['PastResultsRange']['PastResults']);
            }
            //var_dump($goldData);exit();
            //exit();
            $key  = "M4D";
            $lottery_data = [
                'date' => $drawDate,
                'data' => json_encode($magnumData),
                'type' => $key,
                'name' => 'Magnum',
                'display_name' => 'Magnum 4D',
                'draw_start' => !$magnumData["COMPLETE4D"],
                'draw_end' => $magnumData["COMPLETE4D"],
                'ds' => !$magnumData["COMPLETE4D"],
                'df' => $magnumData["COMPLETE4D"],
                'notes' => 'Note'
            ];
            $key2 = "M4DJG";
            $mjg_data = [
                'date' => $drawDate,
                'data' => json_encode($goldData),
                'type' => $key2,
                'name' => 'Magnum 4D Jackpot Gold',
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
            // Kiểm tra xem dữ liệu đã tồn tại chưa
            $existing_data = $lotteryModel->getLotteryDataByDateAndType($drawDate, $key2);
            if ($existing_data) {
                // Cập nhật dữ liệu
                $lotteryModel->updateLotteryData($drawDate, $key2, $mjg_data);
                CLI::write("Data updated for $key2 on $drawDate.", 'yellow');
            } else {
                // Chèn dữ liệu mới
                $lotteryModel->insertLotteryData($mjg_data);
                CLI::write("Data inserted for $key2 on $drawDate.", 'green');
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
