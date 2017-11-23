<?php

App::uses('AppModel', 'Model');

class Center extends AppModel {

//    public $hasMany = array("GarageService", "GarageBreakDown");
    var $recursive = -1;
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
            'name' => 'city',
            'field' => 'city',
        ),
        array(
            'type' => 'like',
            'name' => 'uid',
            'field' => 'uid',
        ),
        array(
            'type' => 'value',
            'name' => 'is_active',
            'field' => 'is_active',
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
                'unique' => array(
                    'rule' => 'isNameUniqueActive',
                    'message' => __('%s already exists', __('Center name'))
                ),
            ),
            'city' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('City')),
                )
            ),
            'uid' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Center id')),
                )
            ),
            'disbursement_date' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Disbursement date')),
                )
            )
        );
    }

    public function validateAdminEdit() {

        return  $this->validateAdminAdd();
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

}
