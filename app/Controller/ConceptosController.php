<?php

App::uses('AppController', 'Controller');

class ConceptosController extends AppController {

  public $uses = array('Concepto', 'Edificioconcepto', 'Ambienteconcepto', 'User', 'Ambiente', 'Subconcepto', 'SubcGestione');
  var $components = array('RequestHandler');
  public $layout = 'sae';

  public function beforeFilter() {
    parent::beforeFilter();
    //$this->Auth->allow();
  }

  public function eservicios($idEdificio = NULL) {
    $this->layout = 'ajax';
    $servicios = $this->Edificioconcepto->findAllByedificio_id($idEdificio);
    $conceptos = $this->Concepto->find('list', array('fields' => 'Concepto.nombre', 'conditions' => array('Concepto.edificio_id' => $idEdificio)));
    $this->set(compact('servicios', 'idEdificio', 'conceptos'));
  }

  public function guarda_nuevo_servicio() {
    $this->Concepto->create();
    $this->Concepto->save($this->request->data['Concepto']);
    $idConcepto = $this->Concepto->getLastInsertID();
    $this->Edificioconcepto->create();
    $this->request->data['Edificioconcepto']['concepto_id'] = $idConcepto;
    $this->Edificioconcepto->save($this->request->data['Edificioconcepto']);
    exit;
  }

  public function quita_servicio($idEdiConcepto = null, $idEdificio = NULL) {
    $this->Edificioconcepto->delete($idEdiConcepto);
    $this->redirect(array('action' => 'eservicios', $idEdificio));
  }

  public function guarda_servicio() {
    $this->Edificioconcepto->create();
    $this->Edificioconcepto->save($this->request->data['Edificioconcepto']);
    exit;
  }

  //Modulo de servicios de ambientes
  public function aservicios($idAmbiente = NULL, $idEdificio = NULL) {
    $this->layout = 'ajax';
    $ambiente = $this->Ambiente->find('first', array('recursive' => -1, 'conditions' => array('Ambiente.id' => $idAmbiente), 'fields' => array('Ambiente.piso_id')));
    $idPiso = $ambiente['Ambiente']['piso_id'];
    $servicios = $this->Ambienteconcepto->findAllByambiente_id($idAmbiente);
    $conceptos = $this->Concepto->find('list', array('fields' => 'Concepto.nombre'));
    $this->set(compact('servicios', 'idEdificio', 'conceptos', 'idAmbiente', 'idPiso'));
  }

  public function guarda_nuevo_servicio_a() {
    $this->Concepto->create();
    $this->Concepto->save($this->request->data['Concepto']);
    $idConcepto = $this->Concepto->getLastInsertID();
    $this->Ambienteconcepto->create();
    $this->request->data['Ambienteconcepto']['concepto_id'] = $idConcepto;
    $this->Ambienteconcepto->save($this->request->data['Ambienteconcepto']);
    exit;
  }

  public function quita_servicio_a($idAmbConcepto = null, $idAmbiente = NULL, $idEdificio = NULL) {
    $this->Ambienteconcepto->delete($idAmbConcepto);
    $this->redirect(array('action' => 'aservicios', $idAmbiente, $idEdificio));
  }

  public function guarda_servicio_a() {
    $ambientecon = $this->Ambienteconcepto->find('first', array(
      'recursive' => -1,
      'conditions' => array(
        'ambiente_id' => $this->request->data['Ambienteconcepto']['ambiente_id'],
        'concepto_id' => $this->request->data['Ambienteconcepto']['concepto_id']
      ),
      'fields' => array('id')
    ));
    if (!empty($ambientecon)) {
      $this->request->data['Ambienteconcepto']['id'] = $ambientecon['Ambienteconcepto']['id'];
    }
    $this->Ambienteconcepto->create();
    $this->Ambienteconcepto->save($this->request->data['Ambienteconcepto']);
    exit;
  }

