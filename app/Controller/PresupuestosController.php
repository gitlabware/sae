<?php

App::uses('AppController', 'Controller');

class PresupuestosController extends AppController {

  public $uses = array('Presupuesto', 'Concepto', 'Subconcepto', 'Ingreso', 'Gasto', 'Subgasto', 'Egreso', 'Nomenclatura', 'NomenclaturasAmbiente', 'Cuentasmonto', 'SubcGestione', 'Pago');
  public $layout = 'sae';
  public $components = array('RequestHandler');

  public function index() {
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $presupuestos = $this->Presupuesto->find('all', array(
      'recursive' => -1,
      'conditions' => array('edificio_id' => $idEdificio),
      'order' => array('Presupuesto.gestion DESC')
    ));
    $this->set(compact('idEdificio', 'presupuestos'));
  }

  public function gestion($idPresupuesto = NULL) {
    $this->layout = 'ajax';
    $this->Presupuesto->id = $idPresupuesto;
    $this->request->data = $this->Presupuesto->read();
  }

  public function guarda_gestion() {
    $valida = $this->validar('Presupuesto');
    if (empty($valida)) {
      $this->Presupuesto->create();
      $this->Presupuesto->save($this->request->data['Presupuesto']);
      $idPresupuesto = $this->Presupuesto->getLastInsertID();
      $this->Session->setFlash('Se regsitro correctamente', 'msgbueno');
      $this->redirect(array('action' => 'presupuesto', $idPresupuesto));
    } else {
      $this->Session->setFlash($valida, 'msgerror');
      $this->redirect(array('action' => 'index'));
    }
  }

  public function eliminar($idPresupuesto = null) {
    if ($this->Presupuesto->delete($idPresupuesto)) {
      $this->Session->setFlash('Se elimino correctamente!!!', 'msgbueno');
    } else {
      $this->Session->setFlash('No se pudo eliminar, verifique que la presupuesto exista!!!', 'msgerror');
    }
    $this->redirect($this->referer());
  }

  public function presupuesto($idPresupuesto = null) {
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $presupuesto = $this->Presupuesto->findByid($idPresupuesto);
    $subconceptos = $this->Subconcepto->find('list', array(
      'conditions' => array('Subconcepto.edificio_id' => $idEdificio),
      'fields' => array('Subconcepto.id', 'Subconcepto.nombre')
    ));
    $conceptos = $this->Concepto->find('list', array('fields' => array('id', 'nombre')));
    $tingresos = $this->Ingreso->find('all', array(
      'recursive' => 0,
      'conditions' => array('Ingreso.presupuesto_id' => $idPresupuesto),
      'group' => array('Subconcepto.tipo'),
      'fields' => array('Subconcepto.tipo', 'SUM(Ingreso.ingreso) as ingreso', 'SUM(Ingreso.pres_anterior) as pres_anterior', 'SUM(Ingreso.ejec_anterior) as ejec_anterior', 'SUM(Ingreso.presupuesto) as presupuesto')
    ));
    $tipos = $this->Subconcepto->find('list', array(
      'recursive' => -1,
      'fields' => array('tipo', 'tipo'),
      'group' => array('tipo')
    ));

    /*$pgastos = $this->Egreso->find('all', array(
      'recursive' => 0,
      'conditions' => array('Egreso.presupuesto_id' => $idPresupuesto),
      'group' => array('Egreso.gasto_id'),
      'fields' => array('Gasto.id', 'Gasto.nombre', 'SUM(Egreso.pres_anterior) as pres_anterior', 'SUM(Egreso.ejec_anterior) as ejec_anterior', 'SUM(Egreso.presupuesto) as presupuesto')
    ));*/
    $this->Nomenclatura->virtualFields = array(
      'nombre_completo' => "CONCAT(Nomenclatura.codigo_completo,' - ',Nomenclatura.nombre)"
    );
    $nomenclaturas = $this->Nomenclatura->find('list',array(
      'recursive' => -1,
      'conditions' => array('Nomenclatura.edificio_id' => $idEdificio),
      'fields' => array('id','nombre_completo')
    ));
    $gestion = $presupuesto['Presupuesto']['gestion'];
    $sql2 = "(SELECT SUM(cuentasegresos.monto) FROM cuentasegresos LEFT JOIN nomenclaturas as nomenclaturas4 ON (nomenclaturas4.id = cuentasegresos.nomenclatura_id) WHERE YEAR(cuentasegresos.fecha) = $gestion AND nomenclaturas4.nomenclatura_id = nomenclaturas.nomenclatura_id GROUP BY nomenclaturas4.nomenclatura_id)";
    $sql = "SELECT SUM(egresos.pres_anterior) as pres_anterior,SUM(egresos.ejec_anterior) as ejec_anterior,SUM(egresos.presupuesto) as presupuesto,$sql2 as ejecutado, nomenclaturas3.nombre, nomenclaturas3.codigo_completo, nomenclaturas3.id FROM egresos LEFT JOIN nomenclaturas ON (egresos.nomenclatura_id = nomenclaturas.id) LEFT JOIN nomenclaturas AS nomenclaturas2 ON (nomenclaturas.nomenclatura_id = nomenclaturas2.id) LEFT JOIN nomenclaturas AS nomenclaturas3 ON (nomenclaturas2.nomenclatura_id = nomenclaturas3.id)  WHERE egresos.presupuesto_id = $idPresupuesto GROUP BY nomenclaturas3.id";
    $egresos2 = $this->Egreso->query($sql);
    //debug($egresos2);exit;
    $this->set(compact('presupuesto', 'subconceptos', 'conceptos', 'tingresos', 'tipos', 'gtipos', 'pgastos','nomenclaturas','egresos2'));
  }
  
