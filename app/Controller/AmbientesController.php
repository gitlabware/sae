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

  public function get_ambientes($idEdificio = NULL, $idPiso = NULL) {
    return $this->Ambiente->find('all', array(
        'recursive' => -1, 'order' => 'Ambiente.id ASC',
        'conditions' => array('Ambiente.edificio_id' => $idEdificio, 'Ambiente.piso_id' => $idPiso)
    ));
  }

  public function ambiente($idPiso = null, $idAmbiente = null, $idUsuario = NULL, $sw = 0) {
    $this->layout = 'ajax';
    $piso = $this->Piso->findByid($idPiso);
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
        if ($sw) {
          $this->request->data = $this->Session->read('fambiente');
          $this->Session->delete('fambiente');
        }
      }
    } else {
      $this->Ambiente->id = $idAmbiente;
      $this->request->data = $this->Ambiente->read();
    }
    $catambientes = $this->Categoriasambiente->find('list', array('fields' => 'Categoriasambiente.nombre_completo'));
    $catpagos = $this->Categoriaspago->find('list', array('fields' => 'Categoriaspago.nombre_completo'));
    $categoria_ambientes = $this->Categoriasambiente->find('all');
    $categoria_pagos = $this->Categoriaspago->find('all');
    $usuarios = $this->User->find('list', array('fields' => 'User.nombre', 'conditions' => array('User.role' => 'Propietario')));
    $this->set(compact('catambientes', 'piso', 'catpagos', 'usuarios', 'categoria_ambientes', 'categoria_pagos', 'idAmbiente', 'idPiso', 'sw'));
  }

  public function guarda_ambiente() {
    if (!empty($this->request->data)) {
      $this->Ambiente->create();
      $valida = $this->validar('Ambiente');
      if (empty($valida)) {
        if ($this->Ambiente->save($this->request->data['Ambiente'])) {
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
    $this->User->create();
    $this->request->data['User']['role'] = 'Propietario';
    $this->User->save($this->request->data['User']);
    $idUsuario = $this->User->getLastInsertID();

    $array['usuario'] = $idUsuario;
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

  public function inquilinos($idAmbiente = NULL) {
    $this->layout = 'ajax';
    $sql = "SELECT * FROM "
      . "(SELECT user_id,estado FROM inquilinos WHERE (ambiente_id = $idAmbiente) ORDER BY id DESC)"
      . " AS Inquilino WHERE 1 GROUP BY user_id";
    $sql2 = "SELECT * FROM ($sql) AS Inquilino LEFT JOIN users AS User ON(Inquilino.user_id = User.id) WHERE (Inquilino.estado = 1)";
    $inquilinos = $this->Inquilino->query($sql2);
    $select_inquilinos = $this->User->find('list', array('fields' => 'User.nombre', 'conditions' => array('User.role' => 'Inquilino')));
    $this->set(compact('inquilinos', 'select_inquilinos', 'idAmbiente'));
  }

  public function guarda_nuevo_inquilino() {
    $this->User->create();
    $this->request->data['User'];
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
        'conditions' => array('Inquilino.user_id' => $this->request->data['Inquilino']['user_id'], 'Inquilino.ambiente_id' => $this->request->data['Inquilino']['ambiente_id'])
      ));
      if (empty($inquilino)) {
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
      , 'fields' => array('Concepto.descripcion', 'Pago.fecha', 'SUM(Pago.monto) totalmonto', 'Pago.concepto_id')
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
        'acciones' => "CONCAT('$acciones')"
      );
      $this->paginate = array(
        'fields' => array('Ambiente.nombre', 'User.nombre', 'Ambiente.lista_inquilinos', 'Piso.nombre', 'Ambiente.acciones'),
        'conditions' => array('Ambiente.edificio_id' => $edificioId),
        'recursive' => 0,
        'order' => 'Ambiente.nombre ASC'
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
              'Ambiente.nombre LIKE' => "%$criterio%"
            )
          ));
          //debug($ambientes);
          $this->set(compact('ambientes'));
          break;
        case 3:
          $ambientes = $this->Ambiente->find('all', array(
            'recursive' => 0,
            'conditions' => array(
              'Ambiente.edificio_id' => $edificioId,
              'Ambiente.nombre LIKE' => "%$criterio%"
            )
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
      'order' => 'id DESC'
    ));
    $ultimoPago_alquiler = $this->Pago->find('first', array(
      'recursive' => -1,
      'fields' => array('Pago.fecha'),
      'conditions' => array('Pago.ambiente_id' => $idAmbiente, 'Pago.concepto_id' => 11, 'Pago.estado' => 'Pagado'),
      'order' => 'id DESC'
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
      'conditions' => array('Ambienteconcepto.ambiente_id' => $idAmbiente)
    ));
    /* debug($conceptos);
      exit; */
    $this->set(compact('datosAmbiente', 'ultimoPago_mantenimiento', 'inquilinos', 'conceptos', 'idAmbiente', 'fecha_mantenimiento', 'fecha_alquiler', 'ultimoPago_alquiler'));
  }

  public function ajaxlistapropietario($idPropietario = null) {
    //debug($idPropietario);
    //$idPropietario = $this->request->data['Ambiente']['idPropietario'];
    $ambientes = $this->Ambiente->find('all', array(
      'recursive' => 0,
      'conditions' => array(
        'Ambiente.user_id' => $idPropietario,
      )
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
        'User.nombre LIKE' => "%$criterio%"
      ),
      'limit' => 8,
      'group' => 'User.id'
    ));
    $this->set(compact('propietarios'));
    //debug($propietarios);
  }

  public function listadopago($idRecibo = null) {
    $recibo = $this->Recibo->findByid($idRecibo, null, null, 2);
    $this->set(compact('recibo'));
  }

  public function registra_pagos() {
    /* debug($this->request->data);
      exit; */
    $idInquilino = $this->request->data['Pago']['inquilino_id'];
    // Genera el recibo
    $numero = 1;
    $ultimo_recibo = $this->Recibo->find('first', array('order' => 'Recibo.id DESC', 'recursive' => -1, 'conditions' => array('Recibo.edificio_id' => $this->Session->read('Auth.User.edificio_id'))));
    if (!empty($ultimo_recibo)) {
      $numero = $ultimo_recibo['Recibo']['numero'] + 1;
    }
    if (!empty($idInquilino)) {
      $inquilino = $this->Inquilino->findByid($idInquilino, null, null, -1);
      $recibo = $this->Recibo->find('first', array(
        'recursive' => 0,
        'order' => 'Recibo.id DESC',
        'fields' => array('Recibo.id'),
        'conditions' => array('Inquilino.user_id' => $inquilino['Inquilino']['user_id'], 'Recibo.estado' => 'Creado')
      ));
    } else {
      $recibo = $this->Recibo->find('first', array(
        'recursive' => 0,
        'order' => 'Recibo.id DESC',
        'fields' => array('Recibo.id'),
        'conditions' => array('Recibo.propietario_id' => $this->request->data['Ambiente']['propietario_id'], 'Recibo.estado' => 'Creado')
      ));
    }
    if (!empty($recibo)) {
      $idRecibo = $recibo['Recibo']['id'];
    } else {
      $this->Recibo->create();
      $this->request->data['Recibo']['numero'] = $numero;
      $this->request->data['Recibo']['inquilino_id'] = $idInquilino;
      $this->request->data['Recibo']['propietario_id'] = $this->request->data['Ambiente']['propietario_id'];
      $this->request->data['Recibo']['estado'] = 'Creado';
      $this->request->data['Recibo']['edificio_id'] = $this->Session->read('Auth.User.edificio_id');
      $this->Recibo->save($this->request->data['Recibo']);
      $idRecibo = $this->Recibo->getLastInsertID();
    }
    $this->request->data['Pago']['recibo_id'] = $idRecibo;
    //termina Parte de recibos
    $edificio = $this->Edificio->find('first', array(
      'conditions' => array('Edificio.id' => $this->Session->read('Auth.User.edificio_id')),
      'fields' => array('Edificio.retencion')
    ));
    if (!empty($this->request->data['Mantenimiento']['pagar'])) {
      if (!empty($this->request->data['Mantenimiento']['retencion'])) {
        $this->pagar_m_a(10, $idRecibo, $this->request->data['Mantenimiento']['cuotas'], $this->request->data['Mantenimiento']['referencia_mantenimiento'], $this->request->data['Mantenimiento']['fecha_inicio'], $edificio['Edificio']['retencion']);
      } else {
        $this->pagar_m_a(10, $idRecibo, $this->request->data['Mantenimiento']['cuotas'], $this->request->data['Mantenimiento']['referencia_mantenimiento'], $this->request->data['Mantenimiento']['fecha_inicio'], NULL);
      }
    }
    if (!empty($this->request->data['Alquiler']['pagar'])) {
      if (!empty($this->request->data['Alquiler']['retencion'])) {
        $this->pagar_m_a(11, $idRecibo, $this->request->data['Alquiler']['cuotas'], $this->request->data['Alquiler']['referencia_alquileres'], $this->request->data['Alquiler']['fecha_inicio'], $edificio['Edificio']['retencion']);
      } else {
        $this->pagar_m_a(11, $idRecibo, $this->request->data['Alquiler']['cuotas'], $this->request->data['Alquiler']['referencia_alquileres'], $this->request->data['Alquiler']['fecha_inicio'], NULL);
      }
    }
    if (!empty($this->request->data['Ascensor']['pagar'])) {
      if (!empty($this->request->data['Ascensor']['retencion'])) {
        $this->pagar_otros(13, $idRecibo, 'Ascensor', $edificio['Edificio']['retencion']);
      } else {
        $this->pagar_otros(13, $idRecibo, 'Ascensor', NULL);
      }
    }
    if (!empty($this->request->data['Multas']['pagar'])) {
      if (!empty($this->request->data['Multas']['retencion'])) {
        $this->pagar_otros(14, $idRecibo, 'Multas', $edificio['Edificio']['retencion']);
      } else {
        $this->pagar_otros(14, $idRecibo, 'Multas', NULL);
      }
    }
    if (!empty($this->request->data['Otros']['pagar'])) {
      if (!empty($this->request->data['Otros']['retencion'])) {
        $this->pagar_otros(15, $idRecibo, 'Otros', $edificio['Edificio']['retencion']);
      } else {
        $this->pagar_otros(15, $idRecibo, 'Otros', NULL);
      }
    }
    $this->redirect(array('action' => 'listadopago', $idRecibo));
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
      'Pago.fecha >=' => $nuevafecha
    ));
    if ($retencion != NULL) {
      $this->request->data['Pago']['retencion'] = $retencion;
    } else {
      $this->request->data['Pago']['retencion'] = NULL;
    }
    foreach ($mantenimientos as $ma) {
      if ($cuotas_man > 0) {
        $this->Pago->id = $ma['Pago']['id'];
        $this->request->data['Pago']['recibo_id'] = $idRecibo;
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
      $this->Pago->save($this->request->data['Pago']);
      $cuotas_man--;
      $this->request->data['Pago'] = NULL;
    }
  }

  public function recibo($idRecibo = null, $terminar = null) {
    $pagos = $this->Pago->find('all', array(
      'recursive' => 0,
      'conditions' => array('Pago.recibo_id' => $idRecibo),
      'group' => array('Pago.concepto_id'),
      'fields' => array('Concepto.nombre', 'SUM(Pago.monto) as imp_total')
    ));

    $todos_pagos = $this->Pago->find('all', array(
      'recursive' => 0,
      'conditions' => array('Pago.recibo_id' => $idRecibo),
      'fields' => array('Pago.id')
    ));
    if ($terminar) {
      $this->Recibo->id = $idRecibo;
      $this->request->data['Recibo']['estado'] = 'Terminado';
      $this->Recibo->save($this->request->data['Recibo']);
      foreach ($todos_pagos as $pa) {
        $this->Pago->id = $pa['Pago']['id'];
        $this->request->data['Pago']['estado'] = 'Pagado';
        $this->Pago->save($this->request->data['Pago']);
      }
    }
    $recibo = $this->Recibo->findByid($idRecibo, null, null, 2);
    $detalles = $this->Pago->find('all', array(
      'recursive' => 0,
      'conditions' => array('Pago.recibo_id' => $idRecibo, 'YEAR(Pago.fecha) >=' => date('Y')),
    ));
    $detalles_a = $this->Pago->find('all', array(
      'recursive' => 0,
      'conditions' => array('Pago.recibo_id' => $idRecibo, 'YEAR(Pago.fecha) <' => date('Y')),
    ));
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
        $this->Pago->save($this->request->data['Pago']);
      }
    }
    $this->Session->setFlash('Se cancelo correctamente!!', 'msgbueno');
    $this->redirect(array('action' => 'buscador'));
  }

  public function generar_pagos() {
    $ambientes = $this->Ambiente->find('all', array(
      'recursive' => -1,
      'fields' => array('Ambiente.id', 'Ambiente.fecha_ocupacion', 'Ambiente.user_id')
      , 'conditions' => array('Ambiente.fecha_ocupacion !=' => NULL)
    ));
    foreach ($ambientes as $am) {
      $monto_mantenimiento = $this->Ambienteconcepto->find('first', array(
        'conditions' => array('Ambienteconcepto.ambiente_id' => $am['Ambiente']['id'], 'Ambienteconcepto.concepto_id' => 10)
        , 'recursive' => -1
      ));
      if (!empty($monto_mantenimiento)) {
        $ultimo_pago_mantenimiento = $this->Pago->find('first', array(
          'order' => 'Pago.id DESC',
          'conditions' => array('Pago.concepto_id' => 10, 'Pago.ambiente_id' => $am['Ambiente']['id']),
          'fields' => array('Pago.fecha')
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
        , 'recursive' => -1
      ));
      if (!empty($monto_alquiler)) {
        $ultimo_pago_alquiler = $this->Pago->find('first', array(
          'order' => 'Pago.id DESC',
          'conditions' => array('Pago.concepto_id' => 11, 'Pago.ambiente_id' => $am['Ambiente']['id']),
          'fields' => array('Pago.fecha')
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
      for ($i = 0; $i < $meses; $i++) {
        $cMeses++;
        if ($cMeses == 13) {
          $cAnos++;
          $cMeses = 1;
        }
        $cFecha = date("Y-m-d", mktime(0, 0, 0, $cMeses, 1, $cAnos));
        $array[$i]['fecha'] = $cFecha;
      }
      //debug($array);exit;
      return $array;
    } else {
      return array();
    }
  }
  
  public function editar_monto($idPago = NULL,$idRecibo = null){
    $this->Pago->id = $idPago;
    $this->request->data = $this->Pago->read();
    $this->set(compact('idRecibo'));
  }
  public function registra_monto_pago($idRecibo = NULL){
    if(!empty($this->request->data['Pago']['id'])){
      $this->Pago->create();
      $this->Pago->save($this->request->data['Pago']);
    }
    $this->Session->setFlash('Se edito correctamente el monto!!!','msgbueno');
    $this->redirect(array('action' => 'listadopago',$idRecibo));
  }
}
