<?php

App::uses('AppController', 'Controller');

class DuesController extends AppController {

    public $components = array(
        'Crud.Crud' => array(
            'actions' => array(
                'api_index' => array('className' => 'Crud.Index'),
                'admin_index' => array('className' => 'Crud.Index', 'relatedModels' => false),
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
                $loan = $this->Loan->find('list',  array('conditions'=>  array('is_closed'=>1),'recursive'=>-1));
                $event->subject->paginator->settings['order'] = array('updated' => 'desc');
                $event->subject->paginator->settings['conditions'] = array('NOT'=>array('loan_id'=>$loan));
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
            '1' => __('Active'),
            '0' => __('Inactive'),
        ));

        $this->set('type', array(
            '1' => __('Collection'),
            '2' => __('Arrear'),
        ));

        $this->Crud->execute();
    }

    public function admin_add() {

//        $this->Crud->on('afterSave', function(\Cake\Event\Event $event) {
//            $this->loadModel('Loan');
//            $this->loadModel('Due');
//            $loan = $this->Loan->find('first', array('conditions' => array('id' => $this->request->data['Due']['loan_id']), 'recursive' => -1));
//            $due = $this->Due->find('all', array('conditions' => array('type' => 1), 'recursive' => -1));
//            if ($loan['Loan']['min_amt_week'] == count($due)) {
//                $this->Loan->id = $this->request->data['Due']['loan_id'];
//                $this->Loan->save(array('is_closed' => 1));
//            }
//        });


        $this->Crud->action()->config('messages.success.text', "{name} successfully added!");
        $this->Crud->action()->config('messages.error.text', "{name} not added!");
        $this->Crud->execute();
    }

    public function admin_edit($id) {
        
        $this->Crud->on('afterSave', function(\Cake\Event\Event $event) {
            $this->loadModel('Loan');
            $this->loadModel('Due');
            $loan = $this->Loan->find('first', array('conditions' => array('id' => $this->request->data['Due']['loan_id']), 'recursive' => -1));
            $due = $this->Due->find('all', array('conditions' => array('type' => 1), 'recursive' => -1));
            if ($loan['Loan']['min_amt_week'] == count($due)) {  
                $this->Loan->id = $this->request->data['Due']['loan_id'];
                $this->Loan->save(array('is_closed' => 1));
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