  public function get_tegresos($idPresupuesto = null, $id = null,$gestion = null) {
    //debug($gestion);exit;
    $sql2 = "(SELECT SUM(cuentasegresos.monto) FROM cuentasegresos LEFT JOIN nomenclaturas as nomenclaturas4 ON (nomenclaturas4.id = cuentasegresos.nomenclatura_id) WHERE YEAR(cuentasegresos.fecha) = $gestion AND nomenclaturas4.nomenclatura_id = nomenclaturas.nomenclatura_id GROUP BY nomenclaturas4.nomenclatura_id)";
    $sql = "SELECT SUM(egresos.pres_anterior) as pres_anterior,SUM(egresos.ejec_anterior) as ejec_anterior,SUM(egresos.presupuesto) as presupuesto, nomenclaturas2.nombre, nomenclaturas2.codigo_completo, nomenclaturas2.id, $sql2 as ejecutado FROM egresos LEFT JOIN nomenclaturas ON (egresos.nomenclatura_id = nomenclaturas.id) LEFT JOIN nomenclaturas AS nomenclaturas2 ON (nomenclaturas.nomenclatura_id = nomenclaturas2.id) LEFT JOIN nomenclaturas AS nomenclaturas3 ON (nomenclaturas2.nomenclatura_id = nomenclaturas3.id)  WHERE egresos.presupuesto_id = $idPresupuesto AND nomenclaturas3.id = $id GROUP BY nomenclaturas2.id";
    //debug($this->Egreso->query($sql));exit;
    return $this->Egreso->query($sql);
  }
  
  

  public function get_egresos($idPresupuesto = null, $idNomencaltura = null, $gestion  = null) {
    $sql2 = "(SELECT SUM(cuentasegresos.monto) FROM cuentasegresos WHERE YEAR(cuentasegresos.fecha) = $gestion AND cuentasegresos.nomenclatura_id = Nomenclatura.id GROUP BY cuentasegresos.nomenclatura_id)";
    $this->Egreso->virtualFields = array(
      'ejecutado_actual' => "$sql2"
    );
    $resp =  $this->Egreso->find('all', array(
        'recursive' => 0,
        'conditions' => array('Egreso.presupuesto_id' => $idPresupuesto, 'Nomenclatura.nomenclatura_id' => $idNomencaltura)
    ));
    return $resp;
    /*debug($idPresupuesto);
    debug($idNomencaltura);
    debug($resp);exit;*/
  }

  public function ingreso($idIngreso = NULL) {
    $this->layout = 'ajax';
    $this->Ingreso->id = $idIngreso;
    $this->request->data = $this->Ingreso->read();
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $subconceptos = $this->Subconcepto->find('list', array(
      'conditions' => array('Subconcepto.edificio_id' => $idEdificio),
      'fields' => array('Subconcepto.id', 'Subconcepto.nombre')
    ));
    $conceptos = $this->Concepto->find('list', array('fields' => array('id', 'nombre')));
    $tipos = $this->Subconcepto->find('list', array(
      'recursive' => -1,
      'fields' => array('tipo', 'tipo'),
      'group' => array('tipo')
    ));
    $this->set(compact('subconceptos', 'conceptos', 'tipos'));
  }

