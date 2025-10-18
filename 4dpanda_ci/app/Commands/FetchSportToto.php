<?php

namespace App\Commands;

use App\Models\LotteryModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Symfony\Component\DomCrawler\Crawler;

class FetchSportToto extends BaseCommand
{
    protected $group       = 'Lottery';
    protected $name        = 'lottery:fetchtoto';
    protected $description = 'Fetch Sport Toto Results (Final Robust Version)';

    public function run(array $params)
    {
        CLI::write("Starting to fetch Sports Toto results...", 'cyan');
        $this->fetchTotoData();
    }

    private function getNodeValueByLabel(Crawler $crawler, string $label, int $offset = 1): ?string
    {
        $xpath = ".//td[contains(normalize-space(.), '{$label}')]/following-sibling::td[{$offset}]";
        $node = $crawler->filterXPath($xpath);
        if ($node->count() > 0) {
            return trim($node->text());
        }
        return null;
    }

    /**
     * Extracts game data from a structured table.
     * Works for the newer, detailed HTML layout.
     */
    private function extractGameDataByTable(Crawler $crawler, string $gameTitle, string $prefix): array
    {
        $data = [];
        $titleNode = $crawler->filterXPath("//td[@class='txt_white5' and contains(normalize-space(.), '{$gameTitle}')]");
        var_dump($titleNode);
        if ($titleNode->count() === 0) return [];

        $table = $titleNode->closest('table');
        if ($table->count() === 0) return [];

        $numberCells = $table->filter('td.txt_black2');
        $numbers = [];
        foreach ($numberCells as $cell) {
            $text = trim((new Crawler($cell))->text());
            if (is_numeric($text)) {
                $numbers[] = $text;
            }
        }

        if ($prefix === 'P650') {
            for ($i = 0; $i < 6; $i++) {
                if (isset($numbers[$i])) $data[$prefix . ($i + 1)] = $numbers[$i];
            }
            if (isset($numbers[6])) $data[$prefix . 'EX'] = $numbers[6];
        } else {
            for ($i = 0; $i < 6; $i++) {
                if (isset($numbers[$i])) $data[$prefix . ($i + 1)] = $numbers[$i];
            }
        }
        
        $jackpot1 = $this->getNodeValueByLabel($table, 'Jackpot 1');
        $jackpot2 = $this->getNodeValueByLabel($table, 'Jackpot 2');
        $singleJackpot = $this->getNodeValueByLabel($table, 'Jackpot');

        if ($jackpot1) $data[$prefix . 'JP1'] = str_replace('RM ', '', $jackpot1);
        if ($jackpot2) $data[$prefix . 'JP2'] = str_replace('RM ', '', $jackpot2);
        if (!$jackpot1 && $singleJackpot) $data[$prefix . 'JP'] = str_replace('RM ', '', $singleJackpot);

        return $data;
    }

    /**
     * Extracts prize numbers from a structured table layout.
     * Works for the newer, detailed HTML for Special/Consolation prizes.
     */
    private function extractPrizesByTable(Crawler $crawler, string $title): array
    {
        $prizes = [];
        $tableNode = $crawler->filterXPath("//td[contains(., '{$title}')]/ancestor::table[1]");

        if ($tableNode->count() > 0) {
            $allCells = $tableNode->filter('tr.txt_black2 td');
            foreach ($allCells as $cell) {
                $text = trim((new Crawler($cell))->text());
                if (preg_match('/^(\d{4}|\*{4})$/', $text)) {
                    $prizes[] = $text;
                }
            }
        }
        return $prizes;
    }

