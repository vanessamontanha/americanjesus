<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * CakePHP ReviewsController
 * @author Vanessa
 */
class ReviewsController extends AppController {

	/**
	 * Helpers
	 * @var array
	 */
	public $helpers = array('Time','Text');
	
	/**
	 * Pagination options
	 * @var array
	 */
	public $paginate = array(
        'limit' => 10,
        'order' => array(
			'Review.approved' => 'asc',
            'Store.name' => 'asc'
        )
    );
	
	/**
	 * Store Reviews
	 * @param int $store_id 
	 */
	public function index($store_id=null) {
		// check id
		if(!$store_id) {
			 $this->Session->setFlash(__('Invalid'), 'alert-box', array('class'=>'alert-error'));
			$this->redirect(array('controller'=>'stores', 'action' => 'index'));
		}
		
		// find Store
		$store = $this->Review->Store->find('first', array(
			'conditions' => array(
				'Store.id' => $store_id,
				'Store.approved' => 1
			)
		));
		
		if(empty($store)) {
			$this->Session->setFlash(__('Invalid Restaurant'), 'alert-box', array('class'=>'alert-error'));
			$this->redirect(array('controller'=>'stores', 'action' => 'index'));
		}
		
		// set View Variables
		$this->set('store', $store);
	}
	
	/**
	 * Add Review
	 * @param int $store_id 
	 */
	public function add($store_id=null) {
		// check id
		if(!$store_id) {
			 $this->Session->setFlash(__('Invalid Review'), 'alert-box', array('class'=>'alert-error'));
			$this->redirect(array('controller'=>'stores', 'action' => 'index'));
		}
		
		// find Store
		$store = $this->Review->Store->find('first', array(
			'conditions' => array(
				'Store.id' => $store_id,
				'Store.approved' => 1
			)
		));
		
		if(empty($store)) {
			 $this->Session->setFlash(__('Invalid Restaurant'), 'alert-box', array('class'=>'alert-error'));
			$this->redirect(array('controller'=>'stores', 'action' => 'index'));
		}
		
		// deal with form
		if($this->request->is('post')) {
			if($this->Review->save($this->request->data)) {
				// send admin an email
				$admin_email = Configure::read('Admin.email');
				$store_email = Configure::read('Store.email');
				$REMOTE_ADDR = env('REMOTE_ADDR');
				if($admin_email && (!empty($REMOTE_ADDR) && $REMOTE_ADDR != '127.0.0.1')) {
					$email = new CakeEmail();
					
					$HTTP_HOST = env('HTTP_HOST');
					if(!empty($HTTP_HOST)) {
						$email->from(array('noreply@'.$HTTP_HOST => 'Applergy'));
					} elseif($store_email) {
						$email->from(array($store_email => 'Applergy'));
					} else {
						$email->from(array('noreply@example.com' => 'Applergy'));
					}
					
					$email->to($admin_email);
					$email->subject('Applergy - New Review Added');
					$email->send("Hello,\n\nA new Review was added, please login to approve it.\n\nCakePHP Store Locator");
				}
				
               $this->Session->setFlash(__('The review has been sent and is subject to approval'), 'alert-box', array('class'=>'alert-success'));
                $this->redirect(array('controller'=>'stores', 'action' => 'index'));
            }
		} else {
			$this->request->data['Review']['store_id'] = $store_id;
			$this->request->data['Review']['stars'] = 3;
		}
		
		// set View Variables
		$this->set('store', $store);
		$this->set('stores', array($store_id=>$store['Store']['name']));
		$this->set('stars', array(1=>1,2=>2,3=>3,4=>4,5=>5));
	}
	
	/**
	 * Admin Index 
	 */
	public function admin_index() {
		$reviews = $this->paginate();
		$this->set(compact('reviews'));
	}
	
	/**
	 * Admin Add 
	 */
	public function admin_add() {
		if($this->request->is('post')) {
			if(Configure::read('Demo')) {
				$this->Session->setFlash('That action has been disabled for the demo', 'flash_bad');
				$this->redirect(array('action' => 'index'));
			}
			
            if($this->Review->save($this->request->data)) {
                $this->Session->setFlash('The Review has been saved', 'flash_good');
                $this->redirect(array('action' => 'index'));
            }
        }
		
		// set View Variables
		$this->set('stores', array(''=>'')+$this->Review->Store->find('list',array(
			'conditions' => array(
				'Store.approved' => 1
			),
			'order' => 'Store.name'
		)));
		$this->set('stars', array(1=>1,2=>2,3=>3,4=>4,5=>5));
	}
	
	/**
	 * Admin Edit
	 * @param int $id 
	 */
	public function admin_edit($id=null) {
		$this->Review->id = $id;
		if($this->request->is('get')) {
			$this->Review->recursive = 1;
			$this->request->data = $this->Review->find('first', array(
				'conditions' => array(
					'Review.id' => $id,
				)
			));
			
			if(empty($this->request->data)) {
				$this->Session->setFlash('Invalid Review', 'flash_bad');
                $this->redirect(array('action' => 'index'));
			}
        } else {
			if(Configure::read('Demo')) {
				$this->Session->setFlash('That action has been disabled for the demo', 'flash_bad');
				$this->redirect(array('action' => 'index'));
			}
			
            if($this->Review->save($this->request->data)) {
                $this->Session->setFlash('The Review has been edited', 'flash_good');
                $this->redirect(array('action' => 'index'));
            }
		}
		
		// view Variables
		$edit = TRUE;
		$stores = $this->Review->Store->find('list',array(
			'conditions' => array(
				'Store.approved' => 1
			),
			'order' => 'Store.name'
		));
		$stars = array(1=>1,2=>2,3=>3,4=>4,5=>5);
		$this->set(compact('edit','stores','stars'));
		
		// load add view
		$this->render('admin_add');
	}
	
	/**
	 * Admin Delete
	 * @param int $id
	 * @throws MethodNotAllowedException 
	 */
	public function admin_delete($id=null) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if(Configure::read('Demo')) {
			$this->Session->setFlash('That action has been disabled for the demo', 'flash_bad');
			$this->redirect(array('action' => 'index'));
		}
		
		if($this->Review->delete($id)) {
			$this->Session->setFlash('The Review has been deleted', 'flash_good');
			$this->redirect(array('action' => 'index'));
		}
	}
	
	/**
	 * Admin Approve
	 * @param int $id
	 */
	public function admin_approve($id=null) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if(Configure::read('Demo')) {
			$this->Session->setFlash('That action has been disabled for the demo', 'flash_bad');
			$this->redirect(array('action' => 'index'));
		}
		
		$this->Review->id = $id;
		if($this->Review->saveField('approved',1)) {
			$this->Session->setFlash('The Review has been approved', 'flash_good');
			$this->redirect(array('action' => 'index'));
		}
	}
	
	/**
	 * Admin Unapprove
	 * @param int $id
	 */
	public function admin_unapprove($id=null) {		
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if(Configure::read('Demo')) {
			$this->Session->setFlash('That action has been disabled for the demo', 'flash_bad');
			$this->redirect(array('action' => 'index'));
		}
		
		$this->Review->id = $id;
		if($this->Review->saveField('approved',0)) {
			$this->Session->setFlash('The Review has been unapproved', 'flash_good');
			$this->redirect(array('action' => 'index'));
		}
	}
}
