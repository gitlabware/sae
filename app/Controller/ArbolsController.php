<?php

App::uses('AppController', 'Controller');

/**
 * Arbols Controller
 *
 * @property Arbol $Arbol
 * @property PaginatorComponent $Paginator
 */
class ArbolsController extends AppController {

  /**
   * Components
   *
   * @var array
   */
  public $components = array('Paginator');

  /**
   * index method
   *
   * @return void
   */
  
  public function index() {
    //$this->Arbol->recursive = 0;
    $this->set('arbols', $this->Paginator->paginate());
  }

  public function muestra() {

    $data = $this->Arbol->generateTreeList(
      null, null, null, '---'
    );
    debug($data);
    die;
  }

  /**
   * view method
   *
   * @throws NotFoundException
   * @param string $id
   * @return void
   */
  public function view($id = null) {
    if (!$this->Arbol->exists($id)) {
      throw new NotFoundException(__('Invalid arbol'));
    }
    $options = array('conditions' => array('Arbol.' . $this->Arbol->primaryKey => $id));
    $this->set('arbol', $this->Arbol->find('first', $options));
  }

  /**
   * add method
   *
   * @return void
   */
  public function add() {
    if ($this->request->is('post')) {
      $this->Arbol->create();
      if ($this->Arbol->save($this->request->data)) {
        $this->Session->setFlash(__('The arbol has been saved.'));
        return $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The arbol could not be saved. Please, try again.'));
      }
    }
  }

  /**
   * edit method
   *
   * @throws NotFoundException
   * @param string $id
   * @return void
   */
  public function edit($id = null) {
    if (!$this->Arbol->exists($id)) {
      throw new NotFoundException(__('Invalid arbol'));
    }
    if ($this->request->is(array('post', 'put'))) {
      if ($this->Arbol->save($this->request->data)) {
        $this->Session->setFlash(__('The arbol has been saved.'));
        return $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The arbol could not be saved. Please, try again.'));
      }
    } else {
      $options = array('conditions' => array('Arbol.' . $this->Arbol->primaryKey => $id));
      $this->request->data = $this->Arbol->find('first', $options);
    }
  }

  /**
   * delete method
   *
   * @throws NotFoundException
   * @param string $id
   * @return void
   */
  public function delete($id = null) {
    $this->Arbol->id = $id;
    if (!$this->Arbol->exists()) {
      throw new NotFoundException(__('Invalid arbol'));
    }
    $this->request->allowMethod('post', 'delete');
    if ($this->Arbol->delete()) {
      $this->Session->setFlash(__('The arbol has been deleted.'));
    } else {
      $this->Session->setFlash(__('The arbol could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
  }

}
