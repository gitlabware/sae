<?php

App::uses('AppModel', 'Model');

/**
 * Egreso Model
 *
 * @property Presupuesto $Presupuesto
 * @property Gasto $Gasto
 * @property Subgasto $Subgasto
 */
class Egreso extends AppModel {

  //The Associations below have been created with all possible keys, those that are not needed can be removed
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
    if (!empty($this->data['Egreso']['id'])) {
      $check['Egreso.id !='] = $this->data['Egreso']['id'];
    }
    $check['Egreso.subgasto_id'] = $this->data['Egreso']['subgasto_id'];
    $check['Egreso.gasto_id'] = $this->data['Egreso']['gasto_id'];
    /* debug($this->data);
      debug($check);
      exit; */
    $existingPromoCount = $this->find('count', array(
      'conditions' => $check,
      'recursive' => -1
    ));
    return $existingPromoCount < $limit;
  }

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
    'Gasto' => array(
      'className' => 'Gasto',
      'foreignKey' => 'gasto_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    ),
    'Subgasto' => array(
      'className' => 'Subgasto',
      'foreignKey' => 'subgasto_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    )
  );

}
