<?php

App::uses('AppController', 'Controller');

class ComprobantesController extends AppController {
  
  public $uses = array('Comprobante','Comprobantescuenta');
  public $layout = 'sae';
  
  public function index(){
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    
  }
  public function no_comprobados(){
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $this->Comprobante->virtualFields = array(
      'monto_total' => "(SELECT SUM(comprobantescuentas.debe) FROM comprobantescuentas WHERE comprobantescuentas.comprobante_id = Comprobante.id GROUP BY comprobantescuentas.comprobante_id)"
    );
    $comprobantes = $this->Comprobante->find('all',array(
      'recursive' => -1,
      'conditions' => array('Comprobante.edificio_id' => $idEdificio,'Comprobante.estado' => 'No Comprobado'),
      'order' => array('Comprobante.fecha DESC'),
      'fields' => array('Comprobante.*')
    ));
    
    $this->set(compact('comprobantes'));
  }
}