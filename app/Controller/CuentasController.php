<?php
App::uses('AppController', 'Controller');

class CuentasController extends AppController {

  public $layout = 'monster';
  public $uses = array('Cuenta', 'Concepto', 'Cuentasporcentaje', 'Cuentasmonto', 'Subconcepto','Banco','Bancosmovimiento','Cuentasegreso');

  public function index() {
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $cuentas = $this->Cuenta->find('all', array(
      'recursive' => 0,
      'conditions' => array('ISNULL(Cuenta.deleted)','Cuenta.edificio_id' => $idEdificio)
    ));
    $conceptos = $this->Concepto->find('all');
    $subconceptos = $this->Subconcepto->find('all', array(
      'recursive' => -1,
      'conditions' => array('Subconcepto.edificio_id' => $idEdificio)
    ));
    $bancos = $this->Banco->find('all', array(
      'conditions' => array('Banco.edificio_id' => $idEdificio,'ISNULL(Banco.deleted)')
    ));
    $this->set(compact('cuentas', 'conceptos','subconceptos','bancos'));
  }

  public function cuenta($idCuenta = null) {
    $this->layout = 'ajax';
    $this->Cuenta->id = $idCuenta;
    $this->request->data = $this->Cuenta->read();
  }

  public function guarda_cuenta() {
    $this->Cuenta->create();
    $this->Cuenta->save($this->request->data['Cuenta']);
    $this->Session->setFlash("Se registro correctamente!!", 'msgbueno');
    $this->redirect($this->referer());
  }

  public function cuentas_porcentajes($idConcepto = null) {
    $this->layout = 'ajax';
    $concepto = $this->Concepto->findByid($idConcepto, null, null, -1);
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $cuentas = $this->Cuenta->find('all', array(
      'conditions' => array('ISNULL(Cuenta.deleted)','Cuenta.edificio_id' => $idEdificio)
    ));
    $porcentajes = $this->Cuentasporcentaje->find('all', array(
      'recursive' => 0,
      'conditions' => array('Cuentasporcentaje.concepto_id' => $idConcepto),
      'fields' => array('Cuentasporcentaje.cuenta_id', 'Cuentasporcentaje.porcentaje', 'Cuentasporcentaje.id')
    ));
    /* debug($porcentajes);
      exit; */
    foreach ($cuentas as $key => $cu) {
        
        $array_colm = array_column(array_column($porcentajes, 'Cuentasporcentaje'), 'cuenta_id');
      if (!empty($array_colm)) {
        $key2 = array_search($cu['Cuenta']['id'], array_column(array_column($porcentajes, 'Cuentasporcentaje'), 'cuenta_id'));

        if (isset($key2) && $key2 !== false) {
          $this->request->data['Cuentasporcentaje'][$key]['id'] = $porcentajes[$key2]['Cuentasporcentaje']['id'];
          $this->request->data['Cuentasporcentaje'][$key]['porcentaje'] = $porcentajes[$key2]['Cuentasporcentaje']['porcentaje'];
        }
      }
    }
    $this->set(compact('cuentas', 'concepto', 'porcentajes'));
  }

  public function guarda_porcentaje() {
    /* debug($this->request->data);
      exit; */
    if (!empty($this->request->data['Cuentasporcentaje'])) {
      foreach ($this->request->data['Cuentasporcentaje'] as $cu) {
        $this->Cuentasporcentaje->create();
        $this->Cuentasporcentaje->save($cu);
      }
      $this->Session->setFlash("Se registro correctamente!!", 'msgbueno');
    }
    $this->redirect($this->referer());
  }
  public function guarda_porcentaje_s() {
    /* debug($this->request->data);
      exit; */
    if (!empty($this->request->data['Cuentasporcentaje'])) {
      foreach ($this->request->data['Cuentasporcentaje'] as $cu) {
        $this->Cuentasporcentaje->create();
        $this->Cuentasporcentaje->save($cu);
      }
      $this->Session->setFlash("Se registro correctamente!!", 'msgbueno');
    }
    $this->redirect($this->referer());
  }

