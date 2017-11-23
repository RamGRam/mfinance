<?php

App::uses('Controller', 'Controller');
App::uses('CrudControllerTrait', 'Crud.Lib');
App::uses('String', 'Utility');

class AppController extends Controller {

    use CrudControllerTrait;

    public $components = array(
        'DebugKit.Toolbar',
        'RequestHandler',
        'Paginator',
        'Session',
//        'EmailQueue.EmailQueue',
        'Auth' => array(
            'authenticate' => array(
                'Form',
            ),
            'authorize' => array('Controller'),
            'loginAction' => array(
                'plugin' => null,
                'controller' => 'users',
                'action' => 'login'
            ),
            'flash' => array(
                'element' => 'alert',
                'key' => 'auth',
                'params' => array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-error'
                )
            ),
        ),
        'Cookie',
        'Crud.Crud',
    );
    public $helpers = array(
        'Session',
        'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
        'Form' => array('className' => 'BoostCake.BoostCakeForm'),
        'Paginator' => array('className' => 'AppPaginator'),
        'Minify' => array('className' => 'Minify.Minify'),
    );

    public function beforeFilter() {
 
        $this->Session->valid();
        parent::beforeFilter();
        
        if ($this->Crud->action()->config('className') == 'Crud.Index') {
            $this->Crud->addListener('Search');
        }
        

        if ($this->request->is('json') || $this->request->is('xml')) {
            // Allow all through API
            if (in_array($this->request->action, array('api_login'))) {
                $this->Auth->allow($this->request->action);
            } else {
                $this->loadModel('User');
                $token = $this->User->hash($this->request->header('AuthToken'), Configure::read('Security.salt'));
                $userData = $this->User->findByAppToken($token);
                if (!empty($userData) && $userData['User']['active'] == 1) {
                    $this->Auth->login($userData['User']);
                    $this->Auth->allow($this->request->action);
                } else {
                    throw new UnauthorizedException('Unauthorized Access');
                }
            }

            $this->Crud->addListener('Api');
            if ($this->Crud->action()->config('className') == 'Crud.Index') {
                $this->Crud->addListener('ApiPagination');
                $this->Crud->addListener('ApiFieldFilter');
                $whitelistedModels = array_merge(array_keys($this->{$this->modelClass}->belongsTo), array_keys($this->{$this->modelClass}->hasOne), array_keys($this->{$this->modelClass}->hasMany), array_keys($this->{$this->modelClass}->hasAndBelongsToMany));
                $this->Crud->listener('ApiFieldFilter')->whitelistModels($whitelistedModels);
            }
            $this->Crud->addListener('ApiQueryLog');
        } else {

            if ($this->Crud->action()->config('className') == 'Crud.Index' && $this->request->is('post')) {
                $data = $this->data[$this->modelClass];
                $url = array_merge(array('action' => 'index'), $data);
                $this->redirect(array('action' => 'index', '?' => $data), 303);
            }

            if (!isset($this->request->params['prefix'])) {
                // Allow all in user panel
                $this->Auth->allow($this->request->action);
            } else {
                $this->layout = $this->request->params['prefix'] . ($this->Auth->loggedIn() ? '' : '_login');
            }
        }

        $this->Crud->action()->config('messages.success', array('element' => 'BoostCake.alert', 'params' => array('class' => 'alert-success')));
        $this->Crud->action()->config('messages.error', array('element' => 'BoostCake.alert', 'params' => array('class' => 'alert-danger')));

        $this->Crud->on('beforePaginate', function(CakeEvent $event) {
            if (isset($this->request->query['limit'])) {
                $event->subject->paginator->settings['limit'] = $this->request->query['limit'];
            }
            if (isset($this->request->query['page'])) {
                $event->subject->paginator->settings['page'] = $this->request->query['page'];
            }
        });

        $method_name = 'validate' . Inflector::camelize($this->request->action);

        if (method_exists($this->{$this->modelClass}, $method_name)) {
            $this->{$this->modelClass}->validate = $this->{$this->modelClass}->{$method_name}();
        }

        foreach (array('belongsTo', 'hasOne', 'hasMany') as $assoc) {
            foreach ($this->{$this->modelClass}->{$assoc} as $assocModel => $tmp) {
                if (method_exists($this->{$this->modelClass}->{$assocModel}, $method_name)) {
                    $this->{$this->modelClass}->{$assocModel}->validate = $this->{$this->modelClass}->{$assocModel}->{$method_name}();
                }
            }
        }

        
    }

    public function isAuthorized() {
        if (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'api') {
            return true;
        }
        if ($this->request->is('json') || $this->request->is('xml')) {
            return true;
        }

        if ($this->Auth->loggedIn() && $this->Auth->user('user_type') !== $this->request->params['prefix']) {
            $this->Session->destroy();
            $this->Auth->logout();
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        } else {
            return true;
        }
    }

    public function androidNotification($reg_ids, $message, $message_type, $statusId, $requestId, $gcm_type, $userType,$keyData=null) {
  
        $url = 'https://android.googleapis.com/gcm/send';
        //$apikey = 'AIzaSyDrjEtpoumha3s0z_SevtQu2dgDaukoHpI';
        if ($userType == 'mechanic') {
            $apikey = 'AIzaSyDrjEtpoumha3s0z_SevtQu2dgDaukoHpI';
        } else if ($userType == 'garage') {
            $apikey = 'AIzaSyBIsL_bozhG14eyUr_48ElPtm1VUshHe2Q';
        } else if ($userType == 'customer') {
            $apikey = 'AIzaSyBeXFLH4lWETSUOJtx3uT_wkadj_i9hU-Q';
        } else if ($userType == 'chauffeur_service') {
            $apikey = 'AIzaSyCM3IZ7jWEZs03rUhfUOFZhVjIw7WIL6kI';
        } else if ($userType == 'chauffeur') {
            $apikey = 'AIzaSyDAY_d9eE_npkdx_eSSncONtlPCebWoiww';
        }
        
        
        $send_id = '';
        foreach ($reg_ids as $reg_id) {
            if (!empty($reg_id['GcmUser']['gcm_reg_id'])) {
                if ($send_id != '') {
                    $send_id = $send_id . ',' . $reg_id['GcmUser']['gcm_reg_id'];
                } else {
                    $send_id = $reg_id['GcmUser']['gcm_reg_id'];
                }
                $devices[] = $reg_id['GcmUser']['gcm_reg_id'];
            }
        }
 
 
        $fields = array('registration_ids' => $devices, 'data' => array("message" => $message, "req_details" => $keyData));
        $headers = array('Authorization: key=' . $apikey, 'Content-Type: application/json');

        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post
        $result = curl_exec($ch);
        
      
        
        // Close connection
        curl_close($ch);

        foreach ($devices as $devicess) {
            $this->loadModel('GcmMessage');
            $this->loadModel('GcmUser');
            $GcmData = $this->GcmUser->find('first', array('conditions' => array('gcm_reg_id' => $devicess, 'user_type' => $userType)));

            $sendData = array('gcm_type' => $gcm_type, 'request_id' => $requestId, 'user_type' => $GcmData['GcmUser']['user_type'], 'user_type_id' => $GcmData['GcmUser']['user_type_id'], 'status_id' => $statusId, 'message' => $message, 'message_type' => $message_type, 'device_id' => 1, 'registrationIDs' => $devicess, 'result' => $result, 'last_updated_time' => date('Y-m-d H:i:s'));
            $this->GcmMessage->saveAll($sendData);
        }
    }

    public function iphoneNotification($reg_ids, $message, $message_type, $statusId, $requestId, $gcm_type, $userType) {
        date_default_timezone_set('Asia/Calcutta');
        $passphrase = 'angler';
        $send_ids = '';
        $ctx = stream_context_create();
        $result = "";
        foreach ($reg_ids as $reg_id) {
            if (!empty($reg_id)) {
                $cert = APP . 'Controller/pitkrew_user.pem';
                stream_context_set_option($ctx, 'ssl', 'local_cert', $cert);
                stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
                if (!$fp) {
                    echo "Failed to connect: $err $errstr" . PHP_EOL;
                } else {
                    $body['aps'] = array('alert' => $message, 'sound' => 'default');
                    $body['type'] = $message_type;
                    // Encode the payload as JSON
                    $payload = json_encode($body);
                    // Build the binary notification            

                    if ($send_ids != '') {
                        $send_ids = $send_ids . ',' . $reg_id['GcmUser']['gcm_reg_id'];
                    } else {
                        $send_ids = $reg_id['GcmUser']['gcm_reg_id'];
                    }
                    $deviceToken = $reg_id['GcmUser']['gcm_reg_id'];
//                    echo "test";
//                    echo $deviceToken; exit;
                    $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
                    // Send it to the server
                    $result = fwrite($fp, $msg, strlen($msg));
                }
            }

            if (!$result) {
                $result = 0;
            } else {
                $result = 1;
            }
            $this->loadModel('GcmMessage');
            $this->loadModel('GcmUser');
            $GcmData = $this->GcmUser->find('first', array('conditions' => array('gcm_reg_id' => $deviceToken, 'user_type' => $userType)));
            $sendData = array('gcm_type' => $gcm_type, 'request_id' => $requestId, 'user_type' => $GcmData['GcmUser']['user_type'], 'user_type_id' => $GcmData['GcmUser']['user_type_id'], 'status_id' => $statusId, 'message' => $message, 'message_type' => $message_type, 'device_id' => 2, 'registrationIDs' => $deviceToken, 'result' => $result, 'last_updated_time' => date('Y-m-d H:i:s'));
            $this->loadModel('GcmMessage');
            if ($this->GcmMessage->saveAll($sendData)) {
//                $this->{$this->modelClass}->id = $msgID;
//                $this->{$this->modelClass}->saveField('is_sent', 1);
            }
        }

        //echo $result;exit;
        fclose($fp);
    }
    
    
    public function sms($phone, $msg) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://www.unicel.in/SendSMS/sendmsg.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "uname=ANGLER&pass=a9F89e&send=Trinetra&dest=+91" . $phone . "&msg=" . $msg . "");
        $buffer = curl_exec($ch);
        curl_close($ch);
    }
     
    
    public function check_version($id,$application){
        $this->loadModel('UserStatus');
        $this->loadModel('Appversion');
        if(!empty($id)){
            $versionId = $id;
        } else {
            $version = $this->Appversion->find('first',array('conditions'=>array('application_id'=>$application,'is_active'=>1),'order'=>array('id'=>'asc'),'recursive'=>-1));
            $versionId = $version['Appversion']['id'];
        }
         
        $checkVersion = $this->Appversion->find('count',array('conditions'=>array('id >'=>$versionId,'application_id'=>$application,'is_active'=>1,'is_compulsory'=>1),'recursive'=>-1));    
        return $checkVersion;
    }

}
