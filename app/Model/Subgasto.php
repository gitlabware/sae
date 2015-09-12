<?php
App::uses('AppModel', 'Model');
/**
 * Subgasto Model
 *
 * @property Gasto $Gasto
 * @property Egreso $Egreso
 */
class Subgasto extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Gasto' => array(
			'className' => 'Gasto',
			'foreignKey' => 'gasto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Egreso' => array(
			'className' => 'Egreso',
			'foreignKey' => 'subgasto_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
