<?php

App::uses('AppController', 'Controller');

class NomenclaturasController extends AppController {

  public $uses = array('Nomenclatura', 'Concepto', 'Ambiente', 'Piso', 'NomenclaturasAmbiente', 'Subconcepto');
  public $layout = 'sae';

  public function index() {
    $idEdificio = $this->Session->read('Auth.User.edificio_id');

    $nomenclaturas = $this->Nomenclatura->find('all', array(
      'recursive' => -1,
      'conditions' => array('edificio_id' => $idEdificio, 'nomenclatura_id' => 0)
    ));

    $this->set(compact('nomenclaturas'));
  }

  public function ver() {
    $idEdificio = $this->Session->read('Auth.User.edificio_id');

    $nomenclaturas = $this->Nomenclatura->find('all', array(
      'recursive' => -1,
      'conditions' => array('edificio_id' => $idEdificio, 'nomenclatura_id' => 0)
    ));

    $this->set(compact('nomenclaturas'));
  }

  public function nomenclatura($idNomenclatura = null, $id = null) {
    $this->layout = 'ajax';
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    if (empty($idNomenclatura)) {
      $ultimo = $this->Nomenclatura->find('first', array(
        'recursive' => -1,
        'conditions' => array('edificio_id' => $idEdificio, 'nomenclatura_id' => 0),
        'order' => array('codigo DESC'),
        'fields' => array('codigo')
      ));
    } else {
      $ultimo = $this->Nomenclatura->find('first', array(
        'recursive' => -1,
        'conditions' => array('edificio_id' => $idEdificio, 'nomenclatura_id' => $idNomenclatura),
        'order' => array('codigo DESC'),
        'fields' => array('codigo')
      ));
    }

    $codigo = 1;
    if (!empty($ultimo)) {
      $codigo = $ultimo['Nomenclatura']['codigo'] + 1;
    }
    $codigo_padre = $this->get_codigo_com($idNomenclatura, "");

    $this->request->data = $nomenclatura = $this->Nomenclatura->find('first', array(
      'recursive' => -1,
      'conditions' => array('id' => $id)
    ));
    if (empty($this->request->data['Nomenclatura']['codigo'])) {
      $this->request->data['Nomenclatura']['codigo'] = $codigo;
    }
    $this->request->data['Nomenclatura']['nomenclatura_id'] = $idNomenclatura;
    $this->request->data['Nomenclatura']['edificio_id'] = $idEdificio;


    $this->Subconcepto->virtualFields = array(
      'nombre_completo' => "CONCAT(codigo,' - ',nombre)"
      );
    $subconceptos = $this->Subconcepto->find('list', array(
      'recursive' => -1,
      'conditions' => array('edificio_id' => $idEdificio),
      'fields' => array('id', 'nombre_completo')
    ));

    $this->set(compact('conceptos', 'subconceptos', 'codigo_padre'));
  }

  public function registra() {
    if (!empty($this->request->data['Nomenclatura'])) {
      //debug($this->request->data);exit;
      $this->Nomenclatura->create();
      if (!empty($this->request->data['Nomenclatura']['codigo_aux'])) {
        $this->request->data['Nomenclatura']['codigo_completo'] = $this->request->data['Nomenclatura']['codigo_aux'] . '.' . $this->request->data['Nomenclatura']['codigo'];
      } else {
        $this->request->data['Nomenclatura']['codigo_completo'] = $this->request->data['Nomenclatura']['codigo'];
      }
      /* debug($this->request->data);
        exit; */
      if (!empty($this->request->data['Nomenclatura']['subconcepto_id'])) {
        $subconcepto = $this->Subconcepto->findByid($this->request->data['Nomenclatura']['subconcepto_id'], null, null, -1);
        $this->request->data['Nomenclatura']['concepto_id'] = $subconcepto['Subconcepto']['concepto_id'];
      }

      $this->Nomenclatura->save($this->request->data['Nomenclatura']);
      $this->Session->setFlash("Se registro correctamente!!", 'msgbueno');
    } else {
      $this->Session->setFlash("No se ha podido registrar, intente nuevamente!!", 'msgerror');
    }
    $this->redirect(array('action' => 'index'));
  }

  public function ajax_nomenclaturas($idNomenclatura = null) {
    $this->layout = 'ajax';
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $nomenclaturas = $this->Nomenclatura->find('all', array(
      'recursive' => -1,
      'conditions' => array('edificio_id' => $idEdificio, 'nomenclatura_id' => $idNomenclatura),
      'order' => array('codigo ASC')
    ));

    $this->set(compact('nomenclaturas', 'idNomenclatura'));
  }

  public function ver_nomenclaturas($idNomenclatura = null) {
    $this->layout = 'ajax';
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $nomenclaturas = $this->Nomenclatura->find('all', array(
      'recursive' => -1,
      'conditions' => array('edificio_id' => $idEdificio, 'nomenclatura_id' => $idNomenclatura),
      'order' => array('codigo ASC')
    ));

    $this->set(compact('nomenclaturas', 'idNomenclatura'));
  }

