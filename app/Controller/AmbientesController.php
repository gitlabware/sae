<?php

App::uses('AppController', 'Controller');

class AmbientesController extends AppController {

  var $components = array('RequestHandler', 'DataTable', 'Montoliteral');
  public $uses = array('Ambiente', 'Edificio', 'Piso', 'Categoriasambiente', 'Categoriaspago', 'User', 'Inquilino', 'Pago', 'Ambienteconcepto', 'Concepto', 'Recibo');
  public $layout = 'sae';

  public function beforeFilter() {
    parent::beforeFilter();
    if ($this->RequestHandler->responseType() == 'json') {
      $this->RequestHandler->setContent('json', 'application/json');
    }
    //debug($this->RequestHandler->responseType());
  }

  public function index() {
    $ambientes = $this->Ambiente->find('all');
    $this->set(compact('ambientes'));
  }

  public function edificio($idEdificio = NULL) {
    $edificio = $this->Edificio->findByid($idEdificio, NULL, NULL, -1);
    $pisos = $this->Piso->find('all', array('conditions' => array('Piso.edificio_id' => $idEdificio)));
    $this->set(compact('pisos', 'edificio'));
  }

  public function lista_ambientes() {
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $ambientes = $this->Ambiente->find('all', array('recursive' => 0, 'conditions' => array('Piso.edificio_id' => $idEdificio)));
    $edificio = $this->Edificio->findByid($idEdificio, NULL, NULL, -1);
    /* debug($ambientes);
      exit; */
    $this->set(compact('edificio', 'ambientes'));
  }

  public function get_ambientes($idEdificio = NULL, $idPiso = NULL) {
    return $this->Ambiente->find('all', array(
        'recursive' => 0, 'order' => 'Ambiente.id ASC',
        'conditions' => array('Ambiente.edificio_id' => $idEdificio, 'Ambiente.piso_id' => $idPiso),
    ));
  }

  public function ambiente($idPiso = null, $idAmbiente = null, $idUsuario = NULL, $sw = 0) {
    $this->layout = 'ajax';
    $piso = $this->Piso->findByid($idPiso);
    $inquilinos = array();
    if (empty($idAmbiente)) {
      if (!empty($idUsuario)) {
        if ($sw) {
          $this->request->data = $this->Session->read('fambiente');
          $this->Session->delete('fambiente');
        }
        $this->request->data['Ambiente']['user_id'] = $idUsuario;
      } else {
        $this->request->data['Ambiente'] = $piso['Edificio'];
        $this->request->data['Ambiente']['nombre'] = "";
        $this->request->data['Ambiente']['id'] = NULL;
        if ($sw) {
          $this->request->data = $this->Session->read('fambiente');
          $this->Session->delete('fambiente');
        }
      }
    } else {
      $this->Ambiente->id = $idAmbiente;
      $this->request->data = $this->Ambiente->read();
      $sql = "SELECT * FROM "
        . "(SELECT user_id,estado FROM inquilinos WHERE (ambiente_id = $idAmbiente) ORDER BY id DESC)"
        . " AS Inquilino WHERE 1 GROUP BY user_id";
      $sql2 = "SELECT * FROM ($sql) AS Inquilino LEFT JOIN users AS User ON(Inquilino.user_id = User.id) WHERE (Inquilino.estado = 1)";
      $inquilinos = $this->Inquilino->query($sql2);
      //debug($inquilinos);exit;
    }
    $catambientes = $this->Categoriasambiente->find('list', array('fields' => 'Categoriasambiente.nombre_completo',
      'conditions' => array('Categoriasambiente.edificio_id' => $piso['Edificio']['id']),
    ));
    $catpagos = $this->Categoriaspago->find('list', array('fields' => 'Categoriaspago.nombre_completo',
      'conditions' => array('Categoriaspago.edificio_id' => $piso['Edificio']['id']),
    ));
    $categoria_ambientes = $this->Categoriasambiente->find('all');
    $categoria_pagos = $this->Categoriaspago->find('all');
    $usuarios = $this->User->find('list', array(
      'fields' => 'User.nombre',
      'conditions' => array(
        'User.role' => 'Propietario',
        'User.edificio_id' => $this->Session->read('Auth.User.edificio_id')
      ),
      'order' => array('User.nombre')
    ));

    $select_inquilinos = $this->User->find('list', array('fields' => 'User.nombre', 'conditions' => array('User.role' => 'Inquilino')));

    $this->set(compact('inquilinos', 'select_inquilinos', 'catambientes', 'piso', 'catpagos', 'usuarios', 'categoria_ambientes', 'categoria_pagos', 'idAmbiente', 'idPiso', 'sw'));
  }

  public function guarda_ambiente() {
    if (!empty($this->request->data)) {
      $this->Ambiente->create();
      $valida = $this->validar('Ambiente');
      if (empty($valida)) {
        if ($this->Ambiente->save($this->request->data['Ambiente'])) {
          if (empty($this->request->data['Ambiente']['id'])) {
            $idAmbiente = $this->Ambiente->getLastInsertID();
            $this->registra_mantenimiento($idAmbiente);
          } else {
            $idAmbiente = $this->request->data['Ambiente']['id'];
            $this->registra_mantenimiento($idAmbiente);
          }
          $this->Session->setFlash('Se registro correctamente los datos!!!', 'msgbueno');
        } else {
          $this->Session->setFlash('NO se pudo registrar los datos del ambiente!!!', 'msgerror');
        }
      } else {
        $this->Session->setFlash($valida, 'msgerror');
      }
    } else {
      $this->Session->setFlash('NO se pudo registrar los datos del ambiente!!!', 'msgerror');
    }
    $this->redirect($this->referer());
  }

