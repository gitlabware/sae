<?php

App::uses('AppController', 'Controller');

class AmbientesController extends AppController {

    var $components = array('RequestHandler');
    public $uses = array('Edificio', 'Piso', 'Ambiente', 'Categoriasambiente', 'Categoriaspago', 'User','Inquilino');
    public $layout = 'sae';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function index() {
        $ambientes = $this->Ambiente->find('all');
        $this->set(compact('ambientes'));
    }

    public function edificio($idEdificio = NULL) {
        $edificio = $this->Edificio->findByid($idEdificio, NULL, NULL, -1);
        $pisos = $this->Piso->find('all', array('conditions' => array('Piso.edificio_id' => $idEdificio)));
        $this->set(compact('pisos', 'edificio'));
    }

    public function get_ambientes($idEdificio = NULL, $idPiso = NULL) {
        return $this->Ambiente->find('all', array(
                    'recursive' => -1, 'order' => 'Ambiente.id ASC',
                    'conditions' => array('Ambiente.edificio_id' => $idEdificio, 'Ambiente.piso_id' => $idPiso)
        ));
    }

    public function ambiente($idPiso = null, $idAmbiente = null, $idUsuario = NULL, $sw = 0) {
        $this->layout = 'ajax';
        $piso = $this->Piso->findByid($idPiso);
        if (empty($idAmbiente)) {
            if (!empty($idUsuario)) {
                if ($sw) {
                    $this->request->data = $this->Session->read('fambiente');
                    $this->Session->delete('fambiente');
                }
                $this->request->data['Ambiente']['user_id'] = $idUsuario;
            } else {
                $this->request->data['Ambiente'] = $piso['Edificio'];
                $this->request->data['Ambiente']['nombre'] = "";
                if ($sw) {
                    $this->request->data = $this->Session->read('fambiente');
                    $this->Session->delete('fambiente');
                }
            }
        } else {
            $this->Ambiente->id = $idAmbiente;
            $this->request->data = $this->Ambiente->read();
        }
        $catambientes = $this->Categoriasambiente->find('list', array('fields' => 'Categoriasambiente.nombre_completo'));
        $catpagos = $this->Categoriaspago->find('list', array('fields' => 'Categoriaspago.nombre_completo'));
        $categoria_ambientes = $this->Categoriasambiente->find('all');
        $categoria_pagos = $this->Categoriaspago->find('all');
        $usuarios = $this->User->find('list', array('fields' => 'User.nombre', 'conditions' => array('User.role' => 'Propietario')));
        $this->set(compact('catambientes', 'piso', 'catpagos', 'usuarios', 'categoria_ambientes', 'categoria_pagos', 'idAmbiente', 'idPiso', 'sw'));
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

    public function usuario($idPiso = NULL) {
        $this->layout = 'ajax';
        $this->set(compact('idPiso'));
    }

    public function rescata_datos() {
        $this->Session->write('fambiente', $this->request->data);
        debug($this->Session->read('fambiente'));
        exit;
    }

    public function guarda_propietario() {
        $this->User->create();
        $this->request->data['User']['role'] = 'Propietario';
        $this->User->save($this->request->data['User']);
        $idUsuario = $this->User->getLastInsertID();

        $array['usuario'] = $idUsuario;
        $this->respond($array, true);
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

    public function inquilinos($idAmbiente = NULL) {
        $this->layout = 'ajax';
        $sql = "SELECT * FROM "
                . "(SELECT user_id,estado FROM inquilinos WHERE (ambiente_id = $idAmbiente) ORDER BY id DESC)"
                . " AS Inquilino WHERE 1 GROUP BY user_id";
        $sql2 = "SELECT * FROM ($sql) AS Inquilino LEFT JOIN users AS User ON(Inquilino.user_id = User.id) WHERE (Inquilino.estado = 1)";
        $inquilinos = $this->Inquilino->query($sql2);
        $select_inquilinos = $this->User->find('list',array('fields' => 'User.nombre','conditions' => array('User.role' => 'Inquilino')));
        $this->set(compact('inquilinos','select_inquilinos','idAmbiente'));
    }
    public function guarda_nuevo_inquilino()
    {
        $this->User->create();
        $this->request->data['User'];
        $this->User->save($this->request->data['User']);
        $idUsuario = $this->User->getLastInsertID();
        $this->Inquilino->create();
        $this->request->data['Inquilino']['user_id'] = $idUsuario;
        $this->Inquilino->save($this->request->data['Inquilino']);
        exit;
    }
    public function guarda_inquilino()
    {
        $this->Inquilino->create();
        $this->Inquilino->save($this->request->data['Inquilino']);
        exit;
    }
    public function  quita_inquilino($idUser = NULL,$idAmbiente= NULL)
    {
        $this->Inquilino->create();
        $this->request->data['Inquilino']['user_id'] = $idUser;
        $this->request->data['Inquilino']['ambiente_id'] = $idAmbiente;
        $this->request->data['Inquilino']['estado'] = 0;
        $this->Inquilino->save($this->request->data['Inquilino']);
        $this->redirect(array('action' => 'inquilinos',$idAmbiente));
    }
}
