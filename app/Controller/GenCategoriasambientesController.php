<?php

App::uses('AppController', 'Controller');

class GenCategoriasambientesController extends AppController {

    public $uses = 'GenCategoriasambiente';
    public $layout = 'sae';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function index() {
        $gen_ambientes = $this->GenCategoriasambiente->find('all');
        $this->set(compact('gen_ambientes'));
    }

    public function gencategoria($idCategoria = NULL) {
        $this->layout = 'ajax';
        $this->GenCategoriasambiente->id = $idCategoria;
        $this->request->data = $this->GenCategoriasambiente->read();
    }

    public function guarda_gencategoria() {
        if (!empty($this->request->data)) {
            $this->GenCategoriasambiente->create();
            $genvalida = $this->validar('GenCategoriasambiente');
            if (empty($genvalida)) {
                if ($this->GenCategoriasambiente->save($this->request->data['GenCategoriasambiente'])) {
                    $this->Session->setFlash('Se registro correctamente los datos!!!', 'msgbueno');
                } else {
                    $this->Session->setFlash('NO se pudo registrar los datos del usuario!!!', 'msgerror');
                }
            } else {
                $this->Session->setFlash($genvalida, 'msgerror');
            }
        } else {
            $this->Session->setFlash('NO se pudo registrar los datos del usuario!!!', 'msgerror');
        }
        $this->redirect(array('action' => 'index'));
    }

    public function delete ($idGenCategoriasambiente = null) {
        if ($this->GenCategoriasambiente->delete($idGenCategoriasambiente)) {
            $this->Session->setFlash('Se elimino correctamente!!!', 'msgbueno');
        } else {
            $this->Session->setFlash('No se pudo eliminar, verifique que la categoria exista!!!', 'msgerror');
        }
        $this->redirect(array('action' => 'index'));
    }

}
