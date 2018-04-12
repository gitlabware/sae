<?php

App::uses('AppController', 'Controller');

class PresupuestosController extends AppController {

	public $uses = array('Presupuesto', 'Concepto', 'Subconcepto', 'Ingreso', 'Gasto', 'Subgasto', 'Egreso', 'Nomenclatura', 'NomenclaturasAmbiente', 'Cuentasmonto', 'SubcGestione', 'Pago', 'Comprobantescuenta');
	public $layout = 'monster';
	public $components = array('RequestHandler');

	public function index() {
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$presupuestos = $this->Presupuesto->find('all', array(
			'recursive' => -1,
			'conditions' => array('ISNULL(Presupuesto.deleted)', 'edificio_id' => $idEdificio),
			'order' => array('Presupuesto.gestion DESC'),
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
		$this->Presupuesto->id = $idPresupuesto;
		$d_presu['deleted'] = date("Y-m-d H:i:s");
		if ($this->Presupuesto->save($d_presu)) {
			$this->Session->setFlash('Se elimino correctamente!!!', 'msgbueno');
		} else {
			$this->Session->setFlash('No se pudo eliminar, verifique que la presupuesto exista!!!', 'msgerror');
		}
		$this->redirect($this->referer());
	}

	public function presupuesto($idPresupuesto = null) {
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$presupuesto = $this->Presupuesto->findByid($idPresupuesto);
		$this->Subconcepto->virtualFields = array(
			'nombre_completo' => "CONCAT(Subconcepto.codigo,' - ',Subconcepto.nombre)",
		);
		$subconceptos = $this->Subconcepto->find('list', array(
			'order' => array('Subconcepto.codigo ASC'),
			'conditions' => array('ISNULL(Subconcepto.deleted)', 'Subconcepto.edificio_id' => $idEdificio, 'Subconcepto.tipo' => 'Ingreso'),
			'fields' => array('Subconcepto.id', 'Subconcepto.nombre_completo'),
		));
		$subconceptos_e = $this->Subconcepto->find('list', array(
			'order' => array('Subconcepto.codigo ASC'),
			'conditions' => array('ISNULL(Subconcepto.deleted)', 'Subconcepto.edificio_id' => $idEdificio, 'Subconcepto.tipo' => 'Egreso'),
			'fields' => array('Subconcepto.id', 'Subconcepto.nombre_completo'),
		));

		$gestion = $presupuesto['Presupuesto']['gestion'];
		$sql_aux1 = "LEFT JOIN subconceptos asub1 ON asub1.id = comprobantescuentas.subconcepto_id LEFT JOIN subconceptos asub2 ON asub2.id = asub1.subconcepto_id LEFT JOIN subconceptos asub3 ON asub3.id = asub2.subconcepto_id";
		//$sql_aux2 = "(IF(ISNULL(asub3.id),(IF(ISNULL(asub2.id),asub1.id,asub2.id)),asub3.id))";
		//$sql_aux3 = "(IF(ISNULL(sub3.id),(IF(ISNULL(sub2.id),sub1.id,sub2.id)),sub3.id))";
		//$sql_7 = "(SELECT SUM(comprobantescuentas.haber) FROM comprobantescuentas $sql_aux1 LEFT JOIN comprobantes ON comprobantes.id = comprobantescuentas.comprobante_id WHERE comprobantes.estado LIKE 'Comprobado' AND  YEAR(comprobantes.fecha) = $gestion AND $sql_aux2 = $sql_aux3 GROUP BY $sql_aux2)";
		$sql_5 = "(SELECT SUM(comprobantescuentas.haber) FROM comprobantescuentas $sql_aux1 LEFT JOIN comprobantes ON comprobantes.id = comprobantescuentas.comprobante_id WHERE comprobantes.estado LIKE 'Comprobado' AND  YEAR(comprobantescuentas.fecha) = $gestion AND  YEAR(comprobantes.fecha) = $gestion AND comprobantescuentas.subconcepto_id = ingresos.subconcepto_id GROUP BY comprobantescuentas.subconcepto_id)";
		$sql_4 = "(SELECT SUM(comprobantescuentas.haber) FROM comprobantescuentas $sql_aux1 LEFT JOIN comprobantes ON comprobantes.id = comprobantescuentas.comprobante_id WHERE comprobantes.estado LIKE 'Comprobado' AND  YEAR(comprobantescuentas.fecha) >= SubcGestione.gestion_ini AND YEAR(comprobantescuentas.fecha) <= SubcGestione.gestion_fin AND YEAR(comprobantes.fecha) = $gestion AND comprobantescuentas.subconcepto_id = ingresos.subconcepto_id GROUP BY comprobantescuentas.subconcepto_id)";
		$sql_3 = "(IF(  ISNULL(SubcGestione.gestion_ini) ,  (IF(ISNULL($sql_5),0,$sql_5)) , (IF(ISNULL($sql_4),0,$sql_4))    ))";
		//$sql_3 = "(IF(ISNULL(SubcGestione.gestion_ini),$sql_5,$sql_4))";
		//$sql_3a = "(IF(  (IF(ISNULL(sub3.id),(IF(ISNULL(sub2.id),sub1.id,sub2.id)),sub3.id)) = ingresos.subconcepto_id,   $sql_3   ,  (IF(ISNULL($sql_7),0,$sql_7)) ))";
		$sql_6 = "(IF(ISNULL(SUM(ingresos.ejecutado)),$sql_3,SUM(ingresos.ejecutado)))";
		$sql_8 = "(IF(  (IF(ISNULL(sub3.id),(IF(ISNULL(sub2.id),sub1.id,sub2.id)),sub3.id)) = ingresos.subconcepto_id,$sql_6, 0  )) as ejecutado_actual";
		$sql_1 = "SELECT sub1.nombre as nombre1, sub2.nombre as nombre2, sub3.nombre as nombre3, (IF(ISNULL(sub3.nombre),(IF(ISNULL(sub2.nombre),sub1.nombre,sub2.nombre)),sub3.nombre)) as nombre, (IF(ISNULL(sub3.id),(IF(ISNULL(sub2.id),sub1.codigo,sub2.codigo)),sub3.codigo)) as codigo , (IF(ISNULL(sub3.id),(IF(ISNULL(sub2.id),sub1.id,sub2.id)),sub3.id)) as idsub,(IF((IF(ISNULL(sub3.id),(IF(ISNULL(sub2.id),sub1.id,sub2.id)),sub3.id))=ingresos.subconcepto_id,ingresos.porcentaje,'')) as porcentaje, SUM(ingresos.ingreso) as ingreso, SUM(ingresos.pres_anterior) as pres_anterior, SUM(ingresos.ejec_anterior) as ejec_anterior, SUM(ingresos.presupuesto) as presupuesto, $sql_8, ingresos.subconcepto_id, ingresos.subge_id, ingresos.id,SubcGestione.* FROM ingresos LEFT JOIN subc_gestiones as SubcGestione ON SubcGestione.id = ingresos.subge_id LEFT JOIN subconceptos sub1 ON sub1.id = ingresos.subconcepto_id LEFT JOIN subconceptos sub2 ON sub2.id = sub1.subconcepto_id LEFT JOIN subconceptos sub3 ON sub3.id = sub2.subconcepto_id WHERE sub1.id != 'null' AND ingresos.presupuesto_id = $idPresupuesto GROUP BY idsub";
		//$sql_1 = "SELECT (SELECT sub1.id as id FROM subconceptos AS sub1, subconceptos AS sub2 WHERE ) WHERE ingresos.presupuesto_id = $idPresupuesto";
		$tingresos = $this->Ingreso->query($sql_1);
		//debug($tingresos);exit;

		$this->Nomenclatura->virtualFields = array(
			'nombre_completo' => "CONCAT(Nomenclatura.codigo_completo,' - ',Nomenclatura.nombre)",
		);

		$sql5 = "(SELECT SUM(comprobantescuentas.debe) FROM comprobantescuentas $sql_aux1 LEFT JOIN comprobantes ON comprobantes.id = comprobantescuentas.comprobante_id WHERE comprobantes.estado LIKE 'Comprobado' AND YEAR(comprobantescuentas.fecha) = $gestion AND comprobantescuentas.subconcepto_id = (IF(ISNULL(sub3.id),(IF(ISNULL(sub2.id),sub1.id,sub2.id)),sub3.id)) GROUP BY comprobantescuentas.subconcepto_id)";

		$sql6 = "(IF(ISNULL(SUM(egresos.ejecutado)) AND (IF(ISNULL(sub3.id),(IF(ISNULL(sub2.id),sub1.id,sub2.id)),sub3.id)) = egresos.subconcepto_id  ,$sql5,SUM(egresos.ejecutado)))";
		$sql8 = "(IF((IF(ISNULL(sub3.id),(IF(ISNULL(sub2.id),sub1.id,sub2.id)),sub3.id)) = egresos.subconcepto_id,$sql6,0)) as ejecutado_actual";
		$sql1 = "SELECT sub1.nombre as nombre1, sub2.nombre as nombre2, sub3.nombre as nombre3, (IF(ISNULL(sub3.nombre),(IF(ISNULL(sub2.nombre),sub1.nombre,sub2.nombre)),sub3.nombre)) as nombre, (IF(ISNULL(sub3.id),(IF(ISNULL(sub2.id),sub1.id,sub2.id)),sub3.id)) as idsub, (IF(ISNULL(sub3.id),(IF(ISNULL(sub2.id),sub1.codigo,sub2.codigo)),sub3.codigo)) as codigo, SUM(egresos.pres_anterior) as pres_anterior, SUM(egresos.ejec_anterior) as ejec_anterior, SUM(egresos.presupuesto) as presupuesto, egresos.subconcepto_id, egresos.id,$sql8, sub1.id FROM egresos LEFT JOIN subconceptos sub1 ON sub1.id = egresos.subconcepto_id LEFT JOIN subconceptos sub2 ON sub2.id = sub1.subconcepto_id LEFT JOIN subconceptos sub3 ON sub3.id = sub2.subconcepto_id WHERE egresos.presupuesto_id = $idPresupuesto GROUP BY idsub";
		$tegresos = $this->Egreso->query($sql1);
		//debug($tegresos);exit;
		$this->set(compact('presupuesto', 'subconceptos', 'subconceptos_e', 'tingresos', 'pgastos', 'tegresos'));
	}

	public function get_egresos($idPresupuesto = null, $idSubconcepto = null, $sw = false) {

		$this->layout = 'ajax';
		//debug($idPresupuesto);exit;
		$presupuesto = $this->Presupuesto->findByid($idPresupuesto, null, null, -1);
		$gestion = $presupuesto['Presupuesto']['gestion'];
		//$sql_aux1 = "LEFT JOIN subconceptos asub1 ON asub1.id = comprobantescuentas.subconcepto_id LEFT JOIN subconceptos asub2 ON asub2.id = asub1.subconcepto_id";
		//$sql_aux3 = "(IF(sub1.subconcepto_id = $idSubconcepto,sub1.id,(IF(sub2.subconcepto_id = $idSubconcepto,sub2.id,sub1.id))))";
		//$sql_aux2 = "(IF(asub1.id = $sql_aux3,asub1.id,  IF(asub2.id = $sql_aux3,asub2.id,asub1.id)  ))";
		$sql_aux4 = "(IF(sub1.subconcepto_id = $idSubconcepto,sub1.id,(IF(sub2.subconcepto_id = $idSubconcepto,sub2.id,sub1.id))))";
		$sql5 = "(SELECT SUM(comprobantescuentas.debe) FROM comprobantescuentas LEFT JOIN comprobantes ON comprobantes.id = comprobantescuentas.comprobante_id WHERE comprobantes.estado LIKE 'Comprobado' AND YEAR(comprobantescuentas.fecha) = $gestion AND comprobantescuentas.subconcepto_id = $sql_aux4 GROUP BY comprobantescuentas.subconcepto_id)";
		$sql_6 = "(IF(ISNULL(egresos.ejecutado),IF(ISNULL($sql5),'0',$sql5),egresos.ejecutado))";
		$sql_8 = "(IF($sql_aux4 = egresos.subconcepto_id,$sql_6,'0')) as ejecutado_actual";
		//$sql_1 = "SELECT sub1.nombre as nombre1, sub2.nombre as nombre2, (IF(ISNULL(sub2.nombre),sub1.nombre,sub2.nombre)) as nombre, (IF(ISNULL(sub3.id),(IF(ISNULL(sub2.id),sub1.id,sub2.id)),sub3.id)) as idsub,(IF((IF(ISNULL(sub3.id),(IF(ISNULL(sub2.id),sub1.id,sub2.id)),sub3.id))=ingresos.subconcepto_id,ingresos.porcentaje,0)) as porcentaje, SUM(ingresos.ingreso) as ingreso, SUM(ingresos.pres_anterior) as pres_anterior, SUM(ingresos.ejec_anterior) as ejec_anterior,SUM(ingresos.presupuesto) as presupuesto, $sql_6, ingresos.subconcepto_id FROM ingresos LEFT JOIN subc_gestiones as SubcGestione ON SubcGestione.id = ingresos.subge_id LEFT JOIN subconceptos sub1 ON sub1.id = ingresos.subconcepto_id LEFT JOIN subconceptos sub2 ON sub2.id = sub1.subconcepto_id LEFT JOIN subconceptos sub3 ON sub3.id = sub2.subconcepto_id WHERE ingresos.presupuesto_id = $idPresupuesto AND sub1.subconcepto_id = $idSubconcepto GROUP BY idsub";
		$sql_1 = "SELECT sub1.nombre as nombre1, sub2.nombre as nombre2, (IF(sub1.subconcepto_id = $idSubconcepto,sub1.codigo,(IF(sub2.subconcepto_id = $idSubconcepto,sub2.codigo,sub1.codigo)))) as codigo, (IF(sub1.subconcepto_id = $idSubconcepto,sub1.nombre,(IF(sub2.subconcepto_id = $idSubconcepto,sub2.nombre,sub1.nombre)))) as nombre, (IF(sub1.subconcepto_id = $idSubconcepto,sub1.id,(IF(sub2.subconcepto_id = $idSubconcepto,sub2.id,sub1.id)))) as idsub, SUM(egresos.pres_anterior) as pres_anterior, SUM(egresos.ejec_anterior) as ejec_anterior,SUM(egresos.presupuesto) as presupuesto, egresos.subconcepto_id, egresos.id,$sql_8 FROM egresos LEFT JOIN subconceptos sub1 ON sub1.id = egresos.subconcepto_id LEFT JOIN subconceptos sub2 ON sub2.id = sub1.subconcepto_id WHERE egresos.presupuesto_id = $idPresupuesto AND (IF(sub1.subconcepto_id = $idSubconcepto,TRUE,(IF(sub2.subconcepto_id = $idSubconcepto,TRUE,FALSE)))) GROUP BY idsub";
		$egresos = $this->Egreso->query($sql_1);

		/* if($sw){
			          debug($egresos);exit;
		*/
		//debug($egresos);
		$subconcepto = $this->Subconcepto->find('first', array(
			'recursive' => -1,
			'conditions' => array('Subconcepto.id' => $idSubconcepto),
			'fields' => array('Subconcepto.subconcepto_id'),
		));

		$this->set(compact('egresos', 'presupuesto', 'sw', 'idSubconcepto', 'subconcepto'));
	}

	public function ingreso($idIngreso = NULL) {
		$this->layout = 'ajax';

		$this->Ingreso->id = $idIngreso;
		$this->request->data = $this->Ingreso->read();
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$this->Subconcepto->virtualFields = array(
			'nombre_completo' => "CONCAT(Subconcepto.codigo,' - ',Subconcepto.nombre)",
		);
		$subconceptos = $this->Subconcepto->find('list', array(
			'order' => array('Subconcepto.codigo ASC'),
			'conditions' => array('ISNULL(Subconcepto.deleted)', 'Subconcepto.edificio_id' => $idEdificio, 'Subconcepto.tipo' => 'Ingreso'),
			'fields' => array('Subconcepto.id', 'Subconcepto.nombre_completo'),
		));
		$tipos = $this->Subconcepto->find('list', array(
			'recursive' => -1,
			'fields' => array('tipo', 'tipo'),
			'group' => array('tipo'),
		));
		$this->set(compact('subconceptos', 'tipos'));
	}

	public function egreso($idEgreso = null) {
		$this->layout = 'ajax';
		$this->Egreso->id = $idEgreso;
		$this->request->data = $this->Egreso->read();
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$this->Subconcepto->virtualFields = array(
			'nombre_completo' => "CONCAT(Subconcepto.codigo,' - ',Subconcepto.nombre)",
		);
		$subconceptos_e = $this->Subconcepto->find('list', array(
			'order' => array('Subconcepto.codigo ASC'),
			'conditions' => array('ISNULL(Subconcepto.deleted)', 'Subconcepto.edificio_id' => $idEdificio, 'Subconcepto.tipo' => 'Egreso'),
			'fields' => array('Subconcepto.id', 'Subconcepto.nombre_completo'),
		));
		$this->set(compact('nomenclaturas', 'subconceptos_e'));
	}

	public function get_ingresos($idPresupuesto = null, $idSubconcepto = null, $sw = false) {
		$this->layout = 'ajax';
		//debug("eynar");exit;
		$presupuesto = $this->Presupuesto->findByid($idPresupuesto, null, null, -1);
		$gestion = $presupuesto['Presupuesto']['gestion'];
		$sql_aux1 = "LEFT JOIN subconceptos asub1 ON asub1.id = comprobantescuentas.subconcepto_id LEFT JOIN subconceptos asub2 ON asub2.id = asub1.subconcepto_id";
		//$sql_aux2 = "(IF(ISNULL(asub2.id),asub1.id,asub2.id))";
		//$sql_aux3 = "(IF(ISNULL(sub2.id),sub1.id,sub2.id))";
		//$sql_aux2 = "(IF(asub1.id = $sql_aux3,asub1.id,  IF(asub2.id = $sql_aux3,asub2.id,asub1.id)  ))";
		//$sql_aux4 = "(IF(sub1.subconcepto_id = $idSubconcepto,sub1.id,(IF(sub2.subconcepto_id = $idSubconcepto,sub2.id,sub1.id))))";
		//$sql_7 = "(SELECT SUM(comprobantescuentas.haber) FROM comprobantescuentas $sql_aux1 LEFT JOIN comprobantes ON comprobantes.id = comprobantescuentas.comprobante_id WHERE comprobantes.estado LIKE 'Comprobado' AND  YEAR(comprobantes.fecha) = $gestion AND $sql_aux4 GROUP BY $sql_aux2)";
		$sql_5 = "(SELECT SUM(comprobantescuentas.haber) FROM comprobantescuentas $sql_aux1 LEFT JOIN comprobantes ON comprobantes.id = comprobantescuentas.comprobante_id WHERE comprobantes.estado LIKE 'Comprobado' AND  YEAR(comprobantescuentas.fecha) = $gestion AND  YEAR(comprobantes.fecha) = $gestion AND comprobantescuentas.subconcepto_id = ingresos.subconcepto_id GROUP BY comprobantescuentas.subconcepto_id)";
		$sql_4 = "(SELECT SUM(comprobantescuentas.haber) FROM comprobantescuentas $sql_aux1 LEFT JOIN comprobantes ON comprobantes.id = comprobantescuentas.comprobante_id WHERE comprobantes.estado LIKE 'Comprobado' AND  YEAR(comprobantescuentas.fecha) >= SubcGestione.gestion_ini AND YEAR(comprobantescuentas.fecha) <= SubcGestione.gestion_fin AND YEAR(comprobantes.fecha) = $gestion AND comprobantescuentas.subconcepto_id = ingresos.subconcepto_id GROUP BY comprobantescuentas.subconcepto_id)";
		$sql_3 = "(IF(  ISNULL(SubcGestione.gestion_ini) ,  (IF(ISNULL($sql_5),0,$sql_5)) , (IF(ISNULL($sql_4),0,$sql_4))    ))";
		//$sql_3 = "(IF(ISNULL(SubcGestione.gestion_ini),$sql_5,$sql_4))";
		//$sql_3a = "(IF(  (IF(sub1.subconcepto_id = $idSubconcepto,sub1.id,(IF(sub2.subconcepto_id = $idSubconcepto,sub2.id,sub1.id)))) = ingresos.subconcepto_id,   $sql_3   ,  (IF(ISNULL($sql_7),0,$sql_7)) ))";
		$sql_6 = "(IF(ISNULL(ingresos.ejecutado),$sql_3,SUM(ingresos.ejecutado)))";
		$sql_8 = "(IF(  (IF(sub1.subconcepto_id = $idSubconcepto,sub1.id,(IF(sub2.subconcepto_id = $idSubconcepto,sub2.id,sub1.id)))) = ingresos.subconcepto_id,  $sql_6, '-')) as ejecutado_actual";
		$sql_1 = "SELECT sub1.nombre as nombre1, sub2.nombre as nombre2, (IF(sub1.subconcepto_id = $idSubconcepto,sub1.nombre,(IF(sub2.subconcepto_id = $idSubconcepto,sub2.nombre,sub1.nombre)))) as nombre, (IF(sub1.subconcepto_id = $idSubconcepto,sub1.codigo,(IF(sub2.subconcepto_id = $idSubconcepto,sub2.codigo,sub1.codigo)))) as codigo, (IF(sub1.subconcepto_id = $idSubconcepto,sub1.id,(IF(sub2.subconcepto_id = $idSubconcepto,sub2.id,sub1.id)))) as idsub, SUM(ingresos.ingreso) as ingreso, SUM(ingresos.pres_anterior) as pres_anterior, SUM(ingresos.ejec_anterior) as ejec_anterior,SUM(ingresos.presupuesto) as presupuesto, ingresos.subconcepto_id,(IF($idSubconcepto = sub1.subconcepto_id,ingresos.porcentaje,'')) as porcentaje,$sql_8,ingresos.subge_id,SubcGestione.*, ingresos.id,sub1.id FROM ingresos LEFT JOIN subconceptos sub1 ON sub1.id = ingresos.subconcepto_id LEFT JOIN subconceptos sub2 ON sub2.id = sub1.subconcepto_id LEFT JOIN subc_gestiones as SubcGestione ON SubcGestione.id = ingresos.subge_id WHERE ingresos.presupuesto_id = $idPresupuesto AND (IF(sub1.subconcepto_id = $idSubconcepto,TRUE,(IF(sub2.subconcepto_id = $idSubconcepto,TRUE,FALSE)))) GROUP BY idsub,subge_id";
		$ingresos = $this->Ingreso->query($sql_1);
		//debug($ingresos);exit;
		$subconcepto = $this->Subconcepto->find('first', array(
			'recursive' => -1,
			'conditions' => array('Subconcepto.id' => $idSubconcepto),
			'fields' => array('Subconcepto.subconcepto_id'),
		));
		$this->set(compact('ingresos', 'presupuesto', 'sw', 'subconcepto', 'idSubconcepto'));
	}

	public function guarda_ingreso() {
		if (!empty($this->request->data['Ingreso'])) {
			$idEdificio = $this->Session->read('Auth.User.edificio_id');
			$dato = $this->request->data['Ingreso'];

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
		*/
		$subconcepto = $this->Subconcepto->findByid($idSubconcepto, null, null, -1);
		$presupuesto = $this->Presupuesto->findByid($idPresupuesto, null, null, -1);

		if (!empty($subconcepto)) {
			//debug("dssd");exit;
			$nomenclaturas = $this->Nomenclatura->find('all', array(
				'recursive' => -1,
				'conditions' => array('ISNULL(Nomenclatura.deleted)', 'Nomenclatura.subconcepto_id' => $idSubconcepto),
			));
			if ($subconcepto['Subconcepto']['gestiones_anteriores'] == 1) {
				$this->SubcGestione->virtualFields = array(
					'nombre' => "(IF(SubcGestione.gestion_ini = SubcGestione.gestion_fin,SubcGestione.gestion_ini,CONCAT(SubcGestione.gestion_ini,' - ',SubcGestione.gestion_fin)))",
				);
				$subcGes = $this->SubcGestione->findByid($idSubcGes, NULL, NULL, -1);

				$ingreso = $this->Ingreso->find('first', array(
					'recursive' => 0,
					'conditions' => array('Presupuesto.gestion <' => $presupuesto['Presupuesto']['gestion'], 'Ingreso.subconcepto_id' => $idSubconcepto, 'Ingreso.subge_id' => $idSubcGes),
					'order' => array('Presupuesto.gestion DESC'),
					'fields' => array('Ingreso.presupuesto', 'Ingreso.ejecutado', 'Presupuesto.gestion'),
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
							'fields' => array('SUM(Cuentasmonto.monto) as monto_t'),
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
					'fields' => array('Ingreso.presupuesto', 'Ingreso.ejecutado', 'Presupuesto.gestion'),
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
							'fields' => array('SUM(Cuentasmonto.monto) as monto_t'),
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
					*/
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
			, 'monto' => "(SELECT ambienteconceptos.monto FROM ambienteconceptos WHERE ambienteconceptos.ambiente_id = Ambiente.id AND ambienteconceptos.concepto_id = $idConcepto LIMIT 1)",
		);
		$ambientes = $this->NomenclaturasAmbiente->find('all', array(
			'recursive' => 0,
			'conditions' => array('NomenclaturasAmbiente.nomenclatura_id' => $idNomenclatura),
			'fields' => array('Ambiente.nombre', 'NomenclaturasAmbiente.piso', 'NomenclaturasAmbiente.representante', 'NomenclaturasAmbiente.monto'),
		));
		return $ambientes;
	}

	public function get_deudas_subg($idNomenclatura = null, $idConcepto = null, $idSubcGes = null) {
		$subcGes = $this->SubcGestione->findByid($idSubcGes, null, null, -1);
		$l_ambientes = $this->NomenclaturasAmbiente->find('list', array(
			'recursive' => -1,
			'conditions' => array('nomenclatura_id' => $idNomenclatura),
			'fields' => array('id', 'ambiente_id'),
		));
		$condiciones = array();

		$condiciones['Pago.concepto_id'] = $idConcepto;
		$condiciones['Pago.ambiente_id'] = $l_ambientes;
		$condiciones['Pago.estado'] = 'Debe';
		$condiciones['ISNULL(Pago.deleted)'] = true;
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
			'gestion' => "(YEAR(Pago.fecha))",
		);
		return $this->Pago->find('all', array(
			'recursive' => 0,
			'conditions' => $condiciones,
			'group' => array('Pago.ambiente_id', 'YEAR(Pago.fecha)'),
			'fields' => array('Ambiente.nombre', 'Pago.piso', 'Pago.representante', 'Pago.monto_total', 'Pago.gestion', 'Pago.ambiente_id', 'Pago.concepto_id'),
			'order' => array(),
		));
	}

	public function get_pagos_amb($idAmbiente = null, $idConcepto = null, $gestion = null) {
		$this->Pago->virtualFields = array(
			'monto_total' => "(Pago.monto)",
		);
		return $this->Pago->find('all', array(
			'recursive' => 0,
			'conditions' => array(
				'ISNULL(Pago.deleted)',
				'Pago.ambiente_id' => $idAmbiente,
				'Pago.concepto_id' => $idConcepto,
				'YEAR(Pago.fecha)' => $gestion,
				'Pago.estado' => 'Debe',
			),
			'fields' => array('Pago.fecha', 'Pago.monto_total', 'Concepto.nombre', 'Pago.id'),
		));
	}

	public function get_ejecutado($gestion = null, $idConcepto = null, $idSubconcepto = null, $idSubcGes = null) {
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
			'fields' => array('SUM(Cuentasmonto.monto) as monto_t'),
		));
		if (!empty($ejecutado[0][0]['monto_t'])) {
			return $ejecutado[0][0]['monto_t'];
		} else {
			return 0.00;
		}
	}

	public function reporte_balance() {

		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$hijos = array();

		if (!empty($this->request->data)) {
			$nivel = $this->request->data['Dato']['nivel'];
			$fecha_inicio = $this->request->data['Dato']['fecha_ini'];
			$fecha_fin = $this->request->data['Dato']['fecha_fin'];

			$condiciones = array();

			$condiciones['Nomenclatura.edificio_id'] = $idEdificio;
			$condiciones2 = array();
			$this->Comprobantescuenta->virtualFields = array(
				'total_t' => "( SUM( IF(ISNULL(Comprobantescuenta.haber),0,Comprobantescuenta.haber) ) + SUM( IF(ISNULL(Comprobantescuenta.debe),0,Comprobantescuenta.debe) ) )",
			);
			$this->NomenclaturasAmbiente->virtualFields = array(
				'nombre_ambiente' => "CONCAT(IF(ISNULL(Representante.nombre),'',Representante.nombre),' ',Ambiente.nombre,'/',Piso.nombre)",
			);
			//$this->Nomenclatura->displayField = 'nombre';

			$hijos = $this->Nomenclatura->generateTreeList($condiciones, null, array(''), '--', null, $nivel);

			foreach ($hijos as $key => $hi) {
				$nomenclatura = $this->Nomenclatura->find('first', array(
					'recursive' => -1,
					'conditions' => array('Nomenclatura.id' => $key),
					'fields' => array('Nomenclatura.*'),
				));
				$hijos[$key] = $nomenclatura;
				$hijos[$key]['Nomenclatura']['espacios'] = $hi;
				$solo_hijos = $this->Nomenclatura->generateTreeList(array('Nomenclatura.rght <' => $nomenclatura['Nomenclatura']['rght'], 'Nomenclatura.lft >' => $nomenclatura['Nomenclatura']['lft']), null, null, '', null);
				$solo_hijos[$key] = $key;
				$condiciones2 = array();
				$condiciones2['Comprobante.estado'] = 'Comprobado';
				$condiciones2['DATE(Comprobantescuenta.created) >='] = $fecha_inicio;
				$condiciones2['DATE(Comprobantescuenta.created) <='] = $fecha_fin;
				if (count($solo_hijos) >= 2) {
					$condiciones2['Comprobantescuenta.nomenclatura_id'] = $solo_hijos;
				} elseif (count($solo_hijos) == 1) {
					$condiciones2['Comprobantescuenta.nomenclatura_id'] = current($solo_hijos);
				} else {
					$condiciones2['Comprobantescuenta.nomenclatura_id'] = NULL;
				}
				$total_com = $this->Comprobantescuenta->find('all', array(
					'recursive' => 0,
					'conditions' => $condiciones2,
					'group' => array('Comprobantescuenta.edificio_id'),
					'fields' => array('Comprobantescuenta.total_t'),
				));
				if (!empty($total_com[0]['Comprobantescuenta']['total_t'])) {
					$hijos[$key]['Nomenclatura']['total'] = $total_com[0]['Comprobantescuenta']['total_t'];
				} else {
					$hijos[$key]['Nomenclatura']['total'] = 0.00;
				}
				if ((strlen($hijos[$key]['Nomenclatura']['espacios']) / 2) < $nivel) {
					$hijos[$key]['Nomenclatura']['ambientes'] = $this->NomenclaturasAmbiente->find('all', array(
						'recursive' => 0,
						'conditions' => array('NomenclaturasAmbiente.nomenclatura_id' => $nomenclatura['Nomenclatura']['id']),
						'joins' => array(
							array(
								'table' => 'pisos',
								'alias' => 'Piso',
								'type' => 'LEFT',
								'conditions' => array(
									'Piso.id = Ambiente.piso_id',
								),
							),
							array(
								'table' => 'users',
								'alias' => 'Representante',
								'type' => 'LEFT',
								'conditions' => array(
									'Representante.id = Ambiente.representante_id',
								),
							),
						),
						'fields' => array('NomenclaturasAmbiente.nombre_ambiente', 'NomenclaturasAmbiente.ambiente_id', 'NomenclaturasAmbiente.codigo'),
					));
				} else {
					$hijos[$key]['Nomenclatura']['ambientes'] = array();
				}

				foreach ($hijos[$key]['Nomenclatura']['ambientes'] as $ikey => $am) {

					$total_com = $this->Comprobantescuenta->find('all', array(
						'recursive' => 0,
						'conditions' => array(
							'Comprobantescuenta.nomenclatura_id' => $nomenclatura['Nomenclatura']['id'],
							'Comprobantescuenta.ambiente_id' => $am['NomenclaturasAmbiente']['ambiente_id'],
							'DATE(Comprobantescuenta.created) >=' => $fecha_inicio,
							'DATE(Comprobantescuenta.created) <=' => $fecha_fin,
						),
						'group' => array('Comprobantescuenta.edificio_id'),
						'fields' => array('Comprobantescuenta.total_t'),
					));
					if (!empty($total_com[0]['Comprobantescuenta']['total_t'])) {
						$hijos[$key]['Nomenclatura']['ambientes'][$ikey]['NomenclaturasAmbiente']['total'] = $total_com[0]['Comprobantescuenta']['total_t'];
					} else {
						$hijos[$key]['Nomenclatura']['ambientes'][$ikey]['NomenclaturasAmbiente']['total'] = 0.00;
					}
				}

				//$hijos[$key]['Nomenclatura']['total'] = $t
			}
		}

		$this->set(compact('hijos'));
		/*debug($hijos);
        exit;*/
	}

	public function actualiza_nomen_tree() {
		$nomenclaturas = $this->Nomenclatura->find('all', array(
			'recursive' => -1,
			'fields' => array('Nomenclatura.*'),
			'order' => array('Nomenclatura.id ASC'),
		));
		$this->Nomenclatura->deleteAll(array('1' => '1'), false);
		foreach ($nomenclaturas as $nom) {

			if (empty($nom['Nomenclatura']['nomenclatura_id'])) {
				$nom['Nomenclatura']['parent_id'] = NULL;
			} else {
				$nom['Nomenclatura']['parent_id'] = $nom['Nomenclatura']['nomenclatura_id'];
			}
			$this->Nomenclatura->create();
			$this->Nomenclatura->save($nom['Nomenclatura']);
		}
		debug('Se realizo la tarea!!');
		exit;
	}

}
