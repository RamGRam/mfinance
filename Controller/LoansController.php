<?php

App::uses('AppController', 'Controller');

class LoansController extends AppController {

    public $components = array(
        'Crud.Crud' => array(
            'actions' => array(
                'api_index' => array('className' => 'Crud.Index'),
                'api_closed' => array('className' => 'Crud.Index'),
                'admin_list' => array('className' => 'Crud.Index'),
                'admin_due' => array('className' => 'Crud.Index'),
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
                $event->subject->paginator->settings['order'] = array('Loan.updated' => 'desc');
                $event->subject->paginator->settings['conditions'] = array('Loan.is_closed' => '0','Loan.is_delete' => '0');
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
                $event->subject->paginator->settings['conditions'] = array('Loan.is_closed' => 0);
                $event->subject->paginator->settings['recursive'] = -1;
            }
        });
        $this->Crud->execute();
    }

    public function admin_list() {
        $this->Auth->allow();
        $this->Crud->addListener('Api');
        $this->Crud->addListener('ApiFieldFilter');
        $this->Crud->addListener('ApiPagination');
        $this->Crud->addListener('ApiTransformation');
        $this->Crud->addListener('ApiQueryLog');
        $this->Crud->addListener('Search');
        $this->Crud->on('beforePaginate', function(CakeEvent $event) {
            if (isset($this->request->query['page'])) {

                $this->loadModel('Due');
                $sdate = date('y-m-d', strtotime("last saturday"));
                $edate = date("y-m-d");
                $loanId = $this->Due->find('list', array('fields' => array('id', 'loan_id'), 'conditions' => array('date(Due.created) BETWEEN ? AND ?' => array($sdate, $edate))));
                $loans = $this->Loan->find('list', array('fields' => array('id'), 'conditions' => array('Group.final_collection_date >='=>date('Y-m-d'),'Group.first_collection_date <='=>date('Y-m-d'),'Loan.is_closed'=>0,'Loan.is_delete'=>0),'recursive'=>0));
                $event->subject->paginator->settings['page'] = $this->request->query['page'];
                $event->subject->paginator->settings['conditions'] = array(
                    'Loan.is_closed' => 0,
                    'Loan.id' => $loans,
                    'NOT'=>  array('Loan.id'=>$loanId)
                );
                $event->subject->paginator->settings['recursive'] = -1;
            }
        });
        $this->Crud->execute();
    }
    
    public function api_closed() {
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
                $event->subject->paginator->settings['conditions'] = array('Loan.is_closed' => 1);
                $event->subject->paginator->settings['recursive'] = -1;
            }
        });
        $this->Crud->execute();
    }

    public function admin_due() {
 
        $loan = $this->Loan->find('first', array(
            'conditions' => array(
                'Loan.id' => $_REQUEST['id'],
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
        $this->loadModel('Due');
        $due = $this->Due->find('first',  array('fields'=>array('SUM(min_amt_paid) as minamount','SUM(extra_amt_paid) as extraamount','SUM(amount) as amount'),'conditions'=>array('loan_id'=>$_REQUEST['id'],'type'=>1),'recursive'=>-1));
        if (!empty($loan)) {

            if (empty($loan['Due'][0]['Due'][0]['min_total'])) {
                $loan['Due'][0]['Due'][0]['min_total'] = 0;
            }
            if (empty($loan['Due'][0]['Due'][0]['extra_total'])) {
                $loan['Due'][0]['Due'][0]['min_total'] = 0;
            }

            $data = array('success' => true);
            if (empty($loan['Loan']['extra_amt_total'])) {
                $rem = ($loan['Loan']['min_amt_total']-$due[0]['amount']);
                if ($loan['Loan']['min_amt_total'] > $loan['Due'][0]['Due'][0]['min_total']) {
                    $data['data'] = array(
                        '0' => array(
                            'id' => '1',
                            'name' => $loan['Loan']['amt_permin_week']
                        ),
                        '1' => array(
                            'id' => "2",
                            'name' => "$rem (Pre close)"
                        )
                    );
                } else {
                    $data['data'] = array();
                }
            } else {
                if ($loan['Loan']['min_amt_total'] > $loan['Due'][0]['Due'][0]['min_total'] && $loan['Loan']['extra_amt_total'] > $loan['Due'][0]['Due'][0]['extra_total']) {
                    $rem = (($loan['Loan']['min_amt_total']+$loan['Loan']['extra_amt_total'])-$due[0]['amount']);
                    $tot = $loan['Loan']['amt_permin_week'] + $loan['Loan']['amt_perextra_week'];
                    $data['data'] = array(
                        '0' => array(
                            'id' => "1",
                            'name' => "$tot"
                        ),
                        '1' => array(
                            'id' => "2",
                            'name' => "$rem (Pre close)"
                        )
                    );
                } else if ($loan['Loan']['min_amt_total'] > $loan['Due'][0]['Due'][0]['min_total'] || $loan['Loan']['extra_amt_total'] > $loan['Due'][0]['Due'][0]['extra_total']) {
                    $rem = ($loan['Loan']['min_amt_total']-$due[0]['minamount']);
                    $tot = $loan['Loan']['amt_permin_week'];
                    $data['data'] = array(
                        '0' => array(
                            'id' => "1",
                            'name' => "$tot"
                        ),
                        '1' => array(
                            'id' => "2",
                            'name' => "$rem (Pre close)"
                        )
                    );
                } else {
                    $data['data'] = array();
                }
            }

            $data['pagination'] = array(
                'page_count' => 1,
                'has_next_page' => false,
                'has_prev_page' => false,
                'count' => 1,
                'limit' => 20
            );
        } else {
            $data = array('success' => true);
            $data['data'] = array();
            $data['pagination'] = array(
                'page_count' => 0,
                'has_next_page' => false,
                'has_prev_page' => false,
                'count' => 0,
                'limit' => 20
            );
        }

        echo json_encode($data);
        exit;
    }

    public function admin_index() {
 
        
        $this->set('statuses', array(
            '1' => __('Active'),
            '0' => __('Inactive'),
        ));


        $this->Crud->execute();
    }

    public function admin_closed() {

        $this->Crud->on('beforePaginate', function(CakeEvent $event) {
            $event->subject->paginator->settings['order'] = array('Loan.updated' => 'desc');
            $event->subject->paginator->settings['conditions'] = array('Loan.is_closed' => '1');
            $event->subject->paginator->settings['recursive'] = 0;
        });
        $this->set('statuses', array(
            '1' => __('Active'),
            '0' => __('Inactive'),
        ));


        $this->Crud->execute();
    }

    public function admin_add() {


        $this->Crud->action()->config('messages.success.text', "{name} successfully added!");
        $this->Crud->action()->config('messages.error.text', "{name} not added!");
        $this->Crud->execute();
    }

    public function admin_edit($id) {

        $this->Crud->action()->config('messages.success.text', "{name} successfully updated!");
        $this->Crud->action()->config('messages.error.text', "{name} not updated!");
        $this->Crud->execute();
    }

    public function admin_view($id) {


        $this->loadModel('Due');
        $due = $this->Due->find('first', array('fields' => array('SUM(id) as id', 'SUM(min_amt_paid) as min', 'SUM(extra_amt_paid) as ext', 'SUM(amount) as tot'), 'conditions' => array('loan_id' => $id), 'recursive' => -1));
        $this->set('minAmountPaid', $due[0]['min']);
        $this->set('extAmountPaid', $due[0]['ext']);
        $this->set('totAmountPaid', $due[0]['tot']);
        $this->set('noOfWeek', $due[0]['id']);
        $this->set('loanCount', count($loan));
        $this->Crud->execute();
    }

    public function admin_delete($id) {
        $this->Session->setFlash('Group successfully deleted!', 'default', array('class' => 'alert alert-success success'));
        $this->Loan->id = $id;
        $this->Loan->save(array('is_delete' => '1'));
        $this->redirect('/admin/loans');
    }

}
