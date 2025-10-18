<?php

namespace App\Commands;

use App\Models\LotteryModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Symfony\Component\DomCrawler\Crawler;

class FetchSingaporePools extends BaseCommand
{
    protected $group       = 'Lottery';
    protected $name        = 'lottery:fetchsingaporepools';
    protected $description = 'Fetch and store SingaporePools lottery data';

    public function run(array $params){
        $type = $params[0] ?? null;
        $time = $params[1] ?? null;
        switch ($type){
            case 'SGPTT':
                $this->fetchTotoData();
                break;
            case 'SGP4D': 
                $this->fetch4DData();
                break;
            default:
                break;
        }        
    }
    /*
    *
    */

    private function fetchTotoData()
    {
        $lotteryModel = new LotteryModel();
        $url = "https://www.singaporepools.com.sg/DataFileArchive/Lottery/Output/toto_result_top_draws_en.html";
        $html = file_get_contents($url);
        $crawler = new Crawler($html);
        //var_dump($html);
        // Tìm phần tử <li> đầu tiên trong <body>
        $firstLi = $crawler->filter('body li .tables-wrap')->eq(0);
        //var_dump($firstLi);
        $ttData = [];
        
        if ($firstLi->count()) {
            $ttData["JP1"] ='';$ttData["JPW1"] ='';
            $ttData["JP2"] ='';$ttData["JPW2"] ='';
            $ttData["JP3"] ='';$ttData["JPW3"] ='';
            $ttData["JP4"] ='';$ttData["JPW4"] ='';
            $ttData["JP5"] ='';$ttData["JPW5"] ='';
            $ttData["JP6"] ='';$ttData["JPW6"] ='';
            $ttData["JP7"] ='';$ttData["JPW7"] ='';

            // Kiểm tra và lấy dữ liệu nếu các class tồn tại
            $drawDate = $firstLi->filter('.drawDate')->count() ? $firstLi->filter('.drawDate')->text() : '';
            $drawNumber = $firstLi->filter('.drawNumber')->count() ? $firstLi->filter('.drawNumber')->text() : '';
            $drawNumber = trim(str_replace("Draw No.","",$drawNumber));
            for ($i = 1; $i <= 6; $i++) {
                $ttData["P$i"] = $firstLi->filter(".win$i")->count() ? $firstLi->filter(".win$i")->text() : '';
            }

            $ttData["P7"] = $firstLi->filter('.additional')->count() ? $firstLi->filter('.additional')->text() : '';
            $ttData["JP1"] = $firstLi->filter('.jackpotPrize')->count() ? $firstLi->filter('.jackpotPrize')->text() : '';
            //$tableWinShare = ;
            // Kiểm tra sự tồn tại của bảng và lấy dữ liệu nếu có
            if ($firstLi->filter('table.tableWinningShares')->count()) {
                //echo "Bảng tableWinningShares tồn tại.<br>"; // Debug line
                $table = $firstLi->filter('table.tableWinningShares tbody tr');
                //var_dump($table);
                // Bỏ qua hàng đầu tiên vì đó là hàng tiêu đề
                $prizes = [];
                $table->each(function ($node, $i) use (&$prizes) {
                    if ($i > 0) {
                        //echo $i;
                        $group = $node->filter('td')->eq(0)->count() ? $node->filter('td')->eq(0)->text() : '';
                        $shareAmount = $node->filter('td')->eq(1)->count() ? $node->filter('td')->eq(1)->text() : '';
                        $winningShares = $node->filter('td')->eq(2)->count() ? $node->filter('td')->eq(2)->text() : '';
                        $prizes[$group] = [
                            'share_amount' => $shareAmount,
                            'winning_shares' => $winningShares
                        ];
                    }
                });

                // Hiển thị các giải thưởng
                foreach ($prizes as $group => $details) {
                    $i = str_replace("Group ","", $group);
                    $ttData["JP$i"] = $details['share_amount'];
                    $ttData["JPW$i"] = $details['winning_shares'];               
                    //echo "$group: Share Amount: {$details['share_amount']}, No. of Winning Shares: {}<br>";
                }
            }
            // Chuyển đổi chuỗi ngày tháng thành đối tượng DateTime
            $date = \DateTime::createFromFormat('D, d M Y', $drawDate);
            $drawDate = $date->format('Y-m-d');
            $ttData["S_T"] = "18:30:00";
            $ttData['DD'] = $date->format('d-m-Y (D)');
            $ttData['DN'] = $drawNumber;//trim(str_replace("Draw No.","",$drawNumber));
            $ttData['COMPLETED4D'] = $ttData['JP1']?1:0;
            $key = 'SGPTT';
            //echo $drawDate;
            //var_dump($ttData);exit();
            $lottery_data = [
                'date' => $drawDate,
                'data' => json_encode($ttData),
                'type' => $key,
                'name' => 'Singapore Pools Toto',
                'draw_start' => !$ttData['COMPLETED4D'],
                'draw_end' => $ttData['COMPLETED4D'],
                'ds' => !$ttData['COMPLETED4D'],
                'df' => $ttData['COMPLETED4D'],
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
    private function fetch4DData()
    {
        $lotteryModel = new LotteryModel();
        $url = "https://www.singaporepools.com.sg/DataFileArchive/Lottery/Output/fourd_result_top_draws_en.html";
        $html = file_get_contents($url);
        $crawler = new Crawler($html);
        //var_dump($html);
        // Tìm phần tử <li> đầu tiên trong <body>
        $li = $crawler->filter('body li')->eq(0);
        //var_dump($firstLi);
        $ttData = [];
        
        if ($li->count()) {
            $drawDate = $li->filter('.drawDate')->count() ? $li->filter('.drawDate')->text() : '';
            $drawNumber = $li->filter('.drawNumber')->count() ? $li->filter('.drawNumber')->text() : '';
            $drawNumber = trim(str_replace("Draw No.","",$drawNumber));
            $ttData["P1"] = $li->filter('.tdFirstPrize')->count() ? $li->filter('.tdFirstPrize')->text() : '----';
            $ttData["P2"]= $li->filter('.tdSecondPrize')->count() ? $li->filter('.tdSecondPrize')->text() : '----';
            $ttData["P3"]= $li->filter('.tdThirdPrize')->count() ? $li->filter('.tdThirdPrize')->text() : '----';

            // Extract Starter Prizes
            if ($li->filter('.tbodyStarterPrizes')->count()) {
                $starterPrizes = [];
                $li->filter('.tbodyStarterPrizes tr')->each(function ($node) use (&$starterPrizes) {
                    $starterPrizes[] = [
                        'prize1' => $node->filter('td')->eq(0)->text(),
                        'prize2' => $node->filter('td')->eq(1)->text(),
                    ];
                });
                $i=0;
                foreach ($starterPrizes as $prize) {
                    $i++;
                    $ttData["S$i"] = $prize['prize1'];
                    $i++;
                    $ttData["S$i"] = $prize['prize2'];
                    //echo "{$prize['prize1']} - {$prize['prize2']}<br>";
                }
            }
            // Extract Consolation Prizes
            if ($li->filter('.tbodyConsolationPrizes')->count()) {
                $consolationPrizes = [];
                $li->filter('.tbodyConsolationPrizes tr')->each(function ($node) use (&$consolationPrizes) {
                    $consolationPrizes[] = [
                        'prize1' => $node->filter('td')->eq(0)->text(),
                        'prize2' => $node->filter('td')->eq(1)->text(),
                    ];
                });
                $i =0;
                foreach ($consolationPrizes as $prize) {
                    $i++;
                    $ttData["C$i"] = $prize['prize1'];
                    $i++;
                    $ttData["C$i"] = $prize['prize2'];
                    //echo "{$prize['prize1']} - {$prize['prize2']}<br>";
                }
            }

            // Chuyển đổi chuỗi ngày tháng thành đối tượng DateTime
            $date = \DateTime::createFromFormat('D, d M Y', $drawDate);
            $drawDate = $date->format('Y-m-d');
            $ttData['S_T'] = "18:30:00";
            $ttData['DD'] = $date->format('d-m-Y (D)');
            $ttData['DN'] = $drawNumber;//trim(str_replace("Draw No.","",$drawNumber));
            $ttData['COMPLETED4D'] = $ttData['P1']?1:0;
            $key = 'SGP4D';
            //echo $drawDate;
            //var_dump($ttData);exit();
            $lottery_data = [
                'date' => $drawDate,
                'data' => json_encode($ttData),
                'type' => $key,
                'name' => 'Singapore Pools',
                'display_name' => 'Singapore Pools 4D',
                'draw_start' => !$ttData['COMPLETED4D'],
                'draw_end' => $ttData['COMPLETED4D'],
                'ds' => !$ttData['COMPLETED4D'],
                'df' => $ttData['COMPLETED4D'],
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
      
}
