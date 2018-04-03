<?php

App::uses('AppController', 'Controller');

class ComprobantesController extends AppController {

  public $uses = array('Comprobante', 'Comprobantescuenta', 'Edificio');
  public $layout = 'monster';

  public function index() {
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $this->Comprobante->virtualFields = array(
      'monto_total' => "(SELECT SUM(comprobantescuentas.debe) FROM comprobantescuentas WHERE comprobantescuentas.comprobante_id = Comprobante.id GROUP BY comprobantescuentas.comprobante_id)"
    );
    $comprobantes = $this->Comprobante->find('all', array(
      'recursive' => -1,
      'conditions' => array('Comprobante.edificio_id' => $idEdificio, 'Comprobante.estado' => 'Comprobado'),
      'order' => array('Comprobante.fecha DESC'),
      'fields' => array('Comprobante.*')
    ));

    $this->set(compact('comprobantes'));
  }

  public function no_comprobados() {
    
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    
    $this->Comprobante->virtualFields = array(
      'monto_total' => "(SELECT SUM(comprobantescuentas.debe) FROM comprobantescuentas WHERE comprobantescuentas.comprobante_id = Comprobante.id GROUP BY comprobantescuentas.comprobante_id)"
    );
    $comprobantes = $this->Comprobante->find('all', array(
      'recursive' => -1,
      'conditions' => array('Comprobante.edificio_id' => $idEdificio, 'Comprobante.estado' => 'No Comprobado', 'Comprobante.estado !=' => 'Anulado'),
      'order' => array('Comprobante.fecha DESC'),
      'fields' => array('Comprobante.*')
    ));
    
    $this->set(compact('comprobantes'));
  }

  public function comprobante($idComprobante = null) {

    if (!empty($this->request->data)) {
      //debug(nl2br($this->request->data['Comprobante']['concepto']));exit;
      $this->request->data['Comprobante']['numero'] = $this->get_numero();
      $this->request->data['Comprobante']['estado'] = "Comprobado";
      $this->Comprobante->create();
      $this->Comprobante->save($this->request->data['Comprobante']);
      foreach ($this->request->data['comprobantes'] as $com) {
        $this->Comprobantescuenta->create();
        $this->Comprobantescuenta->save($com);
      }
      $this->Session->setFlash("Se ha generado un comprobante correctamente!!", 'msgbueno');
      $this->redirect(array('action' => 'ver', $idComprobante));
    }
    $this->Comprobante->id = $idComprobante;
    $this->request->data = $this->Comprobante->read();
    $this->request->data['Comprobante']['concepto'] = str_ireplace('<br>', "\r\n", $this->request->data['Comprobante']['concepto']);
    //$this->request->data['Comprobante']['concepto'] = preg_replace('/<br>/',' \\n ', $this->request->data['Comprobante']['concepto']);
    //debug($this->request->data['Comprobante']['concepto']);exit;
    $c_comprobantes = $this->Comprobantescuenta->find('all', array(
      'recursive' => -1,
      'conditions' => array('Comprobantescuenta.comprobante_id' => $idComprobante),
      'order' => array('Comprobantescuenta.created ASC')
    ));
    $this->set(compact('c_comprobantes'));
  }

  public function get_numero() {
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $comprobante = $this->Comprobante->find('first', array(
      'recursive' => -1,
      'conditions' => array('Comprobante.numero !=' => NULL, 'Comprobante.edificio_id' => $idEdificio),
      'fields' => array('Comprobante.numero'),
      'order' => array('Comprobante.numero DESC')
    ));
    if (!empty($comprobante)) {
      return $comprobante['Comprobante']['numero'] + 1;
    } else {
      return 1;
    }
  }

