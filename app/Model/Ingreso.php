<?php
App::uses('AppModel', 'Model');
/**
 * Ingreso Model
 *
 * @property Presupuesto $Presupuesto
 * @property Concepto $Concepto
 * @property Subconcepto $Subconcepto
 */
class Ingreso extends AppModel {


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
		'Concepto' => array(
			'className' => 'Concepto',
			'foreignKey' => 'concepto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Subconcepto' => array(
			'className' => 'Subconcepto',
			'foreignKey' => 'subconcepto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
