<?php

App::uses('AppModel', 'Model');

class SeatDue extends AppModel {

    var $recursive = 0;
    public $actsAs = array('Containable');
    var $filterArgs = array(
        array(
            'type' => 'value',
            'name' => 'id',
        ),
        array(
            'type' => 'value',
            'name' => 'seat_id',
            'field' => 'seat_id',
        ),
        array(
            'type' => 'value',
            'name' => 'user_id',
            'field' => 'user_id',
        ),
        array(
            'type' => 'value',
            'name' => 'amount',
            'field' => 'amount',
        ),
        array(
            'type' => 'query',
            'method' => 'betweenDates',
            'name' => 'paid_date',
            'field' => 'paid_date'
        )
    );

    public function betweenDates($data = array()) {
        $date = explode('-', $data['paid_date']);

        $filter['from'] = $date[0];
        $filter['to'] = $date[1];

        $cond = array(
            $this->alias . '.created between ? and ?' => array(
                $this->formatLike(date('Y-m-d H:i:s', strtotime($filter['from']))),
                $this->formatLike(date('Y-m-d H:i:s', strtotime('+0 day', strtotime($filter['to']))))
            )
        );

        return $cond;
    }

    public $belongsTo = array(
        'Seat' => array(
            'className' => 'Seat',
            'foreignKey' => 'seat_id',
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
            'amount' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter %s', __('Amount')),
                )
            ),
            'paid_date' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'required' => true,
                    'message' => __('Please enter %s', __('Date')),
                )
            )
        );
    }

    public function beforeSave() {
        $seat = ClassRegistry::init('Seat');
        $seat = $seat->find('first', array(
            'conditions' => array('user_id' => $this->data[$this->alias]['user_id']),
            'fields'=>  array('id','amount_paid'),
            'recursive' => -1
        ));
        $this->data[$this->alias]['seat_id'] = $seat['Seat']['id'];
        $tot = $this->data[$this->alias]['amount']+$seat['Seat']['amount_paid'];
        ClassRegistry::init('Seat')->query('update mf_seats set amount_paid='.$tot.' where id='.$this->data[$this->alias]['seat_id'].'');
        $this->data[$this->alias]['paid_date'] = date('Y-m-d',strtotime($this->data[$this->alias]['paid_date']));
        
    }
    public function afterSave() {
        $seat = ClassRegistry::init('Seat');
        $seatDue = ClassRegistry::init('SeatDue');
        $seat = $seat->find('first', array(
            'conditions' => array('Seat.id' => $this->data[$this->alias]['seat_id']),
            'fields'=>  array('Seat.*'),
            'recursive' => 1
        ));
        
        $seatDue = $seatDue->find('list',array('conditions'=>array('seat_id'=>$this->data[$this->alias]['seat_id']),'recursive'=>-1));
         
        if($seat['Seat']['no_of_weeks'] == count($seatDue)){
              ClassRegistry::init('Seat')->query('update mf_seats set is_closed=1 where id='.$this->data[$this->alias]['seat_id'].'');
        }
        
    }

    public function validateAdminEdit() {

        return $this->validateAdminAdd();
    }

 

}
