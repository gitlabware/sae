<?php

App::uses('AppModel', 'Model');

/**
 * Pago Model
 *
 * @property Ambiento $Ambiento
 * @property User $User
 * @property Propietario $Propietario
 * @property Concepto $Concepto
 */
class Pago extends AppModel {
  //The Associations below have been created with all possible keys, those that are not needed can be removed

  /**
   * belongsTo associations
   *
   * @var array
   */
  public $virtualFields = array(
    'monto_total' => "CONCAT( Pago.monto+(IF((Pago.retencion != 'NULL'),((Pago.retencion/100)*Pago.monto),0)) )"
  );
  public $belongsTo = array(
    'Ambiente' => array(
      'className' => 'Ambiente',
      'foreignKey' => 'ambiente_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    ),
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    ),
    'Propietario' => array(
      'className' => 'User',
      'foreignKey' => 'propietario_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    ),
    'User' => array(
      'className' => 'Inquilino',
      'foreignKey' => 'inquilino_id',
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
    'Recibo' => array(
      'className' => 'Recibo',
      'foreignKey' => 'recibo_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    )
  );

}
