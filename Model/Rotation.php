<?php

App::uses('AppModel', 'Model');

class Rotation extends AppModel {

//    public $hasMany = array("GarageService", "GarageBreakDown");
    var $recursive = -1;
    var $filterArgs = array(
        array(
            'type' => 'value',
            'name' => 'id',
        ),
        array(
            'type' => 'like',
            'name' => 'customer_name',
            'field' => 'customer_name',
        ),
        array(
            'type' => 'like',
            'name' => 'contact',
            'field' => 'contact',
        ),
        array(
            'type' => 'value',
            'name' => 'payment_amount',
            'field' => 'payment_amount',
        ),
        array(
            'type' => 'value',
            'name' => 'collection_amount',
            'field' => 'collection_amount',
        ),
        array(
            'type' => 'value',
            'name' => 'balance_amount',
            'field' => 'balance_amount',
        )
    );

    public function validateAdminAdd() {

        return $this->validate = array(
            'customer_name' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Customer Name')),
                ),
                'unique' => array(
                    'rule' => 'isUnique',
                    'message' => __('%s already exists', __('Customer name'))
                ),
            ),
            'contact' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Contact')),
                )
            ),
            'payment_amount' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Payment Amount')),
                )
            ),
            'payment_date' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please choose the %s', __('Payment Date')),
                )
            ),
            'closed_date' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please choose the %s', __('Closed Date')),
                )
            ),
            'collection_amount' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Collection Amount')),
                ) 
            ),
            'balance_amount' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Balance Amount')),
                )
            )
        );
    }

    public function amount_check(){
        if($this->data['Rotation']['collection_amount']>$this->data['Rotation']['payment_amount']){
            return false;
        } else {
            return true;
        }
    }
    public function validateAdminEdit() {

        return $this->validateAdminAdd();
    }

     

}
