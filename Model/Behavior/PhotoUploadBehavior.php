<?php

App::uses('UploadBehavior', 'Upload.Model/Behavior');

class PhotoUploadBehavior extends UploadBehavior {

    public function afterSave(Model $model, $created, $options = array()) {
        parent::afterSave($model, $created, $options);
        foreach ($this->settings[$model->alias] as $field => $options) {
            if (!empty($model->data[$model->alias][$field]) && !empty($this->settings[$model->alias][$field]['removeOriginal'])) {
                $file_path = $this->settings[$model->alias][$field]['path'] . $model->field('dir') . DS . $model->data[$model->alias]['attachment'];
                if (is_file($file_path)) {
                    $pathinfo = pathinfo($model->data[$model->alias]['attachment']);
                    unlink($file_path);
                    copy($this->settings[$model->alias][$field]['path'] . $model->field('dir') . DS . 'thumb.' . $pathinfo['extension'], $file_path);
                }
            }
            if (!empty($model->data[$model->alias][$field]) && !empty($this->settings[$model->alias][$field]['watermarkThumbnail'])) {
                require_once APP . "/Vendor/ImageTool/ImageTool.php";
                foreach ($this->settings[$model->alias][$field]['watermarkThumbnail'] as $thumb => $watermark) {
                    $pathinfo = pathInfo($model->data[$model->alias]['attachment']);
                    $file_path = $this->settings[$model->alias][$field]['path'] . $model->field('dir') . DS . $thumb . '.' . $pathinfo['extension'];
                    ImageTool::watermark(array(
                        'input' => $file_path,
                        'output' => $file_path,
                        'scale' => false,
                        'strech' => false,
                        'repeat' => false,
                        'watermark' => APP . $watermark,
                        'position' => 'center',
                        'compression' => 9,
                        'quality' => 100,
                        'chmod' => null,
                        'opacity' => 50,
                        'afterCallbacks' => array(
                            array('unsharpMask'),
                        )
                    ));
                }
            }
        }
    }

}