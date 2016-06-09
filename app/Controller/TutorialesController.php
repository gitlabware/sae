<?php

class TutorialesController extends AppController {

  public $layout = 'sae';
  public function index(){
    
  }
  
  public function ver($idvideo = null){
    $this->layout = 'ajax';
    $this->set(compact('idvideo'));
  }

}
