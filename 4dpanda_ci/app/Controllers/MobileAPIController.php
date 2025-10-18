<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MobileNotificationModel;
use App\Models\MobileFavouriteNumbersModel;
use App\Models\MobileFavouriteNumbersPermutationModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\API\ResponseTrait;

class MobileAPIController extends ResourceController
{
    public function __construct()
    {
        $this->notificationModel = new MobileNotificationModel();
        $this->favouriteNumberModel = new MobileFavouriteNumbersModel();
        $this->favouriteNumberPermutationModel = new MobileFavouriteNumbersPermutationModel();
    }
    public function saveNotificationSettings()
    {
        $request = \Config\Services::request();
        //$json = '{"device_token":"dQhK7facQCGhDGeU0uLV4Q:APA91bH3SWmDiPnWIj0LrhgW00irSeBEUYbTmSp_u8kl34bzdxDToWvtX8DxjMJ2cLr7J9f60JIdILyowSiSNtRo4Lc4d4uJZHVc4K32sWg2GlvXFRV3ljUacD7GlZhQcIyk_QTK2FrU","master_notification":true,"os_name":"Android","preferences":[{"lottery_type":"Magnum","lottery_name":"Magnum","notify_start":false,"notify_end":false},{"lottery_type":"Damacai","lottery_name":"Damacai","notify_start":true,"notify_end":true},{"lottery_type":"Toto","lottery_name":"Toto","notify_start":false,"notify_end":false},{"lottery_type":"Grand Dragon","lottery_name":"Grand Dragon","notify_start":true,"notify_end":true},{"lottery_type":"Perdana","lottery_name":"Perdana","notify_start":true,"notify_end":true},{"lottery_type":"9 Lotto","lottery_name":"9 Lotto","notify_start":true,"notify_end":true},{"lottery_type":"Lucky Hari Hari","lottery_name":"Lucky Hari Hari","notify_start":true,"notify_end":true},{"lottery_type":"Sandakan","lottery_name":"Sandakan","notify_start":true,"notify_end":true},{"lottery_type":"Cash Sweep","lottery_name":"Cash Sweep","notify_start":true,"notify_end":true},{"lottery_type":"Sabah","lottery_name":"Sabah","notify_start":true,"notify_end":true},{"lottery_type":"Singapore Pools","lottery_name":"Singapore Pools","notify_start":true,"notify_end":true},{"lottery_type":"Lotto Macao","lottery_name":"Lotto Macao","notify_start":false,"notify_end":false},{"lottery_type":"Matahari","lottery_name":"Matahari","notify_start":false,"notify_end":false}],"timestamp":"1724738519590","secure_token":"0110f3ccfe968ed2e2adc9f46ceaf1fcec850a0f84cd8e9b316ef18902a175fb"}';
        $input = json_decode($request->getBody(), true); // Correctly decode the JSON input
        //$input = json_decode($json, true); // Correctly decode the JSON input
        // Validate the input data
        if (!$this->validateInput($input)) {
            return $this->fail('Invalid input data', 400);
        }

        // Extract the device token and preferences
        $deviceToken = $input['device_token'] ?? null;
        $masterNotification = $input['master_notification'] ?? null;
        $os_name = $input['os_name']?? 'Unknown';
        $preferences = $input['preferences'] ?? [];
        $secureToken = $input['secure_token'] ?? null;

        // Generate the expected secure token on the server side
        $expectedToken = $this->generateSecureToken($input);

        // Verify the secure token
        if ($secureToken !== $expectedToken) {
            return $this->fail('Invalid secure token', 401);
        }

        // Process each lottery preference
        foreach ($preferences as $preference) {
            $lotteryType = $preference['lottery_type'];
            $lotteryName = $preference['lottery_name'];
            $notifyStart = $preference['notify_start'];
            $notifyEnd = $preference['notify_end'];

            // Save the preferences into the database
            $this->savePreference($deviceToken, $lotteryType, $lotteryName, $masterNotification, $notifyStart, $notifyEnd, $os_name);
        }

        return $this->respond(['message' => 'Notification settings updated successfully'], 200);
    }

    private function savePreference($deviceToken, $lotteryType, $lotteryName, $masterNotification, $notifyStart, $notifyEnd, $os_name)
    {
        $this->notificationModel->saveNotificationSettings($deviceToken, $lotteryType, $lotteryName, $masterNotification, $notifyStart, $notifyEnd, $os_name);
    }

