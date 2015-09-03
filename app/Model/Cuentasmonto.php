<?php
App::uses('AppModel', 'Model');
/**
 * Cuentasmonto Model
 *
 * @property Pago $Pago
 * @property Cuenta $Cuenta
 */
class Cuentasmonto extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Pago' => array(
			'className' => 'Pago',
			'foreignKey' => 'pago_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cuenta' => array(
			'className' => 'Cuenta',
			'foreignKey' => 'cuenta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
