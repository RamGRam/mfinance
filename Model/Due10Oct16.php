<?php

App::uses('AppModel', 'Model');

class Due extends AppModel {

    var $recursive = 0;
    public $actsAs = array('Containable');
    var $filterArgs = array(
        array(
            'type' => 'value',
            'name' => 'id',
        ),
        array(
            'type' => 'value',
            'name' => 'user_id',
            'field' => 'user_id',
        ),
        array(
            'type' => 'value',
            'name' => 'loan_id',
            'field' => 'loan_id',
        ),
        array(
            'type' => 'value',
            'name' => 'amount',
            'field' => 'amount',
        ),
        array(
            'type' => 'value',
            'name' => 'type',
            'field' => 'type',
        )
    );
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
        ),
        'Loan' => array(
            'className' => 'Loan',
            'foreignKey' => 'loan_id',
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
            'loan_id' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please choose %s', __('Loan id')),
                )
            ),
            'amount' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter the %s', __('Amount')),
                )
            ),
            'type' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please choose %s', __('due type')),
                )
            )
        );
    }

 

    public function beforeSave() {
//        $loan = ClassRegistry::init('Loan');
//        $loan = $loan->find('first', array('conditions' => array('id' => $this->data[$this->alias]['loan_id']), 'recursive' => -1));
//        $this->data[$this->alias]['user_id'] = $loan['Loan']['user_id'];
//        $this->data['Loan'] = $loan['Loan'];
//        $this->request->data['Loan']['is_closed'] = 1;
//        if (empty($loan['Loan']['extra_amt_total'])) {
//            if ($loan['Loan']['min_amt_week'] > $loan['Loan']['min_amt_week_paid']) {
//                $this->data[$this->alias]['amount'] = $loan['Loan']['amt_permin_week'];
//                $this->data[$this->alias]['min_amt_paid'] = $loan['Loan']['amt_permin_week'];
//            } else {
//                $this->data[$this->alias]['amount'] = "";
//            }
//        } else {
//            if ($loan['Loan']['min_amt_week'] > $loan['Loan']['min_amt_week_paid'] && $loan['Loan']['extra_amt_week'] > $loan['Loan']['extra_amt_week_paid']) {
//                $tot = $loan['Loan']['amt_permin_week'] + $loan['Loan']['amt_perextra_week'];
//                $this->data[$this->alias]['amount'] = $tot;
//                $this->data[$this->alias]['min_amt_paid'] = $loan['Loan']['amt_permin_week'];
//                $this->data[$this->alias]['extra_amt_paid'] = $loan['Loan']['amt_perextra_week'];
//            } else if ($loan['Loan']['min_amt_week'] > $loan['Loan']['min_amt_week_paid'] || $loan['Loan']['extra_amt_week'] > $loan['Loan']['extra_amt_week_paid']) {
//                $tot = $loan['Loan']['amt_permin_week'];
//                $this->data[$this->alias]['amount'] = $tot;
//                $this->data[$this->alias]['min_amt_paid'] = $loan['Loan']['amt_permin_week'];
//            } else {
//                $this->data[$this->alias]['amount'] = "";
//            }
//        }
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

}