  public function registra_mantenimiento($idAmbiente = null) {
    $mantenim = $this->Ambienteconcepto->find('first', array(
      'recursive' => -1,
      'conditions' => array(
        'Ambienteconcepto.ambiente_id' => $idAmbiente,
        'Ambienteconcepto.concepto_id' => 10,
      ),
      'fields' => array('Ambienteconcepto.id'),
    ));
    if (!empty($mantenim)) {
      $this->request->data['Ambienteconcepto']['id'] = $mantenim['Ambienteconcepto']['id'];
    }
    $catambiente = $this->request->data['Ambiente']['categoriasambiente_id'];
    $catpago = $this->request->data['Ambiente']['categoriaspago_id'];
    $a_util = $this->request->data['Ambiente']['area_util'];
    $a_comun = $this->request->data['Ambiente']['area_comun'];

    if (!empty($catambiente) && !empty($catpago) && $a_comun != NULL && $a_util != NULL) {
      $this->request->data['Ambienteconcepto']['ambiente_id'] = $idAmbiente;
      $this->request->data['Ambienteconcepto']['concepto_id'] = 10;
      $this->request->data['Ambienteconcepto']['monto'] = $this->calcula_mantenimiento();
      $this->Ambienteconcepto->create();
      $this->Ambienteconcepto->save($this->request->data['Ambienteconcepto']);
    }
  }

  public function calcula_mantenimiento() {
    $cambiente = $this->Categoriasambiente->findByid($this->request->data['Ambiente']['categoriasambiente_id'], NULL, NULL, -1);
    $cpago = $this->Categoriaspago->findByid($this->request->data['Ambiente']['categoriaspago_id'], NULL, NULL, -1);
    $totalmt = $this->request->data['Ambiente']['area_util'] + $this->request->data['Ambiente']['area_comun'];
    $costob = $totalmt * $cambiente['Categoriasambiente']['constante'];
    $mantenimiento = $costob + $cpago['Categoriaspago']['constante'];
    return $mantenimiento;
  }

  public function eliminar($idAmbiente = null) {
    if ($this->Ambiente->delete($idAmbiente)) {
      $this->Session->setFlash('Se elimino correctamente!!!', 'msgbueno');
    } else {
      $this->Session->setFlash('No se pudo eliminar, verifique que el ambiente exista!!!', 'msgerror');
    }
    $this->redirect($this->referer());
  }

  public function usuario($idPiso = NULL) {
    $this->layout = 'ajax';
    $this->set(compact('idPiso'));
  }

  public function rescata_datos() {
    $this->Session->write('fambiente', $this->request->data);
    debug($this->Session->read('fambiente'));
    exit;
  }

  public function guarda_propietario() {
    if (!empty($this->request->data['User']['email'])) {
      $this->request->data['User']['username'] = $this->request->data['User']['email'];
    }
    $this->User->create();
    if (!empty($this->request->data['User']['email'])) {
      $this->request->data['User']['username'] = $this->request->data['User']['email'];
      $this->request->data['User']['password'] = $this->request->data['User']['ci'];
    }
    $this->request->data['User']['role'] = 'Propietario';
    $this->request->data['User']['edificio_id'] = $this->Session->read('Auth.User.edificio_id');
    $array['mensaje'] = '';
    $valida = $this->validar('User');
    if (empty($valida)) {
      $this->User->save($this->request->data['User']);
      $idUsuario = $this->User->getLastInsertID();
      $array['usuario'] = $idUsuario;
    } else {
      $array['mensaje'] = $valida;
    }

    $this->respond($array, true);
  }

  function respond($message = null, $json = false) {
    if ($message != null) {
      if ($json == true) {
        $this->RequestHandler->setContent('json', 'application/json');
        $message = json_encode($message);
      }
      $this->set('message', $message);
    }
    $this->render('message');
  }

  public function inquilinos($idAmbiente = NULL, $idPiso = NULL) {
    $this->layout = 'ajax';
    $sql = "SELECT * FROM "
      . "(SELECT user_id,estado FROM inquilinos WHERE (ambiente_id = $idAmbiente) ORDER BY id DESC)"
      . " AS Inquilino WHERE 1 GROUP BY user_id";
    $sql2 = "SELECT * FROM ($sql) AS Inquilino LEFT JOIN users AS User ON(Inquilino.user_id = User.id) WHERE (Inquilino.estado = 1)";
    $inquilinos = $this->Inquilino->query($sql2);
    $select_inquilinos = $this->User->find('list', array('fields' => 'User.nombre', 'conditions' => array('User.role' => 'Inquilino')));
    $this->set(compact('inquilinos', 'select_inquilinos', 'idAmbiente', 'idPiso'));
  }

  public function busca_usuario() {

    $this->layout = 'ajax';
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $nombre = $this->request->data['Inquilino']['user'];
    $usuarios = $this->User->find('all', array(
      'recursive' => -1,
      'conditions' => array('User.edificio_id' => $idEdificio, 'User.nombre LIKE' => "%$nombre%", 'User.role IN' => array('Inquilino', 'Propietario')),
      'fields' => array('User.id', 'User.ci', 'User.nombre'),
      'limit' => 5,
      'order' => 'User.nombre',
    ));
    $this->set(compact('usuarios'));
  }

  public function guarda_nuevo_inquilino() {
    if (!empty($this->request->data['User']['email'])) {
      $this->request->data['User']['username'] = $this->request->data['User']['email'];
      $this->request->data['User']['password'] = $this->request->data['User']['ci'];
    }
    $this->request->data['User']['edificio_id'] = $this->Session->read('Auth.User.edificio_id');
    $this->User->create();
    $this->User->save($this->request->data['User']);
    $idUsuario = $this->User->getLastInsertID();
    $this->Inquilino->create();
    $this->request->data['Inquilino']['user_id'] = $idUsuario;
    $this->Inquilino->save($this->request->data['Inquilino']);
    $this->actualiza_inquilinos($this->request->data['Inquilino']['ambiente_id']);
    exit;
  }

  public function guarda_inquilino() {
    if (!empty($this->request->data['Inquilino']['user_id']) && $this->request->data['Inquilino']['ambiente_id']) {
      $inquilino = $this->Inquilino->find('first', array(
        'order' => 'Inquilino.id DESC',
        'conditions' => array('Inquilino.user_id' => $this->request->data['Inquilino']['user_id'], 'Inquilino.ambiente_id' => $this->request->data['Inquilino']['ambiente_id']),
      ));

      if (empty($inquilino)) {
        if (!empty($this->request->data['User']['email'])) {
          $this->request->data['User']['username'] = $this->request->data['User']['email'];
        }
        $this->User->create();
        $this->User->save($this->request->data['User']);

        $this->Inquilino->create();
        $this->Inquilino->save($this->request->data['Inquilino']);
        $this->actualiza_inquilinos($this->request->data['Inquilino']['ambiente_id']);
      } else {
        if ($inquilino['Inquilino']['estado'] != 1) {
          $this->Inquilino->create();
          $this->Inquilino->save($this->request->data['Inquilino']);
          $this->actualiza_inquilinos($this->request->data['Inquilino']['ambiente_id']);
        }
      }
    }
    exit;
  }

