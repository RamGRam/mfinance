<?php

App::uses('PhotoUploadBehavior', 'Model/Behavior');

class Attachment extends AppModel {

    var $useTable = 'attachments';
    //var $recursive = 0;
     
    public $actsAs = array(        
        'PhotoUpload' => array(
            'attachment' => array(
                'thumbnailMethod'=>'php',
                'pathMethod'=>'randomCombined',
                'path'=>'{ROOT}webroot{DS}files{DS}{model}{DS}',
                'thumbnailName'=>'{size}',
                'thumbnailSizes' => array(
                    'thumb' => '50x50'                    
                ),
                'removeOriginal'=>false,
                'deleteFolderOnDelete'=>true                
            )
        )
    );
    
    public $validate = array(
        'GarageProfileImage' => array(
            'extension' => array(
                'rule' => array('isValidExtension', array('jpg', 'gif', 'png'), false),
                //'message' => 'File does not have a jpg, gif, or png extension',
                'message' => false,
                'allowEmpty' => true
            ),            
            'size' => array(
                'rule' => array('isBelowMaxSize', 8388608), //8388608
                'message' => 'File is larger than maximum filesize',
                'allowEmpty' => true
            )           
        )
    );

}