<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\LotteryModel;
use Symfony\Component\DomCrawler\Crawler;

/*
* Have to install SocketIO: 
* composer require textalk/websocket:*
*
*/
class FetchNineLotto extends BaseCommand
{
    protected $group       = 'Lottery';
    protected $name        = 'lottery:fetch9loto';
    protected $description = 'Fetch 9 Loto data 19:30 Everyday';


    public function run(array $params){
        $type = $params[0] ?? null;
        $time = $params[1] ?? null;
        $this->fetch9TotoData();
        
    }
    private function fetch9TotoData()
    {
        $lotteryModel = new LotteryModel();
        $date = date("Y-m-d");
        $url = "https://9lotto.com/result/$date";
        $html = file_get_contents($url);
        //var_dump($html);
        $crawler = new Crawler($html);
        $ttData = [];
        if ($crawler) {
            $i = 0;
            for ($char = 'A'; $char <= 'M'; $char++) {
                $i++;
                $ttData["S$i"] = $crawler->filter("#n$char")->count()?$crawler->filter("#n$char")->text():'';
            }
            $i = 0;
            for ($char = 'N'; $char <= 'W'; $char++) {
                $i++;
                $ttData["C$i"] = $crawler->filter("#n$char")->count()?$crawler->filter("#n$char")->text():'';
            } 
            $ttData['P1'] = $crawler->filter("#n1")->count()?$crawler->filter("#n1")->text():'';           
            $ttData['P2'] = $crawler->filter("#n2")->count()?$crawler->filter("#n2")->text():'';           
            $ttData['P3'] = $crawler->filter("#n3")->count()?$crawler->filter("#n3")->text():'';
            $drawNo = $crawler->filter("h3.heading-black.text-uppercase > span:nth-child(2)")->count()?$crawler->filter("h3.heading-black.text-uppercase > span:nth-child(2)")->text():'';
            $ttData["DN"] = "Draw No: ".$drawNo;
            $ttData["S_T"] = "19:30:00";
            $drawDate = $crawler->filter('input#inputDate')->count()?$crawler->filter('input#inputDate')->attr('placeholder'):date('Y-m-d');
            $ttData['DD'] = date('d-m-Y (D)', strtotime($drawDate));
            $ttData["P6D1"]='';
            for($i = 1; $i < 7; $i++){
                $ttData["P6D1"] .= $crawler->filter("#r60$i")->count()?$crawler->filter("#r60$i")->text():'';
            }
            $ttData["P6D2A"]='';
            for($i = 1; $i < 6; $i++){
                $ttData["P6D2A"] .= $crawler->filter("#r60$i")->count()?$crawler->filter("#r60$i")->text():'';
            }
            $ttData["P6D2B"]='';
            for($i = 2; $i < 7; $i++){
                $ttData["P6D2B"] .= $crawler->filter("#r60$i")->count()?$crawler->filter("#r60$i")->text():'';
            }
            $ttData["P6D3A"]='';
            for($i = 1; $i < 5; $i++){
                $ttData["P6D3A"] .= $crawler->filter("#r60$i")->count()?$crawler->filter("#r60$i")->text():'';
            }
            $ttData["P6D3B"]='';
            for($i = 3; $i < 7; $i++){
                $ttData["P6D3B"] .= $crawler->filter("#r60$i")->count()?$crawler->filter("#r60$i")->text():'';
            }

            $ttData["P6D4A"]='';
            for($i = 1; $i < 4; $i++){
                $ttData["P6D4A"] .= $crawler->filter("#r60$i")->count()?$crawler->filter("#r60$i")->text():'';
            }
            $ttData["P6D4B"]='';
            for($i = 4; $i < 7; $i++){
                $ttData["P6D4B"] .= $crawler->filter("#r60$i")->count()?$crawler->filter("#r60$i")->text():'';
            }           
            $ttData["P6D5A"]='';
            for($i = 1; $i < 3; $i++){
                $ttData["P6D5A"] .= $crawler->filter("#r60$i")->count()?$crawler->filter("#r60$i")->text():'';
            }
            $ttData["P6D5B"]='';
            for($i = 5; $i < 7; $i++){
                $ttData["P6D5B"] .= $crawler->filter("#r60$i")->count()?$crawler->filter("#r60$i")->text():'';
            }

            $ttData["P7D"]='';
            for ($j = 1; $j <=6; $j++){
                $ttData["P7D"] .= $crawler->filter("#r70$j")->count()?$crawler->filter("#r70$j")->text():''; 
            }  
            $ttData["P7D1"] = $crawler->filter("#r707")->count()?$crawler->filter("#r707")->text():''; 

            $ttData['COMPLETED4D'] = $ttData['P1']?1:0;
            $ttData['COMPLETED6D'] = $ttData['P6D1']?1:0;
            $key = 'NLT';
            $lottery_data = [
                'date' => $drawDate,
                'data' => json_encode($ttData),
                'type' => $key,
                'name' => '9 Loto',
                'display_name' => '9Loto 4D 6D 7D',
                'draw_start' => !$ttData['COMPLETED4D'],
                'draw_end' => $ttData['COMPLETED4D'],
                'ds' => !$ttData['COMPLETED4D'],
                'df' => $ttData['COMPLETED4D'],
                'notes' => ''
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
}
