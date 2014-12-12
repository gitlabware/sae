<?php
App::uses('AppController', 'Controller');
class AmbientesController extends AppController {

    public $uses = array('Edificio','Piso','Ambiente','Categoriasambiente','Categoriaspago','User');
    public $layout = 'sae';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }
    public function index() {
        $ambientes = $this->Ambiente->find('all');
        $this->set(compact('ambientes'));
    }
    public function edificio($idEdificio = NULL)
    {
        $edificio = $this->Edificio->findByid($idEdificio,NULL,NULL,-1);
        $pisos = $this->Piso->find('all',array('conditions' => array('Piso.edificio_id' => $idEdificio)));
        $this->set(compact('pisos','edificio'));
    }
    public function get_ambientes($idEdificio = NULL,$idPiso = NULL)
    {
        return $this->Ambiente->find('all',array(
            'recursive' => -1,'order' => 'Ambiente.id ASC',
            'conditions' => array('Ambiente.edificio_id' => $idEdificio,'Ambiente.piso_id' => $idPiso)
            ));
    }

    public function ambiente($idPiso = null,$idAmbiente = null) {
        $this->layout = 'ajax';
        $this->Ambiente->id = $idAmbiente;
        $this->request->data = $this->Ambiente->read();
        $catambientes = $this->Categoriasambiente->find('list',array('fields' => 'Categoriasambiente.nombre'));
        $catpagos = $this->Categoriaspago->find('list',array('fields' => 'Categoriaspago.nombre'));
        $usuarios = $this->User->find('list',array('fields' => 'User.nombre'));
        $piso = $this->Piso->findByid($idPiso);
        $this->set(compact('catambientes','piso','catpagos','usuarios'));
        
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
    
}