  public function quita_inquilino($idUser = NULL, $idAmbiente = NULL) {
    $this->Inquilino->create();
    $this->request->data['Inquilino']['user_id'] = $idUser;
    $this->request->data['Inquilino']['ambiente_id'] = $idAmbiente;
    $this->request->data['Inquilino']['estado'] = 0;
    $this->Inquilino->save($this->request->data['Inquilino']);
    $this->actualiza_inquilinos($idAmbiente);
    $this->redirect(array('action' => 'inquilinos', $idAmbiente));
  }

  public function actualiza_inquilinos($idAmbiente = null) {
    $sql = "SELECT * FROM "
      . "(SELECT user_id,estado FROM inquilinos WHERE (ambiente_id = $idAmbiente) ORDER BY id DESC)"
      . " AS Inquilino WHERE 1 GROUP BY user_id";
    $sql2 = "SELECT * FROM ($sql) AS Inquilino LEFT JOIN users AS User ON(Inquilino.user_id = User.id) WHERE (Inquilino.estado = 1)";
    $inquilinos = $this->Inquilino->query($sql2);
    $text_inquilinos = '';
    foreach ($inquilinos as $inq) {
      $text_inquilinos = $text_inquilinos . $inq['User']['nombre'] . '<br>';
    }
    $this->Ambiente->id = $idAmbiente;
    $this->request->data['Ambiente']['lista_inquilinos'] = $text_inquilinos;
    $this->Ambiente->save($this->request->data['Ambiente']);
  }

  public function pagos($idAmbiente = null) {
    $pagos = $this->Pago->find('all', array(
      'conditions' => array('Pago.ambiente_id' => $idAmbiente)
      , 'group' => array('Pago.fecha', 'Pago.concepto_id')
      , 'fields' => array('Concepto.descripcion', 'Pago.fecha', 'SUM(Pago.monto) totalmonto', 'Pago.concepto_id'),
    ));
    $ambiente = $this->Ambiente->find('first', array('recursive' => -1, 'conditions' => array('Ambiente.id' => $idAmbiente)));

    $this->set(compact('pagos', 'ambiente'));
  }

  public function pago($idAmbiente = null) {
    $ambiente = $this->Ambiente->find('first', array('recursive' => -1, 'conditions' => array('Ambiente.id' => $idAmbiente)));
    $conceptos = $this->Ambienteconcepto->find('list', array('recursive' => 0, 'conditions' => array('Ambienteconcepto.ambiente_id' => $idAmbiente), 'fields' => 'Concepto.nombre'));
    $inquilinos = $this->Inquilino->find('list', array('recursive' => 0, 'fields' => 'User.nombre', 'conditions' => array('Inquilino.ambiente_id' => $idAmbiente)));
    //debug($inquilinos);exit;
    $this->set(compact('inquilinos', 'ambiente', 'conceptos', 'idAmbiente'));
  }

  public function guarda_pago() {
    if (!empty($this->request->data)) {
      $this->Pago->create();
      $this->Pago->save($this->request->data['Pago']);
      $this->Session->setFlash('Se registro correctamente!!', 'msgbueno');
    } else {
      $this->Session->setFlash('No se pudo registrar el pago!!', 'msgbueno');
    }
    $this->redirect(array('action' => 'pagos', $this->request->data['Pago']['ambiente_id']));
    //debug($this->request->data);exit;
  }

  public function detalles_pago($fecha = null, $idConcepto = null, $idAmbiente = null) {
    $this->layout = 'ajax';
    $concepto = $this->Concepto->findByid($idConcepto, null, null, -1);
    $ambiente = $this->Ambiente->findByid($idAmbiente, null, null, -1);
    $pagosd = $this->Pago->find('all', array('conditions' => array('Pago.fecha' => $fecha, 'Pago.concepto_id' => $idConcepto)));
    $this->set(compact('pagosd', 'ambiente', 'concepto', 'fecha'));
  }

  public function elimina_pago($idPago = null, $idAmbiente = null) {
    $this->Pago->delete($idPago);
    $this->Session->setFlash("Se elimino correctamente!!", 'msgbueno');
    $this->redirect(array('action' => 'pagos', $idAmbiente));
  }

  public function buscador() {

    $edificioId = $this->Session->read('Auth.User.edificio_id');

    if ($this->RequestHandler->responseType() == 'json') {
      $pagos = '<button class="btn btn-success" type="button" title="Pagos" onclick="ir_pagos(' . "',Ambiente.id,'" . ')"><i class="fa fa-dollar"></i></button>';
      $acciones = '<div class="btn-group btn-group-sm"> ' . $pagos . ' </div>';
      $this->Ambiente->virtualFields = array(
        'acciones' => "CONCAT('$acciones')",
      );
      $this->paginate = array(
        'fields' => array('Ambiente.nombre', 'User.nombre', 'Ambiente.lista_inquilinos', 'Piso.nombre', 'Ambiente.acciones'),
        'conditions' => array('Ambiente.edificio_id' => $edificioId),
        'recursive' => 0,
        'order' => 'Ambiente.nombre ASC',
      );
      $this->DataTable->fields = array('Ambiente.nombre', 'User.nombre', 'Ambiente.lista_inquilinos', 'Piso.nombre', 'Ambiente.acciones');
      $this->DataTable->emptyEleget_usuarios_adminments = 1;
      $this->set('ambientes', $this->DataTable->getResponse());
      $this->set('_serialize', 'ambientes');
    }
  }

