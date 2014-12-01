<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

/**
 * CakePHP User
 * @author Vanessa
 */
class User extends AppModel {

	/**
	 * Name of Class
	 * @var string
	 */
	public $name = 'User';
	
	/**
	 * Validation rules
	 * @var array
	 */
	public $validate = array(
            
            'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
         
		'email'=>array(
			'notEmpty'=>array(
				'rule'=>'notEmpty',
				'message'=>'Please insert your email'
			),
			
		),
		'password'=>array(
			'notEmpty'=>array(
				'rule'=>'notEmpty',
				'message'=>'Please insert your password'
			)
		)
	);
	
	/**
	 * Private User
	 * @var array
         *
         * @var type 
         */
	 
	public $_user = array();
	
	
	/**
	 * Check a User is valid
	 * @param array $check
	 * @return bool
         * 
         * @param array $check
         * @return boolean|bool
         */
	 
	public function check_user($check) {
		// only check if Username & Password are present
		if(!empty($check['email']) && !empty($_POST['data']['User']['password'])) {
			// get User by username
			$user = $this->find('first',array(
				'conditions' => array(
					'User.email' => $check['email']
				)
			));
			
			// invalid User
			if(empty($user)) {
			return FALSE;
			}
			
			// compare passwords
			//$salt = Configure::read('Security.salt');
			//if($user['User']['password'] != md5($_POST['data']['User']['password'].$salt)) {
			//return FALSE;
			//}
			
			// save User
			$this->_user = $user;
		}
		
	return TRUE;
	}
	
}

/*	public function beforeSave() {
		// hash Password
		if(!empty($this->data['User']['password'])) {
			$salt = Configure::read('Security.salt');
			$this->data['User']['password'] = md5($this->data['User']['password'].$salt);
		} else {
			// remove Password to prevent overwriting empty value
			unset($this->data['User']['password']);
		}
		
	return TRUE;
	}
}
*/