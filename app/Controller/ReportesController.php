<?php

App::uses('AppController', 'Controller');

class ReportesController extends AppController {

  public $uses = array('Concepto', 'Pago', 'Ambiente', 'User', 'Inquilino');
  public $layout = 'sae';

  public function reporte_pagos() {
    $conceptos = $this->Concepto->find('list', array('fields' => 'Concepto.nombre'));

    $conceptos['Todos'] = 'Todos';
    $this->set(compact('conceptos'));
  }

  public function ajax_reporte_pagos() {
    $this->layout = 'ajax';
    $fecha_ini = $this->request->data['Reporte']['fecha_ini'];
    $fecha_fin = $this->request->data['Reporte']['fecha_fin'];
    $tipo = $this->request->data['Reporte']['tipo'];
    $id_concepto = $this->request->data['Reporte']['concepto_id'];
    $condiciones = array();
    if (!empty($this->request->data['Reporte']['ambiente_id'])) {
      $condiciones['Pago.ambiente_id'] = $this->request->data['Reporte']['ambiente_id'];
    }
    if (!empty($this->request->data['Reporte']['propietario_id'])) {
      $condiciones['Pago.propietario_id'] = $this->request->data['Reporte']['propietario_id'];
    }
    if (!empty($this->request->data['Reporte']['inquilino_id'])) {
      if (!empty($this->request->data['Reporte']['ambiente_id'])) {
        $ambiente = $this->Inquilino->find('first', array('recursive' => -1, 'conditions' => array('Inquilino.id' => $this->request->data['Reporte']['inquilino_id'], 'Inquilino.ambiente_id' => $this->request->data['Reporte']['inquilino_id'])));
      } else {
        $ambiente = $this->Inquilino->find('first', array('recursive' => -1, 'conditions' => array('Inquilino.id' => $this->request->data['Reporte']['inquilino_id'])));
      }
      if (!empty($ambiente)) {
        $condiciones['Pago.ambiente_id'] = $ambiente['Inquilino']['ambiente_id'];
      }
    }
    if ($tipo != 'Todos') {
      $condiciones['Pago.estado'] = $tipo;
    }
    if ($id_concepto != 'Todos') {
      $condiciones['Pago.concepto_id'] = $id_concepto;
    }
    $condiciones['DATE(Pago.fecha) BETWEEN ? AND ?'] = array($fecha_ini, $fecha_fin);
    $sql1 = "SELECT nombre FROM pisos WHERE (pisos.id = Ambiente.piso_id)";
    //$sql2 = "SELECT nombre FROM users WHERE (users.id = (SELECT user_id FROM `inquilinos` WHERE (inquilinos.id = Pago.inquilino_id)))";
    $this->Pago->virtualFields = array(
      'piso' => "CONCAT(($sql1))"
      //,'inquilino' => "CONCAT(($sql2))"
    );

    $pagos = $this->Pago->find('all', array(
      'recursive' => 0,
      'conditions' => $condiciones
      , 'group' => ['Pago.ambiente_id', 'Pago.estado', 'Pago.concepto_id']
      , 'fields' => ['Pago.ambiente_id', 'Pago.estado', 'Pago.concepto_id', 'SUM(Pago.monto) as monto_total']
      //, 'fields' => array('Ambiente.nombre', 'Pago.piso', 'Propietario.nombre', 'Ambiente.lista_inquilinos', 'Concepto.nombre', 'Pago.monto', 'Pago.fecha','Pago.estado')
    ));

    foreach ($pagos as $key => $pa) {
      $condiciones2 = $condiciones;
      $condiciones2['Pago.ambiente_id'] = $pa['Pago']['ambiente_id'];
      $condiciones2['Pago.estado'] = $pa['Pago']['estado'];
      $condiciones2['Pago.concepto_id'] = $pa['Pago']['concepto_id'];
      $pagos[$key]['Pago']['pagos'] = $this->Pago->find('all', array(
        'recursive' => 0,
        'conditions' => $condiciones2
        , 'fields' => array('Ambiente.nombre', 'Pago.piso', 'Propietario.nombre', 'Ambiente.lista_inquilinos', 'Concepto.nombre', 'Pago.monto', 'Pago.fecha', 'Pago.estado')
      ));
    }
    /* debug($pagos);
      exit; */
    $this->set(compact('pagos'));
  }

  public function reporte_pagos_a() {
    $conceptos = $this->Concepto->find('list', array('fields' => 'Concepto.nombre'));

    $conceptos['Todos'] = 'Todos';
    $this->set(compact('conceptos'));
  }

