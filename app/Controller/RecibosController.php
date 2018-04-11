<?php

App::uses('AppController', 'Controller');

class RecibosController extends AppController {

  public $layout = 'monster';
  public $uses = array(
    'Recibo', 'Pago'
  );

  public function index() {
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $recibos = $this->Recibo->find('all', array(
      'recursive' => -1,
      'conditions' => array('Recibo.edificio_id' => $idEdificio,'ISNULL(Recibo.deleted)'),
      'order' => array('modified DESC')
    ));
    $this->set(compact('recibos'));
  }

  public function eliminar($idRecibo = null) {
    $this->Recibo->id=$idRecibo;
        $erecibo['deleted']=date("Y-m-d H:i:s");
    $this->Recibo->save($erecibo);
    $pagos = $this->Pago->find('all', array(
      'recursive' => -1,
      'conditions' => array('Pago.recibo_id' => $idRecibo),
      'fields' => array('id')
    ));
    $dpa['recibo_id'] = NULL;
    foreach ($pagos as $pa) {
      $this->Pago->id = $pa['Pago']['id'];
      $this->Pago->save($dpa);
    }
    $this->Session->setFlash("Se elimino correctamente!!", 'msgbueno');
    $this->redirect($this->referer());
  }


}
