<?php

App::uses('AppController', 'Controller');

class RecibosController extends AppController {
  public $layout = 'sae';
  public $uses = array(
    'Recibo'
  );
  
  public function index(){
    $recibos = $this->Recibo->find('all');
    $this->set(compact('recibos'));
  }
  
}