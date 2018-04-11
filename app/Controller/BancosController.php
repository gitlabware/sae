<?php

App::uses('AppController', 'Controller');

class BancosController extends AppController {

	public $uses = array('Banco', 'Cuenta', 'Bancosmovimiento', 'Cuentasmonto', 'Cuentasegreso', 'Nomenclatura', 'Comprobante', 'Comprobantescuenta', 'Edificio');
	public $layout = 'monster';

	public function index() {
		$idEficio = $this->Session->read('Auth.User.edificio_id');
		$bancos = $this->Banco->find('all', array(
			'conditions' => array('Banco.edificio_id' => $idEficio, 'ISNULL(Banco.deleted)'),
		));
		$this->set(compact('bancos'));
	}

	public function banco($idBanco = null) {
		$this->layout = 'ajax';
		$this->Banco->id = $idBanco;
		$this->request->data = $this->Banco->read();
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$cuentas = $this->Cuenta->find('list', array('fields' => array('id', 'nombre'), 'conditions' => array('ISNULL(Cuenta.deleted)', 'Cuenta.edificio_id' => $idEdificio)));

		$this->Nomenclatura->virtualFields = array(
			'nombre_completo' => "CONCAT(Nomenclatura.codigo_completo,' - ',Nomenclatura.nombre)",
		);
		$nomenclaturas = $this->Nomenclatura->find('list', array(
			'recursive' => -1,
			'conditions' => array('ISNULL(Nomenclatura.deleted)', 'Nomenclatura.edificio_id' => $idEdificio),
			'fields' => array('id', 'nombre_completo'),
		));
		$this->set(compact('cuentas', 'nomenclaturas'));
	}

	public function registra() {
		if (!empty($this->request->data['Banco'])) {
			$this->request->data['Banco']['edificio_id'] = $this->Session->read('Auth.User.edificio_id');
			//debug($this->request->data);exit;
			$this->Banco->create();
			$this->Banco->save($this->request->data['Banco']);
			$this->Session->setFlash("Se registro correctamente!!", 'msgbueno');
		} else {
			$this->Session->setFlash("No se pudo registrar, intente nuevamente!!", 'msgerror');
		}
		$this->redirect($this->referer());
	}

	public function eliminar($idBanco = null) {
		$this->Banco->id = $idBanco;
		$ebanco['deleted'] = date("Y-m-d H:i:s");
		if ($this->Banco->save($ebanco)) {
			$this->Session->setFlash("Se ha eliminado correctamente!!", 'msgbueno');
		} else {
			$this->Session->setFlash("No se ha podido eliminar, intente nuevamente!!", 'msgerror');
		}
		$this->redirect($this->referer());
	}

