<?php

App::uses('AppModel', 'Model');

/**
 * Ingreso Model
 *
 * @property Presupuesto $Presupuesto
 * @property Concepto $Concepto
 * @property Subconcepto $Subconcepto
 */
class Ingreso extends AppModel {

  public $validate = array(
    'presupuesto_id' => array(
      'limitDuplicateskcb' => array(
        'rule' => array('limitDuplicateskcb', 1),
        'message' => 'El Ingreso ya fue registrado!!'
      )
    )
  );

  public function limitDuplicateskcb($check, $limit) {

    //$check = array();
    if (!empty($this->data['Ingreso']['id'])) {
      $check['Ingreso.id !='] = $this->data['Ingreso']['id'];
    }
    $check['Ingreso.subconcepto_id'] = $this->data['Ingreso']['subconcepto_id'];
    //$check['Ingreso.concepto_id'] = $this->data['Ingreso']['concepto_id'];
    if(isset($this->data['Ingreso']['subge_id'])){
      $check['Ingreso.subge_id'] = $this->data['Ingreso']['subge_id'];
    }
    /*debug($this->data);
    debug($check);
    exit;*/
    $existingPromoCount = $this->find('count', array(
      'conditions' => $check,
      'recursive' => -1
    ));
    return $existingPromoCount < $limit;
  }

  //The Associations below have been created with all possible keys, those that are not needed can be removed

  /**
   * belongsTo associations
   *
   * @var array
   */
  public $belongsTo = array(
    'Presupuesto' => array(
      'className' => 'Presupuesto',
      'foreignKey' => 'presupuesto_id',
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
    ),
    'Subconcepto' => array(
      'className' => 'Subconcepto',
      'foreignKey' => 'subconcepto_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    ),
    'SubcGestione' => array(
      'className' => 'SubcGestione',
      'foreignKey' => 'subge_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    )
  );

}