  public function ingresos($idCuenta = null) {
    $sql_amb1 = '(SELECT am.nombre FROM ambientes am WHERE am.id = Pago.ambiente_id)';
    $sql_amb2 = '(SELECT am1.piso_id FROM ambientes am1 WHERE am1.id = Pago.ambiente_id)';
    $sql_concepto = '(SELECT con.nombre FROM conceptos con WHERE con.id = Pago.concepto_id)';
    $sql_piso = "SELECT pi1.nombre FROM pisos pi1 WHERE pi1.id = $sql_amb2";
    $this->Cuentasmonto->virtualFields = array(
      'ambiente' => "$sql_amb1",
      'piso' => "$sql_piso",
      'concepto' => "$sql_concepto"
    );
    $ingresos = $this->Cuentasmonto->find('all', array(
      'recursive' => 0,
      'conditions' => array('Cuentasmonto.cuenta_id' => $idCuenta, 'Pago.estado' => 'Pagado'),
      'fields' => array('Cuentasmonto.created', 'Cuentasmonto.concepto', 'Cuentasmonto.piso', 'Cuentasmonto.ambiente','Cuentasmonto.monto', 'Cuentasmonto.porcentaje', 'Pago.monto', 'Pago.fecha')
    ));
    //$movimientos = $this->Bancosmovimiento->find('all',);
    $egresos = $this->Cuentasegreso->find('all',array(
      'recursive' => 0,
      'conditions' => array('Cuentasegreso.cuenta_id' => $idCuenta),
      'fields' => array('Cuentasegreso.*','Nomenclatura.nombre','Banco.nombre','Cuenta.nombre')
    ));
    $this->set(compact('ingresos','egresos'));
  }
  
  public function cuentas_porcentajes_s($idSubconcepto = null) {
    $this->layout = 'ajax';
    $subconcepto = $this->Subconcepto->findByid($idSubconcepto, null, null, -1);
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $cuentas = $this->Cuenta->find('all', array(
      'conditions' => array('ISNULL(Cuenta.deleted)','Cuenta.edificio_id' => $idEdificio)
    ));
    $porcentajes = $this->Cuentasporcentaje->find('all', array(
      'recursive' => 0,
      'conditions' => array('Cuentasporcentaje.subconcepto_id' => $idSubconcepto),
      'fields' => array('Cuentasporcentaje.cuenta_id', 'Cuentasporcentaje.porcentaje', 'Cuentasporcentaje.id')
    ));
    /* debug($porcentajes);
      exit; */
    foreach ($cuentas as $key => $cu) {
        $array_colm = array_column(array_column($porcentajes, 'Cuentasporcentaje'), 'cuenta_id');
      if (!empty($array_colm)) {
        $key2 = array_search($cu['Cuenta']['id'], array_column(array_column($porcentajes, 'Cuentasporcentaje'), 'cuenta_id'));
        if (isset($key2) && $key2 !== false) {
          $this->request->data['Cuentasporcentaje'][$key]['id'] = $porcentajes[$key2]['Cuentasporcentaje']['id'];
          $this->request->data['Cuentasporcentaje'][$key]['porcentaje'] = $porcentajes[$key2]['Cuentasporcentaje']['porcentaje'];
        }
      }
    }
    $this->set(compact('cuentas', 'subconcepto', 'porcentajes'));
  }
  
  public function eliminar($idCuenta = null){
    $this->Cuenta->id=$idCuenta;
    $ecuenta['deleted']=date("Y-m-d H:i:s");
    if($this->Cuenta->save($ecuenta)){
      $this->Session->setFlash("Se ha eliminado correctamente la cuenta!!",'msgbueno');
    }else{
      $this->Session->setFlash("No se ha podido eliminar la cuenta. Intente nuevamente!!",'msgerror');
    }
    $this->redirect($this->referer());
  }
  

}
