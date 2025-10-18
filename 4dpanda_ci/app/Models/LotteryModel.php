<?php

namespace App\Models;

use CodeIgniter\Model;

class LotteryModel extends Model
{
    protected $table = 'lottery_data';
    protected $primaryKey = 'id';
    protected $allowedFields = ['date', 'data', 'type', 'name','display_name', 'notes', 'draw_start', 'draw_end', 'start_notification_send','end_notification_send','ds','df','dsn','dfn'];
    protected $useTimestamps = true; // Cho phép CodeIgniter sử dụng các timestamps

    protected $createdField = 'created_at'; // Trường thời gian tạo mới
    protected $updatedField = 'updated_at'; // Trường thời gian cập nhật
     
    public function getLotteryDataByDateAndType($date, $type)
    {
        return $this->where(['date' => $date, 'type' => $type])->first();
    }
    public function getLotteryDataByType($type)
    {
        return $this->where(['type' => $type])->orderBy('id', 'DESC')->first();
    }
    public function getLotteryPastDataByType($type)
    {
        return $this->where(['type' => $type])->orderBy('id', 'DESC')->limit(3)->findAll();
    }
    public function getLotteryDataByDate($date)
    {
        return $this->where('date',$date)->findAll();
    }    
    public function insertLotteryData($data)
    {
        return $this->insert($data);
    }
    public function getLotteryDateByType($type){
        return $this->where(['type' => $type])
                    ->orderBy('id', 'DESC')
                    ->select(['date'])
                    ->limit(10)
                    ->findAll();
    }
    public function getLotteryDateByTypeDate($type, $date){
        return $this->where(['type' => $type])
                    ->where('DATE_FORMAT(date, "%Y-%m") =', $date)
                    ->orderBy('id', 'DESC')
                    ->select(['date'])
                    ->findAll();
    }
    public function updateLotteryData($date, $type, $data)
    {
        return $this->where(['date' => $date, 'type' => $type])->set($data)->update();
    }
    public function getLotteryDrawStartToSend(){
        return $this->where(['draw_start'=> 1, 'start_notification_send'=> 0, 'draw_end' => 0])
                    ->select(['id','type', 'date'])
                    ->findAll();
    }
    public function getLotteryDrawEndToSend(){
        return $this->where(['draw_start'=> 0, 'end_notification_send'=> 0, 'draw_end' => 1])
                    ->select(['id', 'date','data', 'type'])
                    ->findAll();
    }
    public function updateStartNotificationSent($ids){
        return $this->whereIn('id', $ids)
                    ->set(['start_notification_send'=>1])
                    ->update();
    }
    public function updateEndNotificationSent($ids){
        return $this->whereIn('id',$ids)
                    ->set(['end_notification_send'=>1])
                    ->update();
    }
    public function getLotteryDataById($id){
        return $this->where(['id' => $id])
                    ->select(['data'])
                    ->limit(7)
                    ->first();
    }
}