  public function ajax_reporte_pagos_a() {
    $this->layout = 'ajax';
    $fecha_ini = $this->request->data['Reporte']['fecha_ini'];
    $fecha_fin = $this->request->data['Reporte']['fecha_fin'];
    $tipo = $this->request->data['Reporte']['tipo'];
    $id_concepto = $this->request->data['Reporte']['concepto_id'];
    $condiciones = array();
    if (!empty($this->request->data['Reporte']['ambiente_id'])) {
      $condiciones['Pago.ambiente_id'] = $this->request->data['Reporte']['ambiente_id'];
    }
    if (!empty($this->request->data['Reporte']['propietario_id'])) {
      $condiciones['Pago.propietario_id'] = $this->request->data['Reporte']['propietario_id'];
    }
    if (!empty($this->request->data['Reporte']['inquilino_id'])) {
      if (!empty($this->request->data['Reporte']['ambiente_id'])) {
        $ambiente = $this->Inquilino->find('first', array('recursive' => -1, 'conditions' => array('Inquilino.id' => $this->request->data['Reporte']['inquilino_id'], 'Inquilino.ambiente_id' => $this->request->data['Reporte']['inquilino_id'])));
      } else {
        $ambiente = $this->Inquilino->find('first', array('recursive' => -1, 'conditions' => array('Inquilino.id' => $this->request->data['Reporte']['inquilino_id'])));
      }
      if (!empty($ambiente)) {
        $condiciones['Pago.ambiente_id'] = $ambiente['Inquilino']['ambiente_id'];
      }
    }
    if ($tipo != 'Todos') {
      $condiciones['Pago.estado'] = $tipo;
    }
    if ($id_concepto != 'Todos') {
      $condiciones['Pago.concepto_id'] = $id_concepto;
    }
    $condiciones['DATE(Pago.fecha) BETWEEN ? AND ?'] = array($fecha_ini, $fecha_fin);
    $sql1 = "SELECT nombre FROM pisos WHERE (pisos.id = Ambiente.piso_id)";
    //$sql2 = "SELECT nombre FROM users WHERE (users.id = (SELECT user_id FROM `inquilinos` WHERE (inquilinos.id = Pago.inquilino_id)))";
    $this->Pago->virtualFields = array(
      'piso' => "CONCAT(($sql1))"
      //,'inquilino' => "CONCAT(($sql2))"
    );

    $pagos = $this->Pago->find('all', array(
      'recursive' => 0,
      'conditions' => $condiciones
      , 'fields' => array('Ambiente.nombre', 'Pago.piso', 'Propietario.nombre', 'Ambiente.lista_inquilinos', 'Concepto.nombre', 'SUM(Pago.monto) as monto_total', 'Ambiente.piso_id', 'Pago.estado')
      , 'group' => array('Pago.concepto_id', 'Pago.ambiente_id', 'Pago.estado')
    ));
    //debug($pagos);exit;
    $this->set(compact('pagos'));
  }

  public function comboselect_amb1($campoform = null, $div = null) {
    $this->layout = 'ajax';
    $this->set(compact('campoform', 'div'));
  }

  public function comboselect_prop1($campoform = null, $div = null) {
    $this->layout = 'ajax';
    $this->set(compact('campoform', 'div'));
  }

  public function comboselect_inq1($campoform = null, $div = null) {
    $this->layout = 'ajax';
    $this->set(compact('campoform', 'div'));
  }

  public function comboselect_amb2($campoform = null, $div = null) {
    $this->layout = 'ajax';
    if (!empty($this->request->data['Ambiente']['nombre'])) {
      $lista = $this->Ambiente->find('all', array('recursive' => 0,
        'conditions' =>
        array('Ambiente.nombre LIKE' => '%' . $this->request->data['Ambiente']['nombre'] . "%"),
        'limit' => 8,
        'order' => 'Ambiente.nombre ASC'
      ));
    }
    $this->set(compact('lista', 'div', 'campoform'));
  }

  public function comboselect_prop2($campoform = null, $div = null) {
    $this->layout = 'ajax';
    if (!empty($this->request->data['Propietario']['nombre'])) {
      $sql1 = "SELECT nombre FROM ambientes WHERE (ambientes.user_id = User.id) LIMIT 1";
      $this->User->virtualFields = array(
        'ambiente' => "CONCAT(($sql1))"
      );

      $lista = $this->User->find('all', array('recursive' => -1,
        'conditions' =>
        array('User.nombre LIKE' => '%' . $this->request->data['Propietario']['nombre'] . "%", 'User.role' => 'Propietario'),
        'limit' => 8,
        'order' => 'User.nombre ASC'
      ));
    }
    $this->set(compact('lista', 'div', 'campoform'));
  }

