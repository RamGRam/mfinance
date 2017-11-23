<?php

App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');

class User extends AppModel {

    var $recursive = 0;
    public $actsAs = array('Containable');
    var $filterArgs = array(
        array(
            'type' => 'value',
            'name' => 'id',
        ),
        array(
            'type' => 'like',
            'name' => 'name',
            'field' => 'name',
        ),
        array(
            'type' => 'value',
            'name' => 'user_type',
            'field' => 'user_type',
        ),
        
        array(
            'type' => 'like',
            'name' => 'email',
            'field' => 'email',
        ),
        array(
            'type' => 'like',
            'name' => 'contact',
            'field' => 'contact',
        ),
        array(
            'type' => 'value',
            'name' => 'is_active',
            'field' => 'is_active',
        ),
        array(
            'type' => 'value',
            'name' => 'is_delete',
            'field' => 'is_delete',
        )
    );

    public function salt($length = 22) {
        $salt = str_replace(
                array('+', '=', '/'), '.', base64_encode(sha1(uniqid(Configure::read('Security.salt'), true), true))
        );
        return substr($salt, 0, $length);
    }

    public function hash($str, $salt = null) {
        return Security::hash(Security::hash($str, 'sha1', $salt), 'sha1', true);
    }

    public function token() {
        return $this->salt(10);
    }

    public function beforeSave($options = array()) {
        if($this->data[$this->alias]['id']==1 || $this->data[$this->alias]['id']==2){
            $this->data[$this->alias]['user_type'] = 'admin';
        } else {
            $this->data[$this->alias]['user_type'] = 'customer';
        }
        
        if (array_key_exists('password', $this->data[$this->alias]) && !empty($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['salt'] = $this->salt();
            $this->data[$this->alias]['password'] = $this->hash($this->data[$this->alias]['password'], $this->data[$this->alias]['salt']);
            $this->data[$this->alias]['password_token'] = '';
            $this->data[$this->alias]['password_token_expires'] = '';
        }

        return parent::beforeSave($options);
    }

    public function validateAdminChangePassword() {

        return $this->_validateResetPassword();
    }

    public $hasOne = array(
        'UserProfileImage' => array(
            'className' => 'UserProfileImage',
            'foreignKey' => 'foreign_key',
            'conditions' => array(
                'UserProfileImage.model' => 'User',
                'UserProfileImage.name' => 'UserProfile',
            ),
            'fields' => array('UserProfileImage.dir', 'UserProfileImage.attachment_name', 'UserProfileImage.id'),
        )
    );

    public function saveWithAttachments($data, $options) {
        if (!empty($data['UserProfileImage']['attachment_name']['name'])) {
            if (is_array($data['UserProfileImage']['attachment_name'])) {
                if (isset($data['UserProfileImage']['foreign_key'])) {
                    unset($data['UserProfileImage']['foreign_key']);
                }
                $data['UserProfileImage']['model'] = 'User';
                $data['UserProfileImage']['name'] = 'UserProfile';
            }
        } else {
            unset($data['UserProfileImage']);
        }
        //pr($data);exit;
        $this->create();

        if ($this->saveAll($data, $options)) {
            return true;
        }
        return false;
    }

    public function _validateResetPassword() {
        return $this->validate = array(
            'old_password' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter %s', 'old password'),
                ),
                'checkOldPassword' => array(
                    'rule' => array('checkOldPassword'),
                    'required' => true,
                    'message' => __('Does not match %s', 'old password'),
                )
            ),
            'new_password' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', 'password'),
                ),
//                'minLength' => array(
//                    'rule' => array('minLength', '16'),
//                    'message' => 'Minimum 16 characters long'
//                ),
            ),
            'confirm_password' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', 'confirm password'),
                ),
                'compare' => array(
                    'rule' => array('confirmPassword'),
                    'message' => __('The %s and %s do not match, please re-enter', 'new password', 'confirm password'),
                ),
            ),
        );
    }

    public function validateAdminEdit() {
        return $this->validateAdminAdd();
        return $this->validateKcteamProfile();
        return $this->validateAdminProfile();
    }

    public function validateAdminSuadd() {
        return $this->validateAdminAdd();
    }
    
    public function validateAdminSuedit() {
        return $this->validateAdminAdd();
    }
    
    public function validateKcteamProfile() {
        return array(
            'name' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => __('Please enter the %s', __('name')),
                )
            ),
