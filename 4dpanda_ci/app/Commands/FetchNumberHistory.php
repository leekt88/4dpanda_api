<?php namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\NumberHistoryModel;

class FetchNumberHistory extends BaseCommand
{
    protected $group = 'Lottery';
    protected $name = 'fetch:number-history';
    protected $description = 'Fetch lottery history data for all 4D numbers';

    public function run(array $params)
    {
        $client = new Client();
        $model = new NumberHistoryModel();
        
        for ($i = 0; $i <= 9999; $i++) {
            $number = str_pad($i, 4, '0', STR_PAD_LEFT);
            $url = "https://www.fast4dking.com/num_detail.php?number={$number}&M=on&ST=on&PMP=on&SG=on&CS=on&EE=on&STC=on";
            
            try {
                $response = $client->get($url);
                $html = $response->getBody()->getContents();
                $crawler = new Crawler($html);
                $results= $this->parseResults($crawler);
                $data = $results['data'];
                $top = $results['top'];
                $hit = $results['hit'];
                //var_dump($hit);exit();
                $meaning = $this->parseDreamMeanings($crawler);
                
                /*$history[] = [
                    'number' => $number,
                    'data' => json_encode($data),
                    'meaning' => json_encode($meaning, $number),
                ];*/
                $model->insertOrUpdate($number, $data, $meaning, $top, $hit);
                CLI::write("Fetched data for number: {$number}");
            } catch (\Exception $e) {
                CLI::error("Failed to fetch data for number: {$number}. Error: " . $e->getMessage());
            }
        }
    }
    private function parseResults(Crawler $crawler)
    {
        $data = [];
        $top=[];
        $hit =[];
        $crawler->filter('table#history tbody tr')->each(function (Crawler $row) use (&$data, &$top, &$hit) {
            $imageElement = $row->filter('td')->eq(5)->filter('img');
            $imageUrl = $imageElement->attr('src');
            if (strpos($imageUrl, 'http') === false) {
                $imageUrl = 'https:' . $imageUrl;
            }
            $imageFileName = basename($imageUrl);
            $type = trim(strtolower(str_replace(" ","",$imageElement->attr('title'))));
            $prize = $row->filter('td')->eq(1)->text();
            $pr = explode("-", $prize);
            $prz = isset($pr[1])?$pr[1]:$pr[0];
            $data[] = [
                'number' => $row->filter('td')->eq(0)->text(),
                'prize' => $prz,
                'draw_id' => $row->filter('td')->eq(2)->filter('a')->text(),
                'date' => $row->filter('td')->eq(3)->text(),
                'day' => $row->filter('td')->eq(4)->text(),
                'type' => $type,
                'name' => $imageElement->attr('title'),
                'image_url' => base_url("assets/images/lotto/$imageFileName"),
                'gap' => $row->filter('td')->eq(6)->text(),
            ];
            $top[$type] = isset($top[$type])?$top[$type]+1: 1;
            $hit[$prize] = isset($hit[$prize])? $hit[$prize]+1: 1;
        });
        return ['data'=>$data, 'top'=>$top, 'hit'=> $hit];
    }

    private function parseDreamMeanings(Crawler $crawler)
    {
        $dreamMeanings = [];
        $crawler->filter('table#no')->eq(3)->filter('tr')->each(function (Crawler $row) use (&$dreamMeanings) {
            $columns = $row->filter('td');
            for ($i = 0; $i < $columns->count(); $i += 2) {
                $number = $columns->eq($i)->text();
                $meaning = $columns->eq($i + 1)->text();
                $imageElement = $columns->eq($i + 1)->filter('img');
                $imageUrl = $imageElement->attr('src');
                $lotteryName = $imageElement->attr('alt');
                // Nếu URL ảnh không có domain, thêm domain vào
                if (strpos($imageUrl, 'http') === false) {
                    $imageUrl = 'https:' . $imageUrl;
                }
                // Lấy tên file ảnh từ URL
                $imageFileName = basename($imageUrl);
                $dreamMeanings[] = [
                    'number' => $number,
                    'meaning' => trim($meaning),
                    'image_url' => base_url("assets/images/lotto/$imageFileName"),
                    'image_file_name' => $imageFileName,
                    'lottery_name' => $lotteryName,
                    'type' => trim(strtolower(str_replace(" ","",$lotteryName))),
                ];
            }
        });
        return $dreamMeanings;
    }
}