  public function ajaxresultados() {
    $this->layout = 'ajax';
    if ($this->request->is('post')) {
      //debug($this->request->data);
      $opcion = $this->request->data['Ambiente']['opcion'];
      $edificioId = $this->Session->read('Auth.User.edificio_id');
      //debug($edificioId);
      switch ($opcion) {
        case 1:
          $criterio = $this->request->data['Ambiente']['criterio'];
          $ambientes = $this->Ambiente->find('all', array(
            'recursive' => 0,
            'conditions' => array(
              'Ambiente.edificio_id' => $edificioId,
              'Ambiente.nombre LIKE' => "%$criterio%",
            ),
          ));
          //debug($ambientes);
          $this->set(compact('ambientes'));
          break;
        case 3:
          $ambientes = $this->Ambiente->find('all', array(
            'recursive' => 0,
            'conditions' => array(
              'Ambiente.edificio_id' => $edificioId,
              'Ambiente.nombre LIKE' => "%$criterio%",
            ),
          ));
          //debug($ambientes);
          $this->set(compact('ambientes'));
          break;
      }
    }
  }

  public function pay($idAmbiente = null) {
    $datosAmbiente = $this->Ambiente->findById($idAmbiente, null, null, 0);
    //debug($datosAmbiente);
    $ultimoPago_mantenimiento = $this->Pago->find('first', array(
      'recursive' => -1,
      'fields' => array('Pago.fecha'),
      'conditions' => array('Pago.ambiente_id' => $idAmbiente, 'Pago.concepto_id' => 10, 'Pago.estado' => 'Pagado'),
      'order' => 'id DESC',
    ));
    $ultimoPago_alquiler = $this->Pago->find('first', array(
      'recursive' => -1,
      'fields' => array('Pago.fecha'),
      'conditions' => array('Pago.ambiente_id' => $idAmbiente, 'Pago.concepto_id' => 11, 'Pago.estado' => 'Pagado'),
      'order' => 'id DESC',
    ));
    if (!empty($ultimoPago_mantenimiento)) {
      $fecha_mantenimiento = $ultimoPago_mantenimiento['Pago']['fecha'];
    } else {
      $fecha_mantenimiento = $datosAmbiente['Ambiente']['fecha_ocupacion'];
    }
    if (!empty($ultimoPago_alquiler)) {
      $fecha_alquiler = $ultimoPago_alquiler['Pago']['fecha'];
    } else {
      $fecha_alquiler = $datosAmbiente['Ambiente']['fecha_ocupacion'];
    }
    $deuda_tot_man = $this->Pago->find('all', array(
      'recursive' => -1,
      'conditions' => array('Pago.estado' => 'Debe', 'Pago.concepto_id' => 10, 'Pago.ambiente_id' => $idAmbiente),
      'group' => array('Pago.ambiente_id'),
      'fields' => array('SUM(Pago.monto) as total_alq'),
    ));
    $deuda_tot_alq = $this->Pago->find('all', array(
      'recursive' => -1,
      'conditions' => array('Pago.estado' => 'Debe', 'Pago.concepto_id' => 11, 'Pago.ambiente_id' => $idAmbiente),
      'group' => array('Pago.ambiente_id'),
      'fields' => array('SUM(Pago.monto) as total_alq'),
    ));
    //debug($deuda_tot_alq);exit;
    $ultimos_pagos = $this->Pago->find('all', array(
      'recursive' => 0,
      'conditions' => array('Pago.estado' => 'Pagado', 'Pago.ambiente_id' => $idAmbiente),
      'limit' => 5,
      'order' => 'Pago.id DESC',
    ));
    /* $inquilinos = $this->Inquilino->find('list', array('recursive' => 0
      , 'fields' => 'User.nombre'
      , 'conditions' => array('Inquilino.ambiente_id' => $idAmbiente)
      )); */
    $sql = "SELECT * FROM "
      . "(SELECT user_id,estado,id FROM inquilinos WHERE (ambiente_id = $idAmbiente) ORDER BY id DESC)"
      . " AS Inquilino WHERE 1 GROUP BY user_id";
    $sql2 = "SELECT * FROM ($sql) AS Inquilino LEFT JOIN users AS User ON(Inquilino.user_id = User.id) WHERE (Inquilino.estado = 1)";
    $inquilinos = $this->Inquilino->query($sql2);
    $conceptos = $this->Ambienteconcepto->find('list', array(
      'fields' => array('Ambienteconcepto.concepto_id', 'Ambienteconcepto.monto'),
      'conditions' => array('Ambienteconcepto.ambiente_id' => $idAmbiente),
    ));
    $intereses = $this->Pago->find('all', array(
      'recursive' => -1,
      'conditions' => array('Pago.concepto_id' => 12, 'Pago.ambiente_id' => $idAmbiente, 'Pago.estado' => 'Debe'),
      'group' => array('Pago.ambiente_id', 'Pago.concepto_id'),
      'fields' => array('SUM(Pago.monto) as monto_total'),
    ));
    /* debug($intereses);
      exit; */

    $edificio = $this->Edificio->findByid($this->Session->read('Auth.User.edificio_id'), null, null, -1);
    $edificio['Edificio']['retencion_mantenimiento'];
    $this->set(compact('datosAmbiente', 'ultimoPago_mantenimiento', 'inquilinos', 'conceptos', 'idAmbiente', 'fecha_mantenimiento', 'fecha_alquiler', 'ultimoPago_alquiler', 'deuda_tot_man', 'deuda_tot_alq', 'ultimos_pagos', 'intereses', 'edificio'));
  }

  public function ajaxlistapropietario($idPropietario = null) {
    //debug($idPropietario);
    //$idPropietario = $this->request->data['Ambiente']['idPropietario'];
    $ambientes = $this->Ambiente->find('all', array(
      'recursive' => 0,
      'conditions' => array(
        'Ambiente.user_id' => $idPropietario,
      ),
    ));
    $this->set(compact('ambientes'));
  }

  public function ajaxbuscapropietario() {
    $this->layout = 'ajax';
    //debug($this->request->data);
    $edificioId = $this->Session->read('Auth.User.edificio_id');
    $criterio = $this->request->data['Ambiente']['criterio'];
    $propietarios = $this->Ambiente->find('all', array(
      'recursive' => 0,
      'conditions' => array(
        'Ambiente.edificio_id' => $edificioId,
        'User.nombre LIKE' => "%$criterio%",
      ),
      'limit' => 8,
      'group' => 'User.id',
    ));
    $this->set(compact('propietarios'));
    //debug($propietarios);
  }