  public function get_codigo_com($idNomenclatura = null, $codigo = "") {
    $nomenclatura = $this->Nomenclatura->find('first', array(
      'recursive' => -1,
      'conditions' => array('id' => $idNomenclatura),
      'fields' => array('nomenclatura_id', 'codigo')
    ));
    if (!empty($nomenclatura)) {
      if (!empty($codigo)) {
        $codigo = $nomenclatura['Nomenclatura']['codigo'] . ".$codigo";
      } else {
        $codigo = $nomenclatura['Nomenclatura']['codigo'];
      }
      if (!empty($nomenclatura['Nomenclatura']['nomenclatura_id'])) {
        $codigo = $this->get_codigo_com($nomenclatura['Nomenclatura']['nomenclatura_id'], $codigo);
      }
    }
    //debug($nomenclatura)
    return $codigo;
  }

  public function eliminar($idNomenclatura = null, $sw = TRUE) {
    $nomenclaturas = $this->Nomenclatura->find('all', array(
      'recursive' => -1,
      'conditions' => array('nomenclatura_id' => $idNomenclatura),
      'fields' => array('id')
    ));
    $this->Nomenclatura->delete($idNomenclatura);

    if (!empty($nomenclaturas)) {
      foreach ($nomenclaturas as $nom) {
        $this->eliminar($nom['Nomenclatura']['id'], FALSE);
      }
    }
    if ($sw) {
      $this->Session->setFlash("Se ha eliminado correctamente!!", 'msgbueno');
      $this->redirect($this->referer());
    }
  }

  public function ambientes($idNomenclatura = null) {
    $this->layout = 'ajax';
    $nomenclatura = $this->Nomenclatura->findByid($idNomenclatura, null, null, -1);
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $pisos = $this->Piso->find('list', array(
      'recursive' => -1,
      'conditions' => array('edificio_id' => $idEdificio),
      'fields' => array('id', 'nombre')
    ));
    $this->NomenclaturasAmbiente->virtualFields = array(
      'piso' => "(SELECT pisos.nombre FROM pisos WHERE pisos.id = Ambiente.piso_id)"
    );
    $ambientes = $this->NomenclaturasAmbiente->find('all', array(
      'recursive' => 0,
      'conditions' => array('NomenclaturasAmbiente.nomenclatura_id' => $idNomenclatura),
      'fields' => array('NomenclaturasAmbiente.id', 'Ambiente.nombre', 'NomenclaturasAmbiente.piso')
    ));
    //debug($ambientes);exit;
    $this->set(compact('idNomenclatura', 'pisos', 'nomenclatura', 'ambientes'));
  }

  public function ajax_ambientes() {
    $this->layout = 'ajax';
    $idPiso = $this->request->data['Piso']['id'];
    $idNomenclatura = $this->request->data['Nomenclatura']['id'];
    $ambientes_sel = $this->NomenclaturasAmbiente->find('list', array(
      'recursive' => 0,
      'conditions' => array('NomenclaturasAmbiente.nomenclatura_id' => $idNomenclatura),
      'fields' => array('NomenclaturasAmbiente.id', 'NomenclaturasAmbiente.ambiente_id')
    ));
    if (count($ambientes_sel) == 1) {
      $ambientes_sel = current($ambientes_sel);
    }
    //debug($ambientes_sel);exit;
    $ambientes = $this->Ambiente->find('all', array(
      'recursive' => 0,
      'conditions' => array(
        'Ambiente.piso_id' => $idPiso,
        'Ambiente.id != ' => $ambientes_sel
      ),
      'fields' => array('Ambiente.nombre', 'Representante.nombre', 'Ambiente.id')
    ));
    $this->set(compact('ambientes', 'idNomenclatura'));
  }

  public function registra_ambientes() {
    $this->layout = 'ajax';
    $dato_m['nomenclatura_id'] = $this->request->data['Nomenclatura']['id'];
    foreach ($this->request->data['Dato'] as $da) {
      if ($da['marca'] == '1') {
        $dato_m['ambiente_id'] = $da['ambiente_id'];
        $dato_m['codigo'] = $da['codigo'];
        $this->NomenclaturasAmbiente->create();
        $this->NomenclaturasAmbiente->save($dato_m);
      }
    }

    exit;
  }

  public function quita_ambiente($idNomenclatura = NULL, $id = null) {
    $this->NomenclaturasAmbiente->delete($id);
    $this->redirect(array('action' => 'ambientes', $idNomenclatura));
  }

  public function get_ambientes($idNomenclatura = null) {
    $this->NomenclaturasAmbiente->virtualFields = array(
      'piso' => "(SELECT pisos.nombre FROM pisos WHERE pisos.id = Ambiente.piso_id)"
    );
    $ambientes = $this->NomenclaturasAmbiente->find('all', array(
      'recursive' => 0,
      'conditions' => array('NomenclaturasAmbiente.nomenclatura_id' => $idNomenclatura),
      'fields' => array('NomenclaturasAmbiente.codigo', 'NomenclaturasAmbiente.id', 'Ambiente.nombre', 'NomenclaturasAmbiente.piso')
    ));
    return $ambientes;
  }

  public function ajax_subconceptos($idConcepto = null) {
    $this->layout = 'ajax';
    $subconceptos = $this->Subconcepto->find('list', array(
      'recursive' => -1,
      'conditions' => array('concepto_id' => $idConcepto),
      'fields' => array('id', 'nombre')
    ));
    $this->set(compact('subconceptos'));
  }

}