    /**
     * The main fetch function, rebuilt to be robust and handle multiple HTML structures.
     */
    private function fetchTotoData()
    {
        $lotteryModel = new LotteryModel();
        $url = "https://totolive.sportstoto.com.my/stoto/popup_live_result.asp";
        $context = stream_context_create(["ssl" => ["verify_peer" => false, "verify_peer_name" => false]]);
        $html = @file_get_contents($url, false, $context);

        if ($html === false) {
            CLI::error("Failed to fetch data from URL: " . $url);
            return;
        }

        $crawler = new Crawler($html);
        $ttData = [];

        // --- 1. LẤY NGÀY VÀ SỐ KỲ QUAY (ROBUST METHOD) ---
        $drawInfoNode = $crawler->filterXPath("//td[contains(., 'Draw Date')]");
        if ($drawInfoNode->count() === 0) {
            CLI::error("Could not find Draw Info block.");
            return;
        }
        $drawInfoText = $drawInfoNode->text();
        if (preg_match('/Draw Date\s*:\s*([\d\/]+)/', $drawInfoText, $dateMatches)) {
            $drawDateStr = trim($dateMatches[1]);
        }
        if (preg_match('/Draw No\.?\s*:\s*([\d\/]+)/', $drawInfoText, $noMatches)) {
            $drawNoStr = trim($noMatches[1]);
        }
        if (empty($drawDateStr) || empty($drawNoStr)) {
            CLI::error("Failed to parse Draw Date/No.");
            return;
        }
        $drawDateParts = explode('/', $drawDateStr);
        $drawDate = ($drawDateParts[2] ?? date('Y')) . "-" . ($drawDateParts[1] ?? '00') . "-" . ($drawDateParts[0] ?? '00');
        $ttData["S_T"] = "19:00:00";
        $ttData["DN"] = $drawNoStr;
        $ttData["DD"] = date("d-m-Y (D)", strtotime($drawDate));
        $ttData["P6551"]= '';
        $ttData["P6552"] = '';
        $ttData["P6553"] = '';
        $ttData["P6554"] = '';
        $ttData["P6555"] = '';
        $ttData["P6556"] = '';
        $ttData["P655JP"] = '';
        $ttData["P6501"] = '';
        $ttData["P6502"] = '';
        $ttData["P6503"] = '';
        $ttData["P6504"] = '';
        $ttData["P6505"] = '';
        $ttData["P6506"] = '';
        $ttData["P650EX"] = '';
        $ttData["P650JP1"] = '';
        $ttData["P650JP2"] = '';
        CLI::write("Processing Draw No: {$ttData['DN']} on {$ttData['DD']}", 'blue');

        // --- TỰ ĐỘNG NHẬN DIỆN CẤU TRÚC HTML ---
        // Nếu tìm thấy bảng 4D chi tiết, đây là cấu trúc mới.
        $isDetailedStructure = $crawler->filterXPath("//td[contains(., 'TOTO 4D JACKPOT')]")->count() > 0;
        
        if ($isDetailedStructure) {
            CLI::write("Detected: Detailed Table Structure.", 'green');
            
            // Lấy giải 4D
            // Lấy giải Special & Consolation bằng phương pháp duyệt bảng
            $Prizes = $this->extractPrizesByTable($crawler, 'Special Prize');
            //var_dump($specialPrizes);
            $ttData['P1'] = $Prizes[0];//$this->getNodeValueByLabel($crawler, 'First Prize', 4);
            $ttData['P2'] = $Prizes[1];//$this->getNodeValueByLabel($crawler, 'Second Prize', 6);
            $ttData['P3'] = $Prizes[2];//$this->getNodeValueByLabel($crawler, 'Third Prize', 7);

            for ($i = 0; $i < 13; $i++) {
                $ttData['S' . ($i + 1)] = $Prizes[$i+3] ?? '';
            }
            //$consolationPrizes = $this->extractPrizesByTable($crawler, 'Consolation Prize');
            for ($i = 0; $i < 10; $i++) {
                $ttData['C' . ($i + 1)] = $Prizes[$i+16] ?? '';
            }

            // Lấy các game Toto bằng phương pháp duyệt bảng
            // --- 4. LẤY CÁC GAME TOTO (6/58, 6/55, 6/50) ---
            $totoGames = [
                'SUPREME TOTO 6/58' => 'P658',
                'POWER TOTO 6/55'   => 'P655',
                'STAR TOTO 6/50'    => 'P650'
            ];
            foreach ($totoGames as $title => $prefix) {
                $gameTable = $crawler->filterXPath("//td[@class='txt_white5' and contains(normalize-space(.), '{$title}')]")->closest('table');
                if ($gameTable->count() > 0) {
                    $numbers = $gameTable->filter('td.txt_black2')->each(fn(Crawler $c) => is_numeric(trim($c->text())) ? trim($c->text()) : null);
                    $numbers = array_values(array_filter($numbers));
                    
                    if ($prefix === 'P650') {
                        for ($i = 0; $i < 6; $i++) if (isset($numbers[$i])) $ttData[$prefix . ($i + 1)] = $numbers[$i];
                        if (isset($numbers[6])) $ttData[$prefix . 'EX'] = $numbers[6];
                    } else {
                        for ($i = 0; $i < 6; $i++) if (isset($numbers[$i])) $ttData[$prefix . ($i + 1)] = $numbers[$i];
                    }

                    if ($jackpot1 = $this->getNodeValueByLabel($gameTable, 'Jackpot 1')) $ttData[$prefix . 'JP1'] = str_replace('RM ', '', $jackpot1);
                    if ($jackpot2 = $this->getNodeValueByLabel($gameTable, 'Jackpot 2')) $ttData[$prefix . 'JP2'] = str_replace('RM ', '', $jackpot2);
                    if ($singleJackpot = $this->getNodeValueByLabel($gameTable, 'Jackpot')) {
                        if(!isset($ttData[$prefix . 'JP1'])) $ttData[$prefix . 'JP1'] = str_replace('RM ', '', $singleJackpot);
                    }
                }
            }

            // Lấy 5D & 6D
            //$fiveDTable = $this->extractPrizesByTable($crawler, 'TOTO 5D');
            $fiveDTable = $crawler->filterXPath("//td[@class='txt_white5' and contains(., 'TOTO 5D')]")->closest('table');            
            // var_dump($fiveDTable);
            //var_dump($fiveDTable->count());
            if ($fiveDTable->count() > 0) {
                $ttData['P5D1'] = $this->getNodeValueByLabel($fiveDTable, '1st Prize');
                $ttData['P5D2'] = $this->getNodeValueByLabel($fiveDTable, '2nd Prize');
                $ttData['P5D3'] = $this->getNodeValueByLabel($fiveDTable, '3rd Prize');
                $ttData['P5D4'] = $this->getNodeValueByLabel($fiveDTable, '4th Prize');
                $ttData['P5D5'] = $this->getNodeValueByLabel($fiveDTable, '5th Prize');
                $ttData['P5D6'] = $this->getNodeValueByLabel($fiveDTable, '6th Prize');
            }
            $sixDTable = $crawler->filterXPath("//td[@class='txt_white5' and contains(., 'TOTO 6D')]")->closest('table');
            //var_dump($sixDTable);
            if ($sixDTable->count() > 0) {
                $ttData['P6D1'] = $this->getNodeValueByLabel($sixDTable, '1st Prize');
                // 2. Xử lý các giải từ 2 đến 5 bằng cách phân tích khối
                $text = $sixDTable->text();
                for ($i = 2; $i <= 5; $i++) {
                    // Mẫu để xác định điểm bắt đầu của khối (ví dụ: "2nd Prize")
                    $start_pattern = $i . '(?:st|nd|rd|th) Prize';
                    
                    // Mẫu để xác định điểm kết thúc của khối (giải tiếp theo, hoặc kết thúc chuỗi)
                    $end_pattern = ($i < 5) ? ($i + 1) . '(?:st|nd|rd|th) Prize' : '$';

                    // Regex để lấy toàn bộ nội dung giữa hai điểm, /s cho phép '.' khớp với ký tự xuống dòng
                    if (preg_match('/' . $start_pattern . '(.*?)' . $end_pattern . '/s', $text, $block_match)) {
                        // $block_match[1] bây giờ chứa khối văn bản của giải hiện tại
                        // Ví dụ: "\n   14128\n   or\n   41285\n"
                        
                        // Tìm tất cả các số trong khối văn bản này
                        preg_match_all('/[\d]+/', $block_match[1], $number_matches);
                        
                        // Nếu tìm thấy 2 số, gán vào A và B
                        if (isset($number_matches[0]) && count($number_matches[0]) === 2) {
                            $ttData['P6D' . $i . 'A'] = $number_matches[0][0];
                            $ttData['P6D' . $i . 'B'] = $number_matches[0][1];
                        } 
                        // Nếu chỉ có 1 số, chỉ gán vào A (dự phòng)
                        else if (isset($number_matches[0]) && count($number_matches[0]) === 1) {
                            $ttData['P6D' . $i . 'A'] = $number_matches[0][0];
                        }
                    }
                }          
            }
            $fourDJackpotTable = $crawler->filterXPath("//td[contains(., 'TOTO 4D JACKPOT')]")->closest('table');
            if ($fourDJackpotTable->count() > 0) {
                 $ttData['JP1'] = $this->getNodeValueByLabel($fourDJackpotTable, 'Jackpot 1');
                 $ttData['JP2'] = $this->getNodeValueByLabel($fourDJackpotTable, 'Jackpot 2');
            }
            $ttData["ZODIAC"] = "";
            $ttData["JP1WON"] = "0";
            $ttData["JP2WON"] = "0";
            $ttData["P655JPWON"] = "0";
            $ttData["P658JPWON"] = "0";
            $ttData["P650JP1WON"] = "0";
            $ttData["P650JP2WON"] = "0";
            $ttData["ESTP658"] = $ttData["P658JP"];
            $ttData["ESTP655"] = isset($ttData["P655JP"])? $ttData["P655JP"]:"0";
            $ttData["ESTP650JP1"] = isset($ttData["P650JP1"])? $ttData["P650JP1"]:"0";
            $ttData["ESTP650JP2"] = isset($ttData["P650JP2"])? $ttData["P650JP2"]:"0";
            $ttData["ESTJP1"] = isset($ttData["JP1"])? $ttData["JP1"]:"0";
            $ttData["ESTJP2"] = isset($ttData["JP2"])? $ttData["JP2"]:"0";
        } else {
            CLI_write("Detected: Flat Text Structure.", 'yellow');
            
            // Lấy toàn bộ text và xử lý bằng Regex cho cấu trúc phẳng
            $text = $crawler->text();
            
            // 4D
            if (preg_match('/First Prize\s+\w\s+(\d{4})/', $text, $m)) $ttData['P1'] = $m[1];
            if (preg_match('/Second Prize\s+\w\s+(\d{4})/', $text, $m)) $ttData['P2'] = $m[1];
            if (preg_match('/Third Prize\s+\w\s+(\d{4})/', $text, $m)) $ttData['P3'] = $m[1];

            // Special Prizes
            if(preg_match('/Special Prize(.*?)Consolation Prize/s', $text, $specialBlock)) {
                preg_match_all('/(\d{4}|\*{4})/', $specialBlock[1], $matches);
                if (!empty($matches[0])) {
                    for ($i = 0; $i < 13; $i++) $ttData['S' . ($i + 1)] = $matches[0][$i] ?? '';
                }
            }

            // Consolation Prizes
            if(preg_match('/Consolation Prize(.*?)TOTO 4D JACKPOT/s', $text, $consolationBlock)) {
                preg_match_all('/(\d{4}|\*{4})/', $consolationBlock[1], $matches);
                 if (!empty($matches[0])) {
                    for ($i = 0; $i < 10; $i++) $ttData['C' . ($i + 1)] = $matches[0][$i] ?? '';
                }
            }

            // TOTO Games
            if (preg_match('/SUPREME TOTO 6\/58\s+((?:\d+\s+){5}\d+)/', $text, $m)) $ttData['P658'] = $m[1]; // Simplified
            // ... add other flat text regex here if needed ...

            // 5D & 6D
            if (preg_match('/TOTO 5D.*?1st Prize\s+(\d+)/s', $text, $m)) $ttData['P5D1'] = $m[1];
            if (preg_match('/TOTO 6D.*?1st Prize\s+(\d+)/s', $text, $m)) $ttData['P6D1'] = $m[1];
        }

        // --- PHẦN LƯU VÀO DATABASE (GIỮ NGUYÊN) ---
        $ttData['COMPLETED4D'] = !empty($ttData['P1']) ? 1 : 0;
        $ttData['COMPLETEDTOTO'] = !empty($ttData['P6D1']) ? 1 : 0;
        foreach ($ttData as $key => $value) {
            if ($value === null) {
                $ttData[$key] = "";
            }
        }
        $key = 'TT';
        $lottery_data = [
            'date' => $drawDate,
            'data' => json_encode($ttData),
            'type' => $key, 'name' => 'Toto', 'display_name' => 'Toto 4D 5D 6D',
            'draw_start' => !$ttData['COMPLETED4D'], 'draw_end' => $ttData['COMPLETED4D'],
            'ds' => !$ttData['COMPLETED4D'], 'df' => $ttData['COMPLETED4D'],
            'notes' => 'Note'
        ];
        //var_dump($ttData);
        $existing_data = $lotteryModel->getLotteryDataByDateAndType($drawDate, $key);
        if ($existing_data) {
            $lotteryModel->updateLotteryData($drawDate, $key, $lottery_data);
            CLI::write("Data updated for {$key} on {$drawDate}. Draw No: {$ttData['DN']}", 'yellow');
        } else {
            $lotteryModel->insertLotteryData($lottery_data);
            CLI::write("Data inserted for {$key} on {$drawDate}. Draw No: {$ttData['DN']}", 'green');
        }
    }
}