<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Category
 * @author Vanessa
 */
class Category extends AppModel {

	/**
	 * Name of Class
	 * @var string
	 */
	public $name = 'Category';
	
	/**
	 * Belongs to
	 * @var array
	 */
	public $hasMany = array(
		'Store'=>array(
			'className'=>'Store'
		)
	);
	
	/**
	 * Validation rules
	 * @var array
	 */
	public $validate = array(
		'name'=>array(
			'rule' => array('custom','/^[a-z0-9 ]*$/i'),
			'message' => 'Only characters & numbers are allowed'
		),
		'icon'=>array(
			'isUploadedFile' => array(
				'rule'=>'isUploadedFile',
				'message'=>'File is invalid'
			),
			'isImage' => array(
				'rule'=>'isImage',
				'message'=>'Only Images are allowed'
			),
		),
	);
	
	/**
	 * Virtual Fields
	 * @var array
	 */
	public $virtualFields = array(
	    'num_stores' => '(SELECT COUNT(*) FROM stores WHERE category_id=Category.id)'
	);
	
	/**
	 * Check file is uploaded
	 * @param array $params
	 * @return boolean 
	 */
	public function isUploadedFile($params) {
		$val = array_shift($params);
		
		if ((isset($val['error']) && $val['error'] == 0) || (!empty( $val['tmp_name']) && $val['tmp_name'] != 'none') ) {
			return is_uploaded_file($val['tmp_name']);
		}
		
	return false;
	}
	
	/**
	 * Check file is an image
	 * @param array $params
	 * @return boolean 
	 */
	public function isImage($params) {
		$val = array_shift($params);
		
		if(getimagesize($val['tmp_name']) !== FALSE) {
			return TRUE;
		}
		
	return FALSE;
	}
	
	/**
	 * Before any Save
	 * @param array $options
	 * @return bool
	 */
	public function beforeSave($options = array()) {
		// upload the file to the icons folder
		if(move_uploaded_file($this->data['Category']['icon']['tmp_name'], WWW_ROOT.'img'.DS.'icons'.DS.$this->data['Category']['icon']['name'])) {
			$this->data['Category']['icon'] = $this->data['Category']['icon']['name'];
		}
		
	return parent::beforeSave($options);
	}
}
