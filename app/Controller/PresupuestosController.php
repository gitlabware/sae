<?php

App::uses('AppController', 'Controller');

class PresupuestosController extends AppController {

    public $uses = array('Presupuesto', 'Gestione','Concepto');
    public $layout = 'sae';

    public function index() {
        $idEdificio = $this->Session->read('Auth.User.edificio_id');
        $gestiones = $this->Gestione->findAllByedificio_id($idEdificio, NULL, NULL, -1);
        //debug($gestiones);exit;
        $this->set(compact('gestiones'));
    }

    public function gestion($idGestion = NULL) {
        $this->layout = 'ajax';
        $this->Gestione->id = $idGestion;
        $this->request->data = $this->Gestione->read();
    }

    public function guarda_gestion() {
        $valida = $this->validar('Gestione');
        if (empty($valida)) {
            $this->Gestione->create();
            $this->Gestione->save($this->request->data['Gestione']);
            $idGestion = $this->Gestione->getLastInsertID();
            $this->Session->setFlash('Se regsitro correctamente', 'msgbueno');
            $this->redirect(array('action' => 'presupuesto', $idGestion));
        } else {
            $this->Session->setFlash($valida, 'msgerror');
            $this->redirect(array('action' => 'index'));
        }
    }

    public function presupuestos($idGestion = NULL) {
        $gestion = $this->Gestione->findByid($idGestion);
        $this->set(compact('idGestion','gestion'));
    }

    public function eingresos($idGestion = NULL,$mes = NULL) {
        
        $presupuestos = $this->Presupuesto->find('all', array(
            'conditions' => array('Presupuesto.edificio_id' => $this->Session->read('Auth.User.edificio_id'),
                'Presupuesto.gestione_id' => $idGestion, 'Presupuesto.mes' => $mes),
            'fields' => array('Presupuesto.tipo','Concepto.nombre', 'Presupuesto.concepto_id','Presupuesto.monto','Presupuesto.id')
        ));
        //debug($presupuestos);exit;
        return $presupuestos;
    }

    public function egresos($idGestion = NULL) {
        $presupuestos = $this->Presupuesto->find('all', array(
            'conditions' => array('Presupuesto.edificio_id' => $this->Session->read('Auth.User.edificio_id'),
                'Presupuesto.gestione_id' => $idGestion, 'Presupuesto.tipo' => 'Egreso')
        ));
        return $presupuestos;
    }

    public function guarda_presupuesto() {
        if (!empty($this->request->data)) {
            $this->request->data['Presupuesto']['edificio_id'] = $this->Session->read('Auth.User.edificio_id');
            $this->Presupuesto->create();
            $valida = $this->validar('Presupuesto');
            if (empty($valida)) {
                if ($this->Presupuesto->save($this->request->data['Presupuesto'])) {

                    $this->Session->setFlash('Se registro correctamente los datos!!!', 'msgbueno');
                } else {
                    $this->Session->setFlash('NO se pudo registrar los datos de la presupuesto!!!', 'msgerror');
                }
            } else {
                $this->Session->setFlash($valida, 'msgerror');
            }
        } else {
            $this->Session->setFlash('NO se pudo registrar los datos de la presupuesto!!!', 'msgerror');
        }
        $this->redirect($this->referer());
    }

    public function eliminar($idPresupuesto = null) {
        if ($this->Presupuesto->delete($idPresupuesto)) {
            $this->Session->setFlash('Se elimino correctamente!!!', 'msgbueno');
        } else {
            $this->Session->setFlash('No se pudo eliminar, verifique que la presupuesto exista!!!', 'msgerror');
        }
        $this->redirect($this->referer());
    }
    public function presupuesto($idGestion = NULL,$idPresupuesto = null)
    {
        $this->layout = 'ajax';
        $this->Presupuesto->id = $idPresupuesto;
        $this->request->data = $this->Presupuesto->read();
        $idEdificio = $this->Session->read('Auth.User.edificio_id');
        $conceptos = $this->Concepto->find('list',array('fields' => 'Concepto.nombre','conditions' => array(
            'Concepto.edificio_id' => $idEdificio
        )));
        $gestion = $this->Gestione->findByid($idGestion);
        $this->set(compact('conceptos','gestion'));
    }
}
