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

    public function gencategoria ($idCategoria = NULL) {
        $this->layout = 'ajax';
        $this->GenCategoriasambiente->id = $idCategoria;
        $this->request->data = $this->GenCategoriasambiente->read();
    }
    
    

}
