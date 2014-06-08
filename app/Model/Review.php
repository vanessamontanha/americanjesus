<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Review
 * @author Vanessa
 */

class Review extends AppModel {

	/**
	 * Name of Class
	 * @var string
	 */
	public $name = 'Review';
	
	/**
	 * Belongs to
	 * @var array
	 */
	public $belongsTo = array(
		'Store'=>array(
			'className'=>'Store'
		),
	);
	
	/**
	 * Validation rules
	 * @var array
	 */
	public $validate = array(
		'store_id'=>array(
			'rule' => 'notEmpty'
		),
		'review'=>array(
			'custom' => array(
				'rule' => array('custom','/^[a-z0-9 ]*$/i'),
				'message' => 'Only characters & numbers are allowed'
			),
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter a Review'
			)
		),
		'stars'=>array(
			'rule' => 'notEmpty'
		),
	);
	
	/**
	 * before Save
	 * @param type $options 
	 */
	public function beforeSave($options = array()) {
		$this->data['Review']['session_id'] = session_id();
		$this->data['Review']['ip'] = $_SERVER['REMOTE_ADDR'];
		
		parent::beforeSave($options);
		
	return TRUE;
	}
}