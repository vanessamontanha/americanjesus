<?php
class Store extends AppModel {

	/**
	 * Name of Class
	 * @var string
	 */
	public $name = 'Store';
	
	/**
	 * Belongs to
	 * @var array
	 */
	public $belongsTo = array(
		'Category'=>array(
			'className'=>'Category'
		),
	);
	
	/**
	 * Has Many
	 * @var array
	 */
	public $hasMany = array(
		'Review'=>array(
			'className'=>'Review',
			'conditions' => array(
				'approved' => 1
			),
			'order' => 'created'
		),
	);
	
	/**
	 * Validation rules
	 * @var array
	 */
	public $validate = array(
		'name'=>array(
			'rule' => array('custom','/^[a-z0-9 ]*$/i'),
			'message' => 'Only characters & numbers are allowed',
			'allowEmpty' => false,
		),
		'address'=>array(
			'rule' => array('custom','/^[a-z0-9 ]*$/i'),
			'message' => 'Only characters & numbers are allowed',
			'allowEmpty' => false,
		),
		'email_address'=>array(
			'rule' => 'email',
			'allowEmpty' => TRUE,
			'message' => 'Please enter a valid Email'
		),
		'url'=>array(
			'rule' => array('url',TRUE),
			'allowEmpty' => TRUE,
			'message' => 'Please enter a valid URL e.g. http://www.google.co.uk'
		),
		'description'=>array(
			'rule' => array('custom','/^[a-z0-9 ]*$/i'),
			'message' => 'Only characters & numbers are allowed',
			'allowEmpty' => true,
			'required' => false,
		),
	);
	
	/**
	 * Virtual Fields
	 * @var array
	 */
	public $virtualFields = array(
	    'rating' => '(SELECT COALESCE((SUM(stars)/(SELECT COUNT(*) FROM reviews WHERE store_id=Store.id AND approved=1)),0) FROM reviews WHERE store_id=Store.id AND approved=1)'
	);
	
	/**
	 * Get Stores within a distance
	 * @return array
	 */
	public function get_stores_within_distance() {
		if(!isset($_POST['data']['Store']['lat']) 
			|| !isset($_POST['data']['Store']['lng'])
			|| !isset($_POST['data']['Store']['distance']) ) {
			return array();
		}
		
		// SQL to calculate distance based on Lat/Lng
		$distance_sql = "( 3959 * ACOS( COS( RADIANS(".Sanitize::clean($_POST['data']['Store']['lat']).") ) * COS( RADIANS( lat ) ) * COS( RADIANS( lng ) - RADIANS(".Sanitize::clean($_POST['data']['Store']['lng']).") ) + SIN( RADIANS(".Sanitize::clean($_POST['data']['Store']['lat']).") ) * SIN( RADIANS( lat ) ) ) )";
		
		// change distance for KM
		if(Configure::read('Search.Distance') == 'km') {
			$_POST['data']['Store']['distance'] = $_POST['data']['Store']['distance'] * 1.609344;
			$distance_sql = "({$distance_sql}*1.609344)";
		}
		
		// find conditions
		$conditions = array(
			'Store.approved' => 1,
			'Store.status' => 1,
			"{$distance_sql} <=" => Sanitize::clean($_POST['data']['Store']['distance'])
		);
		
		// filter by Category
		if(isset($_POST['data']['Store']['category']) && $_POST['data']['Store']['category']) {
			$conditions['Store.category_id'] = Sanitize::clean($_POST['data']['Store']['category']);
		}
		
		// find all relevant Stores
		$this->recursive = 1;
		return $this->find('all', array(
			'fields' => array(
				'Store.*',
				'Category.name,Category.icon',
				"{$distance_sql} AS distance"
			),
			'conditions' => $conditions,
			'order' => "{$distance_sql} ASC"
		));
	}
}