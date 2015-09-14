<?php

App::uses('AppController', 'Controller');

class PresupuestosController extends AppController {

  public $uses = array('Presupuesto', 'Concepto', 'Subconcepto', 'Ingreso','Gasto','Subgasto','Egreso');
  public $layout = 'sae';

  public function index() {
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $presupuestos = $this->Presupuesto->find('all', array(
      'recursive' => -1,
      'conditions' => array('edificio_id' => $idEdificio)
    ));
    $this->set(compact('idEdificio', 'presupuestos'));
  }

  public function gestion($idPresupuesto = NULL) {
    $this->layout = 'ajax';
    $this->Presupuesto->id = $idPresupuesto;
    $this->request->data = $this->Presupuesto->read();
  }

  public function guarda_gestion() {
    $valida = $this->validar('Presupuesto');
    if (empty($valida)) {
      $this->Presupuesto->create();
      $this->Presupuesto->save($this->request->data['Presupuesto']);
      $idPresupuesto = $this->Presupuesto->getLastInsertID();
      $this->Session->setFlash('Se regsitro correctamente', 'msgbueno');
      $this->redirect(array('action' => 'presupuesto', $idPresupuesto));
    } else {
      $this->Session->setFlash($valida, 'msgerror');
      $this->redirect(array('action' => 'index'));
    }
  }

  public function eliminar($idPresupuesto = null) {
    if ($this->Presupuesto->delete($idPresupuesto)) {
      $this->Session->setFlash('Se elimino correctamente!!!', 'msgbueno');
    } else {
      $this->Session->setFlash('No se pudo eliminar, verifique que la presupuesto exista!!!', 'msgerror');
    }
    $this->redirect($this->referer());
  }

  public function presupuesto($idPresupuesto = null) {
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $presupuesto = $this->Presupuesto->findByid($idPresupuesto);
    $subconceptos = $this->Subconcepto->find('list', array(
      'conditions' => array('Subconcepto.edificio_id' => $idEdificio),
      'fields' => array('Subconcepto.id', 'Subconcepto.nombre')
    ));
    $conceptos = $this->Concepto->find('list', array('fields' => array('id', 'nombre')));
    $tingresos = $this->Ingreso->find('all', array(
      'recursive' => 0,
      'conditions' => array('Ingreso.presupuesto_id' => $idPresupuesto),
      'group' => array('Subconcepto.tipo'),
      'fields' => array('Subconcepto.tipo', 'SUM(Ingreso.ingreso) as ingreso', 'SUM(Ingreso.pres_anterior) as pres_anterior', 'SUM(Ingreso.ejec_anterior) as ejec_anterior', 'SUM(Ingreso.presupuesto) as presupuesto')
    ));
    $tipos = $this->Subconcepto->find('list', array(
      'recursive' => -1,
      'fields' => array('tipo', 'tipo'),
      'group' => array('tipo')
    ));
    
    $subgastos = $this->Subgasto->find('list', array(
      'conditions' => array('Subgasto.edificio_id' => $idEdificio),
      'fields' => array('Subgasto.id', 'Subgasto.nombre')
    ));
    
    $gtipos = $this->Subgasto->find('list', array(
      'recursive' => -1,
      'fields' => array('tipo', 'tipo'),
      'group' => array('tipo')
    ));
    $gastos = $this->Gasto->find('list', array('fields' => array('id', 'nombre')));
    $pgastos = $this->Egreso->find('all',array(
      'recursive' => 0,
      'conditions' => array('Egreso.presupuesto_id' => $idPresupuesto),
      'group' => array('Egreso.gasto_id'),
      'fields' => array('Gasto.id','Gasto.nombre', 'SUM(Egreso.pres_anterior) as pres_anterior', 'SUM(Egreso.ejec_anterior) as ejec_anterior', 'SUM(Egreso.presupuesto) as presupuesto')
    ));
    $this->set(compact('presupuesto', 'subconceptos', 'conceptos', 'tingresos', 'tipos','subgastos','gastos','gtipos','pgastos'));
  }
  
  public function get_tegresos($idPresupuesto = null,$idGasto = null){
    return $this->Egreso->find('all', array(
      'recursive' => 0,
      'conditions' => array('Egreso.presupuesto_id' => $idPresupuesto,'Egreso.gasto_id' => $idGasto),
      'group' => array('Subgasto.tipo'),
      'fields' => array('Subgasto.nombre','Subgasto.tipo', 'SUM(Egreso.pres_anterior) as pres_anterior', 'SUM(Egreso.ejec_anterior) as ejec_anterior', 'SUM(Egreso.presupuesto) as presupuesto')
    ));
  }
  
  public function get_egresos($idPresupuesto = null,$idGasto = null,$tipo = null){
    return $this->Egreso->find('all', array(
        'recursive' => 0,
        'conditions' => array('Egreso.presupuesto_id' => $idPresupuesto, 'Subgasto.tipo' => $tipo,'Egreso.gasto_id' => $idGasto)
    ));
  }