  public function ambientes() {

    if (!empty($this->request->data)) {
      /* debug($this->request->data);
        exit; */
      foreach ($this->request->data['Dato']['ambientes'] as $dat) {

        if ($dat['marca'] == '1') {
          $ambientecon = $this->Ambienteconcepto->find('first', array(
            'recursive' => -1,
            'conditions' => array(
              'ambiente_id' => $dat['ambiente_id'],
              'concepto_id' => $this->request->data['Dato']['concepto_id']
            ),
            'fields' => array('id')
          ));
          $datos = NULL;
          $datos['monto'] = $this->request->data['Dato']['monto'];
          $datos['concepto_id'] = $this->request->data['Dato']['concepto_id'];
          //$datos['subconcepto_id'] = $this->request->data['Dato']['subconcepto_id'];
          $datos['ambiente_id'] = $dat['ambiente_id'];
          if (!empty($ambientecon)) {
            $datos['id'] = $ambientecon['Ambienteconcepto']['id'];
          }
          //debug($datos);exit;
          $this->Ambienteconcepto->create();
          $this->Ambienteconcepto->save($datos);
        }
      }
      $this->Session->setFlash("Se a registrado correctamente!!", 'msgbueno');
      $this->redirect(array('action' => 'ambientes'));
    }
    $ambientes = $this->Ambiente->find('all', array(
      'recursive' => 0,
      'conditions' => array('Ambiente.edificio_id' => $this->Session->read('Auth.User.edificio_id')),
      'fields' => array('Ambiente.id', 'Ambiente.nombre', 'Piso.nombre', 'Representante.nombre')
    ));
    $conceptos = $this->Concepto->find('list', array('fields' => array('id', 'nombre'), 'order' => array('nombre')));
    $subconceptos = $this->Subconcepto->find('list', array('fields' => array('id', 'nombre'), 'order' => array('nombre')));
    $subconceptos_aux = $this->Subconcepto->find('list', array('fields' => array('id', 'concepto_id')));

    $this->set(compact('ambientes', 'conceptos', 'subconceptos', 'subconceptos_aux'));
  }

