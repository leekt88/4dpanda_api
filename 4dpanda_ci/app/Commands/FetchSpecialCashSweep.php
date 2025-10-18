<?php

namespace App\Commands;

use App\Models\LotteryModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class FetchSpecialCashSweep extends BaseCommand
{
    protected $group       = 'Lottery';
    protected $name        = 'lottery:specialcashsweep';
    protected $description = 'Fetch and store Singapore Pools lottery data';

    public function run(array $params){
        $type = $params[0] ?? null;
        $time = $params[1] ?? null;
        $this->fetchSpecialCashSweepData();
        
    }
    private function fetchSpecialCashSweepData()
    {
        $lotteryModel = new LotteryModel();
        //$url = "https://www.cashsweep.my/api/results/draw";
        $url = "https://www.cashsweep.my/live.json";
        $json = file_get_contents($url);
        $data = json_decode($json, true);

        if ($data) {
            $scsData["S_T"] = "19:00:00";
            $scsData['DN'] = $data["dn"];
            $date = explode("T", $data['d']);
            $drawDate = $date[0];
            $scsData['DD'] = date("d-m-Y (D)", strtotime($drawDate));
            $scsData['P1'] = isset($data["n"][1])?sprintf('%04d', $data["n"][1]):"----";
            $scsData['P2'] = isset($data["n"][2])?sprintf('%04d', $data["n"][2]):"----";;
            $scsData['P3'] = isset($data["n"][3])?sprintf('%04d', $data["n"][3]):"----";;
            //3D BIG
            $scsData['P13D'] = isset($data["n"][4])?sprintf('%03d', $data["n"][4]):"----";;
            $scsData['P23D'] = isset($data["n"][5])?sprintf('%03d', $data["n"][5]):"----";
            $scsData['P33D'] = isset($data["n"][6])?sprintf('%03d', $data["n"][6]):"----";
            for ($i = 9; $i < 19; $i++ ){
                $j = $i - 8;
                $scsData["S$j"]= isset($data["n"][$i])?sprintf('%04d',$data["n"][$i]):'----';
            }
            for ($i = 19; $i < 29; $i++ ){
                $j = $i - 18;
                $scsData["C$j"]= isset($data["n"][$i])?sprintf('%04d',$data["n"][$i]):'----';
            }
            $scsData['COMPLETED4D'] = (($scsData['P1'] == "----") || ($scsData['P2'] == "----") || ($scsData['P3'] == "----"))?0:1;
            $key = 'SCS';
            $lottery_data = [
                'date' => $drawDate,
                'data' => json_encode($scsData),
                'type' => $key,
                'name' => 'Cash Sweep',
                'name' => 'Special Cash Sweep',
                'draw_start' => !$scsData['COMPLETED4D'],
                'draw_end' => $scsData['COMPLETED4D'],
                'ds' => !$scsData['COMPLETED4D'],
                'df' => $scsData['COMPLETED4D'],
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