  public function ingreso($idIngreso = NULL) {
    $this->layout = 'ajax';
    $this->Ingreso->id = $idIngreso;
    $this->request->data = $this->Ingreso->read();
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $subconceptos = $this->Subconcepto->find('list', array(
      'conditions' => array('Subconcepto.edificio_id' => $idEdificio),
      'fields' => array('Subconcepto.id', 'Subconcepto.nombre')
    ));
    $conceptos = $this->Concepto->find('list', array('fields' => array('id', 'nombre')));
    $tipos = $this->Subconcepto->find('list', array(
      'recursive' => -1,
      'fields' => array('tipo', 'tipo'),
      'group' => array('tipo')
    ));
    $this->set(compact('subconceptos', 'conceptos', 'tipos'));
  }
  
  public function egreso($idEgreso = null){
    $this->layout = 'ajax';
    $this->Egreso->id = $idEgreso;
    $this->request->data = $this->Egreso->read();
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $subgastos = $this->Subgasto->find('list', array(
      'conditions' => array('Subgasto.edificio_id' => $idEdificio),
      'fields' => array('Subgasto.id', 'Subgasto.nombre')
    ));
    $gastos = $this->Gasto->find('list', array('fields' => array('id', 'nombre')));
    $gtipos = $this->Subgasto->find('list', array(
      'recursive' => -1,
      'fields' => array('tipo', 'tipo'),
      'group' => array('tipo')
    ));
    $this->set(compact('subgastos', 'gastos', 'gtipos'));
  }

  public function get_ingresos($idPresupuesto = null, $tipo = null) {
    return $this->Ingreso->find('all', array(
        'recursive' => 0,
        'conditions' => array('Ingreso.presupuesto_id' => $idPresupuesto, 'Subconcepto.tipo' => $tipo)
    ));
  }

  public function guarda_ingreso() {
    if (!empty($this->request->data['Ingreso'])) {
      $idEdificio = $this->Session->read('Auth.User.edificio_id');
      $dato = $this->request->data['Ingreso'];
      if (!empty($dato['nombre_subconcepto'])) {
        $subd['nombre'] = $dato['nombre_subconcepto'];
        $subd['concepto_id'] = $dato['concepto_id'];
        $subd['edificio_id'] = $idEdificio;
        if (!empty($dato['nombre_tipo'])) {
          $subd['tipo'] = $dato['nombre_tipo'];
        } else {
          $subd['tipo'] = $dato['tipo'];
        }
        $this->Subconcepto->create();
        $this->Subconcepto->save($subd);
        $dato['subconcepto_id'] = $this->Subconcepto->getLastInsertID();
      } else {
        $subconcepto = $this->Subconcepto->findByid($dato['subconcepto_id'], null, null, -1);
        $dato['concepto_id'] = $subconcepto['Subconcepto']['concepto_id'];
      }
      $this->request->data = $dato;
      $valida = $this->validar('Ingreso');
      if (empty($valida)) {
        $this->Ingreso->create();
        $this->Ingreso->save($dato);
        $this->Session->setFlash("Se registro correctamente el ingreso!!", 'msgbueno');
      } else {
        $this->Session->setFlash($valida, 'msgerror');
      }
    }
    $this->redirect($this->referer());
  }

  public function elimina_ingreso($idIngreso = NULL) {
    if ($this->Ingreso->delete($idIngreso)) {
      $this->Session->setFlash('Se ha eliminado correctamente el ingreso!!', 'msgbueno');
    } else {
      $this->Session->setFlash("No se pudo eliminar el ingreso intente nuevamente!!", 'msgbueno');
    }
    $this->redirect($this->referer());
  }
  public function elimina_egreso($idEgreso = NULL) {
    if ($this->Egreso->delete($idEgreso)) {
      $this->Session->setFlash('Se ha eliminado correctamente el egreso!!', 'msgbueno');
    } else {
      $this->Session->setFlash("No se pudo eliminar el egreso intente nuevamente!!", 'msgbueno');
    }
    $this->redirect($this->referer());
  }
  
  public function guarda_egreso() {
    if (!empty($this->request->data['Egreso'])) {
      $idEdificio = $this->Session->read('Auth.User.edificio_id');
      $dato = $this->request->data['Egreso'];
      if (!empty($dato['nombre_gasto'])){
        $dgasto['nombre'] = $dato['nombre_gasto'];
        $dgasto['edificio_id'] = $idEdificio;
        $this->Gasto->create();
        $this->Gasto->save($dgasto);
        $dato['gasto_id'] = $this->Gasto->getLastInsertID();
      }
      if (!empty($dato['nombre_subgasto'])) {
        $subd['nombre'] = $dato['nombre_subgasto'];
        $subd['gasto_id'] = $dato['gasto_id'];
        $subd['edificio_id'] = $idEdificio;
        if (!empty($dato['nombre_tipo'])) {
          $subd['tipo'] = $dato['nombre_tipo'];
        } else {
          $subd['tipo'] = $dato['tipo'];
        }
        $this->Subgasto->create();
        $this->Subgasto->save($subd);
        $dato['subgasto_id'] = $this->Subgasto->getLastInsertID();
      } else {
        $subgasto = $this->Subgasto->findByid($dato['subgasto_id'], null, null, -1);
        $dato['gasto_id'] = $subgasto['Subgasto']['gasto_id'];
      }
      $this->request->data = $dato;
      $valida = $this->validar('Egreso');
      if (empty($valida)) {
        $this->Egreso->create();
        $this->Egreso->save($dato);
        $this->Session->setFlash("Se registro correctamente el ingreso!!", 'msgbueno');
      } else {
        $this->Session->setFlash($valida, 'msgerror');
      }
    }
    $this->redirect($this->referer());
  }

}
