<?php
App::uses('AppController', 'Controller');
class EdificiosController extends AppController {

    public $uses = array('Edificio','Piso','Ambiente','Categoriasambiente','Categoriaspago');
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
        $catambientes = $this->Categoriasambiente->find('list',array('fields' => 'Categoriasambiente.nombre'));
        $catpagos = $this->Categoriaspago->find('list',array('fields' => 'Categoriaspago.nombre'));
        $this->set(compact('catambientes','catpagos'));
    }
    public function guarda_edificio() {
        if (!empty($this->request->data)) {
            $this->Edificio->create();
            $valida = $this->validar('Edificio');
            if (empty($valida)) {
                if ($this->Edificio->save($this->request->data['Edificio'])) {
                    if(empty($this->request->data['Edificio']['id']))
                    {
                        $idEdificio = $this->Edificio->getLastInsertID();
                        $this->genera_pisos($idEdificio);
                    }
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
        $this->redirect(array('action' => 'index'));
    }
    //genera los pisos con sus respectivos ambientes cuando es nuevo
    public function genera_pisos($idEdificio = NULL)
    {
        $nro_pisos = $this->request->data['Edificio']['pisos'];
        $nro_ambientes = $this->request->data['Edificio']['ambientes'];
        $a_util = $this->request->data['Edificio']['area_util'];
        $a_comun = $this->request->data['Edificio']['area_comun'];
        $catambiente = $this->request->data['Edificio']['categoriasambiente_id'];
        $catpago = $this->request->data['Edificio']['categoriaspago_id'];
        for($i=1;$i<=$nro_pisos;$i++)
        {
            $this->Piso->create();
            $this->request->data['Piso']['nombre'] = "P".$i;
            $this->request->data['Piso']['edificio_id'] = $idEdificio;
            $this->Piso->save($this->request->data['Piso']);
            $idPiso = $this->Piso->getLastInsertID();
            $this->genera_ambientes($idEdificio,$idPiso, $nro_ambientes,$a_util,$a_comun,$catambiente,$catpago);
        }
    }
    public function genera_ambientes($idEdificio = null, $idPiso = null, $numero = null,$a_util = null,$a_comun = null,$catambiente = NULL,$catpago = NULL)
    {
        for($i=1;$i<=$numero;$i++)
        {
            $this->Ambiente->create();
            $this->request->data['Ambiente']['categoriasambiente_id'] = $catambiente;
            $this->request->data['Ambiente']['categoriasambiente_id'] = $catpago;
            $this->request->data['Ambiente']['edificio_id'] = $idEdificio;
            $this->request->data['Ambiente']['piso_id'] = $idPiso;
            $this->request->data['Ambiente']['nombre'] = "A".$i;
            $this->request->data['Ambiente']['area_util'] = $a_util;
            $this->request->data['Ambiente']['area_comun'] = $a_comun;
            $this->request->data['Ambiente']['mantenimiento'] = $this->calcula_mantenimiento();
            $this->Ambiente->save($this->request->data['Ambiente']);
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
    public function calcula_mantenimiento()
    {
        $cambiente = $this->Categoriasambiente->findByid($this->request->data['Edificio']['categoriasambiente_id'],NULL,NULL,-1);
        $cpago = $this->Categoriaspago->findByid($this->request->data['Edificio']['categoriaspago_id'],NULL,NULL,-1);
        $totalmt = $this->request->data['Ambiente']['area_util'] + $this->request->data['Ambiente']['area_comun'];
        $costob = $totalmt*$cambiente['Categoriasambiente']['constante'];
        $mantenimiento = $costob+$cpago['Categoriaspago']['constante'];
        return $mantenimiento;
    }
    
}
