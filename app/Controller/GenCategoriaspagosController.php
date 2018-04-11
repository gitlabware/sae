<?php

App::uses('AppController', 'Controller');

class GenCategoriaspagosController extends AppController {

    public $uses = 'GenCategoriaspago';
    public $layout = 'monster';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function index() {
        $gen_pago = $this->GenCategoriaspago->find('all',array('conditions'=>array('ISNULL(GenCategoriaspago.deleted)')));
        $this->set(compact('gen_pago'));
    }

    public function gencategoriapago($idCategoria = NULL) {
        $this->layout = 'ajax';
        $this->GenCategoriaspago->id = $idCategoria;
        $this->request->data = $this->GenCategoriaspago->read();
    }

    public function guarda_gencategoriapago() {
        if (!empty($this->request->data)) {
            $this->GenCategoriaspago->create();
            $genvalida = $this->validar('GenCategoriaspago');
            if (empty($genvalida)) {
                if ($this->GenCategoriaspago->save($this->request->data['GenCategoriaspago'])) {
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

    public function delete ($idGenCategoriaspago = null) {
        $this->GenCategoriaspago->id=$idGenCategoriaspago;
        $egencategoriap['deleted']=date("Y-m-d H:i:s");
        if ($this->GenCategoriaspago->save($egencategoriap)) {
            $this->Session->setFlash('Se elimino correctamente!!!', 'msgbueno');
        } else {
            $this->Session->setFlash('No se pudo eliminar, verifique que la categoria exista!!!', 'msgerror');
        }
        $this->redirect(array('action' => 'index'));
    }

}
