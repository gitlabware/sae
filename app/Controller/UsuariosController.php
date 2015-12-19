<?php

App::uses("AppController", "Controller");

class UsuariosController extends AppController {

  var $uses = array('Pago', 'Inquilino', 'User', 'Ambiente');
  var $components = array('RequestHandler', 'DataTable');
  var $layout = 'sae';

  public function beforeFilter() {
    parent::beforeFilter();
    if ($this->RequestHandler->responseType() == 'json') {
      $this->RequestHandler->setContent('json', 'application/json');
    }
  }

  public function index() {
    
  }

  public function ambientes() {
    $idUser = $this->Session->read('Auth.User.id');
    /* $sql3 = "SELECT amb.id as idamb, amb.nombre as nombreamb,amb.piso_id FROM ambientes amb WHERE amb.user_id = $idUser";
      $sql2 = "SELECT inq.ambiente_id as idamb, ambientes.nombre as nombreamb, ambientes.piso_id FROM inquilinos inq LEFT JOIN ambientes ON inq.ambiente_id = ambientes.id WHERE inq.user_id = $idUser";
      $sql1 = "$sql2 UNION ALL $sql3";
      $sql4 = "SELECT Ambiente.*, Piso.nombre FROM ($sql1) Ambiente LEFT JOIN pisos Piso ON Ambiente.piso_id = Piso.id";
      $ambientes = $this->Inquilino->query($sql4); */
    //debug($ambientes);exit;
    $sql_1 = "SELECT pisos.nombre FROM pisos WHERE pisos.id = Ambiente.piso_id";
    $this->Inquilino->virtualFields = array(
      'piso' => "CONCAT(($sql_1))"
    );
    $ambientes_inq = $this->Inquilino->find('all', array(
      'recursive' => 0,
      'conditions' => array('Inquilino.user_id' => $idUser),
      'fields' => array('Ambiente.id', 'Ambiente.nombre', 'Inquilino.piso')
    ));
    $ambientes_prop = $this->Ambiente->find('all', array(
      'recursive' => 0,
      'conditions' => array('Ambiente.user_id' => $idUser),
      'fields' => array('Ambiente.id', 'Ambiente.nombre', 'Piso.nombre')
    ));
    //debug($ambientes_inq);exit;
    $this->set(compact('ambientes_inq', 'ambientes_prop'));
  }

  public function usuarios() {
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    if ($this->RequestHandler->responseType() == 'json') {
      $editar = '<a href="javascript:" class="btn btn-info" title="Editar" onclick="editar(' . "',User.id,'" . ');"><i class="gi gi-edit"></i></a>';
      $eliminar = '<a href="javascript:" class="btn btn-danger" title="Eliminar" onclick="eliminar(' . "',User.id,'" . ');"><i class="gi gi-remove"></i></a>';
      $this->User->virtualFields = array(
        'acciones' => "CONCAT('$editar $eliminar')"
      );
      $this->paginate = array(
        'fields' => array('User.id', 'User.nombre', 'User.ci', 'User.role', 'User.email', 'User.acciones'),
        'conditions' => array('User.edificio_id' => $idEdificio, 'User.role' => array('Propietario', 'Inquilino')),
        'recursive' => -1,
        'order' => 'User.nombre ASC'
      );
      $this->DataTable->fields = array('User.id', 'User.nombre', 'User.ci', 'User.role', 'User.email', 'User.acciones');
      $this->DataTable->emptyEleget_usuarios_adminments = 1;
      $this->set('users', $this->DataTable->getResponse('Usuarios', 'User'));
      $this->set('_serialize', 'users');
    }
  }

  public function usuario($idUsuario = null) {
    $this->layout = 'ajax';
    $this->User->id = $idUsuario;
    $this->request->data = $this->User->read();
  }

  public function registra_usuario() {
    if (!empty($this->request->data)) {
      if (!empty($this->request->data['User']['password2'])) {
        $this->request->data['User']['password'] = $this->request->data['User']['password2'];
      }
      $this->request->data['User']['edificio_id'] = $this->Session->read('Auth.User.edificio_id');
      $this->User->create();
      $this->User->save($this->request->data);
      $this->Session->setFlash("Se regsitro correctamente!!", 'msgbueno');
    } else {
      $this->Session->setFlash("No se pudo registrar!!", 'msgerror');
    }
    $this->redirect($this->referer());
  }

  public function pagados($idAmbiente = null) {
    $this->Pago->virtualFields = array(
      'monto_ret' => "CONCAT(((Pago.retencion/100)*Pago.monto))",
      'monto_total' => "CONCAT(IF(ISNULL(((Pago.retencion/100)*Pago.monto)),0,((Pago.retencion/100)*Pago.monto))+Pago.monto)"
    );
    $pagados = $this->Pago->find('all', array(
      'recursive' => 0,
      'conditions' => array('Pago.ambiente_id' => $idAmbiente, 'Pago.estado LIKE' => 'Pagado'),
      'fields' => array('Pago.modified', 'Concepto.nombre', 'Pago.fecha', 'Pago.monto', 'Pago.monto_ret', 'Pago.monto_total'),
      'order' => array('Pago.modified DESC', 'Pago.fecha DESC')
    ));
    /* debug($pagados);
      exit; */
    $this->set(compact('pagados'));
  }

  public function nopagados($idAmbiente = null) {
    $nopagados = $this->Pago->find('all', array(
      'recursive' => 0,
      'conditions' => array('Pago.ambiente_id' => $idAmbiente, 'Pago.estado LIKE' => 'Debe'),
      'fields' => array('Concepto.nombre', 'Pago.fecha', 'Pago.monto'),
      'order' => array('Pago.fecha DESC')
    ));
    $this->set(compact('nopagados'));
  }

  public function elimina_usuario($idUsuario = null) {
    $inquilino = $this->Inquilino->findByuser_id($idUsuario, null, null, -1);
    if (!empty($inquilino)) {
      $this->Inquilino->deleteAll(array('Inquilino.user_id' => $inquilino['Inquilino']['user_id']));
    }
    $ambientes = $this->Ambiente->find('all', array(
      'recursive' => -1,
      'conditions' => array('user_id' => $idUsuario)
    ));
    if (!empty($ambientes)) {
      foreach ($ambientes as $amb) {
        $damb['user_id'] = NULL;
        $this->Ambiente->id = $amb['Ambiente']['id'];
        $this->Ambiente->save($damb);
      }
    }
    
    $ambientes = $this->Ambiente->find('all', array(
      'recursive' => -1,
      'conditions' => array('representante_id' => $idUsuario)
    ));
    if (!empty($ambientes)) {
      foreach ($ambientes as $amb) {
        $damb['representante_id'] = NULL;
        $this->Ambiente->id = $amb['Ambiente']['id'];
        $this->Ambiente->save($damb);
      }
    }
    $this->User->delete($idUsuario);
    $this->Session->setFlash("Se elimino correctamente!!",'msgbueno');
    $this->redirect($this->referer());
  }

}
