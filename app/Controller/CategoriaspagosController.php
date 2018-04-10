<?php
App::uses('AppController', 'Controller');
class CategoriaspagosController extends AppController {

    public $uses = array('Categoriaspago');
    public $layout = 'monster';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }
    public function index() {
        $idEdificio = $this->Session->read('Auth.User.edificio_id');
        $categorias = $this->Categoriaspago->find('all',array('conditions'=>array('Categoriaspago.edificio_id'=>$idEdificio,'ISNULL(Categoriaspago.deleted)')));
        $this->set(compact('categorias'));
    }
    public function categoria($idCategoria = NULL) {
        $this->layout = 'ajax';
        $this->Categoriaspago->id = $idCategoria;
        $this->request->data = $this->Categoriaspago->read();
    }
    public function guarda_categoria() {
        if (!empty($this->request->data)) {
            $this->request->data['Categoriaspago']['edificio_id'] = $this->Session->read('Auth.User.edificio_id');
            $this->Categoriaspago->create();
            $valida = $this->validar('Categoriaspago');
            if (empty($valida)) {
                if ($this->Categoriaspago->save($this->request->data['Categoriaspago'])) {
                    
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
    public function eliminar($idCategoriaspago = null) {
        $this->Categoriaspago->id=$idCategoriaspago;
        $pcategoria['deleted']=date("Y-m-d H:i:s");
        if ($this->Categoriaspago->save($pcategoria)) {
            $this->Session->setFlash('Se elimino correctamente!!!', 'msgbueno');
        } else {
            $this->Session->setFlash('No se pudo eliminar, verifique que la categoria exista!!!', 'msgerror');
        }
        $this->redirect($this->referer());
    }
    
}

