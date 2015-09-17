<?php
App::uses('AppModel', 'Model');
/**
 * Recibo Model
 *
 * @property Inquilino $Inquilino
 * @property Propietario $Propietario
 * @property Ambiente $Ambiente
 */
class Recibo extends AppModel {


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
		)
	);
}
