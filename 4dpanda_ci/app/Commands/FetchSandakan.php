<?php

namespace App\Commands;

use App\Models\LotteryModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Symfony\Component\DomCrawler\Crawler;

class FetchSandakan extends BaseCommand
{
    protected $group       = 'Lottery';
    protected $name        = 'lottery:fetchsandakan';
    protected $description = 'Fetch and store lottery data';

    public function run(array $params){
        $type = $params[0] ?? null;
        $time = $params[1] ?? null;
        $this->fetchSandakanData();
        
    }
    private function fetchSandakanData()
    {
        $lotteryModel = new LotteryModel();
        $url = "http://www.stc4d.com/live_draw.aspx";
        $html = file_get_contents($url);
        $crawler = new Crawler($html);
        $dict = [
            "P1" => "MainCont_LBL003",
            "P2" => "MainCont_LBL004",
            "P3" => "MainCont_LBL005",
            "S1" => "MainCont_LBL006",
            "S2" => "MainCont_LBL007",
            "S3" => "MainCont_LBL008",
            "S4" => "MainCont_LBL009",
            "S5" => "MainCont_LBL010",
            "S6" => "MainCont_LBL011",
            "S7" => "MainCont_LBL012",
            "S8" => "MainCont_LBL013",
            "S9" => "MainCont_LBL014",
            "S10" => "MainCont_LBL015",
            "S11" => "MainCont_LBL016",
            "S12" => "MainCont_LBL017",
            "S13" => "MainCont_LBL018",
            "C1" => "MainCont_LBL019",
            "C2" => "MainCont_LBL020",
            "C3" => "MainCont_LBL021",
            "C4" => "MainCont_LBL022",
            "C5" => "MainCont_LBL023",
            "C6" => "MainCont_LBL024",
            "C7" => "MainCont_LBL025",
            "C8" => "MainCont_LBL026",
            "C9" => "MainCont_LBL027",
            "C10" => "MainCont_LBL028",
        ];
        if ($crawler) {
            // Extract First, Second, and Third Prize
            $date = explode(":",$crawler->filter('#MainCont_LBL002')->text());
            $date = $date[1];
            $date = explode("(", $date);
            $date = trim($date[0]);
            $date = explode("/", $date);
            $drawDate = $date[2] .'-'.$date[1].'-'.$date[0];
            
            $drawNo = explode(":",$crawler->filter('#MainCont_LBL001')->text());
            $drawNo = trim($drawNo[1]);
            $ttData["S_T"] = "19:00:00";
            $ttData["DD"] = date("d-m-Y (D)", strtotime($drawDate));
            $ttData["DN"] = $drawNo;
            foreach($dict as $key => $value){
                $ttData[$key] = $crawler->filter("#$value")->text();
            }
            
            $ttData['COMPLETED4D'] = $ttData['P1']?1:0;
            $key = 'STC';
            $lottery_data = [
                'date' => $drawDate,
                'data' => json_encode($ttData),
                'type' => $key,
                'name' => 'Sandakan',
                'display_name' => 'Sandakan 4D',
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
            'STC' => 'Sandakan 4D',
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
