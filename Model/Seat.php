<?php

App::uses('AppModel', 'Model');

class Seat extends AppModel {

    var $recursive = 1;
    public $actsAs = array('Containable');
    var $filterArgs = array(
        array(
            'type' => 'value',
            'name' => 'id',
        ),
        array(
            'type' => 'like',
            'name' => 'title',
            'field' => 'title',
        ),
        array(
            'type' => 'value',
            'name' => 'staff_id',
            'field' => 'staff_id',
        ),
        array(
            'type' => 'value',
            'name' => 'user_id',
            'field' => 'user_id',
        ),
        array(
            'type' => 'value',
            'name' => 'no_of_weeks',
            'field' => 'no_of_weeks',
        ),
        array(
            'type' => 'value',
            'name' => 'amount_per_week',
            'field' => 'amount_per_week',
        )
    );
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
        ),
        'Staff' => array(
            'className' => 'Staff',
            'foreignKey' => 'staff_id'
        )
    );
    
    public $hasMany = array(
        'SeatDue' => array(
            'className' => 'SeatDue',
            'foreignKey' => 'seat_id',
        )
    );

    public function validateAdminAdd() {

        return $this->validate = array(
            'title' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Place')),
                )
            ),
            'staff_id' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please select %s', __('Staff')),
                )
            ),
            'user_id' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please select %s', __('Customer')),
                ),
                'unique' => array(
                    'rule' => 'isUnique',
                    'message' => __('%s already exists', __('Customer'))
                ),
            ),
            'no_of_weeks' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter %s', __('Number Of Weeks')),
                )
            ),
            'amount_per_week' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter %s', __('Amount Per Week')),
                )
            )
        );
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
            $this->alias . '.title' => $this->data[$this->alias]['title'],
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

}