  public function get_conceptos_a($idAmbiente = null) {
    return $this->Ambienteconcepto->find('all', array(
        'recursive' => 0,
        'conditions' => array('Ambienteconcepto.ambiente_id' => $idAmbiente),
        'fields' => array('Concepto.nombre', 'Ambienteconcepto.monto')
    ));
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

  public function subconcepto($idSubconcepto = null) {
    $this->layout = 'ajax';
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    if (!empty($this->request->data)) {
      $valida = $this->validar('Subconcepto');
      if (empty($valida)) {
        if (!empty($this->request->data['Subconcepto']['nuevo_tipo'])) {
          $this->request->data['Subconcepto']['tipo'] = $this->request->data['Subconcepto']['nuevo_tipo'];
        }
        $this->request->data['Subconcepto']['parent_id'] = $this->request->data['Subconcepto']['subconcepto_id'];
        $this->Subconcepto->create();
        $this->Subconcepto->save($this->request->data['Subconcepto']);
        if (!empty($this->request->data['gestiones'])) {
          $idSubC = $this->Subconcepto->getLastInsertID();
          foreach ($this->request->data['gestiones'] as $ges) {
            $dato_ge = $ges;
            $dato_ge['subconcepto_id'] = $idSubC;
            $this->SubcGestione->create();
            $this->SubcGestione->save($dato_ge);
          }
        }
        $this->Session->setFlash("Se registro correctamente!!", 'msgbueno');
        $array['mensaje'] = '';
      } else {
        $array['mensaje'] = $valida;
      }
      $this->respond($array, true);
    }
    $this->Subconcepto->id = $idSubconcepto;
    $this->request->data = $this->Subconcepto->read();
    $conceptos = $this->Concepto->find('list', array('fields' => array('id', 'nombre'), 'nombre' => array('nombre')));
    $this->Subconcepto->virtualFields = array(
      'nombre_completo' => "CONCAT(Subconcepto.codigo,' - ',Subconcepto.nombre)"
    );
    $subconceptos = $this->Subconcepto->find('list',array(
      'recursive' => -1,
      'conditions' => array('Subconcepto.edificio_id' => $idEdificio,'Subconcepto.id !=' => $idSubconcepto),
      'fields' => array('Subconcepto.id','Subconcepto.nombre_completo')
    ));
    $generaciones = $this->SubcGestione->findAllBysubconcepto_id($idSubconcepto, null, null, null, null, -1);
    $this->set(compact('conceptos', 'generaciones','subconceptos'));
  }

  public function subconceptos() {
    /*$data = $this->Subconcepto->generateTreeList(
      null, null, null, '---',-1
    );
    $resu = $this->Subconcepto->children(1,TRUE,['id','nombre']);
    debug($resu);
    debug($data);
    die;*/
    $subconceptos = $this->Subconcepto->find('all', array(
      'recursive' => 0,
      'conditions' => array(
        'Subconcepto.edificio_id' => $this->Session->read('Auth.User.edificio_id'),
        "Subconcepto.subconcepto_id" => NULL
      ),
      'fields' => array('Subconcepto.codigo','Subconcepto.nombre', 'Concepto.nombre', 'Subconcepto.tipo', 'Subconcepto.id')
    ));
    
    $this->set(compact('subconceptos'));
  }

  public function eliminar_subconcepto($idSubconcepto = null) {
    if ($this->Subconcepto->delete($idSubconcepto)) {
      $this->Session->setFlash("Se elimino correctamente el subconcepto!!", 'msgbueno');
    } else {
      $this->Session->setFlash("No se pudo eliminar intente nuevamente!!", 'msgerror');
    }

    $this->redirect($this->referer());
  }

  public function registra_sgention() {
    //debug($this->request->data['Subconcepto']);exit;
    $valida = $this->validar('Subconcepto');
    if (empty($valida)) {
      if (!empty($this->request->data['Subconcepto']['nuevo_tipo'])) {
        $this->request->data['Subconcepto']['tipo'] = $this->request->data['Subconcepto']['nuevo_tipo'];
      }
      $this->Subconcepto->create();
      $this->Subconcepto->save($this->request->data['Subconcepto']);

      $this->SubcGestione->create();
      $this->SubcGestione->save($this->request->data['SubcGestione']);

      $array['mensaje'] = '';
    } else {
      $array['mensaje'] = $valida;
    }
    $this->respond($array, true);
    //exit;
  }

  public function elimina_subgestion($idSuconcepto = null, $idsg = null) {
    $this->SubcGestione->delete($idsg);
    $this->redirect(array('action' => 'subconcepto', $idSuconcepto));
    exit;
  }

  public function ajax_subges($idSuconcepto = null) {
    $this->layout = 'ajax';
    $this->SubcGestione->virtualFields = array(
      'nombre' => "(IF(SubcGestione.gestion_ini = SubcGestione.gestion_fin,SubcGestione.gestion_ini,CONCAT(SubcGestione.gestion_ini,' - ',SubcGestione.gestion_fin)))"
    );
    $subgestiones = $this->SubcGestione->find('list', array(
      'recursive' => -1,
      'conditions' => array('subconcepto_id' => $idSuconcepto),
      'fields' => array('id', 'nombre')
    ));
    $this->set(compact('subgestiones'));
  }
  
  public function ajax_subconceptos($idSubconcepto = null,$sw = 0){
    $this->layout = 'ajax';
    $subconceptos = $this->Subconcepto->find('all',array(
      'recursive' => 0,
      'conditions' => array('Subconcepto.subconcepto_id' => $idSubconcepto),
      'fields' => array('Subconcepto.*','Concepto.nombre')
    ));
    $this->set(compact('subconceptos','sw'));
    
  }

}
