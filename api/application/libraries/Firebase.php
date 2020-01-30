<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require __DIR__.'/../../vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging\CloudMessage;

class Firebase{
    protected $config   = array();
    protected $serviceAccount;

    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
        $this->serviceAccount = ServiceAccount::fromJsonFile($this->CI->config->item('firebase_app_key'));
    }
    
    public function init()
    {
        return $firebase = (new Factory)->withServiceAccount($this->serviceAccount)->create();
    }

    public function createUser($data){
        
        $firebaseVal = $this->init();
        $auth = $firebaseVal->getAuth();
        $userProperties = [
            'email' => $data['email'],
            'emailVerified' => $data['verified'],
            'password' => $data['password'],
            'displayName' => $data['name'],
            'disabled' => false,
        ];

        $createdUser = $auth->createUser($userProperties);

        return $createdUser;
    }


    public function sendMessage($title,$body,$payload){
        $messaging = (new Firebase\Factory())->createMessaging();

        $message = CloudMessage::withTarget(/* see sections below */)
            ->withNotification(Notification::create($title, $body))
            ->withData($payload);

        $messaging->send($message);
    }
}