  public function comboselect_inq2($campoform = null, $div = null) {
    $this->layout = 'ajax';
    if (!empty($this->request->data['Inquilino']['nombre'])) {
      $lista = $this->Inquilino->find('all', array('recursive' => 0,
        'conditions' =>
        array('User.nombre LIKE' => '%' . $this->request->data['Inquilino']['nombre'] . "%"),
        'limit' => 8,
        'order' => 'User.nombre ASC'
      ));
    }
    $this->set(compact('lista', 'div', 'campoform'));
  }

  public function comboselect_amb3($campoform = null, $div = null, $id = null) {
    $this->layout = 'ajax';
    $datos = $this->Ambiente->findByid($id, null, null, -1);
    $this->set(compact('campoform', 'datos', 'div'));
  }

  public function comboselect_prop3($campoform = null, $div = null, $id = null) {
    $this->layout = 'ajax';
    $datos = $this->User->findByid($id, null, null, -1);
    $this->set(compact('campoform', 'datos', 'div'));
  }

  public function comboselect_inq3($campoform = null, $div = null, $id = null) {
    $this->layout = 'ajax';
    $datos = $this->Inquilino->findByid($id, null, null, 0);
    $this->set(compact('campoform', 'datos', 'div'));
  }

  public function reporte_pagos_totales() {
    $conceptos = $this->Concepto->find('list', array('fields' => 'Concepto.nombre'));
    $conceptos['Todos'] = 'Todos';
    $this->set(compact('conceptos'));
  }

  public function ajax_reporte_pagos_totales() {
    $this->layout = 'ajax';
    $fecha_ini = $this->request->data['Reporte']['fecha_ini'];
    $fecha_fin = $this->request->data['Reporte']['fecha_fin'];
    $tipo = $this->request->data['Reporte']['tipo'];
    $id_concepto = $this->request->data['Reporte']['concepto_id'];
    $condiciones = array();
    if ($tipo != 'Todos') {
      $condiciones['Pago.estado'] = $tipo;
    }
    if ($id_concepto != 'Todos') {
      $condiciones['Pago.concepto_id'] = $id_concepto;
    }
    $condiciones['DATE(Pago.fecha) BETWEEN ? AND ?'] = array($fecha_ini, $fecha_fin);
    $condiciones['Ambiente.edificio_id'] = $this->Session->read('Auth.User.edificio_id');
    $sql1 = "SELECT nombre FROM pisos WHERE (pisos.id = Ambiente.piso_id)";
    //$sql2 = "SELECT nombre FROM users WHERE (users.id = (SELECT user_id FROM `inquilinos` WHERE (inquilinos.id = Pago.inquilino_id)))";
    $this->Pago->virtualFields = array(
      'piso' => "CONCAT(($sql1))"
      //,'inquilino' => "CONCAT(($sql2))"
    );
    $pagos = $this->Pago->find('all', array(
      'recursive' => 0,
      'conditions' => $condiciones
      , 'fields' => array('Ambiente.nombre', 'Pago.piso', 'Propietario.nombre', 'Ambiente.lista_inquilinos', 'Concepto.nombre', 'SUM(Pago.monto) AS monto_total')
      , 'group' => array('Pago.concepto_id')
    ));
    //debug($pagos);exit;
    $this->set(compact('pagos'));
  }

  public function indexcuentasxcobrar() {
    
  }

  public function xgestionmora() {
    $fecha = $this->request->data['Reporte']['fecha'];
    $fecha_a = split('-', $fecha);
    $ano = $fecha_a[0];
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $ambientes = $this->Ambiente->find('all', array(
      'recursive' => 0,
      'conditions' => array('Ambiente.edificio_id' => $idEdificio),
      'fields' => array('Ambiente.nombre', 'Ambiente.id', 'User.nombre')
    ));
    $this->set(compact('ambientes', 'ano', 'fecha'));
  }

  public function get_monto_amb($idAmbiete = null, $ano = null, $fecha = null) {
     $pago = $this->Pago->find('all',array(
       'recursive' => -1,
       'conditions' => array('Pago.ambiente_id' => $idAmbiete,'YEAR(Pago.fecha)' => $ano,'DATE(Pago.fecha) <=' => $fecha,'Pago.estado' => 'Debe'),
       'group' => array('Pago.ambiente_id'),
       'fields' => array('SUM(Pago.monto) as total_g')
     ));
     if(!empty($pago)){
       return $pago[0][0]['total_g'];
     }else{
       return 0;
     }
  }
  
  public function manteoxcobrar(){
    $fecha = $this->request->data['Reporte']['fecha'];
    $fecha_a = split('-', $fecha);
    $ano = $fecha_a[0];
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $ambientes = $this->Ambiente->find('all', array(
      'recursive' => 0,
      'conditions' => array('Ambiente.edificio_id' => $idEdificio),
      'fields' => array('Ambiente.nombre', 'Ambiente.id', 'User.nombre')
    ));
    $this->set(compact('ambientes', 'ano', 'fecha'));
  }

}
