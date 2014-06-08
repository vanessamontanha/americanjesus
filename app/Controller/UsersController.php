<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP UsersController
 * @author Vanessa
 */
class UsersController extends AppController {
	
	/**
	 * Helpers
	 * @var array
	 */
	
        public $helpers = array('Time', 'Html', 'Form', 'Session');
        public $components = array('Session');
	
	/**
	 * Pagination options
	 * @var array
	 */
	public $paginate = array(
        'limit' => 10,
        'order' => array(
			'User.email' => 'asc',
        )
    );
        
  


	/**
	 * Login action
         * 
         * @throws MethodNotAllowedException
         */
	 
	public function login() {
		// disable login if set in settings
		if(!Configure::read('Admin.enable_admin_panel')) {
			throw new MethodNotAllowedException();
		}
		
//		$salt = Configure::read('Security.salt');
//		echo md5('ENTER_YOUR_PASSWORD_HERE'.$salt);
		
		if($this->request->is('post')) {
			// validate form
			$this->User->set($this->data);
			if($this->User->validates()) {
				// save User to Session and redirect
				$this->Session->write('User', $this->User->_user);
				$this->Session->setFlash('You have successfully logged in', 'flash_good');
				
				// redirect Admins to Admin Panel
				if($this->User->_user['User']['admin']) {
					$this->redirect(array('controller'=>'stores', 'action'=>'index', 'admin'=>TRUE));
					
				// redirect normal Users to main page
				} else {
					$this->redirect(array('controller'=>'stores', 'action'=>'index'));
				}
			}
		}
	}
	
	/**
	 * Logout action
         * 
         */
	 
	public function logout() {
		$this->Session->delete('User');
		$this->Session->setFlash('You have successfully logged out', 'flash_good');
		$this->redirect(array('controller'=>'stores', 'action'=>'index'));
	}
        
        
        
	
	/**
	 * Admin Index action
	 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	/**
	 * Admin View action
	 * @param int $id
	 */
	public function admin_view($id = null) {
		$this->User->id = $id;
		$this->User->recursive = 1;
		$user = $this->User->find('first', array(
			'conditions' => array(
				'User.id' => $id,
			)
		));

		if(empty($user)) {
			$this->Session->setFlash('Invalid User', 'flash_bad');
			$this->redirect(array('action' => 'index'));
		}
		
		$this->set(compact('user'));
	}

	/**
	 * Admin Delete action
	 * @param int $id
	 */
	public function admin_delete($id = null) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if(Configure::read('Demo')) {
			$this->Session->setFlash('That action has been disabled for the demo', 'flash_bad');
			$this->redirect(array('action' => 'index'));
		}
		
		if($this->User->delete($id)) {
			$this->Session->setFlash('The User has been deleted', 'flash_good');
			$this->redirect(array('action' => 'index'));
		}
	}
}
