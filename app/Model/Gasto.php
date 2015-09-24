<?php
App::uses('AppModel', 'Model');
/**
 * Gasto Model
 *
 * @property Edificio $Edificio
 */
class Gasto extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

  
  
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Edificio' => array(
			'className' => 'Edificio',
			'foreignKey' => 'edificio_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
