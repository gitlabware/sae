<?php
App::uses('AppModel', 'Model');
/**
 * Comprobantescuenta Model
 *
 * @property Nomenclatura $Nomenclatura
 * @property Comprobante $Comprobante
 */
class Comprobantescuenta extends AppModel {


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
		'Comprobante' => array(
			'className' => 'Comprobante',
			'foreignKey' => 'comprobante_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Ambiente' => array(
			'className' => 'Ambiente',
			'foreignKey' => 'ambiente_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