  public function egreso($idEgreso = null) {
    $this->layout = 'ajax';
    $this->Egreso->id = $idEgreso;
    $this->request->data = $this->Egreso->read();
    $idEdificio = $this->Session->read('Auth.User.edificio_id');
    $this->Nomenclatura->virtualFields = array(
      'nombre_completo' => "CONCAT(Nomenclatura.codigo_completo,' - ',Nomenclatura.nombre)"
    );
    $nomenclaturas = $this->Nomenclatura->find('list',array(
      'recursive' => -1,
      'conditions' => array('Nomenclatura.edificio_id' => $idEdificio),
      'fields' => array('id','nombre_completo')
    ));
    $this->set(compact('nomenclaturas'));
  }

  public function get_ingresos($idPresupuesto = null, $tipo = null) {
    return $this->Ingreso->find('all', array(
        'recursive' => 0,
        'conditions' => array('Ingreso.presupuesto_id' => $idPresupuesto, 'Subconcepto.tipo' => $tipo)
    ));
  }

  public function guarda_ingreso() {
    if (!empty($this->request->data['Ingreso'])) {
      $idEdificio = $this->Session->read('Auth.User.edificio_id');
      $dato = $this->request->data['Ingreso'];
      if (!empty($dato['nombre_subconcepto'])) {
        $subd['nombre'] = $dato['nombre_subconcepto'];
        $subd['concepto_id'] = $dato['concepto_id'];
        $subd['edificio_id'] = $idEdificio;
        if (!empty($dato['nombre_tipo'])) {
          $subd['tipo'] = $dato['nombre_tipo'];
        } else {
          $subd['tipo'] = $dato['tipo'];
        }
        $this->Subconcepto->create();
        $this->Subconcepto->save($subd);
        $dato['subconcepto_id'] = $this->Subconcepto->getLastInsertID();
      } else {
        $subconcepto = $this->Subconcepto->findByid($dato['subconcepto_id'], null, null, -1);
        $dato['concepto_id'] = $subconcepto['Subconcepto']['concepto_id'];
      }
      $this->request->data = $dato;
      $valida = $this->validar('Ingreso');
      if (empty($valida)) {
        $this->Ingreso->create();
        $this->Ingreso->save($dato);
        $this->Session->setFlash("Se registro correctamente el ingreso!!", 'msgbueno');
      } else {
        $this->Session->setFlash($valida, 'msgerror');
      }
      if (!empty($dato['presupuesto_id'])) {
        $this->redirect(array('action' => 'presupuesto', $dato['presupuesto_id']));
      }
    }

    $this->redirect($this->referer());
  }

  public function elimina_ingreso($idIngreso = NULL) {
    if ($this->Ingreso->delete($idIngreso)) {
      $this->Session->setFlash('Se ha eliminado correctamente el ingreso!!', 'msgbueno');
    } else {
      $this->Session->setFlash("No se pudo eliminar el ingreso intente nuevamente!!", 'msgbueno');
    }
    $this->redirect($this->referer());
  }

  public function elimina_egreso($idEgreso = NULL) {
    if ($this->Egreso->delete($idEgreso)) {
      $this->Session->setFlash('Se ha eliminado correctamente el egreso!!', 'msgbueno');
    } else {
      $this->Session->setFlash("No se pudo eliminar el egreso intente nuevamente!!", 'msgbueno');
    }
    $this->redirect($this->referer());
  }

  public function guarda_egreso() {
    if (!empty($this->request->data['Egreso'])) {
      $valida = $this->validar('Egreso');
      if (empty($valida)) {
        $this->Egreso->create();
        $this->Egreso->save($this->request->data['Egreso']);
        $this->Session->setFlash("Se registro correctamente el ingreso!!", 'msgbueno');
      } else {
        $this->Session->setFlash($valida, 'msgerror');
      }
    }
    $this->redirect($this->referer());
  }

  public function presupuesto2($idPresupuesto = null) {
    $conceptos = $this->Concepto->find('all');
    $presupuesto = $this->Presupuesto->findByid($idPresupuesto, null, null, -1);
    $this->set(compact('conceptos', 'presupuesto'));
  }

