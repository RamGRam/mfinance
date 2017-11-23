<?php
App::uses('BoostCakePaginatorHelper', 'BoostCake.View/Helper');

class AppPaginatorHelper extends BoostCakePaginatorHelper {

    public function sort($key, $title = null, $options = array()) {
        $options = array_merge(array('url' => array(), 'model' => null), $options);
        $sortKey = $this->sortKey($options['model']);
        $defaultModel = $this->defaultModel();
        $isSorted = (
                $sortKey === $key ||
                $sortKey === $defaultModel . '.' . $key ||
                $key === $defaultModel . '.' . $sortKey
                );

        if ($isSorted) {
            $dir = $this->sortDir($options['model']) === 'asc' ? 'desc' : 'asc';
            $class = $dir === 'asc' ? 'fa-sort-desc' : 'fa-sort-asc';
        } else {
            $class = 'fa-sort';
        }
      
        $title .= $this->Html->tag('i', '', array('class' => 'fa ' . $class . ' pull-right'));
        $options['escape'] = false;

        return parent::sort($key, $title, $options);
    }
}