  public function listadopago($idRecibo = null, $idAmbiente = NULL) {
    $recibo = $this->Recibo->findByid($idRecibo, null, null, 2);
    $recibo_m = $this->Pago->find('all', array(
      'conditions' => array('Pago.recibo_id' => $idRecibo),
      'group' => array('Pago.ambiente_id'),
      'fields' => array('Pago.monto_tmp', 'Pago.saldo_tmp'),
    ));
    $monto_tmp = 0.00;
    $saldo_tmp = 0.00;
    foreach ($recibo_m as $re) {
      $monto_tmp = $monto_tmp + $re['Pago']['monto_tmp'];
      $saldo_tmp = $saldo_tmp + $re['Pago']['saldo_tmp'];
    }
    $ambiente = $this->Ambiente->findByid($idAmbiente, null, null, -1);
    //debug($recibo);exit;
    $this->set(compact('recibo', 'idAmbiente', 'monto_tmp', 'saldo_tmp', 'ambiente'));
  }

  public function registra_pagos() {
    /* debug($this->request->data);
      exit; */
    $recibo = $this->Recibo->find('first', array(
      'recursive' => 0,
      'order' => 'Recibo.id DESC',
      'fields' => array('Recibo.id', 'Recibo.monto'),
      'conditions' => array('Recibo.ambiente_id' => $this->request->data['Ambiente']['id'], 'Recibo.estado' => 'Creado'),
    ));
    if (!empty($recibo)) {
      $idRecibo = $recibo['Recibo']['id'];
      $drecibo['monto'] = $recibo['Recibo']['monto'] + $this->request->data['Recibo']['monto'];
      $this->Recibo->id = $idRecibo;
      $this->Recibo->save($drecibo);
    } else {
      $numero = $this->get_num_rec();
      $this->Recibo->create();
      $this->request->data['Recibo']['numero'] = $numero;
      $this->request->data['Recibo']['ambiente_id'] = $this->request->data['Ambiente']['id'];
      $this->request->data['Recibo']['estado'] = 'Creado';
      $this->request->data['Recibo']['edificio_id'] = $this->Session->read('Auth.User.edificio_id');
      $this->Recibo->save($this->request->data['Recibo']);
      $idRecibo = $this->Recibo->getLastInsertID();
      $this->set_num_rec($numero);
    }
    $this->request->data['Pago']['recibo_id'] = $idRecibo;
    //termina Parte de recibos
    $edificio = $this->Edificio->find('first', array(
      'conditions' => array('Edificio.id' => $this->Session->read('Auth.User.edificio_id')),
      'fields' => array('Edificio.retencion_alquiler', 'Edificio.retencion_mantenimiento'),
    ));
    if (!empty($this->request->data['Mantenimiento']['pagar'])) {
      if (!empty($this->request->data['Mantenimiento']['retencion_mantenimiento'])) {
        $this->pagar_m_a(10, $idRecibo, $this->request->data['Mantenimiento']['cuotas'], $this->request->data['Mantenimiento']['referencia_mantenimiento'], $this->request->data['Mantenimiento']['fecha_inicio'], $edificio['Edificio']['retencion_mantenimiento']);
      } else {
        $this->pagar_m_a(10, $idRecibo, $this->request->data['Mantenimiento']['cuotas'], $this->request->data['Mantenimiento']['referencia_mantenimiento'], $this->request->data['Mantenimiento']['fecha_inicio'], NULL);
      }
    }
    if (!empty($this->request->data['Alquiler']['pagar'])) {
      if (!empty($this->request->data['Alquiler']['retencion_alquiler'])) {
        $this->pagar_m_a(11, $idRecibo, $this->request->data['Alquiler']['cuotas'], $this->request->data['Alquiler']['referencia_alquileres'], $this->request->data['Alquiler']['fecha_inicio'], $edificio['Edificio']['retencion_alquiler']);
      } else {
        $this->pagar_m_a(11, $idRecibo, $this->request->data['Alquiler']['cuotas'], $this->request->data['Alquiler']['referencia_alquileres'], $this->request->data['Alquiler']['fecha_inicio'], NULL);
      }
    }
    if (!empty($this->request->data['Interes']['pagar'])) {
      $this->pagar_interes($idRecibo, null);
    }
    if (!empty($this->request->data['Ascensor']['pagar'])) {
      $this->pagar_otros(13, $idRecibo, 'Ascensor', NULL);
    }
    if (!empty($this->request->data['Multas']['pagar'])) {
      $this->pagar_otros(14, $idRecibo, 'Multas', NULL);
    }
    if (!empty($this->request->data['Otros']['pagar'])) {
      $this->pagar_otros(15, $idRecibo, 'Otros', NULL);
    }
    $this->redirect(array('action' => 'listadopago', $idRecibo, $this->request->data['Ambiente']['id']));
  }

  public function registra_pagos_mark() {

    debug($this->request->data);
    exit;

    $recibo = $this->Recibo->find('first', array(
      'recursive' => 0,
      'order' => 'Recibo.id DESC',
      'fields' => array('Recibo.id', 'Recibo.monto'),
      'conditions' => array('Recibo.ambiente_id' => $this->request->data['Ambiente']['id'], 'Recibo.estado' => 'Creado'),
    ));
    if (!empty($recibo)) {
      $idRecibo = $recibo['Recibo']['id'];
      /*$drecibo['monto'] = $recibo['Recibo']['monto'] + $this->request->data['Recibo']['monto'];
      $this->Recibo->id = $idRecibo;
      $this->Recibo->save($drecibo);*/
    } else {
      $numero = $this->get_num_rec();
      $this->Recibo->create();
      $this->request->data['Recibo']['numero'] = $numero;
      $this->request->data['Recibo']['ambiente_id'] = $this->request->data['Ambiente']['id'];
      $this->request->data['Recibo']['estado'] = 'Creado';
      $this->request->data['Recibo']['edificio_id'] = $this->Session->read('Auth.User.edificio_id');
      $this->Recibo->save($this->request->data['Recibo']);
      $idRecibo = $this->Recibo->getLastInsertID();
      $this->set_num_rec($numero);
    }
    foreach ($this->request->data['Dato']['pagos'] as $dat){
      if($dat['marca'] == '1'){
        
      }
    }
    
    $this->request->data['Pago']['recibo_id'] = $idRecibo;
  }

