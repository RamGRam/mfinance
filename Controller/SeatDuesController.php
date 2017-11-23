<?php

App::uses('AppController', 'Controller');

class SeatDuesController extends AppController {

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
                $this->loadModel('Seat');
                $seat = $this->Seat->find('list', array('fields'=>array('id'),'conditions' => array('is_delete'=>0,'is_closed' => 0), 'recursive' => -1));
                $event->subject->paginator->settings['order'] = array('created' => 'desc');
                $event->subject->paginator->settings['conditions'] = array('seat_id' => $seat);
                $event->subject->paginator->settings['contain'] = array('Seat'=>array('fields'=>array('id'),'User'=>array('fields'=>array('name'))));
                $event->subject->paginator->settings['recursive'] = -1;
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
 
        $this->Crud->execute();
    }

    public function admin_closed() {

        $this->Crud->on('beforePaginate', function(CakeEvent $event) {
            $this->loadModel('Seat');
            $seat = $this->Seat->find('list', array('fields'=>array('id'),'conditions' => array('is_delete' => 0,'is_closed' => 1), 'recursive' => -1));
            $event->subject->paginator->settings['order'] = array('created' => 'desc');
            $event->subject->paginator->settings['conditions'] = array('SeatDue.seat_id' => $seat);
            $event->subject->paginator->settings['contain'] = array('Seat'=>array('fields'=>array('id'),'User'=>array('fields'=>array('name'))));
            $event->subject->paginator->settings['recursive'] = -1;
        });
 

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

        $this->Crud->execute();
    }

}
