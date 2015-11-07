<?php

App::uses('AppController', 'Controller');

class EgresosController extends AppController {

  public $uses = array('Egreso', 'Cuentasegreso', 'Subgasto', 'Banco', 'Cuenta');
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
    $subgastos = $this->Subgasto->find('list', array(
      'conditions' => array('Subgasto.edificio_id' => $idEdificio),
      'fields' => array('Subgasto.id', 'Subgasto.nombre')
    ));
    $this->set(compact('bancos', 'cuentas', 'subgastos'));
  }

}
