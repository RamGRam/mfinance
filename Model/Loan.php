<?php

App::uses('AppModel', 'Model');

class Loan extends AppModel {

    var $recursive = 1;
    public $actsAs = array('Containable');
    var $virtualFields = array(
        'loan_amount' => 'Loan.min_amount+Loan.extra_amount',
        'interest_amount' => 'Loan.min_amt_interest+Loan.extra_amt_interest',
        'amt_permin_week' => 'round(((Loan.min_amount+Loan.min_amt_interest)/Loan.min_amt_week),2)',
        'amt_perextra_week' => 'round(((Loan.extra_amount+Loan.extra_amt_interest)/Loan.extra_amt_week),2)'
    );
    var $filterArgs = array(
        array(
            'type' => 'value',
            'name' => 'id',
        ),
        array(
            'type' => 'value',
            'name' => 'loan_amount',
            'field' => 'loan_amount',
        ),
        array(
            'type' => 'value',
            'name' => 'user_id',
            'field' => 'user_id',
        ),
        array(
            'type' => 'like',
            'name' => 'uid',
            'field' => 'uid',
        ),
        array(
            'type' => 'value',
            'name' => 'group_id',
            'field' => 'group_id',
        )
    );
    public $belongsTo = array(
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'group_id',
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );
    public $hasMany = array(
        'Due' => array(
            'className' => 'Due',
            'foreignKey' => 'loan_id',
        ),
        'Collection' => array(
            'className' => 'Due',
            'foreignKey' => 'loan_id',
            'conditions'=>array('type'=>1)
        ),
        'ExtraCollection' => array(
            'className' => 'Due',
            'foreignKey' => 'loan_id',
            'conditions'=>array('type'=>1,'extra_amount'=>1)
        )
    );

    public function validateAdminAdd() {

        return $this->validate = array(
            'user_id' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please choose %s', __('Customer')),
                )
            ),
            'group_id' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please choose %s', __('Group')),
                ),
                'compare' => array(
                    'rule' => array('restriction'),
                    'message' => __('Loan limit exceeded in this group, Try with another group')
                ),
            ),
            'uid' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Loan id')),
                ),
                'unique' => array(
                    'rule' => 'isNameUniqueActive',
                    'message' => __('%s already exists', __('Loan Id'))
                ),
            ),
            'amount' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please choose %s', __('Amount')),
                )
            )
        );
    }

    public function restriction() {
         
        if(!empty($this->data[$this->alias]['group_id'])){
            $group = ClassRegistry::init('Group')->find('first',array('conditions'=>array('Group.id'=>$this->data[$this->alias]['group_id']),'recursive'=>1));
            if(count($group['Loan'])>=$group['Group']['no_of_members']){
                return false;
            } else {
                return true;
            }
        }
    }

    public function beforeSave() {

        if ($this->data['Loan']['controller'] == 'loans') {
            $group = ClassRegistry::init('Group');
            $group = $group->find('first', array('conditions' => array('id' => $this->data['Loan']['group_id']), 'recursive' => -1));

            $this->data['Loan']['min_amount'] = $group['Group']['min_amount'];
            $this->data['Loan']['min_amt_interest'] = $group['Group']['min_amt_interest'];
            $this->data['Loan']['min_amt_week'] = $group['Group']['min_amt_week'];
            $this->data['Loan']['min_amt_total'] = $group['Group']['min_amount'] + $group['Group']['min_amt_interest'];

            if ($this->data['Loan']['amount'] == 2) {
                $this->data['Loan']['extra_amount'] = $group['Group']['extra_amount'];
                $this->data['Loan']['extra_amt_interest'] = $group['Group']['extra_amt_interest'];
                $this->data['Loan']['extra_amt_week'] = $group['Group']['extra_amt_week'];
                $this->data['Loan']['extra_amt_total'] = $group['Group']['extra_amount'] + $group['Group']['extra_amt_interest'];
            } else {
                $this->data['Loan']['extra_amount'] = "0";
                $this->data['Loan']['extra_amt_interest'] = "0";
                $this->data['Loan']['extra_amt_week'] = "0";
                $this->data['Loan']['extra_amt_total'] = "0";
            }
        }
    }

    public function validateAdminEdit() {

        return $this->validate = array(
            'user_id' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please choose %s', __('Customer')),
                )
            ),
            'group_id' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please choose %s', __('Group')),
                )
            ),
            'uid' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Loan id')),
                ),
                'unique' => array(
                    'rule' => 'isNameUniqueActive',
                    'message' => __('%s already exists', __('Loan Id'))
                ),
            ),
            'amount' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please choose %s', __('Amount')),
                )
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
            $this->alias . '.uid' => $this->data[$this->alias]['uid'],
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
