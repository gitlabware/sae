<?php
App::uses('AppController', 'Controller');
class ConceptosController extends AppController {
    
    public $uses = array('Concepto','Edificioconcepto','Ambienteconcepto','User');
    public $layout = 'sae';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }
    public function eservicios($idEdificio = NULL)
    {
        $this->layout = 'ajax';
        $servicios = $this->Edificioconcepto->findAllByedificio_id($idEdificio);
        $conceptos = $this->Concepto->find('list',array('fields' => 'Concepto.nombre','conditions' => array('Concepto.edificio_id' => $idEdificio)));
        $this->set(compact('servicios','idEdificio','conceptos'));
    }
    public function guarda_nuevo_servicio()
    {
        $this->Concepto->create();
        $this->Concepto->save($this->request->data['Concepto']);
        $idConcepto = $this->Concepto->getLastInsertID();
        $this->Edificioconcepto->create();
        $this->request->data['Edificioconcepto']['concepto_id'] = $idConcepto;
        $this->Edificioconcepto->save($this->request->data['Edificioconcepto']);
        exit;
    }
    public function quita_servicio($idEdiConcepto = null,$idEdificio = NULL)
    {
        $this->Edificioconcepto->delete($idEdiConcepto);
        $this->redirect(array('action' => 'eservicios',$idEdificio));
    }
    public function guarda_servicio()
    {
        $this->Edificioconcepto->create();
        $this->Edificioconcepto->save($this->request->data['Edificioconcepto']);
        exit;
    }
}