//            'email' => array(
//                'email' => array(
//                    'rule' => 'email',
//                    'message' => __('Please enter a valid %s', __('Email'))
//                ),
//                'unique' => array(
//                    'rule' => 'isEmailUniqueActive',
//                    'message' => __('%s already exists', __('Email'))
//                ),
//            ),
            'first_name' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('First name')),
                ),
            ),
            'last_name' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Last name')),
                ),
            ),
            'city_id' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please select the %s', __('city')),
                ),
            ),
        );
    }

    public function validateAdminProfile() {
        return array(
            'name' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => __('Please enter the %s', __('name')),
                )
            ),
//            'email' => array(
//                'email' => array(
//                    'rule' => 'email',
//                    'message' => __('Please enter a valid %s', __('Email'))
//                ),
//                'unique' => array(
//                    'rule' => 'isEmailUniqueActive',
//                    'message' => __('%s already exists', __('Email'))
//                ),
//            )
        );
    }

    public function validateAdminAdd() {
        return array(
            'name' => array(
                'name' => array(
                    'rule' => 'notEmpty',
                    'message' => __('Please enter the %s', __('Name'))
                ),
                'unique' => array(
                    'rule' => 'isNameUniqueActive',
                    'message' => __('%s already exists', __('Name'))
                ),
            ),
//            'email' => array(
//                'email' => array(
//                    'rule' => 'email',
//                    'message' => __('Please enter a valid %s', __('Email'))
//                ),
//                'unique' => array(
//                    'rule' => 'isEmailUniqueActive',
//                    'message' => __('%s already exists', __('Email'))
//                ),
//            ),
            'address' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => __('Please enter the %s', __('Address'))
                )
            ),
            'contact' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => __('Please enter the %s', __('Contact'))
                )
            ),
            'password' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => __('Please enter the %s', __('Password')),
                ),
                'notEmptyOn' => array(
                    'on' => 'update',
                    'rule' => array('notEmptyOn', 'confirm_password'),
                    'message' => __('Please enter both %s and %s', 'password', 'confirm password'),
                )
            ),
            'confirm_password' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => __('Please enter the %s', __('Confirm Password')),
                ),
                'compare' => array(
                    'allowEmpty' => true,
                    'rule' => array('confirmPassword'),
                    'message' => __('The %s and %s do not match, please re-enter', 'new password', 'confirm password'),
                ),
                'notEmptyOn' => array(
                    'rule' => array('notEmpty', 'password'),
                    'message' => __('Please enter both %s and %s', 'confirm password', 'password'),
                )
            )
        );
    }

    public function validateForm() {
        return array(
            'name' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => __('Please enter the %s', 'name')
                ),
                'maxLength' => array(
                    'rule' => array('maxLength', 25),
                    'message' => __('%s shoud be atmost 25 character', 'Name')
                ),
            ),
            'password' => array(
                'notEmpty' => array(
                    'on' => 'create',
                    'rule' => 'notEmpty',
                    'message' => __('Please enter the %s', 'password'),
                ),
                'minLength' => array(
                    'rule' => array('minLength', 6),
                    'message' => __('%s shoud be alteast 6 character', 'Password')
                ),
                'maxLength' => array(
                    'rule' => array('maxLength', 15),
                    'message' => __('%s shoud be atmost 15 character', 'Password')
                ),
                'pattern' => array(
                    'allowEmpty' => true,
                    'rule' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/i',
                    'message' => __('%s should contain one uppercase, lowercase, digit and special character ', 'Password'),
                ),
                'notEmptyOn' => array(
                    'on' => 'update',
                    'rule' => array('notEmptyOn', 'confirm_password'),
                    'message' => __('Please enter both %s and %s', 'password', 'confirm password'),
                )
            ),
            'confirm_password' => array(
                'notEmpty' => array(
                    'on' => 'create',
                    'rule' => 'notEmpty',
                    'message' => __('Please enter the %s', 'confirm password'),
                ),
                'compare' => array(
                    'allowEmpty' => true,
                    'rule' => array('confirmPassword'),
                    'message' => __('The %s and %s didn\'t match, please re-enter', 'new password', 'confirm password'),
                ),
                'notEmptyOn' => array(
                    'on' => 'update',
                    'rule' => array('notEmptyOn', 'password'),
                    'message' => __('Please enter both %s and %s', 'confirm password', 'password'),
                )
            ),
            'old_password' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => __('Please enter the %s', 'old password'),
                )
            ),
