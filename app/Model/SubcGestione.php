<?php
App::uses('AppModel', 'Model');
/**
 * SubcGestione Model
 *
 * @property Subconcepto $Subconcepto
 */
class SubcGestione extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Subconcepto' => array(
			'className' => 'Subconcepto',
			'foreignKey' => 'subconcepto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
