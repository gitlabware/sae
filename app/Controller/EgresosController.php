<?php

App::uses('AppController', 'Controller');

class EgresosController extends AppController {

  public $uses = array('Egreso', 'Cuentasegreso', 'Banco', 'Cuenta', 'Nomenclatura', 'Edificio', 'Comprobante', 'Comprobantescuenta');
  public $layout = 'monster';

  public function egresocuenta() {
    $this->layout = 'ajax';
    if (!empty($this->request->data)) {
      $cuenta = $this->Cuenta->findByid($this->request->data['Cuentasegreso']['cuenta_id'], null, null, -1);
      $banco = $this->Banco->findByid($this->request->data['Cuentasegreso']['banco_id'], null, null, 0);
      if ($this->request->data['Cuentasegreso']['monto'] <= $banco['Banco']['monto'] && $this->request->data['Cuentasegreso']['monto'] <= $cuenta['Cuenta']['monto']) {
        $this->Cuenta->id = $cuenta['Cuenta']['id'];
        $d_cuenta['monto'] = $cuenta['Cuenta']['monto'] - $this->request->data['Cuentasegreso']['monto'];
        $this->Cuenta->save($d_cuenta);
        $this->Banco->id = $banco['Banco']['id'];
        $d_banco['monto'] = $banco['Banco']['monto'] - $this->request->data['Cuentasegreso']['monto'];
        $this->Banco->save($d_banco);
        $this->Cuentasegreso->create();
        $this->Cuentasegreso->save($this->request->data['Cuentasegreso']);
        $this->genera_comprobante($banco);
        $this->Session->setFlash("Se registro correctamente el egreso!!!", 'msgbueno');
      } else {
        $this->Session->setFlash("No se pudo registrar. Verifique cuentas y bancos!!", 'msgerror');
      }
      $this->redirect($this->referer());
    }
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $this->Banco->virtualFields = array(
      'nombre_completo' => "CONCAT(Banco.nombre,' (disponible: ',Banco.monto,' Bs)')"
    );
    $bancos = $this->Banco->find('list', array(
      'conditions' => array('Banco.edificio_id' => $idEdificio,'ISNULL(Banco.deleted)'),
      'fields' => array('Banco.id', 'Banco.nombre_completo')
    ));
    $this->Cuenta->virtualFields = array(
      'nombre_completo' => "CONCAT(Cuenta.nombre,' (disponible: ',Cuenta.monto,' Bs)')"
    );
    $cuentas = $this->Cuenta->find('list', array(
      'conditions' => array('ISNULL(Cuenta.deleted)','Cuenta.edificio_id' => $idEdificio),
      'fields' => array('Cuenta.id', 'Cuenta.nombre_completo')
    ));
    $this->Nomenclatura->virtualFields = array(
      'nombre_completo' => "CONCAT(Nomenclatura.codigo_completo,' - ',Nomenclatura.nombre)"
    );
    $nomenclaturas = $this->Nomenclatura->find('list', array(
      'recursive' => -1,
      'conditions' => array('Nomenclatura.edificio_id' => $idEdificio),
      'fields' => array('id', 'nombre_completo')
    ));
    $this->set(compact('bancos', 'cuentas', 'subgastos', 'nomenclaturas'));
  }

