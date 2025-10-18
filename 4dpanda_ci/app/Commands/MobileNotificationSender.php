<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Google\Auth\Credentials\ServiceAccountCredentials;
use CodeIgniter\HTTP\CURLRequest;

class MobileNotificationSender extends BaseCommand
{
    protected $group = 'Notifications';
    protected $name = 'notifications:send';
    protected $description = 'Send notifications to users based on their preferences.';

    public function run(array $params)
    {
        $client = service('curlrequest');
        $serviceAccountPath = WRITEPATH . 'live-4d-results-a8654-firebase-adminsdk-wbb30-754b4db893.json';

        // Define the scope for FCM
        $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];
        // Create a credentials object
        $credentials = new ServiceAccountCredentials($scopes, $serviceAccountPath);

        // Obtain the OAuth 2.0 token
        $authToken = $credentials->fetchAuthToken();

        // Get the actual token value
        $accessToken = $authToken['access_token'];

        // Load the model to access notification settings
        $notificationModel = new \App\Models\MobileNotificationModel();

        $lottos = $this->getLottertTypeToSend();
        //var_dump($lottos);
        $startList = $notificationModel->getPendingDrawStartNotifications($lottos[0]);
        $endList = $notificationModel->getPendingDrawEndNotifications($lottos[1]);
        //var_dump($endList); die();
        foreach ($startList as $notification) {
            $this->sendStartNotification($accessToken, $notification);
        }
        $this->updateStartNotificationStatus($lottos[0]);
        // Load the model to lottery data
        $lotteryModel = new \App\Models\LotteryModel();
        foreach ($endList as $key=>$notifications) {
            foreach($notifications as $notification){
                //var_dump($notification);die();

                $data = $lotteryModel->getLotteryDataById($key);
                $body = json_decode($data['data'], true);
                $body = '1ST: '.$body['P1'].' - 2ND: '.$body['P2'].' - 3RD: '.$body['P3'];
                $this->sendEndNotification($accessToken, $notification, $body);
            }
        }
        $this->updateEndNotificationStatus($lottos[1]);

    }
    private function updateStartNotificationStatus($lottos){
        if(empty($lottos) || !is_array($lottos)) return;
        $lotteryModel = new \App\Models\LotteryModel();
        $ids = [];
        foreach ($lottos as $key=>$value){
            $ids[] = $key;
        }
        //var_dump($ids);
        $lotteryModel->updateStartNotificationSent($ids);
    }
    private function updateEndNotificationStatus($lottos){
        if(empty($lottos) || !is_array($lottos)) return;
        $lotteryModel = new \App\Models\LotteryModel();
        $ids = [];
        foreach ($lottos as $key=>$value){
            $ids[] = $key;
        }
        $lotteryModel->updateEndNotificationSent($ids);
    }
    private function getLottertTypeToSend(){
        // Load the model to lottery data
        $lotteryModel = new \App\Models\LotteryModel();
        $dict = [
                "M4D" => "Magnum",
                "M4DJG" => "Magnum",
                "DMC4D" => "Damacai",
                "DMC6D" => "Damacai",
                "TT" => "Toto",
                "GD" => "Grand Dragon",
                "P4D1" => "Perdana",
                "P4D2" => "Perdana",
                "NLT" => "9 Lotto",
                "H4D6D1" => "Lucky Hari Hari",
                "H4D6D2" => "Lucky Hari Hari",
                "STC" => "Sandakan",
                "SCS" => "Cash Sweep",
                "SB" => "Sabah",
                "SBLT" => "Sabah",
                "SGP4D" => "Singapore Pools",
                "SGPTT" => "Singapore Pools",
                "LMC1" => "Lotto Macao",
                "LMC" => "Lotto Macao",
                "MTH" => "Matahari",
                ];
        $drawStartList = $lotteryModel->getLotteryDrawStartToSend();
        $lottoStartList=[];
        foreach ($drawStartList as $drawStart){
            $lottoStartList[$drawStart['id']] = $dict[$drawStart['type']];
        }
        $drawEndList = $lotteryModel->getLotteryDrawEndToSend();

        $lottoEndList = [];
        foreach ($drawEndList as $drawEnd){
            $lottoEndList[$drawEnd['id']] = $dict[$drawEnd['type']];
        }
        return [$lottoStartList, $lottoEndList];
    }
    private function sendStartNotification($accessToken, $notification)
    {
        $deviceToken = $notification['device_token'];
        $title = "Live 4D Results";
        $body = "{$notification['lottery_name']} Start Drawing. Good Luck!.";
        
        $this->sendFirebaseNotification($accessToken, $deviceToken, $title, $body, $notification['lottery_name']);
    }
    private function sendEndNotification($accessToken, $notification, $body)
    {
        $deviceToken = $notification['device_token'];
        $title = "{$notification['lottery_name']} Results Available";
        
        $this->sendFirebaseNotification($accessToken, $deviceToken, $title, $body, $notification['lottery_name']);
    }
    private function sendFirebaseNotification($accessToken, $deviceToken, $title, $body, $lottery)
    {
        $client = \Config\Services::curlrequest();
        $payload = [
            'message' => [
                'token' => $deviceToken,
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
                'data'=>[
                    'lottery' => $lottery
                ],

            ],
        ];
        try {
            $response = $client->setBody(json_encode($payload))
                ->setHeader('Authorization', 'Bearer ' . $accessToken)
                ->setHeader('Content-Type', 'application/json')
                ->post('https://fcm.googleapis.com/v1/projects/live-4d-results-a8654/messages:send');
        
            if ($response->getStatusCode() === 404) {
                $responseData = json_decode($response->getBody(), true);
                if (isset($responseData['error']['details'][0]['errorCode']) && $responseData['error']['details'][0]['errorCode'] === 'UNREGISTERED') {
                    // Token is no longer valid, remove it from the database
                    $this->removeInvalidToken($deviceToken);
                }
            } elseif ($response->getStatusCode() !== 200) {
                CLI::error('Failed to send notification: ' . $response->getBody());
            }
            else{
                CLI::write("Notification sent successfully! to: $deviceToken" , 'green');
            }
        }
        catch (\Exception $e) {
            CLI::error('Error sending notification to ' . $deviceToken . ': ' . $e->getMessage());
            if("22 : The requested URL returned error: 404" === $e->getMessage()){
                // Token is no longer valid, remove it from the database
                $this->removeInvalidToken($deviceToken);
                CLI::write('Removed token ID: ' .$deviceToken, 'green');
            }
        }
    }
    private function removeInvalidToken($deviceToken)
    {
        $notificationModel = new \App\Models\MobileNotificationModel();
        $notificationModel->deleteToken($deviceToken);
        CLI::write('Removed invalid token: ' . $deviceToken, 'yellow');
    }
    
    private function getLotteryUpdates()
    {
        // Logic to get updates based on user preferences
        // This will vary depending on your database structure and requirements
        return [
            'Magnum' => 'New results available!',
            // Add more lottery updates here
        ];
    }
}
