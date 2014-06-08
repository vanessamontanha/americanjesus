<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Contact
 * @author Vanessa
 */

class Contact extends AppModel {

	public $name = 'Contact';

	public $validate = array(
		'name' => 'notEmpty',
		'email' => array(
			'rule' => 'email',
			'message' => 'Please enter a valid Email Address'
		),
		'telephone' => array(
			'rule' => 'numeric',
			'message' => 'Please enter a numeric Telephone Number'
		),
		'message' => 'notEmpty'
	);
}