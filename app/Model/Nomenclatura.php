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
		
		'Edificio' => array(
			'className' => 'Edificio',
			'foreignKey' => 'edificio_id',
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

	public $hasAndBelongsToMany = array(
		'Ambiente' => array(
			'className' => 'Ambiente',
			'joinTable' => 'nomenclaturas_ambientes',
			'foreignKey' => 'nomenclatura_id',
			'associationForeignKey' => 'ambiente_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);
}
