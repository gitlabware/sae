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
App::import('model', 'Cuenta');
App::import('model', 'Nomenclatura');

class Pago extends AppModel {
  //The Associations below have been created with all possible keys, those that are not needed can be removed

  /**
   * belongsTo associations
   *
   * @var array
   */
  public $virtualFields = array(
    'monto_total' => "CONCAT( (IF((Pago.porcentaje_interes != 'NULL'),ROUND(Pago.monto*Pago.porcentaje_interes/100,2),(Pago.monto)))+(IF((Pago.retencion != 'NULL'),ROUND((Pago.retencion/100)*Pago.monto,2),0)) )"
  );

  public function afterSave($created, $options = array()) {

    if (!empty($this->data['Pago']['banco']['Banco'])) {
      if (!empty($this->data['Pago']['id'])) {
        $idPago = $this->data['Pago']['id'];
      } else {
        $idPago = $this->id;
      }
      $pago = $this->find('first', array(
        'recursive' => -1,
        'conditions' => array('id' => $idPago)
      ));
      //debug($this->data);exit;
      $banco = $this->data['Pago']['banco']['Banco'];
      $Cuenta = new Cuenta();
      if (empty($banco['cuenta_id']) && !empty($pago['Pago']['nomenclatura_id'])) {
        $Cuentasporcentaje = new Cuentasporcentaje();
        $Nomenclatura = new Nomenclatura();
        $nomen_a = $Nomenclatura->find('first', array(
          'recursive' => -1,
          'conditions' => array('id' => $pago['Pago']['nomenclatura_id'])
        ));
        $cuentas = array();
        //debug($nomen_a);
        if (!empty($nomen_a['Nomenclatura']['subconcepto_id'])) {
          $cuentas = $Cuentasporcentaje->find('all', array('recursive' => 0,
            'conditions' => array(
              'Cuentasporcentaje.subconcepto_id' => $nomen_a['Nomenclatura']['subconcepto_id']
              , 'Cuenta.edificio_id' => CakeSession::read('Auth.User.edificio_id')
            ),
            'fields' => array('Cuentasporcentaje.cuenta_id', 'Cuentasporcentaje.porcentaje')
          ));
          //debug($cuentas);exit;
        }elseif(!empty($nomen_a['Nomenclatura']['concepto_id'])){
          $cuentas = $Cuentasporcentaje->find('all', array('recursive' => 0,
            'conditions' => array(
              'Cuentasporcentaje.concepto_id' => $nomen_a['Nomenclatura']['concepto_id']
              , 'Cuenta.edificio_id' => CakeSession::read('Auth.User.edificio_id')
            ),
            'fields' => array('Cuentasporcentaje.cuenta_id', 'Cuentasporcentaje.porcentaje')
          ));
        }
        
        $Cuentasmonto = new Cuentasmonto();
        foreach ($cuentas as $cu) {
          $Cuentasmonto->deleteAll(array('pago_id' => $idPago, 'cuenta_id' => $cu['Cuentasporcentaje']['cuenta_id']));
          $monto = 0.00;
          if (!empty($pago['Pago']['retencion'])) {
            $monto = $pago['Pago']['monto'] + ($pago['Pago']['monto'] * ($pago['Pago']['retencion'] / 100));
          }
          $datos['monto'] = $monto * ($cu['Cuentasporcentaje']['porcentaje'] / 100);
          $datos['pago_id'] = $idPago;
          $datos['cuenta_id'] = $cu['Cuentasporcentaje']['cuenta_id'];
          $datos['porcentaje'] = $cu['Cuentasporcentaje']['porcentaje'];
          $Cuentasmonto->create();
          $Cuentasmonto->save($datos);

          $cuenta_a = $Cuenta->find('first', array(
            'recursive' => -1,
            'conditions' => array('Cuenta.id' => $cu['Cuentasporcentaje']['cuenta_id'])
          ));
          $Cuenta->id = $cuenta_a['Cuenta']['id'];
          $d_cuenta['monto'] = $cuenta_a['Cuenta']['monto'] + $datos['monto'];
          $Cuenta->save($d_cuenta);
        }
      } else {
        $Cuentasmonto = new Cuentasmonto();
        $Cuentasmonto->deleteAll(array('pago_id' => $idPago, 'cuenta_id' => $banco['cuenta_id']));
        $monto = $pago['Pago']['monto'];
        if (!empty($pago['Pago']['retencion'])) {
          $monto = $pago['Pago']['monto'] + ($pago['Pago']['monto'] * ($pago['Pago']['retencion'] / 100));
        }
        $datos['monto'] = $monto;
        $datos['pago_id'] = $idPago;
        $datos['cuenta_id'] = $banco['cuenta_id'];
        $datos['porcentaje'] = 100;
        $Cuentasmonto->create();
        $Cuentasmonto->save($datos);
        $cuenta_a = $Cuenta->find('first', array(
          'recursive' => -1,
          'conditions' => array('Cuenta.id' => $banco['cuenta_id'])
        ));
        $Cuenta->id = $banco['cuenta_id'];
        $d_cuenta['monto'] = $cuenta_a['Cuenta']['monto'] + $datos['monto'];
        $Cuenta->save($d_cuenta);
      }
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