//            'email' => array(
//                'email' => array(
//                    'rule' => 'email',
//                    'message' => __('Please enter a valid %s', 'email'),
//                ),
//                'notEmpty' => array(
//                    'rule' => 'notEmpty',
//                    'message' => __('Please enter the %s', 'email'),
//                ),
//                'unique' => array(
//                    'rule' => 'isEmailUniqueActive',
//                    'message' => __('%s already exists', 'Email')
//                ),
//                'maxLength' => array(
//                    'rule' => array('maxLength', 100),
//                    'message' => __('%s shoud be atmost 100 character', 'Email')
//                ),
//            ),
            'contact_no' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => __('Please enter the %s', __('contact number')),
                ),
                'aus_phone' => array(
                    'rule' => array('validate_phone'),
                    'message' => __('Please enter proper %s', __('contact number')),
                    'allowEmpty' => true
                ),
                'maxLength' => array(
                    'rule' => array('maxLength', 14),
                    'message' => __('%s shoud be atmost 14 character', 'Contact number')
                ),
            )
        );
    }

    public function isNameUniqueActive() {
        if (
                array_key_exists('is_delete', $this->data[$this->alias]) && 1 != $this->data[$this->alias]['is_delete']
        ) {
            // Record to save is not 'active', so no need to check if it is unique
            return true;
        }

        $conditions = array(
            $this->alias . '.name' => $this->data[$this->alias]['name'],
            $this->alias . '.is_delete' => 0,
        );

        if ($this->id) {
            // Updating an existing record: don't count the record *itself*
            $conditions[] = array(
                'NOT' => array($this->alias . '.' . $this->primaryKey => $this->id)
            );
        }

        return (0 === $this->find('count', array('conditions' => $conditions)));
    }

    public function isEmailUniqueActive() {
        if (
                array_key_exists('is_delete', $this->data[$this->alias]) && 1 != $this->data[$this->alias]['is_delete']
        ) {
            // Record to save is not 'active', so no need to check if it is unique
            return true;
        }

        $conditions = array(
            $this->alias . '.email' => $this->data[$this->alias]['email'],
            $this->alias . '.is_delete' => 0,
        );

        if ($this->id) {
            // Updating an existing record: don't count the record *itself*
            $conditions[] = array(
                'NOT' => array($this->alias . '.' . $this->primaryKey => $this->id)
            );
        }

        return (0 === $this->find('count', array('conditions' => $conditions)));
    }

    public function checkOldPassword($password = null) {
        $userData = $this->findById($this->data[$this->alias]['id'], array('salt', 'password'));
        if ($userData[$this->alias]['password'] === $this->hash($password['old_password'], $userData[$this->alias]['salt'])) {
            return true;
        }
        return false;
    }

    public function confirmPassword($password = null) {
        if (empty($this->data[$this->alias]['password'])) {
            return true;
        }
        if ((isset($password['confirm_password'])) && !empty($password['confirm_password']) && ($this->data[$this->alias]['password'] === $password['confirm_password'])) {
            return true;
        }
        return false;


        if (empty($this->data[$this->alias]['new_password'])) {
            return true;
        }
        if ((isset($password['confirm_password'])) && !empty($password['confirm_password']) && ($this->data[$this->alias]['new_password'] === $password['confirm_password'])) {
            return true;
        }
        return false;
    }

}
