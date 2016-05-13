<?php

App::uses('AppModel', 'Model');

/**
 * Subconcepto Model
 *
 * @property Edificio $Edificio
 * @property Concepto $Concepto
 */
class Subconcepto extends AppModel {

  //public $useTable = 'subconcepto';
  public $useTable = 'subconceptos';
  public $actsAs = array('Tree');
  //The Associations below have been created with all possible keys, those that are not needed can be removed

  public $displayField = 'nombre';
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
    'Concepto' => array(
      'className' => 'Concepto',
      'foreignKey' => 'concepto_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    )
  );

}
