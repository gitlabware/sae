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
App::import('model', 'Comprobantescuenta');

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
      $idEdificio = CakeSession::read('Auth.User.edificio_id');
      if (!empty($this->data['Pago']['id'])) {
        $idPago = $this->data['Pago']['id'];
      } else {
        $idPago = $this->id;
      }
      $this->virtualFields = array(
        'piso' => "SELECT pisos.nombre FROM pisos WHERE pisos.id = Ambiente.piso_id",
        'monto_total' => "CONCAT( (IF((Pago.porcentaje_interes != 'NULL'),ROUND(Pago.monto*Pago.porcentaje_interes/100,2),(Pago.monto)))+(IF((Pago.retencion != 'NULL'),ROUND((Pago.retencion/100)*Pago.monto,2),0)) )"
      );
      $pago = $this->find('first', array(
        'recursive' => 0,
        'conditions' => array('Pago.id' => $idPago),
        'fields' => array('Pago.*', 'Ambiente.nombre', 'Ambiente.piso_id', 'Pago.piso')
      ));
      //debug($this->data);exit;
      $banco = $this->data['Pago']['banco']['Banco'];
      $Cuenta = new Cuenta();
      $Nomenclatura = new Nomenclatura();
      $nomen_a = $Nomenclatura->find('first', array(
        'recursive' => -1,
        'conditions' => array('id' => $pago['Pago']['nomenclatura_id'])
      ));

      $Comprobantescuenta = new Comprobantescuenta();

      $d_com['cta_ctable'] = $nomen_a['Nomenclatura']['nombre'];
      $d_com['haber'] = $pago['Pago']['monto_total'];
      $d_com['debe'] = NULL;
      $d_com['auxiliar'] = $pago['Ambiente']['nombre'] . '/' . $pago['Pago']['piso'] . ' (' . $pago['Pago']['fecha'] . ')';
      $d_com['comprobante_id'] = $this->data['Pago']['comprobante_id'];
      $d_com['nomenclatura_id'] = $pago['Pago']['nomenclatura_id'];
      $d_com['codigo'] = $nomen_a['Nomenclatura']['codigo_completo'];
      $d_com['edificio_id'] = $idEdificio;

      $Comprobantescuenta->create();
      $Comprobantescuenta->save($d_com);
      
      $d_com['cta_ctable'] = $banco['nombre'];
      $d_com['haber'] = NULL;
      $d_com['debe'] = $pago['Pago']['monto_total'];
      $d_com['auxiliar'] = NULL;
      $d_com['nomenclatura_id'] = $banco['nomenclatura_id'];
      $d_com['comprobante_id'] = $this->data['Pago']['comprobante_id'];
      if (!empty($this->data['Pago']['banco']['Nomenclatura']['codigo_completo'])) {
        $d_com['codigo'] = $this->data['Pago']['banco']['Nomenclatura']['codigo_completo'];
      }else{
        $d_com['codigo'] = NULL;
      }
      $d_com['edificio_id'] = $idEdificio;
      $Comprobantescuenta->create();
      $Comprobantescuenta->save($d_com);


      if (empty($banco['cuenta_id']) && !empty($pago['Pago']['nomenclatura_id'])) {
        $Cuentasporcentaje = new Cuentasporcentaje();

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
          $datos['subconcepto_id'] = $nomen_a['Nomenclatura']['subconcepto_id'];
          //debug($cuentas);exit;
        } elseif (!empty($nomen_a['Nomenclatura']['concepto_id'])) {
          $cuentas = $Cuentasporcentaje->find('all', array('recursive' => 0,
            'conditions' => array(
              'Cuentasporcentaje.concepto_id' => $nomen_a['Nomenclatura']['concepto_id']
              , 'Cuenta.edificio_id' => CakeSession::read('Auth.User.edificio_id')
            ),
            'fields' => array('Cuentasporcentaje.cuenta_id', 'Cuentasporcentaje.porcentaje')
          ));
          $datos['concepto_id'] = $nomen_a['Nomenclatura']['concepto_id'];
        }

        $Cuentasmonto = new Cuentasmonto();
        foreach ($cuentas as $cu) {
          $Cuentasmonto->deleteAll(array('pago_id' => $idPago, 'cuenta_id' => $cu['Cuentasporcentaje']['cuenta_id']));
          $monto = 0.00;
          if (!empty($pago['Pago']['retencion'])) {
            $monto = $pago['Pago']['monto'] + ($pago['Pago']['monto'] * ($pago['Pago']['retencion'] / 100));
          } else {
            $monto = $pago['Pago']['monto'];
          }
          $datos['monto'] = $monto * ($cu['Cuentasporcentaje']['porcentaje'] / 100);
          $datos['pago_id'] = $idPago;
          $datos['cuenta_id'] = $cu['Cuentasporcentaje']['cuenta_id'];
          $datos['porcentaje'] = $cu['Cuentasporcentaje']['porcentaje'];
          $datos['banco_id'] = $banco['id'];
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
      } elseif (!empty($banco['cuenta_id'])) {
        if (!empty($nomen_a['Nomenclatura']['subconcepto_id'])) {
          $datos['subconcepto_id'] = $nomen_a['Nomenclatura']['subconcepto_id'];
          //debug($cuentas);exit;
        } elseif (!empty($nomen_a['Nomenclatura']['concepto_id'])) {
          $datos['concepto_id'] = $nomen_a['Nomenclatura']['concepto_id'];
        }
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
        $datos['banco_id'] = $banco['id'];
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