  public function get_num_rec() {
    $edificio = $this->Edificio->find('first', array(
      'recursive' => -1,
      'conditions' => array('Edificio.id' => $this->Session->read('Auth.User.edificio_id')),
      'fields' => array('num_recibo'),
    ));
    if (!empty($edificio['Edificio']['num_recibo'])) {
      return $edificio['Edificio']['num_recibo'] + 1;
    } else {
      return 1;
    }
  }

  public function set_num_rec($recibo = null) {
    $dato['num_recibo'] = $recibo;
    $this->Edificio->id = $this->Session->read('Auth.User.edificio_id');
    $this->Edificio->save($dato);
  }

  public function pagar_interes($idRecibo = null, $retencion = NULL) {
    if ($retencion != NULL) {
      $dinteres['retencion'] = $retencion;
    } else {
      $dinteres['retencion'] = NULL;
    }
    $por_interes = $this->request->data['Interes']['porcentaje'];
    $intereses = $this->Pago->find('all', array(
      'recursive' => -1,
      'conditions' => array('Pago.concepto_id' => 12, 'Pago.ambiente_id' => $this->request->data['Ambiente']['id'], 'Pago.estado' => 'Debe'),
      'fields' => array('Pago.id', 'Pago.monto'),
    ));
    foreach ($intereses as $in) {
      $dinteres['porcentaje_interes'] = $por_interes;
      $dinteres['recibo_id'] = $idRecibo;
      $dinteres['monto_tmp'] = $this->request->data['Recibo']['monto'];
      $dinteres['saldo_tmp'] = $this->request->data['Recibo']['cambio'];
      $this->Pago->id = $in['Pago']['id'];
      $this->Pago->save($dinteres);
    }
  }

  public function pagar_otros($idConcepto = null, $idRecibo = null, $tipo = null, $retencion = NULL) {
    $this->request->data['Pago'] = NULL;
    $this->Pago->create();
    $this->request->data['Pago']['estado'] = 'Por pagar';
    $this->request->data['Pago']['ambiente_id'] = $this->request->data['Ambiente']['id'];
    $this->request->data['Pago']['user_id'] = $this->Session->read('Auth.User.id');
    $this->request->data['Pago']['propietario_id'] = $this->request->data['Ambiente']['propietario_id'];
    $this->request->data['Pago']['concepto_id'] = $idConcepto;
    $this->request->data['Pago']['recibo_id'] = $idRecibo;
    $this->request->data['Pago']['monto'] = $this->request->data[$tipo]['monto'];
    if ($retencion != NULL) {
      $this->request->data['Pago']['retencion'] = $retencion;
    } else {
      $this->request->data['Pago']['retencion'] = NULL;
    }
    $this->request->data['Pago']['monto_tmp'] = $this->request->data['Recibo']['monto'];
    $this->request->data['Pago']['saldo_tmp'] = $this->request->data['Recibo']['cambio'];
    $this->request->data['Pago']['observacion'] = $this->request->data[$tipo]['onservacion'];
    $this->request->data['Pago']['fecha'] = date('Y-m-d');
    $this->Pago->save($this->request->data['Pago']);
  }

  public function pagar_m_a($idConcepto = null, $idRecibo = null, $cuotas_man = NULL, $referencia = null, $fecha_u = NULL, $retencion = NULL) {
    if (!empty($fecha_u)) {
      $nuevafecha = $fecha_u;
    } else {
      $this->Session->setFlash('Es necesario ingresar la fecha', 'msgerror');
      $this->redirect(array('action' => 'pay', $this->request->data['Ambiente']['id']));
    }
    $mantenimientos = $this->Pago->find('all', array(
      'recursive' => -1,
      'conditions' => array('Pago.estado' => 'Debe',
        'Pago.ambiente_id' => $this->request->data['Ambiente']['id'],
        'Pago.concepto_id' => $idConcepto),
      'Pago.fecha >=' => $nuevafecha,
    ));
    foreach ($mantenimientos as $ma) {
      if ($cuotas_man > 0) {
        $this->Pago->id = $ma['Pago']['id'];
        $this->request->data['Pago']['recibo_id'] = $idRecibo;
        $this->request->data['Pago']['monto_tmp'] = $this->request->data['Recibo']['monto'];
        $this->request->data['Pago']['saldo_tmp'] = $this->request->data['Recibo']['cambio'];
        $this->request->data['Pago']['retencion'] = $retencion;
        $this->Pago->save($this->request->data['Pago']);
        $this->request->data['Pago'] = NULL;
        $cuotas_man--;
      } else {
        break;
      }
    }
    if (!empty($mantenimientos)) {
      $ultimo_pago = array_pop($mantenimientos);
      $nuevafecha = $ultimo_pago['Pago']['fecha'];
    }
    while ($cuotas_man > 0) {
      $nuevafecha = strtotime('+1 month', strtotime(date('Y-m-01', strtotime($nuevafecha))));
      $nuevafecha = date('Y-m-j', $nuevafecha);
      $this->Pago->create();
      $this->request->data['Pago']['estado'] = 'Por pagar';
      $this->request->data['Pago']['ambiente_id'] = $this->request->data['Ambiente']['id'];
      $this->request->data['Pago']['user_id'] = $this->Session->read('Auth.User.id');
      $this->request->data['Pago']['propietario_id'] = $this->request->data['Ambiente']['propietario_id'];
      $this->request->data['Pago']['concepto_id'] = $idConcepto;
      $this->request->data['Pago']['recibo_id'] = $idRecibo;
      $this->request->data['Pago']['monto'] = $referencia;
      $this->request->data['Pago']['fecha'] = $nuevafecha;
      $this->request->data['Pago']['retencion'] = $retencion;
      $this->request->data['Pago']['monto_tmp'] = $this->request->data['Recibo']['monto'];
      $this->request->data['Pago']['saldo_tmp'] = $this->request->data['Recibo']['cambio'];
      $this->Pago->save($this->request->data['Pago']);
      $cuotas_man--;
      $this->request->data['Pago'] = NULL;
    }
  }

