<?php

App::uses("AppController", "Controller");

class UsuariosController extends AppController {

  var $uses = array('Pago', 'Inquilino', 'User');
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
    $sql1 = "SELECT inq.ambiente_id as idamb, ambientes.nombre as nombreamb FROM inquilinos inq LEFT JOIN ambientes ON inq.ambiente_id = ambientes.id WHERE inq.user_id = $idUser UNION ALL SELECT amb.id as idamb, amb.nombre as nombreamb FROM ambientes amb WHERE amb.user_id = $idUser";
    $ambientes = $this->Inquilino->query($sql1);
    //debug($ambientes);exit;
    $this->set(compact('ambientes'));
  }

  public function usuarios() {
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    if ($this->RequestHandler->responseType() == 'json') {
      $editar = '<a href="javascript:" class="label label-primary" onclick="editar(' . "',User.id,'" . ');">Editar</a>';
      $this->User->virtualFields = array(
        'acciones' => "CONCAT('$editar')"
      );
      $this->paginate = array(
        'fields' => array('User.id', 'User.nombre', 'User.role', 'User.email', 'User.acciones'),
        'conditions' => array('User.edificio_id' => $idEdificio, 'User.role' => array('Propietario', 'Inquilino')),
        'recursive' => -1,
        'order' => 'User.nombre ASC'
      );
      $this->DataTable->fields = array('User.id', 'User.nombre', 'User.role', 'User.email', 'User.acciones');
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
      if(!empty($this->request->data['User']['password2'])){
        $this->request->data['User']['password'] = $this->request->data['User']['password2'];
      }
      $this->User->create();
      $this->User->save($this->request->data);
      $this->Session->setFlash("Se regsitro correctamente!!",'msgbueno');
    } else {
      $this->Session->setFlash("No se pudo registrar!!",'msgerror');
    }
    $this->redirect($this->referer());
  }
  

}
