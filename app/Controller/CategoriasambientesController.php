<?php
App::uses('AppController', 'Controller');
class CategoriasambientesController extends AppController {

    public $uses = array('Categoriasambiente');
    public $layout = 'sae';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }
    public function index() {
        $idEdificio = $this->Session->read('Auth.User.edificio_id');
        $categorias = $this->Categoriasambiente->findAllByedificio_id($idEdificio);
        $this->set(compact('categorias'));
    }
    public function categoria($idCategoria = NULL) {
        $this->layout = 'ajax';
        $this->Categoriasambiente->id = $idCategoria;
        $this->request->data = $this->Categoriasambiente->read();
    }
    public function guarda_categoria() {
        if (!empty($this->request->data)) {
            $this->request->data['Categoriasambiente']['edificio_id'] = $this->Session->read('Auth.User.edificio_id');
            $this->Categoriasambiente->create();
            $valida = $this->validar('Categoriasambiente');
            if (empty($valida)) {
                if ($this->Categoriasambiente->save($this->request->data['Categoriasambiente'])) {
                    
                    $this->Session->setFlash('Se registro correctamente los datos!!!', 'msgbueno');
                } else {
                    $this->Session->setFlash('NO se pudo registrar los datos de la categoria!!!', 'msgerror');
                }
            } else {
                $this->Session->setFlash($valida, 'msgerror');
            }
        } else {
            $this->Session->setFlash('NO se pudo registrar los datos de la categoria!!!', 'msgerror');
        }
        $this->redirect($this->referer());
    }
    public function eliminar($idCategoriasambiente = null) {
        if ($this->Categoriasambiente->delete($idCategoriasambiente)) {
            $this->Session->setFlash('Se elimino correctamente!!!', 'msgbueno');
        } else {
            $this->Session->setFlash('No se pudo eliminar, verifique que la categoria exista!!!', 'msgerror');
        }
        $this->redirect($this->referer());
    }
    
}

