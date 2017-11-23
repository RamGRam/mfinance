<?php

App::uses('BoostCakeHtmlHelper', 'BoostCake.View/Helper');

class AppHtmlHelper extends BoostCakeHtmlHelper {
    
    var $helpers = array('Form');

    public function active($status) {
        $out = '';
        $class = 'label label-';
        if ($status == true) {
            $class .= 'success';
            $out = __('Active');
        } else {
            $class .= 'danger';
            $out = __('Inactive');
        }
        return $this->tag('span', $out, array('class' => $class));
    }

    public function actions($question_id, $survey) {
        $actions = $this->tag('li', $this->link('<i class="fa fa-edit text-orange"></i>' . __("Edit"), array(
                    'action' => 'edit', 'controller' => 'questions', $question_id, $survey), array('escape' => false)));
        /*$actions .= $this->tag('li', $this->Form->postLink('<i class="fa fa-trash-o text-red"></i>' . __("Delete"), array(
                    'action' => 'delete', 'controller' => 'questions', $question_id), array('confirm' => __('Do you really want to delete?'), 'escape' => false)));*/
        $actions = $this->tag('ul', $actions, array('role' => 'menu', 'class' => 'dropdown-menu pull-right'));
        $button = $this->Form->button(__("Action"), array('role' => 'menu', 'class' => 'btn btn-default btn-xs'));
        $span = $this->tag('span', '', array('class' => 'caret'));
        $span .= $this->tag('span', __('Toggle Dropdown'), array('class' => 'sr-only'));
        $button .= $this->Form->button($span, array('role' => 'menu', 'class' => 'btn btn-default btn-xs dropdown-toggle',
            'data-toggle' => 'dropdown'));
        return $this->tag('div', $button . $actions, array('class' => 'btn-group'));
    }

    public function getAnswers($answers, $children = null, $questionnaire = null, $question = null, $survey = null) {
        $li = '';
        $li_class = array('class' => 'answer-li');
        foreach ($answers as $answer) {
            $addNewLink = $this->link('Add question here?', array('controller' => 'questions', 'action' => 'add',
                'survey' => $survey, 'parent' => $question, 'parent_questionnaire' => $questionnaire, 'answer' => $answer['id']), array('escape' => false));
            $text = $this->tag('div', $answer['answer'] . $addNewLink, array('class' => 'ui-sortable-handle'));
            if ($children) {
                $li_class = array('class' => 'list-ns-expanded answer-li');
                $text .= $this->_getChildren($children, $answer['id']);
            }
            $li .= $this->tag('li', $text, $li_class);
        }
        return $this->tag('ol', $li);
    }

    public function _getChildren($childNode, $answer_id) {
        $li = $li_class = '';
        foreach ($childNode as $child) {
            if ($answer_id != $child['Questionnaire']['parent_answer_id']) {
                continue;
            }
            $actions = $this->actions($child['Questionnaire']['question_id'], $child['Questionnaire']['survey_revision_id']);
            $text = $this->tag('div', $child['Question']['question'] . $actions, array('class' => 'ui-sortable-handle'));
            if ($child['Question']['Answer'] && $child['children']) {
                $li_class = array('class' => 'list-ns-expanded');
                $text .= $this->getAnswers($child['Question']['Answer'], $child['children'], $child['Questionnaire']['id'], $child['Questionnaire']['question_id'], $child['Questionnaire']['survey_revision_id']);
            } elseif ($child['Question']['Answer']) {
                $li_class = array('class' => 'list-ns-expanded');
                $text .= $this->getAnswers($child['Question']['Answer'], '', $child['Questionnaire']['id'], $child['Questionnaire']['question_id'], $child['Questionnaire']['survey_revision_id']);
            }
            $li .= $this->tag('li', $text, $li_class);
        }
        return $this->tag('ol', $li);
    }
    
    public function getMarker($bays) {
        $markers = '';
        foreach($bays as $key => $bay) {
            if(($key+1) == count($bays)) {
                $markers .= "['". $bay['bay_id'] ."', '". $bay['latitude'] ."', '". $bay['longitude'] ."', '". ($key+1) ."', '". $bay['bay_state_api'] ."', '". $bay['bay_state_officer'] ."', '". $bay['id'] ."']";
                //$markers .= '["' . $bay['bay_id'] . '", ' . $bay['latitude'] . ', ' . $bay['longitude'] . ', ' . ($key+1) . ',  ' . $bay['bay_state_api'] . ', ' . $bay['bay_state_officer']. ', ' . $bay['id'] . ']';
            } else {
                $markers .= "['". $bay['bay_id'] ."', '". $bay['latitude'] ."', '". $bay['longitude'] ."', '". ($key+1) ."', '". $bay['bay_state_api'] ."', '". $bay['bay_state_officer'] ."', '". $bay['id'] ."'],";
                //$markers .= '["' . $bay['bay_id'] . '", ' . $bay['latitude'] . ', ' . $bay['longitude'] . ', ' . ($key+1) . ',  ' . $bay['bay_state_api'] . ', ' . $bay['bay_state_officer']. ', ' . $bay['id'] . '],';
            }            
        }
        return $markers;
    }

}