  public function ver($idComprobante = null) {
    $this->Comprobante->virtualFields = array(
      'monto_total' => "(SELECT SUM(comprobantescuentas.debe) FROM comprobantescuentas WHERE comprobantescuentas.comprobante_id = Comprobante.id GROUP BY comprobantescuentas.comprobante_id)"
    );
    $comprobante = $this->Comprobante->find('first', array(
      'recursive' => -1,
      'conditions' => array('Comprobante.id' => $idComprobante)
    ));
    $comprobantes = $this->Comprobantescuenta->find('all', array(
      'recursive' => -1,
      'conditions' => array('Comprobantescuenta.comprobante_id' => $idComprobante),
      'fields' => array('Comprobantescuenta.*'),
      'order' => array('Comprobantescuenta.created ASC')
    ));
    $edificio = $this->Edificio->findByid($this->Session->read('Auth.User.edificio_id'), null, null, -1);
    $this->set(compact('comprobante', 'comprobantes', 'edificio'));
  }

  public function opciones($idComprobante_c = null) {
    $this->layout = 'ajax';
    $comprobante_u = $this->Comprobantescuenta->find('first', array(
      'recursive' => 0,
      'conditions' => array('Comprobantescuenta.id' => $idComprobante_c),
      'fields' => array('Comprobantescuenta.*', 'Comprobante.tipo')
    ));

    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $this->Comprobante->virtualFields = array(
      'id_completo' => "CONCAT('ID: ',Comprobante.id)"
    );
    $comprobantes = $this->Comprobante->find('list', array(
      'recursive' => -1,
      'conditions' => array(
        'Comprobante.edificio_id' => $idEdificio,
        'Comprobante.estado LIKE' => 'No Comprobado',
        'Comprobante.id !=' => $comprobante_u['Comprobantescuenta']['comprobante_id'],
        'Comprobante.tipo' => $comprobante_u['Comprobante']['tipo']
      ),
      'fields' => array('id', 'id_completo')
    ));
    //debug($comprobante_u);exit;
    $this->set(compact('comprobantes', 'comprobante_u'));
  }

  public function opciones1() {
    $this->layout = 'ajax';
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $this->Comprobante->virtualFields = array(
      'id_completo' => "CONCAT('ID: ',Comprobante.id)"
    );
    $comprobantes = $this->Comprobante->find('list', array(
      'recursive' => -1,
      'conditions' => array('Comprobante.edificio_id' => $idEdificio, 'Comprobante.estado LIKE' => 'No Comprobado'),
      'fields' => array('id', 'id_completo')
    ));
    $this->set(compact('comprobantes'));
  }

  public function union_comprobantes() {
    /* debug($this->request->data);
      exit; */
    if (!empty($this->request->data['Comprobante']['comprobante_id'])) {
      $comprobante = $this->Comprobante->find('first', array(
        'recursive' => -1,
        'conditions' => array('Comprobante.id' => $this->request->data['Comprobante']['comprobante_id']),
        'fields' => array('Comprobante.tipo')
      ));
      $valido = TRUE;
      $contador = 0;
      foreach ($this->request->data['comprobantes'] as $com) {
        if ($com['marcado'] == 1) {
          $contador++;
          if ($com['tipo'] != $comprobante['Comprobante']['tipo'] || $this->request->data['Comprobante']['comprobante_id'] == $com['id']) {
            $valido = FALSE;
          }
        }
      }
      if (!$valido) {
        $this->Session->setFlash("Todos los comprobantes deben de ser del mismo tipo y sin incluir el mismo!!", 'msgerror');
        $this->redirect($this->referer());
      }
      if ($contador == 0) {
        $this->Session->setFlash("Tiene que marcar para poder asignar!!", 'msgerror');
        $this->redirect($this->referer());
      }
      $dato['comprobante_id'] = $this->request->data['Comprobante']['comprobante_id'];
      foreach ($this->request->data['comprobantes'] as $com) {
        if ($com['marcado'] == 1) {
          $comprobantes = $this->Comprobantescuenta->find('all', array(
            'recursive' => -1,
            'conditions' => array('Comprobantescuenta.comprobante_id' => $com['id']),
            'fields' => array('Comprobantescuenta.id')
          ));
          foreach ($comprobantes as $compro) {
            $this->Comprobantescuenta->id = $compro['Comprobantescuenta']['id'];
            $dato['comprobante_aux'] = $com['id'];
            $this->Comprobantescuenta->save($dato);
          }
          $d_com['estado'] = 'Anulado';
          $this->Comprobante->id = $com['id'];
          $this->Comprobante->save($d_com);
        }
      }
      $this->une_glosa_nombre($this->request->data['Comprobante']['comprobante_id']);
      $this->Session->setFlash("Se ha Unido Correctamente los Comprobantes!!", 'msgbueno');
      $this->redirect(array('action' => 'comprobante', $this->request->data['Comprobante']['comprobante_id']));
    }
  }

