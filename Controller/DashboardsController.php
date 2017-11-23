<?php

App::uses('AppController', 'Controller');

class DashboardsController extends AppController {

    public $components = array(
        'Crud.Crud' => array(
            'actions' => array(
                'api_index' => array('className' => 'Crud.Index'),
                'admin_index' => array('className' => 'Crud.Index'),
                'kcteam_index' => array('className' => 'Crud.Index')
            ),
        ),
    );

    public function beforeFilter() {
        parent::beforeFilter();

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
                //$event->subject->paginator->settings['order'] = array('created'=>'desc');
            });
        }
    }

    public function admin_index() {

        $this->loadModel('Group');
        $this->loadModel('Loan');
        $this->loadModel('Due');
        $this->loadModel('User');
        $group = $this->Group->find('all', array(
            'conditions' => array(
                'Group.is_closed' => 0,
                'Group.is_delete' => 0
            ),
            'fields' => array('id', 'name', 'disp_amount', 'interest'),
            'recursive' => -1
        ));

        foreach ($group as $groups) {
            $gname = $groups['Group']['name'];
            $loan = $this->Loan->find('list', array('fields' => array('id'), 'conditions' => array('group_id' => $groups['Group']['id'], 'is_delete' => 0), 'recursive' => -1));
            $due = $this->Due->find('first', array('fields' => array('SUM(amount) as amount'), 'conditions' => array('loan_id' => $loan), 'recursive' => -1));

            $price = $due[0]['amount'];

            $data[] = "['" . $gname . "'," . $price . "]";
            $totAmount += $groups['Group']['disp_amount'];
            $interest += $groups['Group']['interest'];
            $collection += $price;
        }

        $this->set('data', implode(',', $data));

        $group = $this->Group->find('count', array(
            'conditions' => array(
                'Group.is_closed' => 0,
                'Group.is_delete' => 0
            ),
            'recursive' => -1
        ));

        $member = $this->User->find('count', array('conditions' => array('user_type' => 'customer', 'is_delete' => 0), 'recursive' => -1));
        $this->set('collection', $collection);
        $this->set('interest', $interest);
        $this->set('dispAmount', $totAmount);
        $this->set('member', $member);
        $this->set('center', $group);

        $sdate = date('y-m-d', strtotime("last saturday"));
        $edate = date("y-m-d");
        
        $due = $this->Due->find('first', array('fields'=>array('sum(amount) as amount'),'conditions' => array('type'=>1,'date(Due.created) BETWEEN ? AND ?' => array($sdate, $edate))));
        $this->set('nextCollection', $due[0]['amount']);
    }

    function nextDue() {
        $loans = $this->Loan->find('all', array(
            'conditions' => array(
                'Loan.is_delete' => 0,
                'Loan.is_closed' => 0
            ),
            'contain' => array(
                'Due' => array(
                    'fields' => array(
                        'SUM(min_amt_paid) as min_total',
                        'SUM(extra_amt_paid) as extra_total'
                    )
                )
            ),
            'fields' => array('min_amt_total', 'extra_amt_total', 'amt_permin_week', 'amt_perextra_week'),
            'recursive' => -1));

        if (!empty($loans)) {
            $loan = "";
            foreach ($loans as $loan) {
                if (empty($loan['Due'][0]['Due'][0]['min_total'])) {
                    $loan['Due'][0]['Due'][0]['min_total'] = 0;
                }
                if (empty($loan['Due'][0]['Due'][0]['extra_total'])) {
                    $loan['Due'][0]['Due'][0]['min_total'] = 0;
                }
                if (empty($loan['Loan']['extra_amt_total'])) {

                    if ($loan['Loan']['min_amt_total'] > $loan['Due'][0]['Due'][0]['min_total']) {
                        $amount += $loan['Loan']['amt_permin_week'];
                    }
                } else {
                    if ($loan['Loan']['min_amt_total'] > $loan['Due'][0]['Due'][0]['min_total'] && $loan['Loan']['extra_amt_total'] > $loan['Due'][0]['Due'][0]['extra_total']) {

                        $tot = $loan['Loan']['amt_permin_week'] + $loan['Loan']['amt_perextra_week'];
                        $amount += $tot;
                    } else if ($loan['Loan']['min_amt_total'] > $loan['Due'][0]['Due'][0]['min_total'] || $loan['Loan']['extra_amt_total'] > $loan['Due'][0]['Due'][0]['extra_total']) {

                        $tot = $loan['Loan']['amt_permin_week'];
                        $amount += $tot;
                    }
                }
            }
        }

        return $amount;
    }

}
