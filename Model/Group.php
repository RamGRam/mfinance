<?php

App::uses('AppModel', 'Model');

class Group extends AppModel {

    var $virtualFields = array(
        'loan_type2' => 'Group.min_amount+Group.extra_amount',
        'loan_type1' => 'Group.min_amount',
        'amt_permin_week' => 'round(((Group.min_amount+Group.min_amt_interest)/Group.min_amt_week),2)',
        'amt_perextra_week' => 'round(((Group.extra_amount+Group.extra_amt_interest)/Group.extra_amt_week),2)'
    );
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
            'type' => 'like',
            'name' => 'center_id',
            'field' => 'center_id',
        )
    );
    public $belongsTo = array(
        'Center' => array(
            'className' => 'Center',
            'foreignKey' => 'center_id',
        )
    );
    
    public $hasMany = array(
        'Loan' => array(
            'className' => 'Loan',
            'foreignKey' => 'group_id',
        )
    );

    public function validateAdminAdd() {

        return $this->validate = array(
            'name' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Name')),
                ),
                'isUnique' => array(
                    'rule' => 'isUnique',
                    'required' => true,
                    'message' => __('Title already exist, Try with another title'),
                )
            ),
            'center_id' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please choose %s', __('Center')),
                )
            ),
            'disp_amount' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Disbursment Amount')),
                )
            ),
            'interest' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Interest')),
                )
            ),
            'no_of_members' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('No of members')),
                )
            ),
            'first_collection_date' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please choose %s', __('First and final collection date')),
                )
            ),
            'min_amount' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Minimum loan amount')),
                )
            ),
            'min_amt_interest' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Minimum loan interest')),
                )
            ),
            'min_amt_week' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Minimum loan week')),
                )
            ),
            'extra_amount' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Extra loan amount')),
                )
            ),
            'extra_amt_interest' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Extra loan interest')),
                )
            ),
            'extra_amt_week' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Extra loan week')),
                )
            )
        );
    }

    public function beforeSave() {
 
        if(!empty($this->data['Group']['first_collection_date'])){
            $date = strtotime(''.date('d-m-Y',strtotime($this->data['Group']['first_collection_date'])).' + '.($this->data['Group']['min_amt_week']-1).' week');
            $this->data['Group']['first_collection_date'] = date('Y-m-d', strtotime($this->data['Group']['first_collection_date']));
            $this->data['Group']['final_collection_date'] = date('Y-m-d',$date);
        }
    }

    public function validateAdminEdit() {

        return $this->validateAdminAdd();
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

    public $hasOne = array(
        'GroupProfileImage' => array(
            'className' => 'GroupProfileImage',
            'foreignKey' => 'foreign_key',
            'conditions' => array(
                'GroupProfileImage.model' => 'Group',
                'GroupProfileImage.name' => 'GroupProfile',
            ),
            'fields' => array('GroupProfileImage.dir', 'GroupProfileImage.attachment_name', 'GroupProfileImage.id'),
        )
    );

    public function saveWithAttachments($data, $options) {
        if (!empty($data['GroupProfileImage']['attachment_name']['name'])) {
            if (is_array($data['GroupProfileImage']['attachment_name'])) {
                if (isset($data['GroupProfileImage']['foreign_key'])) {
                    unset($data['GroupProfileImage']['foreign_key']);
                }
                $data['GroupProfileImage']['model'] = 'Group';
                $data['GroupProfileImage']['name'] = 'GroupProfile';
            }
        } else {
            unset($data['GroupProfileImage']);
        }
        //pr($data);exit;
        $this->create();

        if ($this->saveAll($data, $options)) {
            return true;
        }
        return false;
    }

}