  public function unir_comprobante() {

    $idCambio = $this->request->data['Aux']['comprobante_cambio'];
    $idComprobante = $this->request->data['Aux']['comprobante_id'];
    $idComprobante_aux = $this->request->data['Aux']['comprobante_aux'];
    $comprobantes = $this->Comprobantescuenta->find('all', array(
      'recursive' => -1,
      'conditions' => array('Comprobantescuenta.comprobante_id' => $idComprobante, 'Comprobantescuenta.comprobante_aux' => $idComprobante_aux)
    ));
    //debug($comprobantes);exit;
    foreach ($comprobantes as $com) {
      $datos['comprobante_aux'] = $com['Comprobantescuenta']['comprobante_id'];
      $datos['comprobante_id'] = $idCambio;
      $this->Comprobantescuenta->id = $com['Comprobantescuenta']['id'];
      $this->Comprobantescuenta->save($datos);
    }

    $n_comprobantes = $this->Comprobantescuenta->find('count', array(
      'recursive' => -1,
      'conditions' => array('Comprobantescuenta.comprobante_id' => $idComprobante)
    ));
    if ($n_comprobantes == 0) {
      $d_comp['estado'] = 'Anulado';
      $this->Comprobante->id = $idComprobante;
      $this->Comprobante->save($d_comp);
    }
    $this->une_glosa_nombre($idCambio);
    $this->Session->setFlash("Se ha unido correctamente al comprobante ID: $idCambio", 'msgbueno');
    $this->redirect(array('action' => 'comprobante', $idCambio));
  }

  public function devolver_comprobante() {

    //$idCambio = $this->request->data['Aux']['comprobante_cambio'];
    $idComprobante = $this->request->data['Aux']['comprobante_id'];
    $idComprobante_aux = $this->request->data['Aux']['comprobante_aux'];
    $comprobantes = $this->Comprobantescuenta->find('all', array(
      'recursive' => -1,
      'conditions' => array('Comprobantescuenta.comprobante_id' => $idComprobante, 'Comprobantescuenta.comprobante_aux' => $idComprobante_aux)
    ));
    //debug($comprobantes);exit;
    foreach ($comprobantes as $com) {
      $datos['comprobante_aux'] = $com['Comprobantescuenta']['comprobante_id'];
      $datos['comprobante_id'] = $idComprobante_aux;
      $this->Comprobantescuenta->id = $com['Comprobantescuenta']['id'];
      $this->Comprobantescuenta->save($datos);
    }
    $d_aux['estado'] = 'No Comprobado';
    $this->Comprobante->id = $idComprobante_aux;
    $this->Comprobante->save($d_aux);
    
    $this->une_glosa_nombre($idComprobante);
    
    $n_comprobantes = $this->Comprobantescuenta->find('count', array(
      'recursive' => -1,
      'conditions' => array('Comprobantescuenta.comprobante_id' => $idComprobante)
    ));
    if ($n_comprobantes == 0) {
      $d_comp['estado'] = 'Anulado';
      $this->Comprobante->id = $idComprobante;
      $this->Comprobante->save($d_comp);
    }
    
    $this->Session->setFlash("Se ha unido correctamente al comprobante ID: $idComprobante_aux", 'msgbueno');
    $this->redirect(array('action' => 'comprobante', $idComprobante_aux));
  }

