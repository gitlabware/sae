<?php
App::uses('AppModel', 'Model');
/**
 * Ambiente Model
 *
 * @property Categoriasambiente $Categoriasambiente
 * @property Edificio $Edificio
 */
class Ambiente extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Categoriasambiente' => array(
			'className' => 'Categoriasambiente',
			'foreignKey' => 'categoriasambiente_id',
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
