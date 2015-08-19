<?php

App::uses('AppController', 'Controller');
App::import('Vendor', 'PHPExcel', array('file' => 'PHPExcel.php'));
App::import('Vendor', 'PHPExcel_Reader_Excel2007', array('file' => 'PHPExcel/Excel2007.php'));
App::import('Vendor', 'PHPExcel_IOFactory', array('file' => 'PHPExcel/PHPExcel/IOFactory.php'));

class PagosController extends AppController {

  public $layout = 'sae';
  public $uses = array(
    'Pago', 'Excel', 'Ambiente'
  );

  public function index() {
    
  }

  public function excels() {
    $excels = $this->Excel->find('all', array('order' => 'id DESC'));
    $this->set(compact('excels'));
  }

  public function registra_excel() {
    /* debug($this->request->data);
      exit; */
    $archivoExcel = $this->request->data['Excel']['excel'];
    $nombreOriginal = $this->request->data['Excel']['excel']['name'];
    App::uses('String', 'Utility');
    if ($archivoExcel['error'] === UPLOAD_ERR_OK) {
      $nombre = string::uuid();
      if (move_uploaded_file($archivoExcel['tmp_name'], WWW_ROOT . 'files' . DS . $nombre . '.xlsx')) {
        $nombreExcel = $nombre . '.xlsx';
        $this->request->data['Excelg']['url'] = $nombreExcel;
        $this->request->data['Excelg']['nombre'] = $nombreOriginal;
        $this->request->data['Excelg']['edificio_id'] = $this->Session->read('Auth.User.edificio_id');
      }
    }
    if ($this->Excel->save($this->data['Excelg'])) {
      $idExcel = $this->Excel->getLastInsertID();
      $excelSubido = $nombreExcel;
      $objLector = new PHPExcel_Reader_Excel2007();
      //debug($objLector);die;
      $objPHPExcel = $objLector->load("../webroot/files/$excelSubido");
      //debug($objPHPExcel);die;
      $rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
      $array_data = array();
      foreach ($rowIterator as $row) {
        $cellIterator = $row->getCellIterator();

        $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set

        if (0 == $row->getRowIndex()) //a partir de la 1
          continue; //skip first row

        $rowIndex = $row->getRowIndex();
        $array_data[$rowIndex] = array(
          'A' => '',
          'B' => '',
          'C' => '',
          'D' => '',
          'E' => '',
          'F' => '',
          'G' => '',
          'H' => '',
          'I' => '',
          'J' => '',
          'K' => '',
          'L' => '',
          'M' => '',
          'N' => '');
        foreach ($cellIterator as $cell) {
          if ('A' == $cell->getColumn()) {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
          } elseif ('B' == $cell->getColumn()) {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
          } elseif ('C' == $cell->getColumn()) {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
          } elseif ('D' == $cell->getColumn()) {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
          } elseif ('E' == $cell->getColumn()) {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
          } elseif ('F' == $cell->getColumn()) {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
          } elseif ('G' == $cell->getColumn()) {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
          } elseif ('H' == $cell->getColumn()) {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
          } elseif ('I' == $cell->getColumn()) {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
          } elseif ('J' == $cell->getColumn()) {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
          } elseif ('K' == $cell->getColumn()) {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
          } elseif ('L' == $cell->getColumn()) {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
          } elseif ('M' == $cell->getColumn()) {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
          } elseif ('N' == $cell->getColumn()) {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
          }
        }
      }

      $datos = array();
      $this->request->data = "";
      $i = 0;

      $primero = $array_data[3];
      unset($array_data[1]);
      unset($array_data[2]);
      unset($array_data[3]);
      unset($array_data[4]);
      unset($array_data[5]);
      /*debug($primero);
      debug(substr($primero['A'], 8));
      debug($array_data);
      exit;*/
      
      foreach ($array_data as $d) {

        $ambiente_a = $this->Ambiente->find('first', array(
          'recursive' => 0,
          'conditions' => array(
            'Ambiente.edificio_id' => $this->Session->read('Auth.User.edificio_id'),
            'Piso.nombre' => $d['A'],
            'Ambiente.nombre' => $d['B']
          ),
          'fields' => array('Ambiente.id', 'Ambiente.user_id')
        ));

        if (empty($ambiente_a)) {
          //debug($d['A']);exit;
          $this->Session->setFlash("No se pudo registrar, el registro " . $d['A'] . "-" . $d['B'] . " no se encontro!!", 'msgerror');
          //$this->Pago->deleteAll(array('Pago.excel_id' => $idExcel));
          $this->redirect(array('action' => 'excels'));
        }

        $dpago['estado'] = 'Debe';
        $dpago['ambiente_id'] = $ambiente_a['Ambiente']['id'];
        $dpago['user_id'] = $this->Session->read('Auth.User.id');
        $dpago['propietario_id'] = $ambiente_a['Ambiente']['user_id'];
        $dpago['concepto_id'] = 10;
        $dpago['excel_id'] = $idExcel;

        if ($d['C'] != '') {
          $dpago['monto'] = $d['C'];
          $dpago['fecha'] = substr($primero['A'], 8). '-01-01';

          $existe = $this->Pago->find('first', array(
            'recursive' => -1,
            'conditions' => array('ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
            'fields' => array('id')
          ));
          if (!empty($existe)) {
            $dpago['id'] = $existe['Pago']['id'];
          } else {
            $dpago['id'] = NULL;
          }
          $this->Pago->create();
          $this->Pago->save($dpago);
        }
        if ($d['D'] != '') {
          $dpago['monto'] = $d['D'];
          $dpago['fecha'] = substr($primero['A'], 8). '-02-01';

          $existe = $this->Pago->find('first', array(
            'recursive' => -1,
            'conditions' => array('ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
            'fields' => array('id')
          ));
          if (!empty($existe)) {
            $dpago['id'] = $existe['Pago']['id'];
          } else {
            $dpago['id'] = NULL;
          }
          $this->Pago->create();
          $this->Pago->save($dpago);
        }
        if ($d['E'] != '') {
          $dpago['monto'] = $d['E'];
          $dpago['fecha'] = substr($primero['A'], 8). '-03-01';

          $existe = $this->Pago->find('first', array(
            'recursive' => -1,
            'conditions' => array('ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
            'fields' => array('id')
          ));
          if (!empty($existe)) {
            $dpago['id'] = $existe['Pago']['id'];
          } else {
            $dpago['id'] = NULL;
          }
          $this->Pago->create();
          $this->Pago->save($dpago);
        }
        if ($d['F'] != '') {
          $dpago['monto'] = $d['F'];
          $dpago['fecha'] = substr($primero['A'], 8). '-04-01';

          $existe = $this->Pago->find('first', array(
            'recursive' => -1,
            'conditions' => array('ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
            'fields' => array('id')
          ));
          if (!empty($existe)) {
            $dpago['id'] = $existe['Pago']['id'];
          } else {
            $dpago['id'] = NULL;
          }
          $this->Pago->create();
          $this->Pago->save($dpago);
        }
        if ($d['G'] != '') {
          $dpago['monto'] = $d['G'];
          $dpago['fecha'] = substr($primero['A'], 8). '-05-01';

          $existe = $this->Pago->find('first', array(
            'recursive' => -1,
            'conditions' => array('ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
            'fields' => array('id')
          ));
          if (!empty($existe)) {
            $dpago['id'] = $existe['Pago']['id'];
          } else {
            $dpago['id'] = NULL;
          }
          $this->Pago->create();
          $this->Pago->save($dpago);
        }
        if ($d['H'] != '') {
          $dpago['monto'] = $d['H'];
          $dpago['fecha'] = substr($primero['A'], 8). '-06-01';

          $existe = $this->Pago->find('first', array(
            'recursive' => -1,
            'conditions' => array('ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
            'fields' => array('id')
          ));
          if (!empty($existe)) {
            $dpago['id'] = $existe['Pago']['id'];
          } else {
            $dpago['id'] = NULL;
          }
          $this->Pago->create();
          $this->Pago->save($dpago);
        }
        if ($d['I'] != '') {
          $dpago['monto'] = $d['I'];
          $dpago['fecha'] = substr($primero['A'], 8). '-07-01';

          $existe = $this->Pago->find('first', array(
            'recursive' => -1,
            'conditions' => array('ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
            'fields' => array('id')
          ));
          if (!empty($existe)) {
            $dpago['id'] = $existe['Pago']['id'];
          } else {
            $dpago['id'] = NULL;
          }
          $this->Pago->create();
          $this->Pago->save($dpago);
        }
        if ($d['J'] != '') {
          $dpago['monto'] = $d['J'];
          $dpago['fecha'] = substr($primero['A'], 8). '-08-01';

          $existe = $this->Pago->find('first', array(
            'recursive' => -1,
            'conditions' => array('ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
            'fields' => array('id')
          ));
          if (!empty($existe)) {
            $dpago['id'] = $existe['Pago']['id'];
          } else {
            $dpago['id'] = NULL;
          }
          $this->Pago->create();
          $this->Pago->save($dpago);
        }
        if ($d['K'] != '') {
          $dpago['monto'] = $d['K'];
          $dpago['fecha'] = substr($primero['A'], 8). '-09-01';

          $existe = $this->Pago->find('first', array(
            'recursive' => -1,
            'conditions' => array('ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
            'fields' => array('id')
          ));
          if (!empty($existe)) {
            $dpago['id'] = $existe['Pago']['id'];
          } else {
            $dpago['id'] = NULL;
          }
          $this->Pago->create();
          $this->Pago->save($dpago);
        }
        if ($d['L'] != '') {
          $dpago['monto'] = $d['L'];
          $dpago['fecha'] = substr($primero['A'], 8). '-10-01';

          $existe = $this->Pago->find('first', array(
            'recursive' => -1,
            'conditions' => array('ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
            'fields' => array('id')
          ));
          if (!empty($existe)) {
            $dpago['id'] = $existe['Pago']['id'];
          } else {
            $dpago['id'] = NULL;
          }
          $this->Pago->create();
          $this->Pago->save($dpago);
        }
        if ($d['M'] != '') {
          $dpago['monto'] = $d['M'];
          $dpago['fecha'] = substr($primero['A'], 8). '-11-01';

          $existe = $this->Pago->find('first', array(
            'recursive' => -1,
            'conditions' => array('ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
            'fields' => array('id')
          ));
          if (!empty($existe)) {
            $dpago['id'] = $existe['Pago']['id'];
          } else {
            $dpago['id'] = NULL;
          }
          $this->Pago->create();
          $this->Pago->save($dpago);
        }
        if ($d['N'] != '') {
          $dpago['monto'] = $d['N'];
          $dpago['fecha'] = substr($primero['A'], 8). '-12-01';

          $existe = $this->Pago->find('first', array(
            'recursive' => -1,
            'conditions' => array('ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
            'fields' => array('id')
          ));
          if (!empty($existe)) {
            $dpago['id'] = $existe['Pago']['id'];
          } else {
            $dpago['id'] = NULL;
          }
          $this->Pago->create();
          $this->Pago->save($dpago);
        }

        $i++;
      }
      $this->Excel->id = $idExcel;
      $dexcel['gestion'] = $primero['H'];
      $this->Excel->save($dexcel);
      $this->Session->setFlash("Se registro correctamente!!", 'msgbueno');
      $this->redirect(array('action' => 'excels'));
    }
  }

  public function det_pagos($idExcel = null) {
    $excel = $this->Excel->findByid($idExcel, null, null, -1);
    $sql = "SELECT pi.nombre FROM pisos pi WHERE pi.id = Ambiente.piso_id";
    $this->Pago->virtualFields = array(
      'piso' => "($sql)"
    );
    $pagos = $this->Pago->find('all', array(
      'recursive' => 0,
      'conditions' => array('Pago.excel_id' => $idExcel),
      'fields' => array('Pago.*', 'Ambiente.nombre', 'Pago.piso')
    ));
    $this->set(compact('pagos', 'excel'));
  }

  public function elimina_excel($idExcel = null) {
    $this->Pago->deleteAll(array('Pago.excel_id' => $idExcel));
    $this->Excel->delete($idExcel);
    $this->Session->setFlash("Se elimino correctamente el excel y sus pagos!!!", 'msgbueno');
    $this->redirect(array('action' => 'excels'));
  }

  public function pre_aviso($idAmbiente = null, $idConcepto = null) {
    $this->layout = 'ajax';
    $ambiente = $this->Ambiente->find('first', array(
      'recursive' => 0,
      'conditions' => array('Ambiente.id' => $idAmbiente),
      'fields' => array('Ambiente.nombre', 'Piso.nombre', 'User.nombre')
    ));
    $this->Pago->virtualFields = array(
      'gestion' => "YEAR(Pago.fecha)"
    );
    $gestiones = $this->Pago->find('all', array(
      'conditions' => array('Pago.ambiente_id' => $idAmbiente, 'Pago.concepto_id' => $idConcepto),
      'group' => array('gestion'),
      'fields' => array('gestion')
    ));

    $this->set(compact('idAmbiente', 'idConcepto', 'gestiones', 'ambiente'));
  }

  public function get_pag_ges($idAmbiente = null, $idConcepto = null, $gestion = null, $mes = null) {
    $pago = $this->Pago->find('first', array(
      'recursive' => -1,
      'conditions' => array(
        'Pago.ambiente_id' => $idAmbiente,
        'YEAR(Pago.fecha)' => $gestion,
        'MONTH(Pago.fecha)' => $mes,
        'Pago.concepto_id' => $idConcepto
      ),
      'fields' => array('Pago.monto', 'Pago.estado')
    ));
    if (!empty($pago)) {
      return $pago['Pago'];
    } else {
      return array('monto' => '-', 'estado' => NULL);
    }
  }

}
