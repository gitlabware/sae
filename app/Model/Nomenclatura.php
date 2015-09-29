<?php
App::uses('AppModel', 'Model');
/**
 * Nomenclatura Model
 *
 * @property Nomenclatura $Nomenclatura
 * @property Edificio $Edificio
 */
class Nomenclatura extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Nomenclatura' => array(
			'className' => 'Nomenclatura',
			'foreignKey' => 'nomenclatura_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Edificio' => array(
			'className' => 'Edificio',
			'foreignKey' => 'edificio_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
