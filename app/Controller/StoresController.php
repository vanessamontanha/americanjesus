<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('CakeEmail', 'Network/Email');

/**
 * CakePHP CategoriesController
 * @author Vanessa
 */
class StoresController extends AppController {
	
	/**
	 * Components
	 * @var array
	 */
	public $components = array('RequestHandler');
	
	/**
	 * Pagination options
	 * @var array
	 */
	public $paginate = array(
        'limit' => 10,
        'order' => array(
			'Store.approved' => 'asc',
            'Store.name' => 'asc'
        )
    );
	
	/**
	 * Distances for index page
	 * @var array
	 */
	public $distances = array(
		'miles' => array(
			'1' => '1 Mile',
			'5' => '5 Miles',
			'10' => '10 Miles',
			'15' => '15 Miles',
			'20' => '20 Miles',
			'30' => '30 Miles',
		),
		'km' => array(
			'1' => '1 Km',
			'5' => '5 Km',
			'10' => '10 Km',
			'15' => '15 Km',
			'20' => '20 Km',
			'30' => '30 Km',
		),
	);
	
	/**
	 * Store Index 
	 */
	public function index() {
		// get Distance unit
		$default_distances = Configure::read('Search.Distance');
		
		// remove address validation rule
		unset($this->Store->validate['address']);
		
		// deal with Ajax Search
		if($this->request->is('ajax')) {
			// set the View Class
			$this->viewClass = 'Json';
			
			// find all relevant Stores
			$stores = $this->Store->get_stores_within_distance();
			
			// set Stores for View
			$this->set('stores',$stores);
			
		} else {
			// get distances unit
			$this->set('default_distances', $default_distances);
			
			// set distance options
			if(isset($this->distances[$default_distances])) {
				$this->set('options_distances', $this->distances[$default_distances]);
			} else {
				$this->set('distances_error', TRUE);
			}
			
			// get used Categories
			$categories = $this->Store->Category->find('list',array(
				'conditions' => array(
					'(SELECT COUNT(*) FROM stores WHERE approved=1 AND category_id=Category.id) >' => 0
				)
			));
			$this->set('categories', array(''=>'')+$categories);
		}
	}
	
	/**
	 * Add a Store 
	 */
	public function add() {
		// disable add page if set in settings
		if(!Configure::read('Feature.allow_visitors_to_add_stores')) {
			throw new MethodNotAllowedException();
		}
		
		if($this->request->is('post')) {
            if($this->Store->save($this->request->data)) {
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
					$email->subject('Applergy - New Store Added');
					$email->send("Hello,\n\nA new Store was added, please login to approve it.\n\nCakePHP Store Locator");
				}
				
               $this->Session->setFlash(__('This restaurant has been submitted and is subject to approval.'), 'alert-box', array('class'=>'alert-success'));
                $this->redirect(array('action' => 'index'));
            }
        }
		
		// get Categories
		$this->set('categories', array(''=>'')+$this->Store->Category->find('list'));
		
		// set Title
		$this->set('title_for_layout','Add Store');
	}
	
	/**
	 * Admin Index 
	 */
	public function admin_index() {
		$stores = $this->paginate();
		$this->set(compact('stores'));
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
			
            if($this->Store->save($this->request->data)) {
                $this->Session->setFlash('Your Store has been saved','flash_good');
                $this->redirect(array('action' => 'index'));
            }
        }
		
		// get Categories
		$this->set('categories', array(''=>'')+$this->Store->Category->find('list'));
	}
	
	/**
	 * Admin Edit
	 * @param int $id
	 */
	public function admin_edit($id=null) {
		$this->Store->id = $id;
		if($this->request->is('get')) {
			$this->Store->recursive = 1;
			$this->request->data = $this->Store->find('first', array(
				'conditions' => array(
					'Store.id' => $id,
				)
			));
			
			if(empty($this->request->data)) {
				$this->Session->setFlash('Invalid Store', 'flash_bad');
                $this->redirect(array('action' => 'index'));
			}
        } else {
			if(Configure::read('Demo')) {
				$this->Session->setFlash('That action has been disabled for the demo', 'flash_bad');
				$this->redirect(array('action' => 'index'));
			}
			
            if($this->Store->save($this->request->data)) {
                $this->Session->setFlash('The Store has been edited', 'flash_good');
                $this->redirect(array('action' => 'index'));
            }
		}
		
		// view Variables
		$edit = TRUE;
		$categories = array(''=>'')+$this->Store->Category->find('list');
		$this->set(compact('edit','categories'));
		
		// load add view
		$this->render('admin_add');
	}
	
	/**
	 * Admin Delete
	 * @param int $id
	 */
	public function admin_delete($id=null) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if(Configure::read('Demo')) {
			$this->Session->setFlash('That action has been disabled for the demo', 'flash_bad');
			$this->redirect(array('action' => 'index'));
		}
		
		if($this->Store->delete($id)) {
			$this->Session->setFlash('The Store has been deleted', 'flash_good');
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
		
		$this->Store->id = $id;
		if($this->Store->saveField('approved',1)) {
			$this->Session->setFlash('The Store has been approved', 'flash_good');
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
		
		$this->Store->id = $id;
		if($this->Store->saveField('approved',0)) {
			$this->Session->setFlash('The Store has been unapproved', 'flash_good');
			$this->redirect(array('action' => 'index'));
		}
	}
}
