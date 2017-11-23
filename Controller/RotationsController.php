<?php

App::uses('AppController', 'Controller');

class RotationsController extends AppController {

    public $components = array(
        'Crud.Crud' => array(
            'actions' => array(
                'api_index' => array('className' => 'Crud.Index'),
                'admin_index' => array('className' => 'Crud.Index', 'relatedModels' => false),
                'admin_closed' => array('className' => 'Crud.Index', 'relatedModels' => false),
                'admin_add' => array('className' => 'Crud.Add', 'relatedModels' => false, 'view' => 'admin_form', 'saveOptions' => array('deep' => true)),
                'admin_edit' => array('className' => 'Crud.Edit', 'relatedModels' => false, 'view' => 'admin_form', 'saveOptions' => array('deep' => true)),
                'admin_view' => array('className' => 'Crud.View', 'relatedModels' => false),
                'admin_delete' => array('className' => 'Crud.Delete')
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
                $event->subject->paginator->settings['order'] = array('updated' => 'desc');
                $event->subject->paginator->settings['conditions'] = array('is_closed' => 0);
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
                $event->subject->paginator->settings['conditions'] = array('is_delete' => '0', 'is_active' => 1);
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

        $cond1 = array('is_closed' => 0);
        if (!empty($_REQUEST['customer_name'])) {
            $cond11 = array('customer_name LIKE' => "%".$_REQUEST['customer_name']."%");
            $cond1 = array_merge($cond1, $cond11);
        }
        if (!empty($_REQUEST['contact'])) {
            $cond11 = array('contact LIKE' => "%".$_REQUEST['contact']."%");
            $cond1 = array_merge($cond1, $cond11);
        }
        if (!empty($_REQUEST['payment_amount'])) {
            $cond11 = array('payment_amount' => $_REQUEST['payment_amount']);
            $cond1 = array_merge($cond1, $cond11);
        }
        if (!empty($_REQUEST['collection_amount'])) {
            $cond11 = array('collection_amount' => $_REQUEST['collection_amount']);
            $cond1 = array_merge($cond1, $cond11);
        }
        if (!empty($_REQUEST['balance_amount'])) {
            $cond11 = array('balance_amount' => $_REQUEST['balance_amount']);
            $cond1 = array_merge($cond1, $cond11);
        }

        $rotation = $this->Rotation->find('first', array(
            'conditions' => $cond1,
            'fields' => array(
                'SUM(payment_amount) as payment_amount',
                'SUM(collection_amount) as collection_amount',
                'SUM(balance_amount) as balance_amount'
            ), 'recursive' => -1
        ));
        if (empty($rotation[0]['payment_amount'])) {
            $rotation[0]['payment_amount'] = 0;
        }
        if (empty($rotation[0]['collection_amount'])) {
            $rotation[0]['collection_amount'] = 0;
        }
        if (empty($rotation[0]['balance_amount'])) {
            $rotation[0]['balance_amount'] = 0;
        }
        $this->set('payment_amount', $rotation[0]['payment_amount']);
        $this->set('collection_amount', $rotation[0]['collection_amount']);
        $this->set('balance_amount', $rotation[0]['balance_amount']);
        $this->Crud->execute();
    }

    public function admin_closed() {

        $this->Crud->on('beforePaginate', function(CakeEvent $event) {
            $event->subject->paginator->settings['order'] = array('updated' => 'desc');
            $event->subject->paginator->settings['conditions'] = array('is_closed' => '1');
            $event->subject->paginator->settings['recursive'] = -1;
        });

        $cond1 = array('is_closed' => 1);
        if (!empty($_REQUEST['customer_name'])) {
            $cond11 = array('customer_name LIKE' => "%".$_REQUEST['customer_name']."%");
            $cond1 = array_merge($cond1, $cond11);
        }
        if (!empty($_REQUEST['contact'])) {
            $cond11 = array('contact LIKE' => "%".$_REQUEST['contact']."%");
            $cond1 = array_merge($cond1, $cond11);
        }
        if (!empty($_REQUEST['payment_amount'])) {
            $cond11 = array('payment_amount' => $_REQUEST['payment_amount']);
            $cond1 = array_merge($cond1, $cond11);
        }
        if (!empty($_REQUEST['collection_amount'])) {
            $cond11 = array('collection_amount' => $_REQUEST['collection_amount']);
            $cond1 = array_merge($cond1, $cond11);
        }
        if (!empty($_REQUEST['balance_amount'])) {
            $cond11 = array('balance_amount' => $_REQUEST['balance_amount']);
            $cond1 = array_merge($cond1, $cond11);
        }

        $rotation = $this->Rotation->find('first', array(
            'conditions' => $cond1,
            'fields' => array(
                'SUM(payment_amount) as payment_amount',
                'SUM(collection_amount) as collection_amount'  
            ), 'recursive' => -1
        ));
        if (empty($rotation[0]['payment_amount'])) {
            $rotation[0]['payment_amount'] = 0;
        }
        if (empty($rotation[0]['collection_amount'])) {
            $rotation[0]['collection_amount'] = 0;
        }
        
        $this->set('payment_amount', $rotation[0]['payment_amount']);
        $this->set('collection_amount', $rotation[0]['collection_amount']);
         

        $this->set('statuses', array(
            '1' => __('Active'),
            '0' => __('Inactive'),
        ));


        $this->Crud->execute();
    }

    public function admin_add() {

        $this->Crud->on('beforeSave', function(CakeEvent $event) {
            $balance = $this->request->data['Rotation']['payment_amount'] - $this->request->data['Rotation']['collection_amount'];
            $this->request->data['Rotation']['balance_amount'] = $balance;

            if ($this->request->data['Rotation']['payment_amount'] <= $this->request->data['Rotation']['collection_amount']) {
                $this->request->data['Rotation']['balance_amount'] = 0;
                $this->request->data['Rotation']['is_closed'] = 1;
            }
        });

        $this->Crud->action()->config('messages.success.text', "{name} successfully added!");
        $this->Crud->action()->config('messages.error.text', "{name} not added!");
        $this->Crud->execute();
    }

    public function admin_edit($id) {

        $this->Crud->on('beforeSave', function(CakeEvent $event) {
            $balance = $this->request->data['Rotation']['payment_amount'] - $this->request->data['Rotation']['collection_amount'];
            $this->request->data['Rotation']['balance_amount'] = $balance;

            if ($this->request->data['Rotation']['payment_amount'] <= $this->request->data['Rotation']['collection_amount']) {
                $this->request->data['Rotation']['balance_amount'] = 0;
                $this->request->data['Rotation']['is_closed'] = 1;
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

        $this->Session->setFlash('Center successfully deleted!', 'default', array('class' => 'alert alert-success success'));
        $this->Center->id = $id;
        $this->Center->save(array('is_delete' => '1'));
        $this->redirect('/admin/centers');
    }

}
