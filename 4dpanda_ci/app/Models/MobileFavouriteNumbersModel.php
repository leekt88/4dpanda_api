<?php
namespace App\Models;

use CodeIgniter\Model;

class MobileFavouriteNumbersModel extends Model
{
    protected $table = 'mobile_favourite_numbers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['device_token', 'favourite_number', 'os_name', 'permutation'];
 
    // Get all favourite numbers for a specific device token
    public function getFavouriteNumbersByToken($device_token)
    {
        return $this->where('device_token', $device_token)
                    ->findAll();
    }
    // Get for a specific device token
    public function getTokenByFavouriteNumber($number)
    {
        return $this->where('favourite_number', $number)
                    ->findAll();
    }

    // Add a favourite number
    public function addFavouriteNumber($device_token, $favourite_number, $os_name, $permutation)
    {
        $data = [
            'device_token' => $device_token,
            'favourite_number' => $favourite_number,
            'os_name' => $os_name,  
            'permutation'=> $permutation,
        ];

        $this->insert($data);
        return $this->insertID();
    }

    // Remove a favourite number
    public function removeFavouriteNumber($device_token, $favourite_number)
    {
        return $this->where('device_token', $device_token)
                    ->where('favourite_number', $favourite_number)
                    ->delete();
    }
    // Remove by $device_token
    public function removeFavouriteNumbersByToken($device_token){
        return $this->where('device_token', $device_token)
                    ->delete();
    }
    // Check if a favourite number already exists
    public function favouriteNumberExists($device_token, $favourite_number)
    {
        $result = $this ->where('device_token', $device_token)
                        ->where('favourite_number', $favourite_number)
                        ->first();
        return $result;
    }
}
