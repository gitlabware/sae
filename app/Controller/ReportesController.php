<?php

App::uses('AppController', 'Controller');

class ReportesController extends AppController {

  public $uses = array('Concepto');
  public $layout = 'sae';

  public function reporte_pagos() {
    $conceptos = $this->Concepto->find('list', array('fields' => 'Concepto.nombre'));
    $this->set(compact('conceptos'));
  }

  public function ajax_reporte_pagos() {
    debug($this->request->data);
    exit;
    $fecha_ini = $this->request->data['Reporte']['fecha_ini'];
    $fecha_fin = $this->request->data['Reporte']['fin'];
    $tipo = $this->request->data['Reporte']['tipo'];
    $id_concepto = $this->request->data['Reporte']['concepto_id'];
  }

}