  public function recibo($idRecibo = null, $terminar = null) {
    /* debug($this->request->data);
      exit; */
    $pagos = $this->Pago->find('all', array(
      'recursive' => 0,
      'conditions' => array('Pago.recibo_id' => $idRecibo),
      'group' => array('Pago.concepto_id'),
      'fields' => array(
        'Concepto.id',
        'Concepto.nombre',
        "SUM(((IF((Pago.porcentaje_interes != 'NULL'),(Pago.monto*Pago.porcentaje_interes/100),(Pago.monto)))+(IF((Pago.retencion != 'NULL'),((Pago.retencion/100)*Pago.monto),0)))) as imp_total"),
    ));

    $todos_pagos = $this->Pago->find('all', array(
      'recursive' => 0,
      'conditions' => array('Pago.recibo_id' => $idRecibo),
      'fields' => array('Pago.id'),
    ));
    if ($terminar) {
      $this->Ambiente->id = $this->request->data['Dato']['ambiente_id'];
      $dambiente['saldo'] = $this->request->data['Dato']['cambio'];
      $this->Ambiente->save($dambiente);
      $this->Recibo->id = $idRecibo;
      $this->request->data['Recibo']['estado'] = 'Terminado';
      $this->Recibo->save($this->request->data['Recibo']);
      foreach ($todos_pagos as $pa) {
        $this->Pago->id = $pa['Pago']['id'];
        $this->request->data['Pago']['estado'] = 'Pagado';
        $this->Pago->save($this->request->data['Pago']);
      }
    }
    $sql1 = "SELECT nombre FROM users WHERE (users.id = Ambiente.user_id) LIMIT 1";
    $this->Recibo->virtualFields = array(
      'propietario' => "CONCAT(($sql1))",
    );
    $recibo = $this->Recibo->findByid($idRecibo, null, null, 2);
    //debug($recibo);exit;
    $detalles = $this->Pago->find('all', array(
      'recursive' => 0,
      'conditions' => array('Pago.recibo_id' => $idRecibo, 'YEAR(Pago.fecha) >=' => date('Y')),
    ));
    $detalles_a = $this->Pago->find('all', array(
      'recursive' => 0,
      'conditions' => array('Pago.recibo_id' => $idRecibo, 'YEAR(Pago.fecha) <' => date('Y')),
    ));
    //debug($recibo);exit;
    $this->set(compact('recibo', 'pagos', 'detalles', 'detalles_a'));
  }

  public function get_monto_literal($monto = null) {
    return $this->Montoliteral->getMontoLiteral($monto);
  }

  public function cancelar_pago($idRecibo = NULL) {
    $pagos = $this->Pago->find('all', array('conditions' => array('Pago.recibo_id' => $idRecibo)));
    foreach ($pagos as $pa) {
      if ($pa['Pago']['estado'] == 'Por pagar') {
        $this->Pago->delete($pa['Pago']['id']);
      } else {
        $this->Pago->id = $pa['Pago']['id'];
        $this->request->data['Pago']['recibo_id'] = NULL;
        $this->request->data['Pago']['monto_tmp'] = NULL;
        $this->request->data['Pago']['saldo_tmp'] = NULL;
        $this->Pago->save($this->request->data['Pago']);
      }
    }
    $this->Recibo->delete($idRecibo);
    $this->Session->setFlash('Se cancelo correctamente!!', 'msgbueno');
    $this->redirect(array('action' => 'buscador'));
  }

  public function generar_pagos() {
    $ambientes = $this->Ambiente->find('all', array(
      'recursive' => -1,
      'fields' => array('Ambiente.id', 'Ambiente.fecha_ocupacion', 'Ambiente.user_id')
      , 'conditions' => array('Ambiente.fecha_ocupacion !=' => NULL),
    ));
    foreach ($ambientes as $am) {
      $monto_mantenimiento = $this->Ambienteconcepto->find('first', array(
        'conditions' => array('Ambienteconcepto.ambiente_id' => $am['Ambiente']['id'], 'Ambienteconcepto.concepto_id' => 10)
        , 'recursive' => -1,
      ));
      if (!empty($monto_mantenimiento)) {
        $ultimo_pago_mantenimiento = $this->Pago->find('first', array(
          'order' => 'Pago.id DESC',
          'conditions' => array('Pago.concepto_id' => 10, 'Pago.ambiente_id' => $am['Ambiente']['id']),
          'fields' => array('Pago.fecha'),
        ));
        if (!empty($ultimo_pago_mantenimiento)) {
          $fecha_ini_m = $ultimo_pago_mantenimiento['Pago']['fecha'];
        } else {
          $fecha_ini_m = $am['Ambiente']['fecha_ocupacion'];
        }
        if (!empty($fecha_ini_m)) {
          if ($fecha_ini_m <= date('Y-m-d')) {
            foreach ($this->genera_meses($fecha_ini_m, date('Y-m-d')) as $gme) {
              $this->Pago->create();
              $this->request->data['Pago']['estado'] = 'Debe';
              $this->request->data['Pago']['ambiente_id'] = $am['Ambiente']['id'];
              $this->request->data['Pago']['propietario_id'] = $am['Ambiente']['user_id'];
              $this->request->data['Pago']['concepto_id'] = 10;
              $this->request->data['Pago']['monto'] = $monto_mantenimiento['Ambienteconcepto']['monto'];
              $this->request->data['Pago']['fecha'] = $gme['fecha'];
              $this->Pago->save($this->request->data['Pago']);
            }
          }
        }
      }
      $monto_alquiler = $this->Ambienteconcepto->find('first', array(
        'conditions' => array('Ambienteconcepto.ambiente_id' => $am['Ambiente']['id'], 'Ambienteconcepto.concepto_id' => 11)
        , 'recursive' => -1,
      ));
      if (!empty($monto_alquiler)) {
        $ultimo_pago_alquiler = $this->Pago->find('first', array(
          'order' => 'Pago.id DESC',
          'conditions' => array('Pago.concepto_id' => 11, 'Pago.ambiente_id' => $am['Ambiente']['id']),
          'fields' => array('Pago.fecha'),
        ));
        if (!empty($ultimo_pago_alquiler)) {
          $fecha_ini_a = $ultimo_pago_alquiler['Pago']['fecha'];
        } else {
          $fecha_ini_a = $am['Ambiente']['fecha_ocupacion'];
        }
        if (!empty($fecha_ini_a)) {
          if ($fecha_ini_a <= date('Y-m-d')) {
            foreach ($this->genera_meses($fecha_ini_a, date('Y-m-d')) as $gme) {
              $this->Pago->create();
              $this->request->data['Pago']['estado'] = 'Debe';
              $this->request->data['Pago']['ambiente_id'] = $am['Ambiente']['id'];
              $this->request->data['Pago']['propietario_id'] = $am['Ambiente']['user_id'];
              $this->request->data['Pago']['concepto_id'] = 11;
              $this->request->data['Pago']['monto'] = $monto_alquiler['Ambienteconcepto']['monto'];
              $this->request->data['Pago']['fecha'] = $gme['fecha'];
              $this->Pago->save($this->request->data['Pago']);
            }
          }
        }
      }
    }
    exit;
  }