  public function genera_comprobante($banco = null) {

    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $edificio = $this->Edificio->find('first', array(
      'recursive' => -1,
      'conditions' => array('id' => $idEdificio),
      'fields' => array('tc_ufv', 'tc_dolar')
    ));
    $d_comprobante['tipo'] = 'Egreso';
    $d_comprobante['estado'] = 'No Comprobado';
    $d_comprobante['fecha'] = $this->request->data['Cuentasegreso']['fecha'];
    $d_comprobante['nombre'] = $this->request->data['Cuentasegreso']['proveedor'];
    $d_comprobante['nota'] = $this->request->data['Cuentasegreso']['referencia'];
    $d_comprobante['concepto'] = $this->request->data['Cuentasegreso']['detalle'];
    $d_comprobante['tc_ufv'] = $edificio['Edificio']['tc_ufv'];
    $d_comprobante['tc_dolar'] = $edificio['Edificio']['tc_dolar'];
    $d_comprobante['edificio_id'] = $idEdificio;
    $this->Comprobante->create();
    $this->Comprobante->save($d_comprobante);
    $idConprobante = $this->Comprobante->getLastInsertID();


    $nomenclatura = $this->Nomenclatura->find('first', array(
      'recursive' => 0,
      'conditions' => array('Nomenclatura.id' => $this->request->data['Cuentasegreso']['nomenclatura_id']),
      'fields' => array('Nomenclatura.nombre', 'Nomenclatura.codigo_completo', 'Nomenclatura.id', 'Subconcepto.codigo', 'Subconcepto.id')
    ));

    $d_com['cta_ctable'] = $nomenclatura['Nomenclatura']['nombre'];
    $d_com['haber'] = NULL;
    $d_com['debe'] = $this->request->data['Cuentasegreso']['monto'];
    $d_com['comprobante_id'] = $idConprobante;
    $d_com['edificio_id'] = $idEdificio;
    $d_com['auxiliar'] = $this->request->data['Cuentasegreso']['detalle'] . ' (' . $d_comprobante['fecha'] . ')';
    $d_com['codigo'] = $nomenclatura['Nomenclatura']['codigo_completo'];
    $d_com['nomenclatura_id'] = $nomenclatura['Nomenclatura']['id'];
    $d_com['subconcepto_id'] = $nomenclatura['Subconcepto']['id'];
    $d_com['codigo_subc'] = $nomenclatura['Subconcepto']['codigo'];
    $d_com['fecha'] = $this->request->data['Cuentasegreso']['fecha'];

    $this->Comprobantescuenta->create();
    $this->Comprobantescuenta->save($d_com);

    $d_com = array();

    $d_com['cta_ctable'] = $banco['Banco']['nombre'];
    $d_com['haber'] = $this->request->data['Cuentasegreso']['monto'];
    $d_com['debe'] = NULL;
    $d_com['comprobante_id'] = $idConprobante;
    $d_com['edificio_id'] = $idEdificio;
    $d_com['nomenclatura_id'] = $banco['Banco']['nomenclatura_id'];
    $d_com['codigo'] = $banco['Nomenclatura']['codigo_completo'];
    $d_com['auxiliar'] = NULL;

    $this->Comprobantescuenta->create();
    $this->Comprobantescuenta->save($d_com);
  }

  public function genera_comprobante2($banco = null) {

    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $edificio = $this->Edificio->find('first', array(
      'recursive' => -1,
      'conditions' => array('id' => $idEdificio),
      'fields' => array('tc_ufv', 'tc_dolar')
    ));
    $d_comprobante['tipo'] = 'Egreso';
    $d_comprobante['estado'] = 'No Comprobado';
    $d_comprobante['fecha'] = $this->request->data['Cuentasegreso']['fecha'];
    $d_comprobante['nombre'] = $this->request->data['Cuentasegreso']['proveedor'];
    $d_comprobante['nota'] = $this->request->data['Cuentasegreso']['referencia'];
    $d_comprobante['concepto'] = $this->request->data['Cuentasegreso']['detalle'];
    $d_comprobante['tc_ufv'] = $edificio['Edificio']['tc_ufv'];
    $d_comprobante['tc_dolar'] = $edificio['Edificio']['tc_dolar'];
    $d_comprobante['edificio_id'] = $idEdificio;
    $this->Comprobante->create();
    $this->Comprobante->save($d_comprobante);
    $idConprobante = $this->Comprobante->getLastInsertID();

    foreach ($this->request->data['Cuentasegresos'] as $cu) {


      $nomenclatura = $this->Nomenclatura->find('first', array(
        'recursive' => 0,
        'conditions' => array('Nomenclatura.id' => $cu['nomenclatura_id']),
        'fields' => array('Nomenclatura.nombre', 'Nomenclatura.codigo_completo', 'Nomenclatura.id', 'Subconcepto.codigo', 'Subconcepto.id')
      ));

      $d_com['cta_ctable'] = $nomenclatura['Nomenclatura']['nombre'];
      $d_com['haber'] = NULL;
      $d_com['debe'] = $cu['monto'];
      $d_com['comprobante_id'] = $idConprobante;
      $d_com['edificio_id'] = $idEdificio;
      $d_com['auxiliar'] = $cu['detalle'] . ' (' . $d_comprobante['fecha'] . ')';
      $d_com['codigo'] = $nomenclatura['Nomenclatura']['codigo_completo'];
      $d_com['nomenclatura_id'] = $nomenclatura['Nomenclatura']['id'];
      $d_com['subconcepto_id'] = $nomenclatura['Subconcepto']['id'];
      $d_com['codigo_subc'] = $nomenclatura['Subconcepto']['codigo'];
      $d_com['fecha'] = $d_comprobante['fecha'];

      $this->Comprobantescuenta->create();
      $this->Comprobantescuenta->save($d_com);

      $d_com = array();

      $d_com['cta_ctable'] = $banco['Banco']['nombre'];
      $d_com['haber'] = $cu['monto'];
      $d_com['debe'] = NULL;
      $d_com['comprobante_id'] = $idConprobante;
      $d_com['edificio_id'] = $idEdificio;
      $d_com['nomenclatura_id'] = $banco['Banco']['nomenclatura_id'];
      $d_com['codigo'] = $banco['Nomenclatura']['codigo_completo'];
      $d_com['auxiliar'] = NULL;

      $this->Comprobantescuenta->create();
      $this->Comprobantescuenta->save($d_com);
    }
  }

