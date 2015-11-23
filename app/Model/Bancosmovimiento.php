<?php
App::uses('AppModel', 'Model');
/**
 * Bancosmovimiento Model
 *
 * @property Desdebanco $Desdebanco
 * @property Desdecuenta $Desdecuenta
 * @property Hastabanco $Hastabanco
 * @property Hastacuenta $Hastacuenta
 */
class Bancosmovimiento extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Desdebanco' => array(
			'className' => 'Banco',
			'foreignKey' => 'desdebanco_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Desdecuenta' => array(
			'className' => 'Cuenta',
			'foreignKey' => 'desdecuenta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Hastabanco' => array(
			'className' => 'Banco',
			'foreignKey' => 'hastabanco_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Hastacuenta' => array(
			'className' => 'Cuenta',
			'foreignKey' => 'hastacuenta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