  public function get_ing_anu() {
    $this->layout = null;
    /* debug($this->request->data);
      exit; */
    $idSubconcepto = $this->request->data['Ingreso']['subconcepto_id'];
    $subconcepto = $this->Subconcepto->findByid($idSubconcepto, null, null, -1);
    if (!empty($subconcepto)) {
      $dato['estado'] = $subconcepto['Subconcepto']['gestiones_anteriores'];
    } else {
      $dato['estado'] = 0;
    }
    $dato['sub'] = $idSubconcepto;
    //debug($subconcepto);exit;
    $dato = json_encode($dato);
    $this->set('mensaje', $dato);
    $this->render('/Elements/ajaxreturn');
  }

  public function pre_ambientes($idPresupuesto = null, $idSubconcepto = null, $idSubcGes = null) {
    /* debug($idPresupuesto);
      debug($idSubconcepto);
      debug($idSubcGes);
      exit; */
    $subconcepto = $this->Subconcepto->findByid($idSubconcepto, null, null, -1);
    $presupuesto = $this->Presupuesto->findByid($idPresupuesto, null, null, -1);

    if (!empty($subconcepto)) {
      //debug("dssd");exit;
      $nomenclaturas = $this->Nomenclatura->find('all', array(
        'recursive' => -1,
        'conditions' => array('Nomenclatura.subconcepto_id' => $idSubconcepto)
      ));
      if ($subconcepto['Subconcepto']['gestiones_anteriores'] == 1) {
        $this->SubcGestione->virtualFields = array(
          'nombre' => "(IF(SubcGestione.gestion_ini = SubcGestione.gestion_fin,SubcGestione.gestion_ini,CONCAT(SubcGestione.gestion_ini,' - ',SubcGestione.gestion_fin)))"
        );
        $subcGes = $this->SubcGestione->findByid($idSubcGes, NULL, NULL, -1);

        $ingreso = $this->Ingreso->find('first', array(
          'recursive' => 0,
          'conditions' => array('Presupuesto.gestion <' => $presupuesto['Presupuesto']['gestion'], 'Ingreso.subconcepto_id' => $idSubconcepto, 'Ingreso.subge_id' => $idSubcGes),
          'order' => array('Presupuesto.gestion DESC'),
          'fields' => array('Ingreso.presupuesto', 'Ingreso.ejecutado', 'Presupuesto.gestion')
        ));
        if (!empty($ingreso)) {
          $this->request->data['Ingreso']['pres_anterior'] = $ingreso['Ingreso']['presupuesto'];
          //debug($ingreso);exit;
          if (!empty($ingreso['Ingreso']['ejecutado'])) {
            //debug($ingreso);exit;
            $this->request->data['Ingreso']['ejec_anterior'] = $ingreso['Ingreso']['ejecutado'];
          } else {
            $condiciones = array();
            $condiciones['Cuentasmonto.subconcepto_id'] = $idSubconcepto;
            $condiciones['YEAR(Cuentasmonto.created)'] = $ingreso['Presupuesto']['gestion'];

            if (!empty($subcGes['SubcGestione']['gestion_ini'])) {
              if ($subcGes['SubcGestione']['gestion_ini'] == $subcGes['SubcGestione']['gestion_fin']) {
                $condiciones['YEAR(Pago.fecha)'] = $subcGes['SubcGestione']['gestion_ini'];
              } else {
                $condiciones['YEAR(Pago.fecha) >='] = $subcGes['SubcGestione']['gestion_ini'];
                $condiciones['YEAR(Pago.fecha) <='] = $subcGes['SubcGestione']['gestion_fin'];
              }
            }

            $eje_ant = $this->Cuentasmonto->find('all', array(
              'recursive' => 0,
              'conditions' => $condiciones,
              'group' => array('Cuentasmonto.subconcepto_id'),
              'fields' => array('SUM(Cuentasmonto.monto) as monto_t')
            ));
            if (!empty($eje_ant[0][0]['monto_t'])) {
              $this->request->data['Ingreso']['ejec_anterior'] = $eje_ant[0][0]['monto_t'];
            }
          }
          if (!empty($this->request->data['Ingreso']['pres_anterior']) && !empty($this->request->data['Ingreso']['ejec_anterior'])) {
            $this->request->data['Ingreso']['porcentaje'] = round($this->request->data['Ingreso']['ejec_anterior'] / $this->request->data['Ingreso']['pres_anterior'], 2);
          }
        }
        //$this->Session->setFlash("No existe aun!!", 'msgerror');
        //$this->redirect($this->referer());
        $this->set(compact('nomenclaturas', 'subconcepto', 'presupuesto', 'subcGes', 'idSubcGes', 'idSubconcepto', 'ambientes'));
      } else {
        $ingreso = $this->Ingreso->find('first', array(
          'recursive' => 0,
          'conditions' => array('Presupuesto.gestion <' => $presupuesto['Presupuesto']['gestion'], 'Ingreso.subconcepto_id' => $idSubconcepto),
          'order' => array('Presupuesto.gestion DESC'),
          'fields' => array('Ingreso.presupuesto', 'Ingreso.ejecutado', 'Presupuesto.gestion')
        ));
        if (!empty($ingreso)) {
          $this->request->data['Ingreso']['pres_anterior'] = $ingreso['Ingreso']['presupuesto'];
          //debug($ingreso);exit;
          if (!empty($ingreso['Ingreso']['ejecutado'])) {
            $this->request->data['Ingreso']['ejec_anterior'] = $ingreso['Ingreso']['ejecutado'];
          } else {
            $eje_ant = $this->Cuentasmonto->find('all', array(
              'recursive' => 0,
              'conditions' => array('Cuentasmonto.subconcepto_id' => $idSubconcepto, 'YEAR(Cuentasmonto.created)' => $ingreso['Presupuesto']['gestion']),
              'group' => array('Cuentasmonto.subconcepto_id'),
              'fields' => array('SUM(Cuentasmonto.monto) as monto_t')
            ));
            if (!empty($eje_ant[0][0]['monto_t'])) {
              $this->request->data['Ingreso']['ejec_anterior'] = $eje_ant[0][0]['monto_t'];
            }
          }
          if (!empty($this->request->data['Ingreso']['pres_anterior']) && !empty($this->request->data['Ingreso']['ejec_anterior'])) {
            $this->request->data['Ingreso']['porcentaje'] = round($this->request->data['Ingreso']['ejec_anterior'] / $this->request->data['Ingreso']['pres_anterior'], 2);
          }
          /* $eje_ant = $this->Cuentasmonto->find('all', array(
            'recursive' => 0,
            //'conditions' => array('Cuentasmonto.subconcepto_id' => $idSubconcepto, 'YEAR(Cuentasmonto.created)' => $ingreso['Presupuesto']['gestion']),
            'group' => array('Cuentasmonto.subconcepto_id'),
            'fields' => array('SUM(Cuentasmonto.monto) as monto_t')
            ));
            if(!empty($eje_ant[0][0]['monto_t'])){
            $this->request->data['Ingreso']['ejec_anterior'] = $eje_ant[0][0]['monto_t'];
            } */
        }

        $this->set(compact('nomenclaturas', 'subconcepto', 'presupuesto'));
      }
    } else {
      $this->Session->setFlash("No existe aun!!", 'msgerror');
      $this->redirect($this->referer());
    }
  }

