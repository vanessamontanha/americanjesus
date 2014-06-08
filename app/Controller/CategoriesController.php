<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP CategoriesController
 * @author Vanessa
 */
class CategoriesController extends AppController {
	
	/**
	 * Pagination options
	 * @var array
	 */
	public $paginate = array(
        'limit' => 10,
        'order' => array(
            'Category.name' => 'asc'
        )
    );
        
        /**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Category->recursive = -1;
		$categories = $this->paginate();
		$this->set(compact('categories'));
	}
	
        /**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));
	}
	
	/**
	 * Admin Index 
	 */
	public function admin_index() {
		$this->Category->recursive = -1;
		$categories = $this->paginate();
		$this->set(compact('categories'));
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
			
            if($this->Category->save($this->request->data)) {
                $this->Session->setFlash('The Category has been saved', 'flash_good');
                $this->redirect(array('action' => 'index'));
            }
        }
	}
	
	/**
	 * Admin Edit
	 * @param int $id 
	 */
	public function admin_edit($id=null) {
		$this->Category->id = $id;
		if($this->request->is('get')) {
			$this->Category->recursive = 1;
			$this->request->data = $this->Category->find('first', array(
				'conditions' => array(
					'Category.id' => $id,
				)
			));
			
			if(empty($this->request->data)) {
				$this->Session->setFlash('Invalid Category', 'flash_bad');
                $this->redirect(array('action' => 'index'));
			}
        } else {	
			if(Configure::read('Demo')) {
				$this->Session->setFlash('That action has been disabled for the demo', 'flash_bad');
				$this->redirect(array('action' => 'index'));
			}
			
            if($this->Category->save($this->request->data)) {
                $this->Session->setFlash('The Category has been edited', 'flash_good');
                $this->redirect(array('action' => 'index'));
            }
		}
		
		// view Variables
		$edit = TRUE;
		$this->set(compact('edit'));
		
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
		
		$this->Category->id = $id;
		$category = $this->Category->find('first', array(
			'conditions' => array(
				'Category.id' => $id,
			)
		));
		
		if(!empty($category['Store'])) {
			$this->Session->setFlash('The Category has associated Stores and cannot be deleted', 'flash_bad');
			$this->redirect(array('action' => 'index'));
		}
		
		if($this->Category->delete($id)) {
			$this->Session->setFlash('The Category has been deleted', 'flash_good');
			$this->redirect(array('action' => 'index'));
		}
	}
}