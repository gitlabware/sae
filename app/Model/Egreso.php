<?php
App::uses('AppModel', 'Model');
/**
 * Egreso Model
 *
 * @property Presupuesto $Presupuesto
 * @property Nomenclatura $Nomenclatura
 */
class Egreso extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Presupuesto' => array(
			'className' => 'Presupuesto',
			'foreignKey' => 'presupuesto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Nomenclatura' => array(
			'className' => 'Nomenclatura',
			'foreignKey' => 'nomenclatura_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
