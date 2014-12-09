<?php
App::uses('AppController', 'Controller');
class UsersController extends AppController {

    public $uses = array('User');
    public $layout = 'sae';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }
    public function index() {
        $usuarios = $this->User->find('all');
        $this->set(compact('usuarios'));
    }

    public function usuario($idUsuario = null) {
        $this->layout = 'ajax';
        $this->User->id = $idUsuario;
        $this->request->data = $this->User->read();
    }

    public function guarda_usuario() {
        if (!empty($this->request->data)) {
            $this->User->create();
            $valida = $this->validar('User');
            if (empty($valida)) {
                if ($this->User->save($this->request->data['User'])) {
                    $this->Session->setFlash('Se registro correctamente los datos!!!', 'msgbueno');
                } else {
                    $this->Session->setFlash('NO se pudo registrar los datos del usuario!!!', 'msgerror');
                }
            } else {
                $this->Session->setFlash($valida, 'msgerror');
            }
        } else {
            $this->Session->setFlash('NO se pudo registrar los datos del usuario!!!', 'msgerror');
        }
        $this->redirect(array('action' => 'index'));
    }

    public function eliminar($idUsuario = null) {
        if ($this->User->delete($idUsuario)) {
            $this->Session->setFlash('Se elimino correctamente!!!', 'msgbueno');
        } else {
            $this->Session->setFlash('No se pudo eliminar, verifique que el usuario exista!!!', 'msgerror');
        }
        $this->redirect(array('action' => 'index'));
    }
    public function login()
    {
        $this->layout = 'login';
        if ($this->request->is('post'))
        {
            //debug($this->request->data);exit;
            if ($this->Auth->login())
            {
                $role = $this->Session->read('Auth.User.role');
                switch ($role) {
                    case 'Administrador':
                        $this->redirect(array('controller' => 'Users','action' => 'index'));
                    default:
                        break;
                }
            }
            else{
                $this->Session->setFlash('Usuario o password Incorrectos, Intente nuevamente','msgerror');
            }
        }
    }
    public function salir()
    {
        $this->redirect($this->Auth->logout());
        $this->redirect(array('action'=>'login'));
    }
    public function get_nombre($idUsuario = null)
    {
        $nombre = '';
        $usuario = $this->User->findByid($idUsuario,null,null,0);
        $nombre = $usuario['User']['nombre'];
        return $nombre;
    }
}
