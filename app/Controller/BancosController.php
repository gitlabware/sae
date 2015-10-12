<?php

App::uses('AppController', 'Controller');

class BancosController extends AppController {

  public $uses = array('Banco', 'Cuenta');
  public $layout = 'sae';

  public function index() {
    $idEficio = $this->Session->read('Auth.User.edificio_id');
    $bancos = $this->Banco->find('all', array(
      'conditions' => array('Banco.edificio_id' => $idEficio)
    ));
    $this->set(compact('bancos'));
  }

  public function banco($idBanco = null) {
    $this->layout = 'ajax';
    $this->Banco->id = $idBanco;
    $this->request->data = $this->Banco->read();
    $cuentas = $this->Cuenta->find('list',array('fields' => array('id','nombre')));
    $this->set(compact('cuentas'));
  }

  public function registra() {
    if (!empty($this->request->data['Banco'])) {
      $this->request->data['Banco']['edificio_id'] = $this->Session->read('Auth.User.edificio_id');
      //debug($this->request->data);exit;
      $this->Banco->create();
      $this->Banco->save($this->request->data['Banco']);
      $this->Session->setFlash("Se registro correctamente!!", 'msgbueno');
    } else {
      $this->Session->setFlash("No se pudo registrar, intente nuevamente!!", 'msgerror');
    }
    $this->redirect(array('action' => 'index'));
  }
  
  public function eliminar($idBanco = null){
    if($this->Banco->delete($idBanco)){
      $this->Session->setFlash("Se ha eliminado correctamente!!",'msgbueno');
    }else{
      $this->Session->setFlash("No se ha podido eliminar, intente nuevamente!!",'msgerror');
    }
    $this->redirect($this->referer());
  }

}
