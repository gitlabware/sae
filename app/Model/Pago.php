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
App::import('model', 'Cuentasporcentaje');
App::import('model', 'Cuentasmonto');

class Pago extends AppModel {
  //The Associations below have been created with all possible keys, those that are not needed can be removed

  /**
   * belongsTo associations
   *
   * @var array
   */
  public $virtualFields = array(
    'monto_total' => "CONCAT( (IF((Pago.porcentaje_interes != 'NULL'),(Pago.monto*Pago.porcentaje_interes/100),(Pago.monto)))+(IF((Pago.retencion != 'NULL'),((Pago.retencion/100)*Pago.monto),0)) )"
  );

  public function afterSave($created, $options = array()) {
    if (!empty($this->data['Pago']['id'])) {
      $idPago = $this->data['Pago']['id'];
    } else {
      $idPago = $this->id;
    }
    $pago = $this->find('first', array(
      'recursive' => -1,
      'conditions' => array('id' => $idPago)
    ));
    $Cuentasporcentaje = new Cuentasporcentaje();
    $cuentas = $Cuentasporcentaje->find('all', array('recursive' => 0,
      'conditions' => array(
        'Cuentasporcentaje.concepto_id' => $pago['Pago']['concepto_id']
        , 'Cuenta.edificio_id' => CakeSession::read('Auth.User.edificio_id')
      ),
      'fields' => array('Cuentasporcentaje.cuenta_id', 'Cuentasporcentaje.porcentaje')
    ));
    $Cuentasmonto = new Cuentasmonto();
    foreach ($cuentas as $cu) {
      $datos['monto'] = $pago['Pago']['monto'] * $cu['Cuentasporcentaje']['porcentaje'] / 100;
      $datos['pago_id'] = $idPago;
      $datos['cuenta_id'] = $cu['Cuentasporcentaje']['cuenta_id'];
      $datos['porcentaje'] = $cu['Cuentasporcentaje']['porcentaje'];
      $Cuentasmonto->create();
      $Cuentasmonto->save($datos);
    }
    return true;
  }

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
