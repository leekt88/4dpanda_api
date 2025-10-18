<?php namespace App\Models;

use CodeIgniter\Model;

class NumberHistoryModel extends Model
{
    protected $table = 'lottery_history_results';
    protected $primaryKey = 'id';
    protected $allowedFields = ['number', 'data', 'meaning', 'top_hot', 'magnum4d','damacai', 'sportstoto','singapore4d', 'cashsweep', 'sabah88','stc4d','created_at', 'updated_at'];
        // Insert or update data
        public function insertOrUpdate($number, $data, $meaning = null, $top_hot = null, $hit)
        {
            $db = \Config\Database::connect();
            $builder = $db->table($this->table);
    
            // Check if number exists
            $existing = $builder->getWhere(['number' => $number])->getRow();
    
            if ($existing) {
                $data = [
                    'data' => json_encode($data),
                    'meaning' => $meaning? json_encode($meaning): null,
                    'top_hot' => $hit?json_encode($hit):null,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                 // Thêm các cặp key-value từ $top vào $updateData
                foreach ($top_hot as $key => $value) {
                    $data[$key] = $value;
                }
                $builder->where('number', $number);
                $builder->update($data);
            } else {
                $data = [
                    'number' => $number,
                    'data' => json_encode($data),
                    'top_hot' => $hit?json_encode($hit):null,
                    'meaning' => $meaning? json_encode($meaning): null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                // Thêm các cặp key-value từ $top vào $updateData
                foreach ($top_hot as $key => $value) {
                    $data[$key] = $value;
                }
                $builder->insert($data);
            }
        }
        /*
        */
        public function getResultsByNumber($number) {
            
            $data = $this->where('number', $number)->first();
            return $data;
        }
        /*
        */
        public function getResultsByNumbers($numbers){
            $data = $this->whereIn('number', $numbers)->findAll();
            return $data;
        }
        /*
        */
        public function getResultsByMeaning($keyword){
            // Chuyển chuỗi tìm kiếm về chữ thường
            $lowercaseKeyword = strtolower($keyword);

            // Tạo truy vấn SQL tùy chỉnh để tìm kiếm không phân biệt chữ hoa, chữ thường
            $data = $this->db->table($this->table)
                                ->select('number, meaning')
                                ->where("LOWER(meaning) LIKE '%" . $this->db->escapeLikeString($lowercaseKeyword) . "%'", null, false)
                                ->get()
                        ->getResultArray();

            //$data = $this->like('meaning', $keyword)
            //        ->select('number, meaning')
            //        ->findAll();
            // Chuyển từ tìm kiếm sang biểu thức chính quy để tìm whole words
            $keywordPattern = '\b' . preg_quote($keyword, '/') . '\b';
            // Nếu keyword có chứa ký tự tiếng Trung, chỉ dùng strpos để tìm kiếm
            $isChineseKeyword = preg_match("/\p{Han}+/u", $keyword);
            $res = [];
            foreach($data as $key=>$result){
                $meanings = json_decode($result['meaning'], true);
                if (is_array($meanings)) {
                    $matchedMeanings=[];
                    foreach ($meanings as $value) {
                        // Check for whole word in English
                        $englishMatch = preg_match("/$keywordPattern/i", $value['meaning']);
                        // Check for exact match in Chinese
                        $chineseMatch = strpos($value['meaning'], $keyword) !== false;
                        // If keyword is Chinese, only use Chinese match
                        if ($isChineseKeyword && $chineseMatch) {
                            $matchedMeanings[] = $value;
                        } 
                        // If keyword is not Chinese, use both English and Chinese matches
                        else if (!$isChineseKeyword && ($englishMatch)){//} || $chineseMatch)) {
                            $matchedMeanings[] = $value;
                        }
                    }
                    if (!empty($matchedMeanings)) {
                        $res[$key]['number'] = $result['number'];
                        $res[$key]['meaning'] = json_encode($matchedMeanings); 
                    }
                }
            }
            return $res;
        }  
        /*
        */
        public function getTop15($operator)
    {
        return $this->orderBy($operator, 'DESC')
                    ->select('number, ' . $operator)
                    ->limit(15)
                    ->findAll();
    }      
}
