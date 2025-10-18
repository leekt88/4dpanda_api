<?php

namespace App\Commands;

use App\Models\LotteryModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class FetchLotteryData extends BaseCommand
{
    protected $group       = 'Lottery';
    protected $name        = 'lottery:fetch';
    protected $description = 'Fetch and store lottery data';

    public function run(array $params){
        $type = $params[0] ?? null;
        $time = $params[1] ?? null;
        switch ($type) {
            // Lucky Hari Hari 4D 6D
            case 'H4D':
                $this->fetchHari4D6D($time);
                break;
            // Add more cases for other types of lotteries
            case 'DMC':
                $this->fetchDamacai();
                break;
            // Perdana 4D 6D
            case 'P4D':
                $this->fetchPerdana($time);
                break;
            //Grand Dragon 
            case 'GD':
                $this->fetechGrandDragon();
                break;
            default:
                $this->fetchOldMethod();
                //CLI::write("Unsupported lottery type: {$type}", 'red');
                break;
        }        
    }
    private function fetchOldMethod()
    {
        $url = "https://www.check4d.org/liveosx.json";
        $json = file_get_contents($url);
        $data = json_decode($json, true);

        if ($data) {
            $lotteryModel = new LotteryModel();
            foreach ($data as $key => $value) {
                if (isset($value['DD'])) {
                    $date = $this->formatDate($value['DD']);
                    $lottery_data = [
                        'date' => $date,
                        'data' => json_encode($value),
                        'type' => $key,
                        'name' => $this->getLotteryName($key),
                        'notes' => $this->generateNotes($value)
                    ];
                    // Kiểm tra xem dữ liệu đã tồn tại chưa
                    $existing_data = $lotteryModel->getLotteryDataByDateAndType($date, $key);
                    if ($existing_data) {
                        // Cập nhật dữ liệu
                        $lotteryModel->updateLotteryData($date, $key, $lottery_data);
                        CLI::write("Data updated for $key on $date.", 'yellow');
                    } else {
                        // Chèn dữ liệu mới
                        $lotteryModel->insertLotteryData($lottery_data);
                        CLI::write("Data inserted for $key on $date.", 'green');
                    }
                }
            }
        } else {
            CLI::error("Failed to fetch data.");
        }
    }
    /* Fetch Lucky Hari Hari 4D-6D
    */
    private function fetchHari4D6D($time)
    {
        $date = date('Y-m-d');
        $url = "https://api.hari4d.com/DrawResultL/GetDrawResult?date={$date}T{$time}";

        $client = \Config\Services::curlrequest();
        $response = $client->get($url);
        $result = json_decode($response->getBody(), true);

        if (isset($result['updatedBy'])) {
            $data = [
                "S_T" => $time,
                "C1" => $result['prizeN'],
                "C2" => $result['prizeO'],
                "C3" => $result['prizeP'],
                "C4" => $result['prizeQ'],
                "C5" => $result['prizeR'],
                "C6" => $result['prizeS'],
                "C7" => $result['prizeT'],
                "C8" => $result['prizeU'],
                "C9" => $result['prizeV'],
                "DD" => date('d-m-Y H:i (D)', strtotime($result['drawDate'])),
                "DN" => $result['id'],
                "P1" => $result['prize1'],
                "P2" => $result['prize2'],
                "P3" => $result['prize3'],
                "S1" => $result['prizeA'],
                "S2" => $result['prizeB'],
                "S3" => $result['prizeC'],
                "S4" => $result['prizeD'],
                "S5" => $result['prizeE'],
                "S6" => $result['prizeF'],
                "S7" => $result['prizeG'],
                "S8" => $result['prizeH'],
                "S9" => $result['prizeI'],
                "C10" => $result['prizeW'],
                "S10" => $result['prizeJ'],
                "S11" => $result['prizeK'],
                "S12" => $result['prizeL'],
                "S13" => $result['prizeM'],
                "COMPLETE4D" => ($result['prize1']=='----') ? '0' : '1',
                "prize6D" => $result['prize6D'],
                "prize6D_2A" => $result['prize6D_2A'],
                "prize6D_2B" => $result['prize6D_2B'],
                "prize6D_3A" => $result['prize6D_3A'],
                "prize6D_3B" => $result['prize6D_3B'],
                "prize6D_4A" => $result['prize6D_4A'],
                "prize6D_4B" => $result['prize6D_4B'],
                "prize6D_5A" => $result['prize6D_5A'],
                "prize6D_5B" => $result['prize6D_5B'],
                "COMPLETE6D" => $result['prize6D']=='------' ? '0' : '1'
            ];

            $lotteryModel = new LotteryModel();
            if($time=="15:30:00")
                $key = "H4D6D1";
            else 
                $key = "H4D6D2";
            $lottery_data = [
                'date' => $date,
                'data' => json_encode($data),
                'type' => $key,
                'draw_start' => !$data['COMPLETE4D'],
                'draw_end' => $data['COMPLETE4D'],
                'ds' => !$data['COMPLETE4D'],
                'df' => $data['COMPLETE4D'],
                'name' => 'Lucky Hari Hari',
                'display_name' => $this->getLotteryName($key),
                'notes' => ''
            ];
            // Kiểm tra xem dữ liệu đã tồn tại chưa
            $existing_data = $lotteryModel->getLotteryDataByDateAndType($date, $key);
            if ($existing_data) {
                // Cập nhật dữ liệu
                $lotteryModel->updateLotteryData($date, $key, $lottery_data);
                CLI::write("Data updated for $key on $date.", 'yellow');
            } else {
                // Chèn dữ liệu mới
                $lotteryModel->insertLotteryData($lottery_data);
                CLI::write("Data inserted for $key on $date.", 'green');
            }
            CLI::write("Hari4D data for {$time} fetched and stored successfully", 'green');
        } else {
            CLI::write("No data available for {$time} or the draw is not yet done.", 'yellow');
        }
    }
    /*
    ** Fetch Damacai Results
    */
    private function fetchDamacai()
    {
        $url = 'https://prddmcremt1.blob.core.windows.net/drawresult/DrawResult.json?st=2018-05-24T09%3A54%3A31Z&se=2028-05-25T09%3A54%3A00Z&sp=rl&sv=2017-07-29&sr=b&sig=inT8KHVV3QpYI7e7X0ZQ%2BNX%2BlboBg%2Fs%2FX9GTfUhfRGo%3D';
        $json = file_get_contents($url);
        if ($json === false) {
            CLI::error('Failed to fetch Damacai data.');
            return;
        }

        $data = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            CLI::error('Failed to parse Damacai JSON.');
            return;
        }

        $this->parseAndStoreDamacaiData($data);
    }
    private function parseAndStoreDamacaiData($data)
    {
        $lotteryModel = new LotteryModel();

        $completed = $data['status'] === 'COMPLETED' ? 1 : 0;
        $date = date('Y-m-d');
        if(isset($data["drawDate"]) && $data["drawDate"]){
            $str = explode("/", $data["drawDate"]);
            $drawDate = $str[2].'-'.$str[1].'-'.$str[0];
            $_dD = $str[2].$str[1].$str[0];
        }
        else {
            $drawDate = $date;
        }
        $dict =[
            1 => "RAT",
            2 => "OX",
            3 => "TIGER",
            4 => "RABBIT",
            5 => "DRAGON",
            6 => "SNAKE",
            7 => "HORSE",
            8 => "GOAT",
            9 => "MONKEY",
            10 => "ROOSTER",
            11 => "DOG",
            12 => "BOAR"
        ];
        // 3+3D Data
        $data6D = [
            "S_T" => "19:00:00",
            "DD"=>date('d-m-Y (D)', strtotime($drawDate)), 
            "DN"=>$data["drawNo"], 
            "P1"=>$data["p13p3d"], 
            "P2"=>$data["p23p3d"], 
            "P3"=>$data["p33p3d"],
            "C1"=>isset($data["consolidateList3p3d"][0])?$data["consolidateList3p3d"][0]:'----',     
            "C2"=>isset($data["consolidateList3p3d"][1])?$data["consolidateList3p3d"][1]:'----', 
            "C3"=>isset($data["consolidateList3p3d"][2])?$data["consolidateList3p3d"][2]:'----', 
            "C4"=>isset($data["consolidateList3p3d"][3])?$data["consolidateList3p3d"][3]:'----', 
            "C5"=>isset($data["consolidateList3p3d"][4])?$data["consolidateList3p3d"][4]:'----', 
            "C6"=>isset($data["consolidateList3p3d"][5])?$data["consolidateList3p3d"][5]:'----', 
            "C7"=>isset($data["consolidateList3p3d"][6])?$data["consolidateList3p3d"][6]:'----', 
            "C8"=>isset($data["consolidateList3p3d"][7])?$data["consolidateList3p3d"][7]:'----', 
            "C9"=>isset($data["consolidateList3p3d"][8])?$data["consolidateList3p3d"][8]:'----', 
            "C10"=>isset($data["consolidateList3p3d"][9])?$data["consolidateList3p3d"][9]:'----',
            "S1"=>isset($data["starterList3p3d"][0])?$data["starterList3p3d"][0]:'----', 
            "S2"=>isset($data["starterList3p3d"][1])?$data["starterList3p3d"][1]:'----', 
            "S3"=>isset($data["starterList3p3d"][2])?$data["starterList3p3d"][2]:'----', 
            "S4"=>isset($data["starterList3p3d"][3])?$data["starterList3p3d"][3]:'----', 
            "S5"=>isset($data["starterList3p3d"][4])?$data["starterList3p3d"][4]:'----', 
            "S6"=>isset($data["starterList3p3d"][5])?$data["starterList3p3d"][5]:'----', 
            "S7"=>isset($data["starterList3p3d"][6])?$data["starterList3p3d"][6]:'----', 
            "S8"=>isset($data["starterList3p3d"][7])?$data["starterList3p3d"][7]:'----', 
            "S9"=>isset($data["starterList3p3d"][8])?$data["starterList3p3d"][8]:'----', 
            "S10"=>isset($data["starterList3p3d"][9])?$data["starterList3p3d"][9]:'----', 
            "J61"=> $data["3+3DBonusp1"], 
            "J62"=> $data["3+3DBonusp2"], 
            "J63"=> $data["3+3DBonusp3"], 
            "P1B"=> $data["zodiac3dp1"]?$dict[$data["zodiac3dp1"]]:'----',
            "P2B"=> $data["zodiac3dp2"]?$dict[$data["zodiac3dp2"]]:'----', 
            "P3B"=> $data["zodiac3dp3"]?$dict[$data["zodiac3dp3"]]:'----', 
            
            "J61WON"=> $data["3+3DBonusp1Winning"], 
            "J62WON"=> $data["3+3DBonusp2Winning"], 
            "J63WON"=> $data["3+3DBonusp3Winning"], 
            "COMPLETE4D"=>$completed
        ];
        // 1+3D Data
        $data4D = [
            "S_T" => "19:00:00",
            "DD"=>date('d-m-Y (D)', strtotime($drawDate)), 
            "DN"=>$data["drawNo"], 
            "P1"=> $data["p1"], 
            "P2"=> $data["p2"], 
            "P3"=> $data["p3"], 
            "C1"=> isset($data["consolidateList"][0])?$data["consolidateList"][0]:'----', 
            "C2"=> isset($data["consolidateList"][1])?$data["consolidateList"][1]:'----', 
            "C3"=> isset($data["consolidateList"][2])?$data["consolidateList"][2]:'----', 
            "C4"=> isset($data["consolidateList"][3])?$data["consolidateList"][3]:'----', 
            "C5"=> isset($data["consolidateList"][4])?$data["consolidateList"][4]:'----', 
            "C6"=> isset($data["consolidateList"][5])?$data["consolidateList"][5]:'----', 
            "C7"=> isset($data["consolidateList"][6])?$data["consolidateList"][6]:'----', 
            "C8"=> isset($data["consolidateList"][7])?$data["consolidateList"][7]:'----', 
            "C9"=> isset($data["consolidateList"][8])?$data["consolidateList"][8]:'----', 
            "C10"=> isset($data["consolidateList"][9])?$data["consolidateList"][9]:'----',
            "S1"=> isset($data["starterList"][0])?$data["starterList"][0]:'----', 
            "S2"=> isset($data["starterList"][1])?$data["starterList"][1]:'----', 
            "S3"=> isset($data["starterList"][2])?$data["starterList"][2]:'----', 
            "S4"=> isset($data["starterList"][3])?$data["starterList"][3]:'----', 
            "S5"=> isset($data["starterList"][4])?$data["starterList"][4]:'----', 
            "S6"=> isset($data["starterList"][5])?$data["starterList"][5]:'----', 
            "S7"=> isset($data["starterList"][6])?$data["starterList"][6]:'----', 
            "S8"=> isset($data["starterList"][7])?$data["starterList"][7]:'----', 
            "S9"=> isset($data["starterList"][8])?$data["starterList"][8]:'----', 
            "S10"=> isset($data["starterList"][9])?$data["starterList"][9]:'----', 
            "JP1"=> $data["1+3DJackpot1"], 
            "JP2"=> $data["1+3DJackpot2"], 
            "JP3"=> $data["3DJackpot"], 
            "JP1WON"=> $data["1+3DJackpotWinning1"], 
            "JP2WON"=> $data["1+3DJackpotWinning2"], 
            "JP3WON"=> $data["3DJackpotWinning"], 
            "COMPLETE4D"=>$completed
        ];
        $client = new Client();
        // Gửi yêu cầu và nhận nội dung HTML
        $response = $client->request('GET', 'https://www.damacai.com.my/home');
        $html = (string) $response->getBody();
        // Khởi tạo Crawler
        $crawler = new Crawler($html);
        $data4D["EJP1"] = ($crawler->filter('.13DJackpot1')->count()?$crawler->filter('.13DJackpot1')->eq(1)->text():$data["1+3DJackpot1"]);
        $data4D["EJP2"] = ($crawler->filter('.13DJackpot2')->count()?$crawler->filter('.13DJackpot2')->eq(1)->text():$data["1+3DJackpot2"]);
        $data4D["EJP3"] = ($crawler->filter('.3DJackpot')->count()?$crawler->filter('.3DJackpot')->eq(1)->text():$data["3DJackpot"]);
        $data6D["EJ61"] = ($crawler->filter('.DMCJackpot1')->count()?$crawler->filter('.DMCJackpot1')->eq(1)->text():$data["3+3DBonusp1"]);
        $data6D["EJ62"] = ($crawler->filter('.DMCJackpot2')->count()?$crawler->filter('.DMCJackpot2')->eq(2)->text():$data["3+3DBonusp2"]);
        $data6D["EJ63"] = ($crawler->filter('.DMCJackpot2')->count()?$crawler->filter('.DMCJackpot2')->eq(1)->text():$data["3+3DBonusp3"]); 
        if($completed){
            $pastdate = $_dD;
            $url = ("https://www.damacai.com.my/callpassresult?pastdate=" . urlencode($pastdate));
            $options = [
                "http" => [
                    "header" => "cookiesession: 774\r\n",
                    "method" => "GET"
                ]
            ];
            $context = stream_context_create($options);
            $data = json_decode(file_get_contents($url, false, $context), true);
            if ($data && isset($data['link'])) {
                $url  =  $data['link'];
                $json = file_get_contents($url);
                $data = (json_decode($json, true));
                if($data && isset($data['1+3DJackpotWinning1'])){
                    $data4D["JP1WON"] = $data["1+3DJackpotWinning1"]; 
                    $data4D["JP2WON"] = $data["1+3DJackpotWinning2"]; 
                    $data4D["JP3WON"] = $data["3DJackpotWinning"]; 
                }
            }
        }
        //var_dump($data4D);
        //var_dump($data6D);exit();
        $threePlusThreeDData = [
            'type' => 'DMC6D',
            'date' => $drawDate,
            'name' => "Damacai 3+3D",
            'data' => json_encode($data6D),
            'draw_start' => !$completed,
            'draw_end' => $completed,
            'ds' => !$completed,
            'df' => $completed,
            'notes' => ''
        ];

        $onePlusThreeDData = [
            'type' => 'DMC4D',
            'date' => $drawDate,
            'name' => "Damacai",
            'display_name' => "Damacai 1+3D",
            'data' => json_encode($data4D),
            'draw_start' => !$completed,
            'draw_end' => $completed,
            'ds' => !$completed,
            'df' => $completed,
            'notes' => ''
        ];

           // Kiểm tra xem dữ liệu đã tồn tại chưa
        $key = 'DMC4D';
        $existing_data = $lotteryModel->getLotteryDataByDateAndType($drawDate, $key);
        if ($existing_data) {
            // Cập nhật dữ liệu
             $lotteryModel->updateLotteryData($drawDate, $key, $onePlusThreeDData);
            CLI::write("Data updated for $key on $date.", 'yellow');
        }else {
            // Chèn dữ liệu mới
            $lotteryModel->insertLotteryData($onePlusThreeDData);
            CLI::write("Data inserted for $key on $date.", 'green');
        }
           // Kiểm tra xem dữ liệu đã tồn tại chưa
        $key = 'DMC6D';
        $existing_data = $lotteryModel->getLotteryDataByDateAndType($drawDate, $key);
        if ($existing_data) {
            // Cập nhật dữ liệu
             $lotteryModel->updateLotteryData($drawDate, $key, $threePlusThreeDData);
            CLI::write("Data updated for $key on $date.", 'yellow');
        }else {
            // Chèn dữ liệu mới
            $lotteryModel->insertLotteryData($threePlusThreeDData);
            CLI::write("Data inserted for $key on $date.", 'green');
        }
                
        CLI::write('Damacai data (1+3D and 3+3D) fetched and stored successfully.');
    }    

    /*
    ** Fetch Perdana Results
    */
    private function fetchPerdana($time)
    {
        if($time === '15:00:00'){
            $url = 'https://www.perdana4d.com/Index?handler=First';
        }
        else {
            $url = 'https://www.perdana4d.com/Index?handler=Refresh';
        }
        $json = file_get_contents($url);
        if ($json === false) {
            CLI::error('Failed to fetch Damacai data.');
            return;
        }

        $data = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            CLI::error('Failed to parse Damacai JSON.');
            return;
        }

        $this->parseAndStorePerdanaData($data, $time);
    }
    private function parseAndStorePerdanaData($data, $time){
        $lotteryModel = new LotteryModel();
        $p4dData["S_T"] = $time;
        $p4dData["S1"] ="----";
        $p4dData["S2"] ="----";
        $p4dData["S3"] ="----";
        $p4dData["S4"] ="----";
        $p4dData["S5"] ="----";
        $p4dData["S6"] ="----";
        $p4dData["S7"] ="----";
        $p4dData["S8"] ="----";
        $p4dData["S9"] ="----";
        $p4dData["S10"] ="----";
        $p4dData["S11"] ="----";
        $p4dData["S12"] ="----";
        $p4dData["S13"] ="----";
        $p4dData["C1"] ="----";
        $p4dData["C2"] ="----";
        $p4dData["C3"] ="----";
        $p4dData["C4"] ="----";
        $p4dData["C5"] ="----";
        $p4dData["C6"] ="----";
        $p4dData["C7"] ="----";
        $p4dData["C8"] ="----";
        $p4dData["C9"] ="----";
        $p4dData["C9"] ="----";
        $p4dData["C10"] ="----";
        foreach ($data['fourDModel'] as $prize){
            if($prize['resultType'] === 41) $p4dData['P1'] = $prize['result'];
            if($prize['resultType'] === 42) $p4dData['P2'] = $prize['result'];
            if($prize['resultType'] === 43) $p4dData['P3'] = $prize['result'];
        }

        foreach($data['fourDSpecialPrize'] as $prize){
            if($prize['resultType'] === 44) $p4dData['S1'] = $prize['result'];
            if($prize['resultType'] === 45) $p4dData['S2'] = $prize['result'];
            if($prize['resultType'] === 46) $p4dData['S3'] = $prize['result'];
            if($prize['resultType'] === 47) $p4dData['S4'] = $prize['result'];
            if($prize['resultType'] === 48) $p4dData['S5'] = $prize['result'];
            if($prize['resultType'] === 49) $p4dData['S6'] = $prize['result'];
            if($prize['resultType'] === 50) $p4dData['S7'] = $prize['result'];
            if($prize['resultType'] === 51) $p4dData['S8'] = $prize['result'];
            if($prize['resultType'] === 52) $p4dData['S9'] = $prize['result'];
            if($prize['resultType'] === 53) $p4dData['S10'] = $prize['result'];
            if($prize['resultType'] === 54) $p4dData['S11'] = $prize['result'];
            if($prize['resultType'] === 55) $p4dData['S12'] = $prize['result'];
            if($prize['resultType'] === 56) $p4dData['S13'] = $prize['result'];
        }
        foreach($data['fourDConsolationPrize'] as $prize){
            if($prize['resultType'] === 57) $p4dData['C1'] = $prize['result'];
            if($prize['resultType'] === 58) $p4dData['C2'] = $prize['result'];
            if($prize['resultType'] === 59) $p4dData['C3'] = $prize['result'];
            if($prize['resultType'] === 60) $p4dData['C4'] = $prize['result'];
            if($prize['resultType'] === 61) $p4dData['C5'] = $prize['result'];
            if($prize['resultType'] === 62) $p4dData['C6'] = $prize['result'];
            if($prize['resultType'] === 63) $p4dData['C7'] = $prize['result'];
            if($prize['resultType'] === 64) $p4dData['C8'] = $prize['result'];
            if($prize['resultType'] === 65) $p4dData['C9'] = $prize['result'];
            if($prize['resultType'] === 66) $p4dData['C10'] = $prize['result'];
        }
        //$date = date('Y-m-d');
        $p4dData['DN'] = $data['pool']['gameId'];
        $p4dData['COMPLETE4D'] = ($p4dData['P1'] !='----')?1:0;
        $gameTime = explode("T",$data['pool']['endTime']);
        $drawDate = $gameTime[0];
        $p4dData['DD'] = date('d-m-Y (D)', strtotime($drawDate));
        $key = ($gameTime[1] == '15:00:00')? 'P4D1':'P4D2';
        $p4dData['6D'] = $data['sixDModel'][0]['result'];
        $p4dData['6DDN'] = $data['sixDModel'][0]['gameId'];
        $gameTime = explode("T",$data['sixDModel'][0]['endTime']);
        $p4dData['6DDD'] = date('d-m-Y (D)', strtotime($gameTime[0]));
        $p4dData['COMPLETED6D'] = ($p4dData['6D']==NULL)?1:1;        
        $perdanaData = [
            'type' => $key,
            'date' => $drawDate,
            'name' => "Perdana",
            'display_name' => "Perdana 4D 6D",
            'data' => json_encode($p4dData),
            'draw_start' => !$p4dData['COMPLETE4D'],
            'draw_end' => $p4dData['COMPLETE4D'],
            'ds' => !$p4dData['COMPLETE4D'],
            'df' => $p4dData['COMPLETE4D'],
            'notes' => ''
        ];
        $existing_data = $lotteryModel->getLotteryDataByDateAndType($drawDate, $key);
        if ($existing_data) {
            // Cập nhật dữ liệu
             $lotteryModel->updateLotteryData($drawDate, $key, $perdanaData);
            CLI::write("Data updated for $key on $drawDate.", 'yellow');
        }else {
            // Chèn dữ liệu mới
            $lotteryModel->insertLotteryData($perdanaData);
            CLI::write("Data inserted for $key on $drawDate.", 'green');
        }
                
        CLI::write('Perdana data 4D fetched and stored successfully.');
    }
    /*
    * Fetch Grand Dragon Result
    */
    private function fetechGrandDragon()
    {
                // Khởi tạo Guzzle client
                $client = new Client();
                // Gửi yêu cầu và nhận nội dung HTML
                $response = $client->request('GET', 'https://gdlotto.com/results/ajax/_result.aspx');
                $html = (string) $response->getBody();
                // Khởi tạo Crawler
                $crawler = new Crawler($html);
                // 4D Prizes
                $firstPrize = $crawler->filter('#1stPz')->count() ? $crawler->filter('#1stPz')->text() : '----';
                $secondPrize = $crawler->filter('#2ndPz')->count() ? $crawler->filter('#2ndPz')->text() : '----';
                $thirdPrize = $crawler->filter('#3rdPz')->count() ? $crawler->filter('#3rdPz')->text() : '----';
                $date = $crawler->filter('.rdt-center')->count() ? $crawler->filter('.rdt-center')->text() : date("Y-m-d");;
                $date = trim(str_replace('Date :', '', $date));
                $date = explode(",", $date);
                $date = $date[0];
                $date = explode("/",$date);
                $drawDate = $date[2]."-".$date[1]."-".$date[0]; 
                // Create a new instance of LotteryModel
                $lotteryModel = new LotteryModel();
        
                // Parse 4D results
                $fourDData = [];
                $fourDData['S_T'] = "19:00:00";
                $fourDData['DD'] = date("d-m-Y (D)", strtotime($drawDate));;
                $fourDData['DN'] ='';
                $fourDData['P1'] = $firstPrize;
                $fourDData['P2'] = $secondPrize;
                $fourDData['P3'] = $thirdPrize;
        
                $specialPrizes = [];
                $j=0;
                for ($i = 'A'; $i <= 'M'; $i++) {
                    $selector = "#Pz$i";
                    $j++;
                    $fourDData["S$j"] = $crawler->filter($selector)->count() ? $crawler->filter($selector)->text() : '----';
                }        
                $consolationPrizes = [];
                $j =0;
                for ($i = 'N'; $i <= 'W'; $i++) {
                    $selector = "#Pz$i";
                    $j++;
                    $fourDData["C$j"] = $crawler->filter($selector)->count() ? $crawler->filter($selector)->text() : '----';
                }                
                // Parse 6D results        
                for ($i = 0; $i <= 5; $i++) {
                    $selector = ".L6_$i";
                    $d[$i]  = $crawler->filter($selector)->count() ? $crawler->filter($selector)->text() : '-';;
                }
                $fourDData["GD6D1"] = $d[0].$d[1].$d[2].$d[3].$d[4].$d[5];
                $fourDData["GD6DA1"] = $d[0].$d[1].$d[2].$d[3].$d[4];//.$d[5];
                $fourDData["GD6DA2"] = $d[1].$d[2].$d[3].$d[4].$d[5];
                $fourDData["GD6DB1"] = $d[0].$d[1].$d[2].$d[3];//.$d[4].$d[5];
                $fourDData["GD6DB2"] = $d[2].$d[3].$d[4].$d[5];
                $fourDData["GD6DC1"] = $d[0].$d[1].$d[2];
                $fourDData["GD6DC2"] = $d[3].$d[4].$d[5];
                $fourDData["GD6DD1"] = $d[0].$d[1];
                $fourDData["GD6DD2"] = $d[4].$d[5];
                $fourDData["COMPLETED4D"] = ($firstPrize =="----")?0: 1;
                $fourDData["COMPLETED6D"] = ($d[0] == "-")?0: 1;
                $key = "GD";
                $granddragonData = [
                    'type' => $key,
                    'date' => $drawDate,
                    'display_name' => "Grand Dragon 4D 6D",
                    'name' => "Grand Dragon",
                    'data' => json_encode($fourDData),
                    'draw_start' => !$fourDData["COMPLETED4D"],
                    'draw_end' => $fourDData["COMPLETED4D"],
                    'ds' => !$fourDData["COMPLETED4D"],
                    'df' => $fourDData["COMPLETED4D"],
                    'notes' => ''
                ];
                $existing_data = $lotteryModel->getLotteryDataByDateAndType($drawDate, $key);
                if ($existing_data) {
                    // Cập nhật dữ liệu
                     $lotteryModel->updateLotteryData($drawDate, $key, $granddragonData);
                    CLI::write("Data updated for $key on $drawDate.", 'yellow');
                }else {
                    // Chèn dữ liệu mới
                    $lotteryModel->insertLotteryData($granddragonData);
                    CLI::write("Data inserted for $key on $drawDate.", 'green');
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