  public function get_amb_nom($idNomenclatura = null, $idConcepto = null) {
    //debug($idConcepto);exit;
    $this->NomenclaturasAmbiente->virtualFields = array(
      'piso' => "(SELECT pisos.nombre FROM pisos WHERE pisos.id = Ambiente.piso_id)",
      'representante' => "(SELECT users.nombre FROM users WHERE Ambiente.representante_id = users.id)"
      , 'monto' => "(SELECT ambienteconceptos.monto FROM ambienteconceptos WHERE ambienteconceptos.ambiente_id = Ambiente.id AND ambienteconceptos.concepto_id = $idConcepto LIMIT 1)"
    );
    $ambientes = $this->NomenclaturasAmbiente->find('all', array(
      'recursive' => 0,
      'conditions' => array('NomenclaturasAmbiente.nomenclatura_id' => $idNomenclatura),
      'fields' => array('Ambiente.nombre', 'NomenclaturasAmbiente.piso', 'NomenclaturasAmbiente.representante', 'NomenclaturasAmbiente.monto')
    ));
    return $ambientes;
  }

  public function get_deudas_subg($idNomenclatura = null, $idConcepto = null, $idSubcGes = null) {
    $subcGes = $this->SubcGestione->findByid($idSubcGes, null, null, -1);
    $l_ambientes = $this->NomenclaturasAmbiente->find('list', array(
      'recursive' => -1,
      'conditions' => array('nomenclatura_id' => $idNomenclatura),
      'fields' => array('id', 'ambiente_id')
    ));
    $condiciones = array();

    $condiciones['Pago.concepto_id'] = $idConcepto;
    $condiciones['Pago.ambiente_id'] = $l_ambientes;
    $condiciones['Pago.estado'] = 'Debe';
    if (!empty($subcGes)) {
      $condiciones['YEAR(Pago.fecha) >='] = $subcGes['SubcGestione']['gestion_ini'];
      $condiciones['YEAR(Pago.fecha) <='] = $subcGes['SubcGestione']['gestion_fin'];
    } else {
      $condiciones['YEAR(Pago.fecha) <'] = date('Y');
    }
    $this->Pago->virtualFields = array(
      'piso' => "(SELECT pisos.nombre FROM pisos WHERE pisos.id = Ambiente.piso_id)",
      'representante' => "(SELECT users.nombre FROM users WHERE Ambiente.representante_id = users.id)",
      'monto_total' => "SUM(Pago.monto)",
      'gestion' => "(YEAR(Pago.fecha))"
    );
    return $this->Pago->find('all', array(
        'recursive' => 0,
        'conditions' => $condiciones,
        'group' => array('Pago.ambiente_id', 'YEAR(Pago.fecha)'),
        'fields' => array('Ambiente.nombre', 'Pago.piso', 'Pago.representante', 'Pago.monto_total', 'Pago.gestion', 'Pago.ambiente_id', 'Pago.concepto_id'),
        'order' => array()
    ));
  }

