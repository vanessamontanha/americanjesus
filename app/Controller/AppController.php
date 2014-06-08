<?php
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	/**
	 * Logged in User
	 * @var array
	 */
	public $_user = array();
	
	/**
	 * Before any Controller Action
	 * @throws NotFoundException 
	 */
	public function beforeFilter() {		
		// get logged in User
		$this->_user = $this->Session->read('User');
		
		// save settings for view so we can turn things on/off
		$this->set('_admin_enable_admin_panel', Configure::read('Admin.enable_admin_panel'));
		$this->set('_feature_allow_visitors_to_add_stores', Configure::read('Feature.allow_visitors_to_add_stores'));
		$this->set('_feature_allow_visitors_to_add_reviews', Configure::read('Feature.allow_visitors_to_add_reviews'));
		$this->set('_feature_allow_reviews', Configure::read('Feature.allow_reviews'));
		$this->set('_feature_enable_browser_geolocation', Configure::read('Feature.enable_browser_geolocation'));
		$this->set('_feature_show_results_table', Configure::read('Feature.show_results_table'));
		$this->set('_search_distance', Configure::read('Search.Distance'));
		$this->set('_demo', Configure::read('Demo'));
		
		// swop layout for admin
		if(isset($this->request->params['admin']) && $this->request->params['admin']) {
			// redirect users to main page if not an admin
			if($this->_user && !$this->_user['User']['admin']) {
				$this->redirect(array('controller'=>'stores','action'=>'index','admin'=>FALSE));
			// throw 404 if User not logged in
			} elseif(!$this->_user) {
				throw new NotFoundException('Page not found');
			} else {
				$this->layout = 'admin';
			}
		}
		
		Configure::write('_user', $this->_user);
		$this->set('_user', $this->_user);
	}
}