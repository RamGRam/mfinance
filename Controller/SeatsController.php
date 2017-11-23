<?php

App::uses('AppController', 'Controller');

class SeatsController extends AppController {

    public $components = array(
        'Crud.Crud' => array(
            'actions' => array(
                'api_index' => array('className' => 'Crud.Index'),
                'api_closed' => array('className' => 'Crud.Index'),
                'admin_index' => array('className' => 'Crud.Index', 'relatedModels' => false),
                'admin_closed' => array('className' => 'Crud.Index', 'relatedModels' => false),
                'admin_add' => array('className' => 'Crud.Add', 'relatedModels' => false, 'view' => 'admin_form', 'saveOptions' => array('deep' => true)),
                'admin_edit' => array('className' => 'Crud.Edit', 'relatedModels' => false, 'view' => 'admin_form', 'saveOptions' => array('deep' => true)),
                'admin_view' => array('className' => 'Crud.View', 'relatedModels' => false),
                'admin_delete' => array('className' => 'Crud.Delete'),
                'admin_seatdue' => array('className' => 'Crud.Index'),
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
                $event->subject->paginator->settings['order'] = array('Seat.updated' => 'desc');
                $event->subject->paginator->settings['conditions'] = array('Seat.is_closed' => '0', 'Seat.is_delete' => '0');
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
                $event->subject->paginator->settings['conditions'] = array('is_delete' => 0,'is_closed' => 0);
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
                $event->subject->paginator->settings['conditions'] = array('is_delete' => 0,'is_closed' => 1);
                $event->subject->paginator->settings['recursive'] = -1;
            }
        });
        $this->Crud->execute();
    }

    public function admin_seatdue() {

        $seat = $this->Seat->find('first', array(
            'conditions' => array(
                'Seat.user_id' => $_REQUEST['id'],
                'Seat.is_closed' => 0,
                'Seat.is_active' => 1,
                'Seat.is_delete' => 0
            ),
            'fields' => array('amount_per_week'),
            'recursive' => -1));
        if (!empty($seat)) {
 
            $data['data'] = array(
                '0' => array(
                    'id' => $seat['Seat']['amount_per_week'],
                    'name' => $seat['Seat']['amount_per_week']
                )
            );

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
        $this->loadModel('Seat');
        $cond1 = array('Seat.is_closed' => 0, 'Seat.is_delete' => 0);
        if (!empty($_REQUEST)) {
            if (!empty($_REQUEST['user_id'])) {
                $cond11 = array('Seat.user_id' => $_REQUEST['user_id']);
                $cond1 = array_merge($cond1, $cond11);
            }
            if (!empty($_REQUEST['staff_id'])) {
                $cond11 = array('Seat.staff_id' => $_REQUEST['staff_id']);
                $cond1 = array_merge($cond1, $cond11);
            }
            if (!empty($_REQUEST['title'])) {
                $cond11 = array('Seat.title' => $_REQUEST['title']);
                $cond1 = array_merge($cond1, $cond11);
            } 
        }

        $customers = $this->Seat->find('count', array(
            'conditions' => $cond1
        ));
        
        $amount = $this->Seat->find('first', array(
            'conditions' => $cond1,
            'fields' => array(
                'SUM(amount_paid) as tot'
            )
        ));
        if(empty($amount[0]['tot'])){
            $amount[0]['tot'] = 0;
        }
        $this->set('amount', $amount[0]['tot']);
        $this->set('customers', $customers);
        $this->Crud->execute();
    }

    public function admin_closed() {

        $this->Crud->on('beforePaginate', function(CakeEvent $event) {
            $event->subject->paginator->settings['order'] = array('Seat.updated' => 'desc');
            $event->subject->paginator->settings['conditions'] = array('Seat.is_closed' => '1');
            $event->subject->paginator->settings['recursive'] = 0;
        });
        
        $this->loadModel('Seat');
        $cond1 = array('Seat.is_closed' => 1);
        if (!empty($_REQUEST)) {
            if (!empty($_REQUEST['user_id'])) {
                $cond11 = array('Seat.user_id' => $_REQUEST['user_id']);
                $cond1 = array_merge($cond1, $cond11);
            }
            if (!empty($_REQUEST['staff_id'])) {
                $cond11 = array('Seat.staff_id' => $_REQUEST['staff_id']);
                $cond1 = array_merge($cond1, $cond11);
            }
            if (!empty($_REQUEST['title'])) {
                $cond11 = array('Seat.title' => $_REQUEST['title']);
                $cond1 = array_merge($cond1, $cond11);
            } 
        }

        $customers = $this->Seat->find('count', array(
            'conditions' => $cond1
        ));
        
        $amount = $this->Seat->find('first', array(
            'conditions' => $cond1,
            'fields' => array(
                'SUM(amount_paid) as tot'
            )
        ));
        if(empty($amount[0]['tot'])){
            $amount[0]['tot'] = 0;
        }
        $this->set('amount', $amount[0]['tot']);
        $this->set('customers', $customers);
          
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
        $this->Crud->execute();
    }

    public function admin_delete($id) {

        $this->Session->setFlash('Seat successfully deleted!', 'default', array('class' => 'alert alert-success success'));
        $this->Seat->id = $id;
        $this->Seat->save(array('is_delete' => '1'));
        $this->redirect('/admin/seats');
    }

}
