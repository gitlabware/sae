<?php
App::uses('AppModel', 'Model');
/**
 * Cuentasegreso Model
 *
 * @property Subgasto $Subgasto
 * @property Cuenta $Cuenta
 * @property Banco $Banco
 */
class Cuentasegreso extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Subgasto' => array(
			'className' => 'Subgasto',
			'foreignKey' => 'subgasto_id',
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
		),
		'Banco' => array(
			'className' => 'Banco',
			'foreignKey' => 'banco_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