    /*
    * FavouriteNumbers Part
    */
    // Add a new favourite number
    public function addFavouriteNumbers()
    {
        $request = \Config\Services::request();
        //$json = '{"device_token":"e4pE-fwRUk3ZjRCS8nASQV:APA91bEsu6P4e7l1fUtY-c9gQXbYI-aMDBVk9jTrh68VdF4SC3Mdf7_xmYsBTZ6PqNpbhN00OvpT5Jf7_xrxN_Dk5GtVp5O-PdtVtcP-GS3WeWftuZzZFgDChJmWtWhPobPM0cSSI6IJ","favourite_numbers":"{\"number\":\"3453\",\"permutation\":\"on\",\"related_numbers\":[\"3453\",\"3435\",\"3543\",\"3534\",\"3354\",\"3345\",\"4353\",\"4335\",\"4533\",\"5433\",\"5343\",\"5334\"]}","os_name":"iOS","timestamp":"1726394626757","secure_token":"8da695a2d9ce66e7a61cf17d3bd4f5ed89d1c1f89065c0b9d5b07980da0d895c"}';
        //$input = json_decode($json, true); // Correctly decode the JSON input
        $input = json_decode($request->getBody(), true); // Correctly decode the JSON input
        //var_dump($input);
        // Extract the device token and favourite numbers
        $deviceToken = $input['device_token'] ?? null;
        $os_name = $input['os_name']?? 'Unknown';
        $options = $input['options']?? null;
        $favourite_numbers = json_decode($input['favourite_numbers'], true) ?? [];
        //var_dump($favourite_numbers);die();
        $favourite_number = $favourite_numbers['number'] ?? null;
        $permutation_numbers = $favourite_numbers['related_numbers']?? [];
        $permutation = $favourite_numbers['permutation']?? "off";
        $secureToken = $input['secure_token'] ?? null;

        // Generate the expected secure token on the server side
        $expectedToken = $this->generateSecureToken($input);
        // Verify the secure token
        if ($secureToken !== $expectedToken) {
            return $this->fail('Invalid secure token', 401);
        }
        if(!$favourite_numbers || !$deviceToken || !$secureToken){
            return  $this->fail('Missing information', 400);
        }
            
        if ($this->favouriteNumberModel->favouriteNumberExists($deviceToken, $favourite_number)) {
            $this->favouriteNumberModel->removeFavouriteNumber($deviceToken, $favourite_number);
        }
        $id = $this->favouriteNumberModel->addFavouriteNumber($deviceToken, $favourite_number, $os_name, $permutation=="on"?1:0);
        if(!$id){
            return  $this->fail('Failed to add Favourite Numbers', 400);
        }
        $result = $this->favouriteNumberPermutationModel->addPermutationNumber($id, $permutation_numbers);
        if(!$result){
            return  $this->fail('Failed to add Favourite Numbers', 400);
        }
        return  $this->respond('Favourite Numbers Updated Successfully', 200);
    }

    // Remove a favourite number
    public function removeFavouriteNumber()
    {
        $request = \Config\Services::request();
        //$json = '{"device_token":"cksImoDTTFqHupN8bgtS4H:APA91bFzOAc2lsVcv4bibmkqX6i2IE_7ICyFZYRZ1kuUaDX4UwIHb-MsPE6bobEN8pGgGRHtz6U_-8W6j4ItllCa4jcjKLa5oATHrAhbBHbyWxY4KLzvA5xOaduHzHji7-msven2LXdv","favourite_number":"2345","timestamp":"1725430278871","secure_token":"f6e0cdbe96769659a73427f6ed11ca4dc69834979edd4db8d5da951d8ac83931"}';
        $input = json_decode($request->getBody(), true); // Correctly decode the JSON input
        //$input = json_decode($json, true); // Correctly decode the JSON input
        //var_dump($input);
        // Extract the device token and favourite numbers
        $deviceToken = $input['device_token'] ?? null;
        $favourite_numbers = $input['favourite_numbers'] ?? [];
        $os_name = $input['os_name']?? 'Unknown';
        $secureToken = $input['secure_token'] ?? null;

        // Generate the expected secure token on the server side
        $expectedToken = $this->generateSecureToken($input);
        // Verify the secure token
        if ($secureToken !== $expectedToken) {
            return $this->fail('Invalid secure token', 401);
        }

        if (!$deviceToken || !$favourite_numbers) {
            return  $this->fail('Missing information', 400);
        }
        $result = $this->favouriteNumberModel->removeFavouriteNumber($deviceToken, $favourite_numbers);
        if(!$result) {
            return  $this->fail('Failed to remove '. $favourite_number, 400);
        }
        return $this->respond("Successfully", 200);
    }

    /**
     * 
     *  END
     */

    private function validateInput($input)
    {
        if (!isset($input['device_token']) || !is_string($input['device_token'])) {
            return false;
        }

        if (!isset($input['master_notification']) || !is_bool($input['master_notification'])) {
            return false;
        }

        if (!isset($input['preferences']) || !is_array($input['preferences'])) {
            return false;
        }

        foreach ($input['preferences'] as $preference) {
            if (!isset($preference['lottery_name']) || !is_string($preference['lottery_name'])) {
                return false;
            }

            if (!isset($preference['notify_start']) || !is_bool($preference['notify_start'])) {
                return false;
            }

            if (!isset($preference['notify_end']) || !is_bool($preference['notify_end'])) {
                return false;
            }
        }

        return true;
    }

    private function generateSecureToken($data)
    {
        // We assume the SecurityHelper in the Flutter app and this method use the same logic
        $secretKey = getenv('SECRET_KEY');;
        unset($data['secure_token']); // Remove the secure token before hashing

        ksort($data); // Sort the array by key
        $dataString = json_encode($data);

        return hash_hmac('sha256', $dataString, $secretKey);
    }

}
