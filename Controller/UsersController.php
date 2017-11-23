<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {

    public $components = array(
        'Crud.Crud' => array(
            'actions' => array(
                'api_index' => array('className' => 'Crud.Index'),
                'api_seatuser' => array('className' => 'Crud.Index'),
                'api_login' => array('className' => 'Crud.View', 'relatedModels' => false),
                'admin_login' => array('className' => 'Crud.View', 'relatedModels' => false),
                'admin_index' => array('className' => 'Crud.Index', 'relatedModels' => false),
                'admin_seat_user' => array('className' => 'Crud.Index', 'relatedModels' => false),
                'admin_change_password' => array('className' => 'Crud.Edit', 'relatedModels' => false),
                'admin_forgot_password' => array('className' => 'Crud.View', 'relatedModels' => false),
                'admin_reset_password' => array('className' => 'Crud.View', 'relatedModels' => false),
                'admin_profile' => array('className' => 'Crud.Edit', 'relatedModels' => false, 'saveMethod' => 'saveWithAttachments'),
                'admin_add' => array('className' => 'Crud.Add', 'relatedModels' => false, 'saveMethod' => 'saveWithAttachments', 'view' => 'admin_form', 'saveOptions' => array('deep' => true)),
                'admin_edit' => array('className' => 'Crud.Edit', 'relatedModels' => false, 'saveMethod' => 'saveWithAttachments', 'view' => 'admin_form', 'saveOptions' => array('deep' => true)),
                'admin_suadd' => array('className' => 'Crud.Add', 'relatedModels' => false, 'saveMethod' => 'saveWithAttachments', 'view' => 'admin_suform', 'saveOptions' => array('deep' => true)),
                'admin_suedit' => array('className' => 'Crud.Edit', 'relatedModels' => false, 'saveMethod' => 'saveWithAttachments', 'view' => 'admin_suform', 'saveOptions' => array('deep' => true)),
                'admin_view' => array('className' => 'Crud.View', 'relatedModels' => false),
                'admin_logout' => array('className' => 'Crud.View', 'relatedModels' => false),
                'admin_delete' => array('className' => 'Crud.Delete', 'relatedModels' => false),
                'admin_check_token' => array('className' => 'Crud.View', 'relatedModels' => false),
            ),
        ),
    );

    public function beforeFilter() {
        parent::beforeFilter();

        $this->Auth->allow(array(
            'api_login',
            'admin_forgot_password',
            'admin_reset_password',
            'admin_check_token'
        ));

        $this->Crud->action()->config('messages.success', array('element' => 'BoostCake.alert', 'params' => array('class' => 'alert-success')));
        $this->Crud->action()->config('messages.error', array('element' => 'BoostCake.alert', 'params' => array('class' => 'alert-danger')));

        if (in_array($this->request->action, array('admin_index'))) {
            $this->Crud->addListener('Search');

            if ($this->request->is('post')) {
                $data = $this->data[$this->modelClass];
                $url = array_merge(array('action' => 'index'), $data);
                $this->redirect(array('action' => 'index', '?' => $data), 303);
            }

            $this->Crud->on('beforePaginate', function(CakeEvent $event) {
                $event->subject->paginator->settings['order'] = array('updated' => 'desc');
                $event->subject->paginator->settings['conditions'] = array('NOT' => array('user_type'=>'admin'),'user_role'=>'loan','is_delete'=>0);
                $event->subject->paginator->settings['recursive'] = -1;
            });
        }
    }

    public function api_index() {
        $this->Auth->allow();
        $this->Crud->addListener('Api');
        $this->Crud->addListener('ApiFieldFilter');
        $this->Crud->addListener('ApiPagination');
        $this->Crud->addListener('ApiTransformation');
        $this->Crud->addListener('ApiQueryLog');
        $this->Crud->addListener('Search');
        $this->Crud->on('beforePaginate', function(CakeEvent $event) {
            if (isset($this->request->query['page'])) {
                $event->subject->paginator->settings['page'] = $this->request->query['page'];
                $event->subject->paginator->settings['conditions'] = array('user_role'=>'loan','user_type'=>'customer','is_delete' => '0', 'is_active' => 1);
                $event->subject->paginator->settings['recursive'] = -1;
            }
        });
        $this->Crud->execute();
    }
    
    public function api_seatuser() {
        $this->Auth->allow();
        $this->Crud->addListener('Api');
        $this->Crud->addListener('ApiFieldFilter');
        $this->Crud->addListener('ApiPagination');
        $this->Crud->addListener('ApiTransformation');
        $this->Crud->addListener('ApiQueryLog');
        $this->Crud->addListener('Search');
        $this->Crud->on('beforePaginate', function(CakeEvent $event) {
            if (isset($this->request->query['page'])) {
                $event->subject->paginator->settings['page'] = $this->request->query['page'];
                $event->subject->paginator->settings['conditions'] = array('user_role'=>'seat','user_type'=>'customer','is_delete' => '0', 'is_active' => 1);
                $event->subject->paginator->settings['recursive'] = -1;
            }
        });
        $this->Crud->execute();
    }

    public function admin_login() {
        $this->layout = 'admin_login';
        $this->_login(array('controller' => 'dashboards', 'action' => 'index', 'admin' => true));
    }

    public function admin_index() {
         
        $this->set('statuses', array(
            '1' => __('Active'),
            '0' => __('Inactive'),
        ));


        $this->Crud->execute();
    }
    
    
    public function admin_seat_user() {
         
        $this->set('statuses', array(
            '1' => __('Active'),
            '0' => __('Inactive'),
        ));
        
        $this->Crud->on('beforePaginate', function(CakeEvent $event) {
            $event->subject->paginator->settings['order'] = array('updated' => 'desc');
            $event->subject->paginator->settings['conditions'] = array('NOT' => array('user_type'=>'admin'),'user_role'=>'seat','is_delete'=>0);
            $event->subject->paginator->settings['recursive'] = -1;
        });


        $this->Crud->execute();
    }

    public function admin_add() {
        $this->Crud->execute();
    }

    public function admin_edit() {
        $this->Crud->execute();
    }
    
    public function admin_suadd() {
        $this->Crud->execute();
    }

    public function admin_suedit() {
        $this->Crud->execute();
    }
    
    public function admin_view() {
        $this->Crud->execute();
    }
    
    public function admin_delete($id) {
        
        $this->Session->setFlash('User successfully deleted!', 'default', array('class' => 'alert alert-success success'));
        $this->User->id = $id;
        $this->User->save(array('is_delete' => '1'));
        $this->redirect('/admin/users');
    }

    public function admin_check_token($token) {

        $this->autoRender = false;

        $userData = $this->User->find('first', array('conditions' => array('password_token' => $token, 'password_token_expires >' => date('Y-m-d H:i:s'))));

        if (!empty($userData)) {
            $this->Auth->login($userData[$this->modelClass]);
            //unset($userData[$this->modelClass]);

            $this->loadModel('UserProfileImage');
            $this->loadModel('KcTeam');

            if ($userData['User']['user_type'] == 'kcteam') {
                $kcTeam = $this->KcTeam->findById($userData['User']['user_type_id']);
                $image = $this->UserProfileImage->find('first', array('fields' => array('attachment_name', 'dir', 'id'), 'conditions' => array('foreign_key' => $kcTeam['KcTeam']['id'], 'model' => 'KcTeam', 'name' => 'KcTeamProfile')));
            } else {
                $image = $this->UserProfileImage->find('first', array('fields' => array('attachment_name', 'dir', 'id'), 'conditions' => array('foreign_key' => $userData['User']['id'], 'model' => 'User', 'name' => 'UserProfile')));
            }
            

            $this->Session->write('User', $userData);
            $this->Session->write('ProfileImage', $image['UserProfileImage']);
            //$this->{$this->modelClass}->id = $this->Auth->user('id');
            //$this->{$this->modelClass}->saveField('last_login', date('Y-m-d H:i:s'));

            if (!empty($postData['remember_me'])) {
                $this->Cookie->write('remember', $postData, true, '30 Days');
                setcookie("user", $postData['username'], time() + 3600);
            } else {
                $this->Cookie->delete('remember');
                setcookie("user");
            }

            $this->redirect('/admin/users');
        } else {
            $this->Session->setFlash(__('Invalid token.'), 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            $this->redirect('/admin/users/forgot_password');
        }
    }

    public function api_login() {

        $this->set('success', 0);
        $data = array("message" => "Unauthorized Access");

        if ($this->request->is('post')) {

            $postData = $this->data;

            if (empty($postData['username']) || empty($postData['password'])) {
                $data['message'] = "Username or password should not be empty";
            } else if (empty($postData['device_imei'])) {
                $data['message'] = "Your device is not recognised";
            } else {

                $userData = $this->{$this->modelClass}->findByEmail($postData['username']);

                // Check if User Account Exists
                if (isset($userData[$this->modelClass]) && $userData[$this->modelClass]['is_active'] != 1) {
                    // Check if User Account Inactive
                    $data['message'] = __('Your account is not active, please contact the Administrator');
                    $this->set('success', -1);
                } else if (isset($userData[$this->modelClass]) && $userData[$this->modelClass]['device_imei'] != $postData['device_imei']) {
                    $data['message'] = __('You are not an authorised user for the device!');
                    $this->set('success', -2);
                } else if ($userData[$this->modelClass]['password'] === $this->{$this->modelClass}->hash($postData['password'], $userData[$this->modelClass]['salt'])) {

                    $this->Auth->login($userData[$this->modelClass]);

                    $token = $this->{$this->modelClass}->hash($userData[$this->modelClass]['email'], Configure::read('Security.salt'));
                    $this->{$this->modelClass}->id = $userData[$this->modelClass][id];
                    $this->{$this->modelClass}->saveField('app_token', $this->{$this->modelClass}->hash($token, Configure::read('Security.salt')));

                    $this->set('success', 1);
                    //$data['id'] = $userData[$this->modelClass][id];
                    $data['Auth'] = array('token' => $token);
                    $this->loadModel('Agent');

                    $agent = $this->Agent->read(null, $userData[$this->modelClass][user_type_id]);
                    $user = array_intersect_key($agent['User'], array('name' => null, 'email' => null));

                    $data = array_merge($data, $agent, array('User' => $user));

                    unset($data['message']);
                } else {
                    $data['message'] = __('Invalid username or password');
                    $this->set('success', 0);
                }
            }
        }
        $this->set('data', $data);
        $this->set('_serialize', array('success', 'data'));
    }

    private function _login($redirect_to) {

        $this->autoRender = false;

        if ($this->request->is('post')) {
            $this->_login2($this->request->data['User'], 'post', $redirect_to);
        } else if ($this->Cookie->read('remember')) {
            $this->_login2($this->Cookie->read('remember'), 'cookie', $redirect_to);
        }

        if ($this->Cookie->read('pk_user.User.remember') == 1) {
            $this->set('pk_username', $this->Cookie->read('pk_user.User.username'));
            $this->set('pk_password', $this->Cookie->read('pk_user.User.password'));
            $this->set('pk_remember', 'checked');
        }


        if ($this->Auth->loggedIn()) {
            $this->redirect($redirect_to);
        }
        $this->set('title_for_layout', __('Login'));
        $this->render('login');
    }

    private function _login2($postData, $type = 'post', $redirect_to) {
        // Check if Username and Password are Empty
        if (empty($postData['username']) || empty($postData['password'])) {
            $this->Session->setFlash(__('Username  and Password should not be empty'), 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            $this->redirect(array('controller' => "users", 'action' => "login"));
        }

        $userData = $this->{$this->modelClass}->findByName($postData['username']);

        // Check if User Account Exists
        if (!isset($userData[$this->modelClass])) {
            $this->Session->setFlash(__('Incorrect Username or Password'), 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            $this->redirect(array('controller' => "users", 'action' => "login"));
        }

        // Check if User Account Inactive
        if ($userData[$this->modelClass]['is_active'] != 1) {
            $this->Session->setFlash(__('Your account is not active, please contact the Administrator'), 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            $this->redirect(array('controller' => "users", 'action' => "login"));
        }


        if ($userData[$this->modelClass]['password'] === $this->{$this->modelClass}->hash($postData['password'], $userData[$this->modelClass]['salt'])) {

            if (!empty($this->data['User']['remember'])) {
                $this->Cookie->write('pk_user', $this->data);
            } else {
                $this->Cookie->delete('pk_user');
            }

            $this->Auth->login($userData[$this->modelClass]);
            //unset($userData[$this->modelClass]);

            $this->loadModel('UserProfileImage');
            $image = $this->UserProfileImage->find('first', array('fields' => array('attachment_name', 'dir', 'id'), 'conditions' => array('foreign_key' => $userData['User']['id'], 'model' => 'User', 'name' => 'UserProfile')));

            $this->Session->write('User', $userData);
            $this->Session->write('ProfileImage', $image['UserProfileImage']);
            //$this->{$this->modelClass}->id = $this->Auth->user('id');
            //$this->{$this->modelClass}->saveField('last_login', date('Y-m-d H:i:s'));

            if (!empty($postData['remember_me'])) {
                $this->Cookie->write('remember', $postData, true, '30 Days');
                setcookie("user", $postData['username'], time() + 3600);
            } else {
                $this->Cookie->delete('remember');
                setcookie("user");
            }

            $this->redirect($redirect_to);
        } else {
            $this->Session->setFlash(__('Incorrect Username or Password'), 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            $this->redirect(array('controller' => "users", 'action' => "login"));
        }
    }

    public function admin_logout() {
        $this->_logout(array('controller' => 'users', 'action' => 'login', 'admin' => true));
    }

    private function _logout($redirect_to) {
        $this->Session->destroy();
        //$this->Cookie->destroy();
        $this->Auth->logout();
        $this->redirect($redirect_to);
    }

    public function admin_forgot_password() {
        $this->_forgot_password();
    }

    private function _forgot_password() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $user = $this->{$this->modelClass}->find('first', array(
                'contain' => array(),
                'conditions' => array(
                    $this->modelClass . '.email' => $this->request->data[$this->modelClass]['username'], 'User.user_type' => 'admin'),
                'fields' => array(
                    'id', 'email', 'password_token_expires')));

            if (empty($user)) {
                $this->Session->setFlash(__('Invalid Email, please retry!'), 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
                $this->redirect(array('action' => 'forgot_password'));
            }

            $user[$this->modelClass]['password_token'] = $this->{$this->modelClass}->token();
            $user[$this->modelClass]['password_token_expires'] = date('Y-m-d H:i:s', time() + 86400);
            $this->{$this->modelClass}->save($user, array('validate' => false));

            $Email = new CakeEmail();
            $Email->from(array('admin@pitkrew.in' => 'Pitkrew'))
                    ->to($this->request->data[$this->modelClass]['username'])
                    ->subject('Forgot Password');
            $Email->emailFormat('html');
            $Email->template('forgot_password')
                    ->viewVars(
                            array(
                                'tokan' => $user[$this->modelClass]['password_token']
            ));
            $Email->send('Forgot Password');

            $this->Session->setFlash(__('Your password reset instructions was sent to your registered email account.'), 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            $this->redirect(array('action' => 'forgot_password'));
        }

        $this->set('title_for_layout', __('Forgot Password?'));
        $this->render('forgot_password');
    }

    public function admin_reset_password($token = null) {
        $this->_reset_password($token);
    }

    private function _reset_password($token) {

        $user = $this->{$this->modelClass}->find('first', array(
            'contain' => array(),
            'conditions' => array(
                $this->modelClass . '.password_token' => $token),
            'fields' => array(
                'id', 'email', 'password_token_expires')));

        if (empty($user)) {
            $this->Session->setFlash(__('Invalid token, please retry!'), 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            $this->redirect(array('action' => 'forgot_password'));
        }

        $expires = strtotime($user[$this->modelClass]['password_token_expires']);
        if ($expires < time()) {
            $this->Session->setFlash(__('Token expired, please retry!'), 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            $this->redirect(array('action' => 'forgot_password'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->{$this->modelClass}->save($this->request->data, array('validate' => true))) {
                $this->Session->setFlash(__('Your password has been reset. Please use the new password to login to the system!'), 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
                $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
        } else {
            $this->request->data[$this->modelClass] = array('id' => $user[$this->modelClass]['id']);
        }

        $this->set('title_for_layout', __('Reset Password'));
        $this->render('reset_password');
    }

    /*
     * Change Password
     */

    public function admin_change_password() {

//        $this->Crud->on('afterSave', function(\Cake\Event\Event $event) {
//                    $this->redirect('/admin/agents');
//        });

        if ($this->request->is('post') || $this->request->is('put')) {


//            if ($this->{$this->modelClass}->validates()) {
//                $user = $this->{$this->modelClass}->findById($this->Auth->user('id'));
//				 
//                if ($user[$this->modelClass]['password'] === $this->{$this->modelClass}->hash($this->request->data[$this->modelClass]['old_password'], $user[$this->modelClass]['salt'])) {
//                    $user[$this->modelClass]['id'] = $this->Auth->user('id');
//                    $user[$this->modelClass]['password'] = $this->request->data[$this->modelClass]['new_password'];
            $this->request->data['User']['password'] = $this->request->data['User']['new_password'];
// 
//                    if ($this->{$this->modelClass}->saveAll($user, array('validate' => false))) {
//                        //$Email = new CakeEmail('default');
//                        //$Email->from(array('admin@angleritech.com' => FromName));
//                        //$Email->to($user[$this->modelClass]['email']);
//                        //$Email->subject('Reset pin');
//                        //$Email->emailFormat('html');
//                        //$Email->template('change_pin_template')
//                                //->viewVars(
//                                        //array(
//                                            //'name' => $user[$this->modelClass]['name'],
//                                            //'password' => $this->request->data[$this->modelClass]['password']
//                                //));
//                        //$Email->subject('Metro Park' . '- Reset pin Mail');
//                        //pr($Email);exit;
//                       // $Email->send();
//
//
//                        $this->Session->setFlash(__('Your password has been reset. Please use the new password to login to the system!'), 'default', array('class' => 'success'), 'auth');
//                        $this->redirect(array('controller' => 'agents', 'action' => 'index'));
//                    } else {
//                        $this->Session->setFlash(__('Your password has not been reset. Please try again!'), 'default', array(), 'auth');
//                    }
//                } else {
//                    $this->Session->setFlash(__('old password not match. Please try again!'), 'default', array(), 'auth');
//                }
//            }
        }
        $this->Crud->execute();
    }

    /*
     * Admin Profile
     */

    public function admin_profile($id, $kid) {

        $this->Crud->execute();
    }

}
