<?php

App::uses('AppController', 'Controller');

class GroupsController extends AppController {

    public $components = array(
        'Crud.Crud' => array(
            'actions' => array(
                'api_index' => array('className' => 'Crud.Index'),
                'admin_index' => array('className' => 'Crud.Index', 'relatedModels' => false),
                'admin_closed' => array('className' => 'Crud.Index', 'relatedModels' => false),
                'admin_add' => array('className' => 'Crud.Add', 'relatedModels' => false, 'view' => 'admin_form', 'saveMethod' => 'saveWithAttachments', 'saveOptions' => array('deep' => true)),
                'admin_edit' => array('className' => 'Crud.Edit', 'relatedModels' => false, 'view' => 'admin_form', 'saveMethod' => 'saveWithAttachments', 'saveOptions' => array('deep' => true)),
                'admin_view' => array('className' => 'Crud.View', 'relatedModels' => false, 'view' => 'admin_view'),
                'admin_delete' => array('className' => 'Crud.Delete'),
                'admin_price' => array('className' => 'Crud.Index')
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
                $event->subject->paginator->settings['order'] = array('Group.updated' => 'desc');
                $event->subject->paginator->settings['conditions'] = array('Group.is_closed' => '0','Group.is_delete' => '0');
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
                $event->subject->paginator->settings['conditions'] = array('is_delete' => '0', 'is_closed' => 0);
                $event->subject->paginator->settings['recursive'] = -1;
            }
        });
        $this->Crud->execute();
    }

    public function admin_price() {
        $group = $this->Group->find('first', array('conditions' => array('id' => $_REQUEST['id']), 'recursive' => -1));
        if (!empty($group)) {

            $data = array('success' => true);
            if (!empty($_REQUEST['page'])) {
                if(!empty($group['Group']['extra_amount'])){
                    $data['data'] = array(
                        '0' => array(
                            'id' => '1', 'name' => $group['Group']['loan_type1']
                        ),
                        '1' => array(
                            'id' => '2', 'name' => $group['Group']['loan_type2']
                        )
                    );
                } else {
                    $data['data'] = array(
                        '0' => array(
                            'id' => '1', 'name' => $group['Group']['loan_type1']
                        ) 
                    );
                }
            } else {
                if (empty($_REQUEST['extra_amount'])) {
                    $data['data'] = array(
                        '0' => array(
                            'id' => '1', 'name' => $group['Group']['loan_type1']
                        )
                    );
                } else {
                    $data['data'] = array(
                        '0' => array(
                            'id' => '1', 'name' => $group['Group']['loan_type2']
                        )
                    );
                }
            }


            $data['pagination'] = array(
                'page_count' => 1,
                'has_next_page' => false,
                'has_prev_page' => false,
                'count' => count($data),
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
            $event->subject->paginator->settings['order'] = array('Group.updated' => 'desc');
            $event->subject->paginator->settings['conditions'] = array('Group.is_closed' => '1','Group.is_delete' => '0');
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
 
        $this->loadModel('Loan');
        $this->loadModel('Due');
        $loan = $this->Loan->find('list', array('fields' => array('id'), 'conditions' => array('group_id' => $id), 'recursive' => -1));
        $due = $this->Due->find('first', array('fields' => array('SUM(id) as id', 'SUM(min_amt_paid) as min', 'SUM(extra_amt_paid) as ext', 'SUM(amount) as tot'), 'conditions' => array('type'=>1,'loan_id' => $loan), 'recursive' => -1));
        $minPaid = $this->Due->find('count', array('group'=>array('created'),'conditions' => array('type'=>1,'loan_id' => $loan), 'recursive' => -1));
        $extraPaid = $this->Due->find('count', array('group'=>array('created'),'conditions' => array('extra_amt_paid !='=>NULL,'type'=>1,'loan_id' => $loan), 'recursive' => -1));
        $group = $this->Group->find('first',array('fields'=>array('no_of_members'),'conditions'=>array('id'=>$id),'recursive'=>-1));
        
         
        $minCollWeek = ceil($minPaid/count($loan));
        $extraCollWeek = ceil($extraPaid/count($loan));
        
        $this->set('minCollectionWeek', $minPaid);
        $this->set('extraCollectionWeek', $extraPaid);
        $this->set('minAmountPaid', $due[0]['min']);
        $this->set('extAmountPaid', $due[0]['ext']);
        $this->set('totAmountPaid', $due[0]['tot']);
        $this->set('noOfWeek', $due[0]['id']);
        $this->set('loanCount', count($loan));
        $this->Crud->execute();
    }

    public function admin_delete($id) {

        $this->Session->setFlash('Group successfully deleted!', 'default', array('class' => 'alert alert-success success'));
        $this->Group->id = $id;
        $this->Group->save(array('is_delete' => '1'));
        $this->redirect('/admin/groups');
    }

}
