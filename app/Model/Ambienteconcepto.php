<?php
App::uses('AppModel', 'Model');
/**
 * Ambienteconcepto Model
 *
 * @property Ambiente $Ambiente
 * @property Concepto $Concepto
 */
class Ambienteconcepto extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Ambiente' => array(
			'className' => 'Ambiente',
			'foreignKey' => 'ambiente_id',
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
		)
	);
}
