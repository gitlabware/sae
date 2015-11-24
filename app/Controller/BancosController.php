<?php

App::uses('AppController', 'Controller');

class BancosController extends AppController {

  public $uses = array('Banco', 'Cuenta', 'Bancosmovimiento', 'Cuentasmonto','Cuentasegreso');
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
    $cuentas = $this->Cuenta->find('list', array('fields' => array('id', 'nombre')));
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
    $this->redirect($this->referer());
  }

  public function eliminar($idBanco = null) {
    if ($this->Banco->delete($idBanco)) {
      $this->Session->setFlash("Se ha eliminado correctamente!!", 'msgbueno');
    } else {
      $this->Session->setFlash("No se ha podido eliminar, intente nuevamente!!", 'msgerror');
    }
    $this->redirect($this->referer());
  }

  public function movimiento() {
    $this->layout = 'ajax';
    if (!empty($this->request->data)) {
      $iddbanco = $this->request->data['Bancosmovimiento']['desdebanco_id'];
      $idabanco = $this->request->data['Bancosmovimiento']['hastabanco_id'];
      $dbanco = $this->Banco->findByid($iddbanco, null, null, -1);
      if ($dbanco['Banco']['monto'] >= $this->request->data['Bancosmovimiento']['monto']) {
        $abanco = $this->Banco->findByid($idabanco, null, null, -1);
        $this->Banco->id = $dbanco['Banco']['id'];
        $d_banco['monto'] = $dbanco['Banco']['monto'] - $this->request->data['Bancosmovimiento']['monto'];
        $this->Banco->save($d_banco);
        $this->Banco->id = $abanco['Banco']['id'];
        $d_banco['monto'] = $abanco['Banco']['monto'] + $this->request->data['Bancosmovimiento']['monto'];
        $this->Banco->save($d_banco);
        $this->Bancosmovimiento->create();
        $this->request->data['Bancosmovimiento']['saldo'] = $abanco['Banco']['saldo'];
        $this->Bancosmovimiento->save($this->request->data['Bancosmovimiento']);
        $this->Session->setFlash("Se registro correctamente el movimiento!!", 'msgbueno');
      } else {
        $this->Session->setFlash($dbanco['Banco']['nombre'] . ' no tiene lo suficiente para el movimiento!!', 'msgerror');
      }

      $this->redirect($this->referer());
    }
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $bancos = $this->Banco->find('list', array('fields' => array('id', 'nombre'), 'conditions' => array('Banco.edificio_id' => $idEdificio)));
    $this->set(compact('bancos'));
  }

  public function estado($idBanco = null) {
    $banco = $this->Banco->findByid($idBanco, null, null, -1);
    $sql_amb1 = '(SELECT am.nombre FROM ambientes am WHERE am.id = Pago.ambiente_id)';
    $sql_amb2 = '(SELECT am1.piso_id FROM ambientes am1 WHERE am1.id = Pago.ambiente_id)';
    $sql_concepto = '(SELECT con.nombre FROM conceptos con WHERE con.id = Pago.concepto_id)';
    $sql_piso = "SELECT pi1.nombre FROM pisos pi1 WHERE pi1.id = $sql_amb2";
    $this->Cuentasmonto->virtualFields = array(
      'ambiente' => "$sql_amb1",
      'piso' => "$sql_piso",
      'concepto' => "$sql_concepto"
    );
    $ingresos = $this->Cuentasmonto->find('all', array(
      'recursive' => 0,
      'conditions' => array('Cuentasmonto.banco_id' => $idBanco, 'Pago.estado' => 'Pagado'),
      'fields' => array('Cuentasmonto.created', 'Cuentasmonto.concepto', 'Cuentasmonto.piso', 'Cuentasmonto.ambiente', 'Cuentasmonto.monto', 'Cuentasmonto.porcentaje', 'Pago.monto', 'Pago.fecha')
    ));
    $this->Bancosmovimiento->virtualFields = array(
      'movimiento' => "IF(Bancosmovimiento.desdebanco_id = $idBanco,'SALIDA','INGRESO')",
      'banco' => "IF(Bancosmovimiento.desdebanco_id = $idBanco,Hastabanco.nombre,Desdebanco.nombre)"
    );
    $movimientos = $this->Bancosmovimiento->find('all', array(
      'recursive' => 0,
      'consitions' => array(
        'OR' => array('Bancosmovimiento.desdebanco_id' => $idBanco, 'Bancosmovimiento.hastabanco_id' => $idBanco)
      ),
      'fields' => array('Bancosmovimiento.*')
    ));
    $egresos = $this->Cuentasegreso->find('all',array(
      'recursive' => 0,
      'conditions' => array('Cuentasegreso.banco_id' => $idBanco),
      'fields' => array('Cuentasegreso.*','Nomenclatura.nombre','Banco.nombre','Cuenta.nombre')
    ));
    
    /*debug($movimientos);
    exit;*/

    $this->set(compact('ingresos', 'banco','movimientos','egresos'));
  }

}
