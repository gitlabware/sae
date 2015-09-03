<?php

App::uses('AppController', 'Controller');

class CuentasController extends AppController {

  public $layout = 'sae';
  public $uses = array('Cuenta', 'Concepto', 'Cuentasporcentaje');

  public function index() {
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $cuentas = $this->Cuenta->find('all', array(
      'recursive' => 0,
      'conditions' => array('Cuenta.edificio_id' => $idEdificio)
    ));
    $conceptos = $this->Concepto->find('all');
    /* debug($conceptos);
      exit; */
    $this->set(compact('cuentas', 'conceptos'));
  }

  public function cuenta($idCuenta = null) {
    $this->layout = 'ajax';
    $this->Cuenta->id = $idCuenta;
    $this->request->data = $this->Cuenta->read();
  }

  public function guarda_cuenta() {
    $this->Cuenta->create();
    $this->Cuenta->save($this->request->data['Cuenta']);
    $this->Session->setFlash("Se registro correctamente!!", 'msgbueno');
    $this->redirect($this->referer());
  }

  public function cuentas_porcentajes($idConcepto = null) {
    $this->layout = 'ajax';
    $concepto = $this->Concepto->findByid($idConcepto, null, null, -1);
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $cuentas = $this->Cuenta->find('all', array(
      'conditions' => array('Cuenta.edificio_id' => $idEdificio)
    ));
    $porcentajes = $this->Cuentasporcentaje->find('all', array(
      'recursive' => 0,
      'conditions' => array('Cuentasporcentaje.concepto_id' => $idConcepto),
      'fields' => array('Cuentasporcentaje.cuenta_id', 'Cuentasporcentaje.porcentaje', 'Cuentasporcentaje.id')
    ));

    foreach ($cuentas as $key => $cu) {
      if (!empty(array_column(array_column($porcentajes, 'Cuentasporcentaje'), 'cuenta_id'))) {
        $key2 = array_search($cu['Cuenta']['id'], array_column(array_column($porcentajes, 'Cuentasporcentaje'), 'cuenta_id'));
        if (isset($key2)) {
          $this->request->data['Cuentasporcentaje'][$key]['id'] = $porcentajes[$key2]['Cuentasporcentaje']['id'];
          $this->request->data['Cuentasporcentaje'][$key]['porcentaje'] = $porcentajes[$key2]['Cuentasporcentaje']['porcentaje'];
        }
      }
    }

    $this->set(compact('cuentas', 'concepto', 'porcentajes'));
  }

  public function guarda_porcentaje() {
    if (!empty($this->request->data['Cuentasporcentaje'])) {
      foreach ($this->request->data['Cuentasporcentaje'] as $cu) {
        $this->Cuentasporcentaje->create();
        $this->Cuentasporcentaje->save($cu);
      }
      $this->Session->setFlash("Se registro correctamente!!", 'msgbueno');
    }
    $this->redirect($this->referer());
  }

}