  public function get_pagos_amb($idAmbiente = null, $idConcepto = null, $gestion = null) {
    $this->Pago->virtualFields = array(
      'monto_total' => "(Pago.monto)"
    );
    return $this->Pago->find('all', array(
        'recursive' => 0,
        'conditions' => array(
          'Pago.ambiente_id' => $idAmbiente,
          'Pago.concepto_id' => $idConcepto,
          'YEAR(Pago.fecha)' => $gestion,
          'Pago.estado' => 'Debe'
        ),
        'fields' => array('Pago.fecha', 'Pago.monto_total', 'Concepto.nombre', 'Pago.id')
    ));
  }

  public function get_ejecutado($gestion = null,$idConcepto = null, $idSubconcepto = null, $idSubcGes = null) {
    //debug($gestion);exit;
    //$gestion = intval($gestion);
    $subconcepto = $this->Subconcepto->findByid($idSubconcepto, null, null, -1);
    $subcGes = $this->SubcGestione->findByid($idSubcGes, NULL, NULL, -1);
    $condiciones = array();
    //$condiciones['Cuentasmonto.concepto_id'] = $idConcepto;
    $condiciones['YEAR(Cuentasmonto.created)'] = $gestion;
    if (!empty($subconcepto)) {
      //$condiciones = array();
      $condiciones['Cuentasmonto.subconcepto_id'] = $idSubconcepto;
      if ($subconcepto['Subconcepto']['gestiones_anteriores'] == 1) {
        if (!empty($subcGes)) {
          if (!empty($subcGes['SubcGestione']['gestion_ini'])) {
            if ($subcGes['SubcGestione']['gestion_ini'] == $subcGes['SubcGestione']['gestion_fin']) {
              $condiciones['YEAR(Pago.fecha)'] = $subcGes['SubcGestione']['gestion_ini'];
            } else {
              $condiciones['YEAR(Pago.fecha) >='] = $subcGes['SubcGestione']['gestion_ini'];
              $condiciones['YEAR(Pago.fecha) <='] = $subcGes['SubcGestione']['gestion_fin'];
            }
          }
        } else {
          $condiciones['YEAR(Pago.fecha) <'] = $gestion;
        }
      } else {
        
      }
    }
    //debug($condiciones);
    $ejecutado = $this->Cuentasmonto->find('all', array(
      'recursive' => 0,
      'conditions' => $condiciones,
      'group' => array('Cuentasmonto.subconcepto_id'),
      'fields' => array('SUM(Cuentasmonto.monto) as monto_t')
    ));
    if(!empty($ejecutado[0][0]['monto_t'])){
      return $ejecutado[0][0]['monto_t'];
    }else{
      return 0.00;
    }
  }

}