	public function movimiento() {
		$this->layout = 'ajax';
		if (!empty($this->request->data)) {
			$iddbanco = $this->request->data['Bancosmovimiento']['desdebanco_id'];
			$idabanco = $this->request->data['Bancosmovimiento']['hastabanco_id'];
			$iddcuenta = $this->request->data['Bancosmovimiento']['desdecuenta_id'];
			$idacuenta = $this->request->data['Bancosmovimiento']['hastacuenta_id'];
			$dbanco = $this->Banco->findByid($iddbanco, null, null, -1);
			$dcuenta = $this->Cuenta->findByid($iddcuenta, null, null, -1);
			if ($dbanco['Banco']['monto'] >= $this->request->data['Bancosmovimiento']['monto'] && $dcuenta['Cuenta']['monto'] >= $this->request->data['Bancosmovimiento']['monto']) {
				$abanco = $this->Banco->findByid($idabanco, null, null, -1);
				$this->Banco->id = $dbanco['Banco']['id'];
				$d_banco['monto'] = $dbanco['Banco']['monto'] - $this->request->data['Bancosmovimiento']['monto'];
				$this->Banco->save($d_banco);
				$this->Banco->id = $abanco['Banco']['id'];
				$d_banco['monto'] = $abanco['Banco']['monto'] + $this->request->data['Bancosmovimiento']['monto'];
				$this->Banco->save($d_banco);
				$this->Bancosmovimiento->create();
				$this->request->data['Bancosmovimiento']['saldo'] = $abanco['Banco']['monto'];
				$this->Bancosmovimiento->save($this->request->data['Bancosmovimiento']);

				$this->Cuenta->id = $dcuenta['Cuenta']['id'];
				$d_cuenta['monto'] = $dcuenta['Cuenta']['monto'] - $this->request->data['Bancosmovimiento']['monto'];
				$this->Cuenta->save($d_cuenta);

				$acuenta = $this->Cuenta->findByid($idacuenta, null, null, -1);
				$this->Cuenta->id = $acuenta['Cuenta']['id'];
				$d_ceunta['monto'] = $acuenta['Cuenta']['monto'] + $this->request->data['Bancosmovimiento']['monto'];
				$this->Cuenta->save($d_ceunta);
				$this->genera_comprobante($dbanco, $abanco);

				$this->Session->setFlash("Se registro correctamente el movimiento!!", 'msgbueno');
			} else {
				$this->Session->setFlash($dbanco['Banco']['nombre'] . ' no tiene lo suficiente para el movimiento!!', 'msgerror');
			}

			$this->redirect($this->referer());
		}
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$this->Banco->virtualFields = array(
			'nombre_completo' => "CONCAT(Banco.nombre,' (Disponibilidad: ',Banco.monto,')')",
		);
		$this->Cuenta->virtualFields = array(
			'nombre_completo' => "CONCAT(Cuenta.nombre,' (Disponibilidad: ',Cuenta.monto,')')",
		);
		$cuentas = $this->Cuenta->find('list', array('fields' => array('id', 'nombre_completo'), 'conditions' => array('ISNULL(Cuenta.deleted)', 'Cuenta.edificio_id' => $idEdificio)));
		$bancos = $this->Banco->find('list', array('fields' => array('id', 'nombre_completo'), 'conditions' => array('Banco.edificio_id' => $idEdificio, 'ISNULL(Banco.deleted)')));
		$this->set(compact('bancos', 'cuentas'));
	}

	public function genera_comprobante($dbanco = null, $abanco = null) {
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$edificio = $this->Edificio->find('first', array(
			'recursive' => -1,
			'conditions' => array('id' => $idEdificio),
			'fields' => array('tc_ufv'),
		));
		$d_comprobante['tipo'] = 'Ingreso de Banco';
		$d_comprobante['estado'] = 'No Comprobado';
		$d_comprobante['fecha'] = $this->request->data['Bancosmovimiento']['fecha'];
		$d_comprobante['nombre'] = $dbanco['Banco']['nombre'];
		$d_comprobante['nota'] = $this->request->data['Bancosmovimiento']['nota'];
		$d_comprobante['concepto'] = "Movimiento de Caja/Banco";
		$d_comprobante['tc_ufv'] = $edificio['Edificio']['tc_ufv'];
		$d_comprobante['edificio_id'] = $idEdificio;
		$this->Comprobante->create();
		$this->Comprobante->save($d_comprobante);
		$idConprobante = $this->Comprobante->getLastInsertID();

		$d_com['cta_ctable'] = $abanco['Banco']['nombre'];
		$d_com['haber'] = NULL;
		$d_com['debe'] = $this->request->data['Bancosmovimiento']['monto'];
		$d_com['comprobante_id'] = $idConprobante;
		$d_com['edificio_id'] = $idEdificio;

		$this->Comprobantescuenta->create();
		$this->Comprobantescuenta->save($d_com);

		$d_com['cta_ctable'] = $dbanco['Banco']['nombre'];
		$d_com['haber'] = $this->request->data['Bancosmovimiento']['monto'];
		$d_com['debe'] = NULL;
		$d_com['comprobante_id'] = $idConprobante;
		$d_com['edificio_id'] = $idEdificio;

		$this->Comprobantescuenta->create();
		$this->Comprobantescuenta->save($d_com);

	}