  public function eliminar_comprobante() {
    $idComprobante = $this->request->data['Aux']['comprobante_id'];
    $idComprobante_aux = $this->request->data['Aux']['comprobante_aux'];
    $this->Comprobantescuenta->deleteAll(array('Comprobantescuenta.comprobante_id' => $idComprobante, 'Comprobantescuenta.comprobante_aux' => $idComprobante_aux));
    $n_comprobantes = $this->Comprobantescuenta->find('count', array(
      'recursive' => -1,
      'conditions' => array('Comprobantescuenta.comprobante_id' => $idComprobante)
    ));
    $this->Session->setFlash("Se ha eliminado correctamente del comprobante ID: $idComprobante_aux", 'msgbueno');
    if ($n_comprobantes == 0) {
      $this->Comprobante->delete($idComprobante);
      $this->redirect(array('action' => 'no_comprobados'));
    }
    $this->redirect($this->referer());
  }

  public function eliminar($idComprobante = null) {
    $this->Comprobantescuenta->deleteAll(array('Comprobantescuenta.comprobante_id' => $idComprobante));
    $this->Comprobante->delete($idComprobante);
    $this->Session->setFlash("Se ha eliminado correctamente el comprobante!!", 'msgbueno');
    $this->redirect(array('action' => 'no_comprobados'));
  }

  public function anular($idComprobante = null) {
    $this->Comprobante->id = $idComprobante;
    $d_comprobante['estado'] = 'Anulado';
    $this->Comprobante->save($d_comprobante);
    $this->Session->setFlash("Se ha anulado correctamente el comprobante!!", 'msgbueno');
    $this->redirect($this->referer());
  }

  public function une_glosa_nombre($idComprobante = null) {

    $comprobante = $this->Comprobante->find('first', array(
      'recursive' => -1,
      'conditions' => array('Comprobante.id' => $idComprobante),
      'fields' => array('Comprobante.tipo', 'Comprobante.nombre')
    ));
    $comprobantes_u = $this->Comprobantescuenta->find('all', array(
      'recursive' => -1,
      'conditions' => array('Comprobantescuenta.comprobante_id' => $idComprobante, 'Comprobantescuenta.haber !=' => NULL),
      'fields' => array('Comprobantescuenta.auxiliar')
    ));
    $glosa = "";
    if ($comprobante['Comprobante']['tipo'] == 'Ingreso') {
      foreach ($comprobantes_u as $co) {
        if (!empty($glosa)) {
          $glosa = $glosa . '<br> Ingreso de ' . $co['Comprobantescuenta']['auxiliar'];
        } else {
          $glosa = 'Ingreso de ' . $co['Comprobantescuenta']['auxiliar'];
        }
      }
    } elseif ($comprobante['Comprobante']['tipo'] == 'Egreso') {
      foreach ($comprobantes_u as $co) {
        if (!empty($glosa)) {
          $glosa = $glosa . '<br> ' . $co['Comprobantescuenta']['auxiliar'];
        } else {
          $glosa = ' ' . $co['Comprobantescuenta']['auxiliar'];
        }
      }
    }

    $this->Comprobantescuenta->virtualFields = array(
      'nombre_comprobante' => "(SELECT comprobantes.nombre FROM comprobantes WHERE Comprobantescuenta.comprobante_aux = comprobantes.id)"
    );
    $comprobantes_n = $this->Comprobantescuenta->find('all', array(
      'recursive' => -1,
      'conditions' => array('Comprobantescuenta.comprobante_id' => $idComprobante, 'Comprobantescuenta.comprobante_aux !=' => NULL),
      'fields' => array('Comprobantescuenta.nombre_comprobante'),
      'group' => array('Comprobantescuenta.comprobante_aux', '(SELECT comprobantes.nombre FROM comprobantes WHERE Comprobantescuenta.comprobante_aux = comprobantes.id)')
    ));
    $nombre = split(',', $comprobante['Comprobante']['nombre'])[0];
    //$array_nombre = split($glosa, $comprobante['Comprobante']['nombre']);
    foreach ($comprobantes_n as $com) {
      if (!empty($nombre)) {
        $nombre = "$nombre, " . $com['Comprobantescuenta']['nombre_comprobante'];
      } else {
        $nombre = $com['Comprobantescuenta']['nombre_comprobante'];
      }
    }
    $d_comprobante['nombre'] = $nombre;
    $d_comprobante['concepto'] = $glosa;
    $this->Comprobante->id = $idComprobante;
    $this->Comprobante->save($d_comprobante);
  }
  
  

}
