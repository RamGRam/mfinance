<?php

App::uses('AppController', 'Controller');

class DuesController extends AppController {

    public $components = array(
        'Crud.Crud' => array(
            'actions' => array(
                'api_index' => array('className' => 'Crud.Index'),
                'admin_index' => array('className' => 'Crud.Index', 'relatedModels' => false),
                'admin_closed' => array('className' => 'Crud.Index', 'relatedModels' => false),
                'admin_add' => array('className' => 'Crud.Add', 'relatedModels' => false, 'view' => 'admin_form', 'saveOptions' => array('deep' => true)),
                'admin_edit' => array('className' => 'Crud.Edit', 'relatedModels' => false, 'view' => 'admin_form', 'saveOptions' => array('deep' => true)),
                'admin_view' => array('className' => 'Crud.View', 'relatedModels' => false),
                'admin_delete' => array('className' => 'Crud.Delete'),
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
                $this->loadModel('Loan');
                $loan = $this->Loan->find('list', array('fields'=>array('id'),'conditions' => array('is_delete' => 0,'is_closed' => 0), 'recursive' => -1));
                $event->subject->paginator->settings['order'] = array('updated' => 'desc');
                $event->subject->paginator->settings['conditions'] = array('loan_id' => $loan);
                $event->subject->paginator->settings['recursive'] = 0;
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
                $event->subject->paginator->settings['conditions'] = array('is_closed' => 1);
                $event->subject->paginator->settings['recursive'] = -1;
            }
        });
        $this->Crud->execute();
    }

    public function admin_index() {

        $this->set('statuses', array(
            '1' => __('Collection'),
            '0' => __('Arrear'),
        ));

        $this->set('type', array(
            '1' => __('Collection'),
            '2' => __('Arrear'),
        ));

        $this->loadModel('Due');


        $cond1 = array('Due.type' => 1, 'Loan.is_closed' => 0, 'Loan.is_delete' => 0);
        $cond2 = array('Due.type' => 2, 'Loan.is_closed' => 0, 'Loan.is_delete' => 0);
        if (!empty($_REQUEST)) {
            if (!empty($_REQUEST['loan_id'])) {
                $cond11 = array('Due.loan_id' => $_REQUEST['loan_id']);
                $cond1 = array_merge($cond1, $cond11);
                $cond2 = array_merge($cond2, $cond11);
            }
            if (!empty($_REQUEST['amount'])) {
                $cond11 = array('Due.amount' => $_REQUEST['amount']);
                $cond1 = array_merge($cond1, $cond11);
                $cond2 = array_merge($cond2, $cond11);
            }
            if (!empty($_REQUEST['user_id'])) {
                $cond11 = array('Due.user_id' => $_REQUEST['user_id']);
                $cond1 = array_merge($cond1, $cond11);
                $cond2 = array_merge($cond2, $cond11);
            }
            if (!empty($_REQUEST['type'])) {
                $cond11 = array('Due.type' => $_REQUEST['type']);
                $cond1 = array_merge($cond1, $cond11);
                $cond2 = array_merge($cond2, $cond11);
            }
            if (!empty($_REQUEST['date'])) {
                $date = explode('-', $_REQUEST['date']);
                $cond11 = array('Due.created >=' => date('Y-m-d', strtotime($date[0])));
                $cond1 = array_merge($cond1, $cond11);
                $cond2 = array_merge($cond2, $cond11);
                $cond11 = array('Due.created <=' => date('Y-m-d', strtotime($date[1])));
                $cond1 = array_merge($cond1, $cond11);
                $cond2 = array_merge($cond2, $cond11);
            }
        }

        $collection = $this->Due->find('first', array(
            'conditions' => $cond1,
            'fields' => array(
                'SUM(amount) as tot'
            )
        ));
        $arrear = $this->Due->find('first', array(
            'conditions' => $cond2,
            'fields' => array(
                'SUM(amount) as tot'
            )
        ));
        if (empty($collection[0]['tot'])) {
            $collection[0]['tot'] = 0;
        }
        if (empty($arrear[0]['tot'])) {
            $arrear[0]['tot'] = 0;
        }

        $this->set('collection', round($collection[0]['tot'],2));
        $this->set('arrear', round($arrear[0]['tot'],2));
        $this->Crud->execute();
    }

    public function admin_closed() {

        $this->Crud->on('beforePaginate', function(CakeEvent $event) {
            $this->loadModel('Loan');
            $loan = $this->Loan->find('list', array('fields'=>array('id'),'conditions' => array('is_delete' => 0,'is_closed' => 1), 'recursive' => -1));
            $event->subject->paginator->settings['order'] = array('updated' => 'desc');
            $event->subject->paginator->settings['conditions'] = array('loan_id' => $loan);
            $event->subject->paginator->settings['recursive'] = 0;
        });

        $this->set('statuses', array(
            '1' => __('Collection'),
            '0' => __('Arrear'),
        ));

        $this->set('type', array(
            '1' => __('Collection'),
            '2' => __('Arrear'),
        ));

        $cond1 = array('Due.type' => 1, 'Loan.is_closed' => 1, 'Loan.is_delete' => 0);
        $cond2 = array('Due.type' => 2, 'Loan.is_closed' => 1, 'Loan.is_delete' => 0);
        if (!empty($_REQUEST)) {
            if (!empty($_REQUEST['loan_id'])) {
                $cond11 = array('Due.loan_id' => $_REQUEST['loan_id']);
                $cond1 = array_merge($cond1, $cond11);
                $cond2 = array_merge($cond2, $cond11);
            }
            if (!empty($_REQUEST['amount'])) {
                $cond11 = array('Due.amount' => $_REQUEST['amount']);
                $cond1 = array_merge($cond1, $cond11);
                $cond2 = array_merge($cond2, $cond11);
            }
            if (!empty($_REQUEST['user_id'])) {
                $cond11 = array('Due.user_id' => $_REQUEST['user_id']);
                $cond1 = array_merge($cond1, $cond11);
                $cond2 = array_merge($cond2, $cond11);
            }
            if (!empty($_REQUEST['type'])) {
                $cond11 = array('Due.type' => $_REQUEST['type']);
                $cond1 = array_merge($cond1, $cond11);
                $cond2 = array_merge($cond2, $cond11);
            }
            if (!empty($_REQUEST['date'])) {
                $date = explode('-', $_REQUEST['date']);
                $cond11 = array('Due.created >=' => date('Y-m-d', strtotime($date[0])));
                $cond1 = array_merge($cond1, $cond11);
                $cond2 = array_merge($cond2, $cond11);
                $cond11 = array('Due.created <=' => date('Y-m-d', strtotime($date[1])));
                $cond1 = array_merge($cond1, $cond11);
                $cond2 = array_merge($cond2, $cond11);
            }
        }

        $collection = $this->Due->find('first', array(
            'conditions' => $cond1,
            'fields' => array(
                'SUM(amount) as tot'
            )
        ));
        $arrear = $this->Due->find('first', array(
            'conditions' => $cond2,
            'fields' => array(
                'SUM(amount) as tot'
            )
        ));
        if (empty($collection[0]['tot'])) {
            $collection[0]['tot'] = 0;
        }
        if (empty($arrear[0]['tot'])) {
            $arrear[0]['tot'] = 0;
        }

        $this->set('collection', round($collection[0]['tot'],2));
        $this->set('arrear', round($arrear[0]['tot'],2));

        $this->Crud->execute();
    }

    public function admin_add() {

        $this->Crud->on('afterSave', function(\Cake\Event\Event $event) {
            $this->loadModel('Loan');
            $this->loadModel('Due');
            $this->loadModel('Group');
            $loan = $this->Loan->find('first', array('conditions' => array('id' => $this->request->data['Due']['loan_id']), 'recursive' => -1));
            $due = $this->Due->find('first', array('fields' => array('SUM(amount) as amount'), 'conditions' => array('loan_id' => $this->request->data['Due']['loan_id'], 'type' => 1), 'recursive' => -1));
            if (!empty($loan)) {
                if (($loan['Loan']['min_amt_total'] + $loan['Loan']['extra_amt_total']) <= $due[0]['amount']) {
                    $this->Loan->id = $this->request->data['Due']['loan_id'];
                    $this->Loan->query('update mf_loans set is_closed=1 where id='.$this->Loan->id.'');
                    $list = $this->Loan->find('count', array('conditions' => array('is_closed' => 1, 'group_id' => $loan['Loan']['group_id']), 'recursive' => -1));
                    $group = $this->Group->find('first', array('fields' => array('no_of_members'), 'conditions' => array('id' => $loan['Loan']['group_id']), 'recursive' => -1));
                    
                    if ($group['Group']['no_of_members'] == $list) {
                        $this->Group->id = $loan['Loan']['group_id'];
                        $this->Loan->query('update mf_groups set is_closed=1 where id='.$this->Group->id.'');
                    }
                }
            }
        });


        $this->Crud->action()->config('messages.success.text', "{name} successfully added!");
        $this->Crud->action()->config('messages.error.text', "{name} not added!");
        $this->Crud->execute();
    }

    public function admin_edit($id) {

        $this->Crud->on('afterSave', function(\Cake\Event\Event $event) {
            $this->loadModel('Loan');
            $this->loadModel('Due');
            $this->loadModel('Group');
            $loan = $this->Loan->find('first', array('conditions' => array('id' => $this->request->data['Due']['loan_id']), 'recursive' => -1));
            $due = $this->Due->find('all', array('conditions' => array('loan_id' => $this->request->data['Due']['loan_id'], 'type' => 1), 'recursive' => -1));
            if ($loan['Loan']['min_amt_week'] == count($due)) {
                $this->Loan->id = $this->request->data['Due']['loan_id'];
                $this->Loan->save(array('is_closed' => 1));

                $list = $this->Loan->find('count', array('conditions' => array('is_closed' => 1, 'group_id' => $loan['Loan']['group_id']), 'recursive' => -1));
                $group = $this->Group->find('first', array('fields' => array('no_of_members'), 'conditions' => array('id' => $loan['Loan']['group_id']), 'recursive' => -1));
                if ($group['Group']['no_of_members'] == $list) {
                    $this->Group->id = $loan['Loan']['group_id'];
                    $this->Group->save(array('is_closed' => 1));
                }
            }
        });

        $this->Crud->action()->config('messages.success.text', "{name} successfully updated!");
        $this->Crud->action()->config('messages.error.text', "{name} not updated!");
        $this->Crud->execute();
    }

    public function admin_view($id) {
        $this->Crud->execute();
    }

    public function admin_delete($id) {

        $this->Crud->execute();
    }

}