  public function genera_meses($fInicial = null, $fFinal = null) {
    if (!empty($fInicial) && !empty($fFinal)) {
      $fInicial = explode('-', $fInicial);
      $fFinal = explode('-', $fFinal);
      $fi = $fInicial[0] . '-' . $fInicial[1] . '-' . '01';
      $ff = $fFinal[0] . '-' . $fFinal[1] . '-' . '01';
      $fIni = new DateTime($fi);
      $fFin = new DateTime($ff);
      $diferencia = $fIni->diff($fFin);
      $meses = ($diferencia->y * 12) + $diferencia->m;
      $fechai = explode("-", $fi);
      $cMeses = $fechai[1];
      $cAnos = $fechai[0];
      $array = array();
      //debug($cMeses);exit;
      for ($i = 0; $i <= $meses; $i++) {

        if ($cMeses == 13) {
          $cAnos++;
          $cMeses = 1;
        }
        $cFecha = date("Y-m-d", mktime(0, 0, 0, $cMeses, 1, $cAnos));
        $array[$i]['fecha'] = $cFecha;
        $cMeses++;
      }
      return $array;
    } else {
      return array();
    }
  }

  public function editar_monto($idPago = NULL, $idRecibo = null) {
    $this->Pago->id = $idPago;
    $this->request->data = $this->Pago->read();
    $this->set(compact('idRecibo'));
  }

  public function registra_monto_pago($idRecibo = NULL) {
    if (!empty($this->request->data['Pago']['id'])) {
      $this->Pago->create();
      $this->Pago->save($this->request->data['Pago']);
    }
    $this->Session->setFlash('Se edito correctamente el monto!!!', 'msgbueno');
    $this->redirect(array('action' => 'listadopago', $idRecibo));
  }

  public function registra_nombre() {
    $valida = $this->validar('Piso');
    $array['msgerror'] = '';
    if (empty($valida)) {
      $this->Piso->create();
      $this->Piso->save($this->request->data['Piso']);
    } else {
      $array['msgerror'] = $valida;
    }
    $array['nombre_amb'] = $this->request->data['Piso']['nombre'];

    $this->respond($array, true);
    /* debug($this->request->data);
      exit; */
  }

  public function xcobrar($idAmbiente = null) {

    $ambiente = $this->Ambiente->find('first', array(
      'recursive' => 0,
      'conditions' => array('Ambiente.id' => $idAmbiente),
      'fields' => array('Ambiente.nombre', 'Piso.nombre', 'Ambiente.id', 'Ambiente.user_id', 'Ambiente.fecha_ocupacion'),
    ));
    $conceptos = $this->Concepto->find('list', array('fields' => 'nombre', 'conditions' => array("Concepto.id" => array(10, 11))));
    $conceptos_mon = $this->Ambienteconcepto->find('list', array(
      'conditions' => array('Ambienteconcepto.ambiente_id' => $idAmbiente, 'Ambienteconcepto.concepto_id' => array(10, 11))
      , 'recursive' => 0,
      'fields' => ['Concepto.id', 'Ambienteconcepto.monto'],
    ));
    if (!empty($this->request->data)) {
      $fecha_ini = $this->request->data['Dato']['fecha_ini'];
      $fecha_fin_m = $this->request->data['Dato']['fecha_fin'];
      $concepto = $this->request->data['Dato']['concepto'];
      $monto = $this->request->data['Dato']['monto'];
      $interes = $this->request->data['Dato']['interes'];
      /* debug($fecha_ini);
        debug($fecha_ini_m);exit; */
      if ($fecha_ini <= $fecha_fin_m) {
        $meses = $this->genera_meses($fecha_ini, $fecha_fin_m);
        $numero_c = count($meses);
        foreach ($meses as $gme) {
          $this->Pago->create();
          $this->request->data['Pago']['estado'] = 'Debe';
          $this->request->data['Pago']['ambiente_id'] = $idAmbiente;
          $this->request->data['Pago']['propietario_id'] = $ambiente['Ambiente']['user_id'];
          $this->request->data['Pago']['concepto_id'] = $concepto;
          $this->request->data['Pago']['monto'] = $monto;
          $this->request->data['Pago']['fecha'] = $gme['fecha'];
          $this->Pago->save($this->request->data['Pago']);
          $this->gen_interes($gme['fecha'], $ambiente, ((($numero_c * $interes) / 100) * $monto));
          $numero_c--;
        }
      }
    }
    $pagos = $this->Pago->find('all', array(
      'recursive' => 0,
      'conditions' => array('Pago.ambiente_id' => $idAmbiente, 'Pago.estado' => 'Debe'),
      'order' => 'Pago.fecha DESC', 'limit' => 30,
    ));
    $this->set(compact('ambiente', 'conceptos', 'pagos', 'conceptos_mon'));
  }

  public function gen_interes($fecha = null, $ambiente = null, $monto = null) {
    $this->Pago->create();
    $dinteres['estado'] = 'Debe';
    $dinteres['ambiente_id'] = $ambiente['Ambiente']['id'];
    $dinteres['propietario_id'] = $ambiente['Ambiente']['user_id'];
    $dinteres['concepto_id'] = 12;
    $dinteres['monto'] = $monto;
    $dinteres['fecha'] = $fecha;
    $this->Pago->save($dinteres);
  }

  public function quita_pago($idPago = null) {
    $this->Pago->id = $idPago;
    $dpago['retencion'] = 0.00;
    $dpago['recibo_id'] = NULL;
    $dpago['estado'] = 'Debe';
    $this->Pago->save($dpago);
    $this->Session->setFlash("Se quito correctamente el pago!!", 'msgbueno');
    $this->redirect($this->referer());
  }

}
