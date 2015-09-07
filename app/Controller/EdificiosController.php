<?php

App::uses('AppController', 'Controller');

class EdificiosController extends AppController {

  var $components = array('RequestHandler');
  public $uses = array('Edificio', 'Piso', 'Ambiente', 'Categoriasambiente', 'Categoriaspago', 'User', 'Edificioconcepto', 'Ambienteconcepto', 'Retencione', 'GenCategoriasambiente', 'GenCategoriaspago');
  public $layout = 'sae';

  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow();
  }

  public function index() {
    $edificios = $this->Edificio->find('all');
    $this->set(compact('edificios'));
  }

  public function edificio($idEdificio = null) {
    $this->layout = 'ajax';
    $this->Edificio->id = $idEdificio;
    $this->request->data = $this->Edificio->read();
    if (empty($idEdificio)) {
      $catambientes = $this->GenCategoriasambiente->find('list', array('fields' => 'GenCategoriasambiente.nombre'));
      $catpagos = $this->GenCategoriaspago->find('list', array('fields' => 'GenCategoriaspago.nombre'));
    } else {
      $catambientes = $this->Categoriasambiente->find('list', array('fields' => 'Categoriasambiente.nombre', 'conditions' => array('Categoriasambiente.edificio_id' => $idEdificio)));
      $catpagos = $this->Categoriaspago->find('list', array('fields' => 'Categoriaspago.nombre', 'conditions' => array('Categoriaspago.edificio_id' => $idEdificio)));
    }
    $pisos = $this->Piso->find('count', array('conditions' => array('Piso.edificio_id' => $idEdificio)));
    $this->set(compact('catambientes', 'catpagos', 'pisos'));
  }

  public function guarda_edificio() {
    if (!empty($this->request->data)) {
      if (!empty($this->request->data['Edificio']['imagen_up'])) {
        $archivo = $this->request->data['Edificio']['imagen_up'];
        $extension = explode('.', $archivo['name']);
        $ext = end($extension);
        if ($archivo['error'] === UPLOAD_ERR_OK) {
          $nombre = String::uuid();
          if (move_uploaded_file($archivo['tmp_name'], WWW_ROOT . 'imagenes' . DS . $nombre . '.' . $ext)) {
            $nombre_archivo = $nombre . '.' . $ext;
            $this->request->data['Edificio']['imagen'] = $nombre_archivo;
          }
        } else {
          $this->Session->setFlash('Ocurrio un error al cargar la imagen ' . $archivo['name'],'msgerror');
          $this->redirect($this->referer());
        }
      }

      /*debug($this->request->data);
      exit;*/
      $this->Edificio->create();
      $valida = $this->validar('Edificio');
      if (empty($valida)) {
        if ($this->Edificio->save($this->request->data['Edificio'])) {
          if (empty($this->request->data['Edificio']['id'])) {
            $idEdificio = $this->Edificio->getLastInsertID();
            $this->registra_categorias($idEdificio);
          } else {
            $idEdificio = $this->request->data['Edificio']['id'];
          }
          if (!empty($this->request->data['Edificio']['pisos'])) {
            $this->genera_pisos($idEdificio);
          }
          $this->genera_servicio_ambientes($idEdificio);
          $this->Session->setFlash('Se registro correctamente los datos!!!', 'msgbueno');
        } else {
          $this->Session->setFlash('NO se pudo registrar los datos del edificio!!!', 'msgerror');
        }
      } else {
        $this->Session->setFlash($valida, 'msgerror');
      }
    } else {
      $this->Session->setFlash('NO se pudo registrar los datos del edificio!!!', 'msgerror');
    }
    $this->redirect($this->referer());
  }

  public function registra_categorias($idEdificio = null) {
    if (!empty($this->request->data['Edificio']['gcategoriasambiente_id'])) {
      $categoria_ambiente = $this->GenCategoriasambiente->findByid($this->request->data['Edificio']['gcategoriasambiente_id'], null, null, -1);
      $this->request->data['Categoriasambiente']['nombre'] = $categoria_ambiente['GenCategoriasambiente']['nombre'];
      $this->request->data['Categoriasambiente']['edificio_id'] = $idEdificio;
      $this->Categoriasambiente->create();
      $this->Categoriasambiente->save($this->request->data['Categoriasambiente']);
      $datos_e['categoriasambiente_id'] = $this->Categoriasambiente->getLastInsertID();
      $this->request->data['Edificio']['categoriasambiente_id'] = $datos_e['categoriasambiente_id'];
    }
    if (!empty($this->request->data['Edificio']['gcategoriasambiente_id'])) {
      $categoria_pago = $this->GenCategoriaspago->findByid($this->request->data['Edificio']['gcategoriaspago_id'], null, null, -1);
      $this->request->data['Categoriaspago']['nombre'] = $categoria_pago['GenCategoriaspago']['nombre'];
      $this->request->data['Categoriaspago']['edificio_id'] = $idEdificio;
      $this->Categoriaspago->create();
      $this->Categoriaspago->save($this->request->data['Categoriaspago']);
      $datos_e['categoriaspago_id'] = $this->Categoriaspago->getLastInsertID();
      $this->request->data['Edificio']['categoriaspago_id'] = $datos_e['categoriaspago_id'];
    }
    $this->Edificio->id = $idEdificio;
    $this->Edificio->save($datos_e);
  }

  //genera los pisos con sus respectivos ambientes cuando es nuevo
  public function genera_pisos($idEdificio = NULL) {
    $nro_pisos = $this->request->data['Edificio']['pisos'];
    $nro_ambientes = $this->request->data['Edificio']['ambientes'];
    $a_util = $this->request->data['Edificio']['area_util'];
    $a_comun = $this->request->data['Edificio']['area_comun'];
    $catambiente = $this->request->data['Edificio']['categoriasambiente_id'];
    $catpago = $this->request->data['Edificio']['categoriaspago_id'];
    for ($i = 1; $i <= $nro_pisos; $i++) {
      $this->Piso->create();
      $this->request->data['Piso']['nombre'] = "P" . $i;
      $this->request->data['Piso']['edificio_id'] = $idEdificio;
      $this->Piso->save($this->request->data['Piso']);
      $idPiso = $this->Piso->getLastInsertID();
      if (!empty($nro_ambientes)) {
        $this->genera_ambientes($idEdificio, $idPiso, $nro_ambientes, $a_util, $a_comun, $catambiente, $catpago);
      }
    }
  }

  public function genera_ambientes($idEdificio = null, $idPiso = null, $numero = null, $a_util = null, $a_comun = null, $catambiente = NULL, $catpago = NULL) {
    for ($i = 1; $i <= $numero; $i++) {
      $this->Ambiente->create();
      $this->request->data['Ambiente']['categoriasambiente_id'] = $catambiente;
      $this->request->data['Ambiente']['categoriaspago_id'] = $catpago;
      $this->request->data['Ambiente']['edificio_id'] = $idEdificio;
      $this->request->data['Ambiente']['piso_id'] = $idPiso;
      $this->request->data['Ambiente']['nombre'] = "A" . $i;
      $this->request->data['Ambiente']['area_util'] = $a_util;
      $this->request->data['Ambiente']['area_comun'] = $a_comun;
      $this->Ambiente->save($this->request->data['Ambiente']);
      if (!empty($catambiente) && !empty($catpago) && $a_comun != NULL && $a_util != NULL) {
        $this->request->data['Ambienteconcepto']['ambiente_id'] = $this->Ambiente->getLastInsertID();
        $this->request->data['Ambienteconcepto']['concepto_id'] = 10;
        $this->request->data['Ambienteconcepto']['monto'] = $this->calcula_mantenimiento();
        $this->Ambienteconcepto->create($this->request->data['Ambienteconcepto']);
        $this->Ambienteconcepto->save();
      }
    }
  }

  public function eliminar($idEdificio = null) {
    if ($this->Edificio->delete($idEdificio)) {
      $this->Session->setFlash('Se elimino correctamente!!!', 'msgbueno');
    } else {
      $this->Session->setFlash('No se pudo eliminar, verifique que el edificio exista!!!', 'msgerror');
    }
    $this->redirect(array('action' => 'index'));
  }

  public function calcula_mantenimiento() {

    $cambiente = $this->Categoriasambiente->findByid($this->request->data['Edificio']['categoriasambiente_id'], NULL, NULL, -1);
    $cpago = $this->Categoriaspago->findByid($this->request->data['Edificio']['categoriaspago_id'], NULL, NULL, -1);

    $totalmt = $this->request->data['Ambiente']['area_util'] + $this->request->data['Ambiente']['area_comun'];
    $costob = $totalmt * $cambiente['Categoriasambiente']['constante'];
    $mantenimiento = $costob + $cpago['Categoriaspago']['constante'];
    return $mantenimiento;
  }

  public function usuarios($idEdificio = NULL) {
    $this->layout = 'ajax';
    $select_usuarios = $this->User->find('list', array('fields' => 'User.nombre', 'conditions' => array('User.role' => 'Administrador', 'User.edificio_id' => NULL)));
    $usuarios = $this->User->find('all', array('conditions' => array('User.role' => 'Administrador', 'User.edificio_id' => $idEdificio)));
    $this->set(compact('idEdificio', 'select_usuarios', 'usuarios'));
  }

  public function guarda_nuevo_usuario() {
    $valida = $this->validar('User');
    if (empty($valida)) {
      $this->User->create();
      $this->User->save($this->request->data['User']);
      $array['mensaje'] = '';
    } else {
      $array['mensaje'] = $valida;
    }
    $this->respond($array, true);
  }

  public function guarda_usurio() {
    $this->User->create();
    $this->User->save($this->request->data['User']);
    exit;
  }

  public function quita_usuario($idUsuario = NULL, $idEdificio = NULL) {
    $this->User->create();
    $this->request->data['User']['id'] = $idUsuario;
    $this->request->data['User']['edificio_id'] = NULL;
    $this->User->save($this->request->data['User']);
    $this->redirect(array('action' => 'usuarios', $idEdificio));
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

  public function genera_servicio_ambientes($idEdificio = NULL) {
    $edi_serv = $this->Edificioconcepto->find('all', array('recursive' => -1, 'conditions' => array('Edificioconcepto.edificio_id' => $idEdificio)));
    if (!empty($edi_serv)) {
      $ambientes = $this->Ambiente->find('all', array('recursive' => -1, 'conditions' => array('Ambiente.edificio_id' => $idEdificio)));
      foreach ($ambientes as $am) {
        foreach ($edi_serv as $ed) {
          $this->Ambienteconcepto->create();
          $this->request->data['Ambienteconcepto']['ambiente_id'] = $am['Ambiente']['id'];
          $this->request->data['Ambienteconcepto']['concepto_id'] = $ed['Edificioconcepto']['concepto_id'];
          $this->request->data['Ambienteconcepto']['monto'] = $ed['Edificioconcepto']['monto'];
          $this->Ambienteconcepto->save($this->request->data['Ambienteconcepto']);
        }
      }
    }
  }

  public function datos() {
    $edificio = $this->Edificio->findByid($this->Session->read('Auth.User.edificio_id'));
    $nro_pisos = $this->Piso->find('count', array('conditions' => array('Piso.edificio_id' => $this->Session->read('Auth.User.edificio_id'))));
    $nro_ambientes = $this->Ambiente->find('count', array('conditions' => array('Ambiente.edificio_id' => $this->Session->read('Auth.User.edificio_id'))));
    $nro_usuarios = $this->User->find('count', array('conditions' => array('User.edificio_id' => $this->Session->read('Auth.User.edificio_id'))));
    $this->set(compact('edificio', 'nro_pisos', 'nro_ambientes', 'nro_usuarios'));
  }
  
  public function piso(){
    $this->layout = 'ajax';
    if(!empty($this->request->data['Piso'])){
      $idEdificio = $this->Session->read('Auth.User.edificio_id');
      $this->Piso->create();
      $this->request->data['Piso']['edificio_id'] = $idEdificio;
      $this->Piso->save($this->request->data['Piso']);
      $this->Session->setFlash("Se registrpo correctamente!!!",'msgbueno');
      $this->redirect($this->referer());
    }
  }
  
  public function elimina_piso($idPiso = null){
    if($this->Piso->delete($idPiso)){
      $this->Session->setFlash("Se ha eliminado correctamente el piso!!",'msgbueno');
    }else{
      $this->Session->setFlash("No se ha podido eliminar el piso intentelo nuevamente!!",'msgerror');
    }
    $this->redirect($this->referer());
  }

}
