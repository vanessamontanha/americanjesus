<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP ContactsController
 * @author Vanessa
 */

class ContactsController extends AppController {

	public $components = array('RequestHandler');

	public function beforeFilter() {
		parent::beforeFilter();

		// Change layout for Ajax requests
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}
	}

	public function index() {
		// form posted
		if ($this->request->is('post')) {
			// create
			$this->Contact->create();

			// attempt to save
			if ($this->Contact->save($this->request->data)) {
				$this->Session->setFlash(__('Your message has been sent.'), 'alert-box', array('class'=>'alert-success')); 
				$this->redirect(array('action' => 'index'));
			}
		}
	}
}
