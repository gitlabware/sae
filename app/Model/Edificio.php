<?php
App::uses('AppModel', 'Model');
/**
 * Edificio Model
 *
 * @property Ambiente $Ambiente
 * @property Piso $Piso
 */
class Edificio extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Ambiente' => array(
			'className' => 'Ambiente',
			'foreignKey' => 'edificio_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Piso' => array(
			'className' => 'Piso',
			'foreignKey' => 'edificio_id',
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
