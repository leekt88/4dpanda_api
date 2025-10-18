<?php
namespace App\Models;

use CodeIgniter\Model;

class MobileFavouriteNumbersPermutationModel extends Model
{
    protected $table = 'mobile_favourite_numbers_permutation';
    protected $primaryKey = 'id';
    protected $allowedFields = ['favourite_number_id', 'permuted_number', 'notification'];
 
    // Get all favourite numbers for a specific device token
    public function getPermutationNumbersByFavouriteNumberId($id)
    {
        return $this->where('favourite_number_id', $id)
                    ->findAll();
    }
    public function addPermutationNumber($id, $permutation_numbers)
    {
    $data = [];
    foreach ($permutation_numbers as $number) {
        $data[] = [
            'favourite_number_id' => $id,
            'permuted_number' => $number, 
        ];
    }
    // Chèn tất cả các hàng vào cơ sở dữ liệu
    return $this->insertBatch($data); 
    }
}
