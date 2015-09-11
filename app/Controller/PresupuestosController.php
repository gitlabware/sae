<?php

App::uses('AppController', 'Controller');

class PresupuestosController extends AppController {

  public $uses = array('Presupuesto', 'Concepto', 'Subconcepto','Ingreso');
  public $layout = 'sae';

  public function index() {
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $presupuestos = $this->Presupuesto->find('all', array(
      'recursive' => -1,
      'conditions' => array('edificio_id' => $idEdificio)
    ));
    $this->set(compact('idEdificio', 'presupuestos'));
  }

  public function gestion($idPresupuesto = NULL) {
    $this->layout = 'ajax';
    $this->Presupuesto->id = $idPresupuesto;
    $this->request->data = $this->Presupuesto->read();
  }

  public function guarda_gestion() {
    $valida = $this->validar('Presupuesto');
    if (empty($valida)) {
      $this->Presupuesto->create();
      $this->Presupuesto->save($this->request->data['Presupuesto']);
      $idPresupuesto = $this->Presupuesto->getLastInsertID();
      $this->Session->setFlash('Se regsitro correctamente', 'msgbueno');
      $this->redirect(array('action' => 'presupuesto', $idPresupuesto));
    } else {
      $this->Session->setFlash($valida, 'msgerror');
      $this->redirect(array('action' => 'index'));
    }
  }

  public function eliminar($idPresupuesto = null) {
    if ($this->Presupuesto->delete($idPresupuesto)) {
      $this->Session->setFlash('Se elimino correctamente!!!', 'msgbueno');
    } else {
      $this->Session->setFlash('No se pudo eliminar, verifique que la presupuesto exista!!!', 'msgerror');
    }
    $this->redirect($this->referer());
  }

  public function presupuesto($idPresupuesto = null) {
    $idEdificio = $this->Session->read('Auth.USer.edificio_id');
    $presupuesto = $this->Presupuesto->findByid($idPresupuesto);
    $subconceptos = $this->Subconcepto->find('list', array(
      'conditions' => array('Subconcepto.edificio_id' => $idEdificio),
      'fields' => array('Subconcepto.id','Subconcepto.nombre')
    ));
    $conceptos = $this->Concepto->find('list',array('fields' => array('id','nombre')));
    $ingresos = $this->Ingreso->find('all',array(
      'recursive' => 0,
      'conditions' => array('Ingreso.presupuesto_id' => $idPresupuesto)
    ));
    $this->set(compact('presupuesto', 'subconceptos','conceptos','ingresos'));
  }
  
  public function guarda_ingreso(){
    debug($this->request->data);
    exit;
  }

}
