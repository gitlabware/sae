<?php

App::uses('AppController', 'Controller');

class ConceptosController extends AppController {

  public $uses = array('Concepto', 'Edificioconcepto', 'Ambienteconcepto', 'User', 'Ambiente', 'Subconcepto');
  public $layout = 'sae';

  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow();
  }

  public function eservicios($idEdificio = NULL) {
    $this->layout = 'ajax';
    $servicios = $this->Edificioconcepto->findAllByedificio_id($idEdificio);
    $conceptos = $this->Concepto->find('list', array('fields' => 'Concepto.nombre', 'conditions' => array('Concepto.edificio_id' => $idEdificio)));
    $this->set(compact('servicios', 'idEdificio', 'conceptos'));
  }

  public function guarda_nuevo_servicio() {
    $this->Concepto->create();
    $this->Concepto->save($this->request->data['Concepto']);
    $idConcepto = $this->Concepto->getLastInsertID();
    $this->Edificioconcepto->create();
    $this->request->data['Edificioconcepto']['concepto_id'] = $idConcepto;
    $this->Edificioconcepto->save($this->request->data['Edificioconcepto']);
    exit;
  }

  public function quita_servicio($idEdiConcepto = null, $idEdificio = NULL) {
    $this->Edificioconcepto->delete($idEdiConcepto);
    $this->redirect(array('action' => 'eservicios', $idEdificio));
  }

  public function guarda_servicio() {
    $this->Edificioconcepto->create();
    $this->Edificioconcepto->save($this->request->data['Edificioconcepto']);
    exit;
  }

  //Modulo de servicios de ambientes
  public function aservicios($idAmbiente = NULL, $idEdificio = NULL) {
    $this->layout = 'ajax';
    $ambiente = $this->Ambiente->find('first', array('recursive' => -1, 'conditions' => array('Ambiente.id' => $idAmbiente), 'fields' => array('Ambiente.piso_id')));
    $idPiso = $ambiente['Ambiente']['piso_id'];
    $servicios = $this->Ambienteconcepto->findAllByambiente_id($idAmbiente);
    $conceptos = $this->Concepto->find('list', array('fields' => 'Concepto.nombre'));
    $this->set(compact('servicios', 'idEdificio', 'conceptos', 'idAmbiente', 'idPiso'));
  }

  public function guarda_nuevo_servicio_a() {
    $this->Concepto->create();
    $this->Concepto->save($this->request->data['Concepto']);
    $idConcepto = $this->Concepto->getLastInsertID();
    $this->Ambienteconcepto->create();
    $this->request->data['Ambienteconcepto']['concepto_id'] = $idConcepto;
    $this->Ambienteconcepto->save($this->request->data['Ambienteconcepto']);
    exit;
  }

  public function quita_servicio_a($idAmbConcepto = null, $idAmbiente = NULL, $idEdificio = NULL) {
    $this->Ambienteconcepto->delete($idAmbConcepto);
    $this->redirect(array('action' => 'aservicios', $idAmbiente, $idEdificio));
  }

  public function guarda_servicio_a() {
    $ambientecon = $this->Ambienteconcepto->find('first', array(
      'recursive' => -1,
      'conditions' => array(
        'ambiente_id' => $this->request->data['Ambienteconcepto']['ambiente_id'],
        'concepto_id' => $this->request->data['Ambienteconcepto']['concepto_id']
      ),
      'fields' => array('id')
    ));
    if (!empty($ambientecon)) {
      $this->request->data['Ambienteconcepto']['id'] = $ambientecon['Ambienteconcepto']['id'];
    }
    $this->Ambienteconcepto->create();
    $this->Ambienteconcepto->save($this->request->data['Ambienteconcepto']);
    exit;
  }

  public function ambientes() {
    
    if (!empty($this->request->data)) {
      /*debug($this->request->data);
      exit;*/
      foreach ($this->request->data['Dato']['ambientes'] as $dat) {

        if ($dat['marca'] == '1') {
          $ambientecon = $this->Ambienteconcepto->find('first', array(
            'recursive' => -1,
            'condtions' => array(
              'ambiente_id' => $dat['ambiente_id'],
              'concepto_id' => $this->request->data['Dato']['concepto_id']
            ),
            'fields' => array('id')
          ));
          $datos = NULL;
          $datos['monto'] = $this->request->data['Dato']['monto'];
          $datos['concepto_id'] = $this->request->data['Dato']['concepto_id'];
          $datos['subconcepto_id'] = $this->request->data['Dato']['subconcepto_id'];
          $datos['ambiente_id'] = $dat['ambiente_id'];
          if(!empty($ambientecon)){
            $datos['id'] = $ambientecon['Ambienteconcepto']['id'];
          }
          debug($datos);exit;
          $this->Ambienteconcepto->create();
          $this->Ambienteconcepto->save($datos);
        }
      }
      $this->Session->setFlash("Se a registrado correctamente!!",'msgbueno');
      $this->redirect(array('action' => 'ambientes'));
    }
    $ambientes = $this->Ambiente->find('all', array(
      'recursive' => 0,
      'conditions' => array('Ambiente.edificio_id' => $this->Session->read('Auth.User.edificio_id')),
      'fields' => array('Ambiente.id', 'Ambiente.nombre', 'Piso.nombre', 'Representante.nombre')
    ));
    $conceptos = $this->Concepto->find('list', array('fields' => array('id', 'nombre'), 'order' => array('nombre')));
    $subconceptos = $this->Subconcepto->find('list', array('fields' => array('id', 'nombre'), 'order' => array('nombre')));
    $this->set(compact('ambientes', 'conceptos', 'subconceptos'));
  }

  public function get_conceptos_a($idAmbiente = null) {
    return $this->Ambienteconcepto->find('all', array(
        'recursive' => 0,
        'conditions' => array('Ambienteconcepto.ambiente_id' => $idAmbiente),
        'fields' => array('Concepto.nombre', 'Ambienteconcepto.monto')
    ));
  }

}
