<?php

namespace App\Models;

use CodeIgniter\Model;

class MobileNotificationModel extends Model
{
    protected $table = 'mobile_notification_settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['device_token', 'lottery_type', 'lottery_name', 'master_notification', 'notify_start', 'notify_end', 'os_name'];
    // Fetch preferences by device ID
    public function getNotificationSettingsByDeviceId($deviceId)
    {
        return $this->where('device_id', $deviceId)->findAll();
    }
    //  Fetch  pending device notification
    public function getPendingDrawStartNotifications($lottos){
        // Kiểm tra nếu $lottos không rỗng thì mới gọi whereIn
        if (empty($lottos) || !is_array($lottos)) {
            return [];
        }
        $this->where(['master_notification' => 1,'notify_start' => 1, 'os_name' =>"Android"]);
        $this->whereIn('lottery_name', $lottos);
        $result =  $this->findAll();
        // In ra câu lệnh SQL cuối cùng để kiểm tra
        //echo $this->db->getLastQuery();
        return $result;
    }
    //  Fetch  pending device notification
    public function getPendingDrawEndNotifications($lottos){
        // Kiểm tra nếu $lottos không rỗng thì mới gọi whereIn
        if (empty($lottos) || !is_array($lottos)) {
            return [];
        }
        $result=[];
        foreach($lottos as $key=>$lotto){
            $result[$key] =  $this->where('master_notification', 1)
                        ->where('notify_end', 1)
                        ->whereIn('lottery_name', $lottos)
                        ->where('os_name', "Android")
                        ->findAll();
        }
        return $result;
    }
    // Save or update preferences
    public function saveNotificationSettings($deviceId, $lotteryType, $lotteryName, $masterNotification, $notifyStart, $notifyEnd, $os_name = null)
    {
        // Check if the preference already exists
        $existing = $this->where('device_token', $deviceId)
                         ->where('lottery_type', $lotteryType)
                         ->where('lottery_name', $lotteryName)
                         ->first();

        if ($existing) {
            // Update existing record
            return $this->update($existing['id'], [
                'master_notification' => $masterNotification,
                'notify_start' => $notifyStart,
                'notify_end' => $notifyEnd,
                'os_name' => $os_name,
            ]);
        } else {
            // Insert new record
            return $this->insert([
                'device_token' => $deviceId,
                'lottery_type' => $lotteryType,
                'lottery_name' => $lotteryName,
                'master_notification' => $masterNotification,
                'notify_start' => $notifyStart,
                'notify_end' => $notifyEnd,
                'os_name' => $os_name
            ]);
        }
    }
    public function deleteToken($deviceToken)
    {
        $this->where('device_token', $deviceToken)->delete();
    }
}