	public function estado($idBanco = null) {
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		if (!empty($this->request->data)) {
			$fecha_ini = $this->request->data['Reporte']['fecha_ini'];
			$fecha_fin = $this->request->data['Reporte']['fecha_fin'];
		} else {
			$fecha_ini = $this->request->data['Reporte']['fecha_ini'] = date('Y-m-d');
			$fecha_fin = $this->request->data['Reporte']['fecha_fin'] = date('Y-m-d');
		}
		$a_sql_ingresos1 = "SELECT monto FROM bancosmovimientos WHERE ";

		$sql1 = "SELECT CONCAT(Cuentasegreso.fecha) AS fecha, CONCAT(Cuentasegreso.referencia) AS referencia, CONCAT(Cuentasegreso.proveedor) AS proveedor,CONCAT(Cuentasegreso.detalle) AS detalle, CONCAT(nomenclaturas.nombre) AS nomenclatura, 0 AS ingreso, CONCAT(Cuentasegreso.monto) AS egreso, 0 AS saldo, CONCAT(Cuentasegreso.modified) as fecha_or FROM cuentasegresos AS Cuentasegreso LEFT JOIN nomenclaturas ON(Cuentasegreso.nomenclatura_id = nomenclaturas.id) WHERE Cuentasegreso.banco_id = $idBanco AND Cuentasegreso.fecha >= '$fecha_ini' AND Cuentasegreso.fecha <= '$fecha_fin'";
		$sql2 = "SELECT CONCAT(bancosmovimientos.fecha) AS fecha, CONCAT('') AS referencia, CONCAT('') AS proveedor,CONCAT('INGESO A CAJA CHICA') AS detalle, CONCAT('') AS nomenclatura, CONCAT(bancosmovimientos.monto) AS ingreso, 0 AS egreso, CONCAT(bancosmovimientos.saldo) AS saldo , CONCAT(bancosmovimientos.modified) AS fecha_or FROM bancosmovimientos WHERE bancosmovimientos.hastabanco_id = $idBanco AND bancosmovimientos.fecha >= '$fecha_ini' AND bancosmovimientos.fecha <= '$fecha_fin'";
		$sql3 = "SELECT CONCAT(bancosmovimientos.fecha) AS fecha, CONCAT('') AS referencia, CONCAT('') AS proveedor,CONCAT('EGRESO DE CAJA CHICA') AS detalle, CONCAT('') AS nomenclatura, 0 AS ingreso, CONCAT(bancosmovimientos.monto) AS egreso, CONCAT(bancosmovimientos.saldo) AS saldo , CONCAT(bancosmovimientos.modified) AS fecha_or FROM bancosmovimientos WHERE bancosmovimientos.desdebanco_id = $idBanco AND bancosmovimientos.fecha >= '$fecha_ini' AND bancosmovimientos.fecha <= '$fecha_fin'";
		$sql4 = "SELECT * FROM (($sql1) UNION ALL ($sql2) UNION ALL ($sql3)) datos ORDER BY fecha ASC , fecha_or ASC";
		$egresos = $this->Cuentasegreso->query($sql4);

		//debug($egresos);exit;
		$cuentas = $this->Cuentasegreso->find('all', array(
			'recursive' => 0,
			'conditions' => array(
				'Cuentasegreso.banco_id' => $idBanco,
				'Cuentasegreso.fecha >=' => $fecha_ini,
				'Cuentasegreso.fecha <=' => $fecha_fin,
			),
			'group' => array('Cuentasegreso.nomenclatura_id'),
			'fields' => array('Nomenclatura.codigo_completo', 'Nomenclatura.nombre', 'SUM(Cuentasegreso.monto) AS monto'),
		));
		$banco = $this->Banco->find('first', array(
			'recursive' => -1,
			'conditions' => array('id' => $idBanco, 'ISNULL(Banco.deleted)'),
			'fields' => array('id', 'nombre', 'monto'),
		));
		$this->set(compact('banco', 'egresos', 'cuentas'));
	}

}
