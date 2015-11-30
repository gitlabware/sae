<?php

App::uses('AppController', 'Controller');

class EgresosController extends AppController {

  public $uses = array('Egreso', 'Cuentasegreso', 'Banco', 'Cuenta','Nomenclatura');
  public $layout = 'sae';

  public function egresocuenta() {
    $this->layout = 'ajax';
    if (!empty($this->request->data)) {
      $cuenta = $this->Cuenta->findByid($this->request->data['Cuentasegreso']['cuenta_id'], null, null, -1);
      $banco = $this->Banco->findByid($this->request->data['Cuentasegreso']['banco_id'], null, null, -1);
      if ($this->request->data['Cuentasegreso']['monto'] <= $banco['Banco']['monto'] && $this->request->data['Cuentasegreso']['monto'] <= $cuenta['Cuenta']['monto']) {
        $this->Cuenta->id = $cuenta['Cuenta']['id'];
        $d_cuenta['monto'] = $cuenta['Cuenta']['monto'] - $this->request->data['Cuentasegreso']['monto'];
        $this->Cuenta->save($d_cuenta);
        $this->Banco->id = $banco['Banco']['id'];
        $d_banco['monto'] = $banco['Banco']['monto'] - $this->request->data['Cuentasegreso']['monto'];
        $this->Banco->save($d_banco);
        $this->Cuentasegreso->create();
        $this->Cuentasegreso->save($this->request->data['Cuentasegreso']);
        $this->Session->setFlash("Se registro correctamente el egreso!!!",'msgbueno');
      }else{
        $this->Session->setFlash("No se pudo registrar. Verifique cuentas y bancos!!",'msgerror');
      }
      $this->redirect($this->referer());
    }
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $bancos = $this->Banco->find('list', array(
      'conditions' => array('Banco.edificio_id' => $idEdificio),
      'fields' => array('Banco.id', 'Banco.nombre')
    ));
    $cuentas = $this->Cuenta->find('list', array(
      'conditions' => array('Cuenta.edificio_id' => $idEdificio),
      'fields' => array('Cuenta.id', 'Cuenta.nombre')
    ));
    $this->Nomenclatura->virtualFields = array(
      'nombre_completo' => "CONCAT(Nomenclatura.codigo_completo,' - ',Nomenclatura.nombre)"
    );
    $nomenclaturas = $this->Nomenclatura->find('list',array(
      'recursive' => -1,
      'conditions' => array('Nomenclatura.edificio_id' => $idEdificio),
      'fields' => array('id','nombre_completo')
    ));
    $this->set(compact('bancos', 'cuentas', 'subgastos','nomenclaturas'));
  }
  
  public function genera_comprobante($banco = null) {
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $edificio = $this->Edificio->find('first', array(
      'recursive' => -1,
      'conditions' => array('id' => $idEdificio),
      'fields' => array('tc_ufv')
    ));
    $d_comprobante['tipo'] = 'Egreso';
    $d_comprobante['estado'] = 'No Comprobado';
    $d_comprobante['fecha'] = $this->request->data['Cuentasegreso']['fecha'];
    $d_comprobante['nombre'] = $this->request->data['Cuentasegreso']['proveedor'];
    $d_comprobante['nota'] = $this->request->data['Cuentasegreso']['referencia'];
    $d_comprobante['concepto'] = $this->request->data['Cuentasegreso']['detalle'];
    $d_comprobante['tc_ufv'] = $edificio['Edificio']['tc_ufv'];
    $d_comprobante['edificio_id'] = $idEdificio;
    $this->Comprobante->create();
    $this->Comprobante->save($d_comprobante);
    $idConprobante = $this->Comprobante->getLastInsertID();

    $d_com['cta_ctable'] = $banco['Banco']['nombre'];
    $d_com['debe'] = $this->request->data['Cuentasegreso']['monto'];
    $d_com['haber'] = NULL;
    $d_com['comprobante_id'] = $idConprobante;
    $d_com['edificio_id'] = $idEdificio;
    $d_com['nomenclatura_id'] = $banco['Banco']['nomenclatura_id'];
    $d_com['codigo'] = $banco['Nomenclatura']['codigo_completo'];
    $d_com['auxiliar'] = NULL;
    
    $this->Comprobantescuenta->create();
    $this->Comprobantescuenta->save($d_com);
    
    $nomenclatura = $this->Nomenclatura->find('first',array(
      'recursive' => -1,
      'conditions' => array('Nomenclatura.id' => $this->request->data['Cuentasegreso']['nomenclatura_id']),
      'fields' => array('Nomenclatura.')
    ));

    $d_com['cta_ctable'] = $banco['Nomenclatura']['nombre'];
    $d_com['debe'] = NULL;
    $d_com['haber'] = $this->request->data['Cuentasegreso']['monto'];
    $d_com['comprobante_id'] = $idConprobante;
    $d_com['edificio_id'] = $idEdificio;
    $d_com['auxiliar'] = NULL;
    $d_com['codigo'] = $banco['Nomenclatura']['codigo_completo'];
    $d_com['nomenclatura_id'] = $banco['Nomenclatura']['id'];

    $this->Comprobantescuenta->create();
    $this->Comprobantescuenta->save($d_com);
  }

}