  public function multi_egreso() {
    if (!empty($this->request->data)) {
      $cuenta = $this->Cuenta->findByid($this->request->data['Cuentasegreso']['cuenta_id'], null, null, -1);
      $banco = $this->Banco->findByid($this->request->data['Cuentasegreso']['banco_id'], null, null, 0);

      $total = 0.00;
      $concepto = "";
      foreach ($this->request->data['Cuentasegresos'] as $cu) {
        $total = $total + $cu['monto'];
        if (empty($concepto)) {
          $concepto = $cu['detalle'].' ('.$this->request->data['Cuentasegreso']['fecha'].')';
        } else {
          $concepto = $concepto . '<br> ' . $cu['detalle'].' ('.$this->request->data['Cuentasegreso']['fecha'].')';
        }
      }
      $this->request->data['Cuentasegreso']['detalle'] = $concepto;
      if ($total <= $banco['Banco']['monto'] && $total <= $cuenta['Cuenta']['monto']) {

        $this->Cuenta->id = $cuenta['Cuenta']['id'];
        $d_cuenta['monto'] = $cuenta['Cuenta']['monto'] - $total;
        $this->Cuenta->save($d_cuenta);
        $this->Banco->id = $banco['Banco']['id'];
        $d_banco['monto'] = $banco['Banco']['monto'] - $total;
        $this->Banco->save($d_banco);
        $this->Cuentasegreso->create();
        $this->Cuentasegreso->save($this->request->data['Cuentasegreso']);
        $this->genera_comprobante2($banco);
        $this->Session->setFlash("Se registro correctamente el egreso!!!", 'msgbueno');
      } else {
        $this->Session->setFlash("No se pudo registrar. Verifique cuentas y bancos!!", 'msgerror');
      }
      $this->redirect($this->referer());
    }
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $this->Banco->virtualFields = array(
      'nombre_completo' => "CONCAT(Banco.nombre,' (disponible: ',Banco.monto,' Bs)')"
    );
    $bancos = $this->Banco->find('list', array(
      'conditions' => array('Banco.edificio_id' => $idEdificio,'ISNULL(Banco.deleted)'),
      'fields' => array('Banco.id', 'Banco.nombre_completo')
    ));
    $this->Cuenta->virtualFields = array(
      'nombre_completo' => "CONCAT(Cuenta.nombre,' (disponible: ',Cuenta.monto,' Bs)')"
    );
    $cuentas = $this->Cuenta->find('list', array(
      'conditions' => array('ISNULL(Cuenta.deleted)','Cuenta.edificio_id' => $idEdificio),
      'fields' => array('Cuenta.id', 'Cuenta.nombre_completo')
    ));
    $this->Nomenclatura->virtualFields = array(
      'nombre_completo' => "CONCAT(Nomenclatura.codigo_completo,' - ',Nomenclatura.nombre)"
    );
    $nomenclaturas = $this->Nomenclatura->find('list', array(
      'recursive' => -1,
      'conditions' => array('Nomenclatura.edificio_id' => $idEdificio),
      'fields' => array('id', 'nombre_completo')
    ));
    $this->set(compact('bancos', 'cuentas', 'nomenclaturas'));
  }

}
