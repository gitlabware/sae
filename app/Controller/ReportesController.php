<?php

App::uses('AppController', 'Controller');

class ReportesController extends AppController {

  public $uses = array('Concepto', 'Pago');
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
    if ($tipo != 'Todos') {
      $condiciones['Pago.estado'] = $tipo;
    }
    if ($id_concepto != 'Todos') {
      $condiciones['Pago.concepto_id'] = $id_concepto;
    }
    $condiciones['DATE(Pago.fecha) BETWEEN ? AND ?'] = array($fecha_ini, $fecha_fin);
    $sql1 = "SELECT nombre FROM pisos WHERE (pisos.id = Ambiente.piso_id)";
    $sql2 = "SELECT nombre FROM users WHERE (users.id = (SELECT user_id FROM `inquilinos` WHERE (inquilinos.id = Pago.inquilino_id)))";
    $this->Pago->virtualFields = array(
      'piso' => "CONCAT(($sql1))",
      'inquilino' => "CONCAT(($sql2))"
    );
    $pagos = $this->Pago->find('all', array(
      'recursive' => 0,
      'conditions' => $condiciones
      , 'fields' => array('Ambiente.nombre', 'Pago.piso', 'Propietario.nombre', 'Pago.inquilino', 'Concepto.nombre', 'Pago.monto', 'Pago.fecha')
    ));
    //debug($pagos);exit;
    $this->set(compact('pagos'));
  }

}
