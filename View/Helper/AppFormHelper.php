<?php

App::uses('BoostCakeFormHelper', 'BoostCake.View/Helper');

class AppFormHelper extends BoostCakeFormHelper {

    public function create($model = null, $options = array()) {
        $prefix = explode('_', $this->request->params['action']);
        //pr($prefix);
        //if(isset($prefix[0]) && $prefix[0]==='admin'){
        $options += array(
            'inputDefaults' => array(
                'div' => 'form-group',
                'wrapInput' => false,
                'class' => 'form-control'
            ),
            'role' => 'form',
            'novalidate'
        );
        //}
        // pr($options);

        return parent::create($model, $options);
    }

    public function input($fieldName, $options = array()) {

        $prefix = explode('_', $this->request->params['action']);
        //if (isset($prefix[0]) && $prefix[0] === 'admin') {
        $label = null;
        if (isset($options['label'])) {
            $label = $options['label'];
            if ($label === false) {
                $options['label'] = false;
                $options['wrapInput'] = 'col col-sm-12';
            } else {
                $options['label'] = array();
                if (is_array($label)) {
                    $options['label'] = $label;
                } else {
                    $options['label']['text'] = $label;
                }
            }
        }

        if (isset($options['type'])) {
            switch ($options['type']) {
                case 'checkbox-inline':
                    $options['type'] = 'checkbox';
                    $options['class'] = false;
                    $options['div'] = false;
                break;
                case 'checkbox':
                    //$label_attr = array('class' => 'col col-sm-3 text-right');
                    $label_attr = '';
                    if (!isset($options['id'])) {
                        $options['id'] = 'id_' . $fieldName . '_' . rand();
                    }
                    $label_attr['for'] = $options['id'];
                    $options['before'] = '<div class="form-group">' . $this->Html->tag('label', $label, $label_attr);
                    $options['after'] = '</div>';
                    $options['label'] = false;
                    $options['class'] = false;
                    $options['checkboxDiv'] = false;
                    $options['beforeInput'] = '<div class="checkbox">';
                    $options['afterInput'] = '</div>';                    
                    break;
                case 'radio':
                    //$options['before'] = $this->Html->tag('label', $label, array('class' => 'col col-sm-12'));
                    $options['class'] = 'radio-inline';
                    $options['legend'] = false;
                    $options['before'] = '<div class="radio">' . $this->Html->tag('label', $label, array('class' => 'radio-heading'));
                    $options['after'] = '</div>';
                    /*$label_attr = '';
                    if (!isset($options['id'])) {
                        $options['id'] = 'id_' . $fieldName . '_' . rand();
                    }
                    $label_attr['for'] = $options['id'];
                    $label_attr['class'] = 'col-sm-2 no-padding';
                    $options['before'] = '<div class="form-group">' . $this->Html->tag('label', $label, $label_attr);
                    $options['after'] = '</div>';
                    $options['class'] = 'radio-inline';
                    $options['legend'] = false;
                    $options['beforeInput'] = '<div class="col-sm-10 no-padding">';
                    $options['afterInput'] = '</div>';*/
                    break;
            }
        }
        //}

        return parent::input($fieldName, $options);
    }

}