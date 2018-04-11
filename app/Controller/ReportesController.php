<?php

App::uses('AppController', 'Controller');

class ReportesController extends AppController {

	public $uses = array('Concepto', 'Pago', 'Ambiente', 'User', 'Inquilino', 'Banco', 'Cuentasegreso', 'Bancosmovimiento', 'Comprobantescuenta', 'Comprobante', 'Nomenclatura');
	public $layout = 'monster';

	public function reporte_pagos() {
		$conceptos = $this->Concepto->find('list', array('fields' => 'Concepto.nombre'));

		$conceptos['Todos'] = 'Todos';
		$this->set(compact('conceptos'));
	}

	public function ajax_reporte_pagos() {
		$this->layout = 'ajax';
		$fecha_ini = $this->request->data['Reporte']['fecha_ini'];
		$fecha_fin = $this->request->data['Reporte']['fecha_fin'];
		$tipo = $this->request->data['Reporte']['tipo'];
		$id_concepto = $this->request->data['Reporte']['concepto_id'];
		$condiciones = array();
		if (!empty($this->request->data['Reporte']['ambiente_id'])) {
			$condiciones['Pago.ambiente_id'] = $this->request->data['Reporte']['ambiente_id'];
		}
		if (!empty($this->request->data['Reporte']['propietario_id'])) {
			$condiciones['Pago.propietario_id'] = $this->request->data['Reporte']['propietario_id'];
		}
		if (!empty($this->request->data['Reporte']['inquilino_id'])) {
			if (!empty($this->request->data['Reporte']['ambiente_id'])) {
				$ambiente = $this->Inquilino->find('first', array('recursive' => -1, 'conditions' => array('Inquilino.id' => $this->request->data['Reporte']['inquilino_id'], 'Inquilino.ambiente_id' => $this->request->data['Reporte']['inquilino_id'])));
			} else {
				$ambiente = $this->Inquilino->find('first', array('recursive' => -1, 'conditions' => array('Inquilino.id' => $this->request->data['Reporte']['inquilino_id'])));
			}
			if (!empty($ambiente)) {
				$condiciones['Pago.ambiente_id'] = $ambiente['Inquilino']['ambiente_id'];
			}
		}
		if ($tipo != 'Todos') {
			$condiciones['Pago.estado'] = $tipo;
		}
		if ($id_concepto != 'Todos') {
			$condiciones['Pago.concepto_id'] = $id_concepto;
		}
		$condiciones['DATE(Pago.fecha) BETWEEN ? AND ?'] = array($fecha_ini, $fecha_fin);
		$sql1 = "SELECT nombre FROM pisos WHERE (pisos.id = Ambiente.piso_id)";
		//$sql2 = "SELECT nombre FROM users WHERE (users.id = (SELECT user_id FROM `inquilinos` WHERE (inquilinos.id = Pago.inquilino_id)))";
		$this->Pago->virtualFields = array(
			'piso' => "CONCAT(($sql1))",
			'representante' => "SELECT users.nombre FROM users WHERE users.id = Ambiente.representante_id",
			//,'inquilino' => "CONCAT(($sql2))"
		);

		$pagos = $this->Pago->find('all', array(
			'recursive' => 0,
			'conditions' => $condiciones
			, 'group' => ['Pago.ambiente_id', 'Pago.estado', 'Pago.concepto_id']
			, 'fields' => ['Pago.ambiente_id', 'Pago.estado', 'Pago.concepto_id', 'SUM(Pago.monto) as monto_total', 'Pago.representante'],
			//, 'fields' => array('Ambiente.nombre', 'Pago.piso', 'Propietario.nombre', 'Ambiente.lista_inquilinos', 'Concepto.nombre', 'Pago.monto', 'Pago.fecha','Pago.estado')
		));

		foreach ($pagos as $key => $pa) {
			$condiciones2 = $condiciones;
			$condiciones2['Pago.ambiente_id'] = $pa['Pago']['ambiente_id'];
			$condiciones2['Pago.estado'] = $pa['Pago']['estado'];
			$condiciones2['Pago.concepto_id'] = $pa['Pago']['concepto_id'];
			$pagos[$key]['Pago']['pagos'] = $this->Pago->find('all', array(
				'recursive' => 0,
				'conditions' => $condiciones2
				, 'fields' => array('Ambiente.nombre', 'Pago.piso', 'Propietario.nombre', 'Ambiente.lista_inquilinos', 'Concepto.nombre', 'Pago.monto', 'Pago.fecha', 'Pago.estado', 'Pago.representante'),
			));
		}
		/* debug($pagos);
      exit; */
		$this->set(compact('pagos'));
	}

	public function reporte_pagos_a() {
		$conceptos = $this->Concepto->find('list', array('fields' => 'Concepto.nombre'));

		$conceptos['Todos'] = 'Todos';
		$this->set(compact('conceptos'));
	}

	public function ajax_reporte_pagos_a() {
		$this->layout = 'ajax';
		$fecha_ini = $this->request->data['Reporte']['fecha_ini'];
		$fecha_fin = $this->request->data['Reporte']['fecha_fin'];
		$tipo = $this->request->data['Reporte']['tipo'];
		$id_concepto = $this->request->data['Reporte']['concepto_id'];
		$condiciones = array();
		if (!empty($this->request->data['Reporte']['ambiente_id'])) {
			$condiciones['Pago.ambiente_id'] = $this->request->data['Reporte']['ambiente_id'];
		}
		if (!empty($this->request->data['Reporte']['propietario_id'])) {
			$condiciones['Pago.propietario_id'] = $this->request->data['Reporte']['propietario_id'];
		}
		if (!empty($this->request->data['Reporte']['inquilino_id'])) {
			if (!empty($this->request->data['Reporte']['ambiente_id'])) {
				$ambiente = $this->Inquilino->find('first', array('recursive' => -1, 'conditions' => array('Inquilino.id' => $this->request->data['Reporte']['inquilino_id'], 'Inquilino.ambiente_id' => $this->request->data['Reporte']['inquilino_id'])));
			} else {
				$ambiente = $this->Inquilino->find('first', array('recursive' => -1, 'conditions' => array('Inquilino.id' => $this->request->data['Reporte']['inquilino_id'])));
			}
			if (!empty($ambiente)) {
				$condiciones['Pago.ambiente_id'] = $ambiente['Inquilino']['ambiente_id'];
			}
		}
		if ($tipo != 'Todos') {
			$condiciones['Pago.estado'] = $tipo;
		}
		if ($id_concepto != 'Todos') {
			$condiciones['Pago.concepto_id'] = $id_concepto;
		}
		$condiciones['DATE(Pago.fecha) BETWEEN ? AND ?'] = array($fecha_ini, $fecha_fin);
		$sql1 = "SELECT nombre FROM pisos WHERE (pisos.id = Ambiente.piso_id)";
		//$sql2 = "SELECT nombre FROM users WHERE (users.id = (SELECT user_id FROM `inquilinos` WHERE (inquilinos.id = Pago.inquilino_id)))";
		$this->Pago->virtualFields = array(
			'piso' => "CONCAT(($sql1))",
			'representante' => "SELECT users.nombre FROM users WHERE users.id = Ambiente.representante_id",
			//,'inquilino' => "CONCAT(($sql2))"
		);

		$pagos = $this->Pago->find('all', array(
			'recursive' => 0,
			'conditions' => $condiciones
			, 'fields' => array('Ambiente.nombre', 'Pago.piso', 'Propietario.nombre', 'Ambiente.lista_inquilinos', 'Concepto.nombre', 'SUM(Pago.monto) as monto_total', 'Ambiente.piso_id', 'Pago.estado', 'Pago.representante')
			, 'group' => array('Pago.concepto_id', 'Pago.ambiente_id', 'Pago.estado'),
		));
		//debug($pagos);exit;
		$this->set(compact('pagos'));
	}

	public function comboselect_amb1($campoform = null, $div = null) {
		$this->layout = 'ajax';
		$this->set(compact('campoform', 'div'));
	}

	public function comboselect_prop1($campoform = null, $div = null) {
		$this->layout = 'ajax';
		$this->set(compact('campoform', 'div'));
	}

	public function comboselect_inq1($campoform = null, $div = null) {
		$this->layout = 'ajax';
		$this->set(compact('campoform', 'div'));
	}

	public function comboselect_amb2($campoform = null, $div = null) {
		$this->layout = 'ajax';
		if (!empty($this->request->data['Ambiente']['nombre'])) {
			$lista = $this->Ambiente->find('all', array('recursive' => 0,
				'conditions' => array('Ambiente.nombre LIKE' => '%' . $this->request->data['Ambiente']['nombre'] . "%"),
				'limit' => 8,
				'order' => 'Ambiente.nombre ASC',
			));
		}
		$this->set(compact('lista', 'div', 'campoform'));
	}

	public function comboselect_prop2($campoform = null, $div = null) {
		$this->layout = 'ajax';
		if (!empty($this->request->data['Propietario']['nombre'])) {
			$sql1 = "SELECT nombre FROM ambientes WHERE (ambientes.user_id = User.id) LIMIT 1";
			$this->User->virtualFields = array(
				'ambiente' => "CONCAT(($sql1))",
			);

			$lista = $this->User->find('all', array('recursive' => -1,
				'conditions' => array('ISNULL(User.deleted)', 'User.nombre LIKE' => '%' . $this->request->data['Propietario']['nombre'] . "%", 'User.role' => 'Propietario'),
				'limit' => 8,
				'order' => 'User.nombre ASC',
			));
		}
		$this->set(compact('lista', 'div', 'campoform'));
	}

	public function comboselect_inq2($campoform = null, $div = null) {
		$this->layout = 'ajax';
		if (!empty($this->request->data['Inquilino']['nombre'])) {
			$lista = $this->Inquilino->find('all', array('recursive' => 0,
				'conditions' => array('User.nombre LIKE' => '%' . $this->request->data['Inquilino']['nombre'] . "%"),
				'limit' => 8,
				'order' => 'User.nombre ASC',
			));
		}
		$this->set(compact('lista', 'div', 'campoform'));
	}

	public function comboselect_amb3($campoform = null, $div = null, $id = null) {
		$this->layout = 'ajax';
		$datos = $this->Ambiente->findByid($id, null, null, -1);
		$this->set(compact('campoform', 'datos', 'div'));
	}

	public function comboselect_prop3($campoform = null, $div = null, $id = null) {
		$this->layout = 'ajax';
		$datos = $this->User->findByid($id, null, null, -1);
		$this->set(compact('campoform', 'datos', 'div'));
	}

	public function comboselect_inq3($campoform = null, $div = null, $id = null) {
		$this->layout = 'ajax';
		$datos = $this->Inquilino->findByid($id, null, null, 0);
		$this->set(compact('campoform', 'datos', 'div'));
	}

	public function reporte_pagos_totales() {
		$conceptos = $this->Concepto->find('list', array('fields' => 'Concepto.nombre'));
		$conceptos['Todos'] = 'Todos';
		$this->set(compact('conceptos'));
	}

	public function ajax_reporte_pagos_totales() {
		$this->layout = 'ajax';
		$fecha_ini = $this->request->data['Reporte']['fecha_ini'];
		$fecha_fin = $this->request->data['Reporte']['fecha_fin'];
		$tipo = $this->request->data['Reporte']['tipo'];
		$id_concepto = $this->request->data['Reporte']['concepto_id'];
		$condiciones = array();
		if ($tipo != 'Todos') {
			$condiciones['Pago.estado'] = $tipo;
		}
		if ($id_concepto != 'Todos') {
			$condiciones['Pago.concepto_id'] = $id_concepto;
		}
		$condiciones['DATE(Pago.fecha) BETWEEN ? AND ?'] = array($fecha_ini, $fecha_fin);
		$condiciones['Ambiente.edificio_id'] = $this->Session->read('Auth.User.edificio_id');
		$sql1 = "SELECT nombre FROM pisos WHERE (pisos.id = Ambiente.piso_id)";
		//$sql2 = "SELECT nombre FROM users WHERE (users.id = (SELECT user_id FROM `inquilinos` WHERE (inquilinos.id = Pago.inquilino_id)))";
		$this->Pago->virtualFields = array(
			'piso' => "CONCAT(($sql1))",
			//,'inquilino' => "CONCAT(($sql2))"
		);
		$pagos = $this->Pago->find('all', array(
			'recursive' => 0,
			'conditions' => $condiciones
			, 'fields' => array('Ambiente.nombre', 'Pago.piso', 'Propietario.nombre', 'Ambiente.lista_inquilinos', 'Concepto.nombre', 'SUM(Pago.monto) AS monto_total')
			, 'group' => array('Pago.concepto_id'),
		));
		//debug($pagos);exit;
		$this->set(compact('pagos'));
	}

	public function indexcuentasxcobrar() {
		$this->Pago->virtualFields = array(
			'gestion' => "YEAR(Pago.fecha)",
		);
		$gestiones = $this->Pago->find('list', array(
			'group' => array('gestion'),
			'fields' => array('gestion', 'gestion'),
		));
		$this->set(compact('gestiones'));
		//debug($gestiones);exit;
	}

	public function xgestionmora() {
		$fecha = $this->request->data['Reporte']['fecha'];
		$tipo = $this->request->data['Reporte']['tipo'];
		//debug($tipo);exit;
		$fecha_a = split('-', $fecha);
		$ano = $fecha_a[0];
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$ambientes = $this->Ambiente->find('all', array(
			'recursive' => 0,
			'conditions' => array('Ambiente.edificio_id' => $idEdificio),
			'fields' => array('Ambiente.nombre', 'Ambiente.id', 'User.nombre', 'Piso.nombre', 'Representante.nombre'),
		));
		//debug($ambientes);exit;
		$this->set(compact('ambientes', 'ano', 'fecha', 'tipo'));
	}

	public function get_monto_amb($idAmbiete = null, $ano = null, $fecha = null, $tipo = NULL) {
		$pago = $this->Pago->find('all', array(
			'recursive' => -1,
			'conditions' => array('Pago.ambiente_id' => $idAmbiete, 'YEAR(Pago.fecha)' => $ano, 'DATE(Pago.fecha) <=' => $fecha, 'Pago.estado' => $tipo),
			'group' => array('Pago.ambiente_id'),
			'fields' => array('SUM(Pago.monto) as total_g'),
		));
		/* debug($tipo);
      debug($ano);exit; */
		if (!empty($pago)) {
			return $pago[0][0]['total_g'];
		} else {
			return '-';
		}
	}

	public function manteoxcobrar() {
		$fecha = $this->request->data['Reporte']['fecha'];
		$tipo = $this->request->data['Reporte']['tipo'];
		$fecha_a = split('-', $fecha);
		$ano = $fecha_a[0];
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$ambientes = $this->Ambiente->find('all', array(
			'recursive' => 0,
			'conditions' => array('Ambiente.edificio_id' => $idEdificio),
			'fields' => array('Ambiente.nombre', 'Ambiente.id', 'Representante.nombre', 'Piso.nombre'),
		));
		$this->set(compact('ambientes', 'ano', 'fecha', 'tipo'));
	}

	public function manteoxcobrarges() {
		$tipo = $this->request->data['Reporte']['tipo'];
		$ano = $this->request->data['Reporte']['gestion'];
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$ambientes = $this->Ambiente->find('all', array(
			'recursive' => 0,
			'conditions' => array('Ambiente.edificio_id' => $idEdificio),
			'fields' => array('Ambiente.nombre', 'Ambiente.id', 'Representante.nombre', 'Piso.nombre'),
		));
		$this->set(compact('ambientes', 'ano', 'tipo', 'gestion'));
	}

	public function get_monto_amb_m($idAmbiete = null, $fecha = null, $ano = null, $mes = null, $tipo = null) {
		$pago = $this->Pago->find('all', array(
			'recursive' => -1,
			'conditions' => array('Pago.ambiente_id' => $idAmbiete, 'YEAR(Pago.fecha)' => $ano, 'MONTH(Pago.fecha)' => $mes, 'DATE(Pago.fecha) <=' => $fecha, 'Pago.estado' => $tipo, 'Pago.concepto_id' => 10),
			'group' => array('Pago.ambiente_id'),
			'fields' => array('SUM(Pago.monto) as total_g'),
		));
		if (!empty($pago)) {
			return $pago[0][0]['total_g'];
		} else {
			return '-';
		}
	}

	public function get_monto_amb_m_g($idAmbiete = null, $ano = null, $mes = null, $tipo = null) {
		$pago = $this->Pago->find('all', array(
			'recursive' => -1,
			'conditions' => array('Pago.ambiente_id' => $idAmbiete, 'YEAR(Pago.fecha)' => $ano, 'MONTH(Pago.fecha)' => $mes, 'Pago.estado' => $tipo, 'Pago.concepto_id' => 10),
			'group' => array('Pago.ambiente_id'),
			'fields' => array('SUM(Pago.monto) as total_g'),
		));
		if (!empty($pago)) {
			return $pago[0][0]['total_g'];
		} else {
			return '-';
		}
	}

	public function xcobrarambiente() {
		$fecha = $this->request->data['Reporte']['fecha'];
		$tipo = $this->request->data['Reporte']['tipo'];
		$fecha_a = split('-', $fecha);
		$ano = $fecha_a[0];
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$ambientes = $this->Ambiente->find('all', array(
			'recursive' => 0,
			'conditions' => array('Ambiente.edificio_id' => $idEdificio),
			'fields' => array('Ambiente.nombre', 'Ambiente.id', 'Representante.nombre', 'Piso.nombre'),
		));
		$this->set(compact('ambientes', 'ano', 'fecha', 'tipo'));
	}

	public function gen_xcobrar_amb_a($idAmbiente = null, $fecha = null, $tipo = null) {

		$anos = $this->Pago->find('all', array(
			'conditions' => array('Pago.ambiente_id' => $idAmbiente, 'DATE(Pago.fecha) <=' => $fecha, 'Pago.estado' => $tipo),
			'group' => array('YEAR(Pago.fecha)'),
			'fields' => array('YEAR(Pago.fecha) as ano'),
		));
		if (!empty($anos)) {
			return $anos;
		} else {
			return array();
		}
	}

	public function get_xcobrar_amb_s($idAmbiente = null, $fecha = null, $ano = null, $mes = null, $tipo = null) {
		$pago = $this->Pago->find('all', array(
			'recursive' => -1,
			'conditions' => array('Pago.ambiente_id' => $idAmbiente, 'YEAR(Pago.fecha)' => $ano, 'MONTH(Pago.fecha)' => $mes, 'DATE(Pago.fecha) <=' => $fecha, 'Pago.estado' => $tipo),
			'group' => array('Pago.ambiente_id'),
			'fields' => array('SUM(Pago.monto) as total_g'),
		));
		if (!empty($pago)) {
			return $pago[0][0]['total_g'];
		} else {
			return '-';
		}
	}

	public function reporte_egresos_ban() {
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$egresos = array();
		$movimientos = array();
		$cuentas = array();
		if (!empty($this->request->data)) {
			$idBanco = $this->request->data['Reporte']['banco_id'];
			$fecha_ini = $this->request->data['Reporte']['fecha_ini'];
			$fecha_fin = $this->request->data['Reporte']['fecha_fin'];

			$sql1 = "SELECT CONCAT(Cuentasegreso.fecha) AS fecha, CONCAT(Cuentasegreso.referencia) AS referencia, CONCAT(Cuentasegreso.proveedor) AS proveedor,CONCAT(Cuentasegreso.detalle) AS detalle, CONCAT(nomenclaturas.nombre) AS nomenclatura, 0 AS ingreso, CONCAT(Cuentasegreso.monto) AS egreso, 0 AS saldo, CONCAT(Cuentasegreso.modified) as fecha_or FROM cuentasegresos AS Cuentasegreso LEFT JOIN nomenclaturas ON(Cuentasegreso.nomenclatura_id = nomenclaturas.id) WHERE Cuentasegreso.banco_id = $idBanco AND Cuentasegreso.fecha >= '$fecha_ini' AND Cuentasegreso.fecha <= '$fecha_fin'";
			$sql2 = "SELECT CONCAT(bancosmovimientos.fecha) AS fecha, CONCAT('') AS referencia, CONCAT('') AS proveedor,CONCAT('INGESO A CAJA CHICA') AS detalle, CONCAT('') AS nomenclatura, CONCAT(bancosmovimientos.monto) AS ingreso, 0 AS egreso, CONCAT(bancosmovimientos.saldo) AS saldo , CONCAT(bancosmovimientos.modified) AS fecha_or FROM bancosmovimientos WHERE bancosmovimientos.hastabanco_id = $idBanco AND bancosmovimientos.fecha >= '$fecha_ini' AND bancosmovimientos.fecha <= '$fecha_fin'";
			$sql3 = "SELECT * FROM (($sql1) UNION ALL ($sql2)) datos ORDER BY fecha ASC , fecha_or ASC";
			$egresos = $this->Cuentasegreso->query($sql3);
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
		}
		$bancos = $this->Banco->find('list', array(
			'recursive' => -1,
			'conditions' => array('edificio_id' => $idEdificio, 'ISNULL(Banco.deleted)'),
			'fields' => array('id', 'nombre'),
		));
		$this->set(compact('bancos', 'egresos', 'movimientos', 'cuentas'));
	}

	public function reporte_auxiliares() {
		if (!empty($this->request->data)) {
			$fecha_ini = $this->request->data['Reporte']['fecha_ini'];
			$fecha_fin = $this->request->data['Reporte']['fecha_fin'];
			$auxiliar = $this->request->data['Reporte']['auxiliar'];

			$condiciones = array();
			$condiciones['Comprobante.fecha >='] = $fecha_ini;
			$condiciones['Comprobante.fecha <='] = $fecha_fin;
			$condiciones['Comprobante.estado LIKE'] = 'Comprobado';
			$condiciones['Comprobante.tipo LIKE'] = 'Ingreso';
			$condiciones['Comprobantescuenta.haber !='] = NULL;
			if (!empty($auxiliar)) {
				$condiciones['Comprobantescuenta.auxiliar LIKE'] = "%$auxiliar%";
			}
			if (!empty($this->request->data['Reporte']['propietario_id'])) {
				$condiciones['Ambiente.user_id'] = $this->request->data['Reporte']['propietario_id'];
				$propietario = $this->User->find('first', array(
					'recursive' => -1,
					'conditions' => array('User.id' => $this->request->data['Reporte']['propietario_id']),
					'fields' => array('User.nombre'),
				));
			}
			if (!empty($this->request->data['Reporte']['inquilino_id'])) {
				$condiciones['(SELECT inquilinos.id FROM inquilinos WHERE inquilinos.ambiente_id = Ambiente.id LIMIT 1)'] = $this->request->data['Reporte']['inquilino_id'];
				$inquilino = $this->Inquilino->find('first', array(
					'recursive' => 0,
					'consitions' => array('Inquilino.id' => $this->request->data['Reporte']['inquilino_id']),
					'fields' => array('User.nombre'),
				));
			}
			if (!empty($this->request->data['Reporte']['ambiente_id'])) {
				$condiciones['Ambiente.id'] = $this->request->data['Reporte']['ambiente_id'];
				$ambiente = $this->Ambiente->find('first', array(
					'recursive' => 0,
					'conditions' => array('Ambiente.id' => $this->request->data['Reporte']['ambiente_id']),
					'fields' => array('Ambiente.nombre', 'Piso.nombre'),
				));
			}
			$this->Comprobantescuenta->virtualFields = array(
				'propietario' => "(SELECT users.nombre FROM users WHERE users.id = Ambiente.user_id)",
				'piso' => "(SELECT pisos.nombre FROM pisos WHERE pisos.id = Ambiente.piso_id)",
			);
			$pagos = $this->Comprobantescuenta->find('all', array(
				'recursive' => 0,
				'conditions' => $condiciones,
				'fields' => array('Comprobantescuenta.*', 'SUM(Comprobantescuenta.haber) AS importe_total', 'Comprobante.fecha', 'Comprobante.numero', 'Ambiente.lista_inquilinos', 'Ambiente.nombre'),
				'group' => array('Comprobantescuenta.ambiente_id', 'Comprobantescuenta.nomenclatura_id'),
			));
			//debug($pagos);exit;
			$this->set(compact('pagos', 'propietario', 'inquilino', 'ambiente', 'fecha_ini', 'fecha_fin'));
		}
	}

	public function comprobantes_pago_meses() {
		$idEdificio = $this->Session->read('Auth.User.edificio_id');

		if (!empty($this->request->data['Reporte']['gestion'])) {
			$gestion = $this->request->data['Reporte']['gestion'];

			$condiciones = array();
			$condiciones['YEAR(Comprobante.fecha)'] = $gestion;
			$condiciones['Comprobante.estado LIKE'] = 'Comprobado';
			$condiciones['Comprobante.tipo LIKE'] = 'Ingreso';
			$condiciones['Comprobantescuenta.haber !='] = NULL;

			$this->Comprobantescuenta->virtualFields = array(
				'propietario' => "(SELECT users.nombre FROM users WHERE users.id = Ambiente.user_id)",
				'piso' => "(SELECT pisos.nombre FROM pisos WHERE pisos.id = Ambiente.piso_id)",
			);
			$pagos = $this->Comprobantescuenta->find('all', array(
				'recursive' => 0,
				'conditions' => $condiciones,
				'fields' => array('Comprobantescuenta.*', 'Comprobante.fecha', 'Comprobante.numero', 'Ambiente.lista_inquilinos', 'Ambiente.nombre'),
				'group' => array('Comprobantescuenta.ambiente_id'),
			));
		}
		$this->Comprobante->virtualFields = array(
			'gestion' => "YEAR(Comprobante.fecha)",
		);
		$gestiones = $this->Comprobante->find('list', array(
			'conditions' => array('ISNULL(Comprobante.deleted)','Comprobante.edificio_id' => $idEdificio),
			'fields' => array('Comprobante.gestion', 'Comprobante.gestion'),
			'group' => array('YEAR(Comprobante.fecha)'),
		));
		//debug($gestiones);exit;
		$this->set(compact('gestiones', 'gestion', 'pagos'));
	}

	public function get_monto_com($idAmbiente = NULL, $gestion = null, $idNomenclatura = null, $idSubconcepto = null, $mes = null) {
		$condiciones = array();
		$condiciones['Comprobantescuenta.ambiente_id'] = $idAmbiente;
		$condiciones['YEAR(Comprobante.fecha)'] = $gestion;
		if (!empty($mes)) {
			$condiciones['MONTH(Comprobante.fecha)'] = $mes;
		}
		$condiciones['Comprobantescuenta.nomenclatura_id'] = $idNomenclatura;
		$condiciones['Comprobantescuenta.subconcepto_id'] = $idSubconcepto;

		$condiciones['Comprobante.estado LIKE'] = 'Comprobado';
		$condiciones['Comprobante.tipo LIKE'] = 'Ingreso';
		$condiciones['Comprobantescuenta.haber !='] = NULL;
		$comprobante = $this->Comprobantescuenta->find('all', array(
			'recursive' => 0,
			'conditions' => $condiciones,
			'fields' => array('SUM(Comprobantescuenta.haber) as importe_total'),
			'groups' => array('Comprobantescuenta.nomenclatura_id', 'Comprobantescuenta.ambiente_id', 'Comprobantescuenta.subconcepto_id', 'YEAR(Comprobante.fecha)'),
		));
		if (!empty($comprobante[0][0]['importe_total'])) {
			return $comprobante[0][0]['importe_total'];
		} else {
			return 0.00;
		}
	}

	public function comprobantes_pago_gestiones() {

		$idEdificio = $this->Session->read('Auth.User.edificio_id');

		if (!empty($this->request->data['Reporte'])) {
			$gestion_ini = $this->request->data['Reporte']['gestion_ini'];
			$gestion_fin = $this->request->data['Reporte']['gestion_fin'];

			$condiciones = array();
			$condiciones['YEAR(Comprobante.fecha) >='] = $gestion_ini;
			$condiciones['YEAR(Comprobante.fecha) <='] = $gestion_fin;
			$condiciones['Comprobante.estado LIKE'] = 'Comprobado';
			$condiciones['Comprobante.tipo LIKE'] = 'Ingreso';
			$condiciones['Comprobantescuenta.haber !='] = NULL;

			$this->Comprobantescuenta->virtualFields = array(
				'propietario' => "(SELECT users.nombre FROM users WHERE users.id = Ambiente.user_id)",
				'piso' => "(SELECT pisos.nombre FROM pisos WHERE pisos.id = Ambiente.piso_id)",
			);
			$pagos = $this->Comprobantescuenta->find('all', array(
				'recursive' => 0,
				'conditions' => $condiciones,
				'fields' => array('Comprobantescuenta.*', 'Comprobante.fecha', 'Comprobante.numero', 'Ambiente.lista_inquilinos', 'Ambiente.nombre'),
				'group' => array('Comprobantescuenta.ambiente_id'),
			));
			//debug($pagos);exit;
		}
		$this->Comprobante->virtualFields = array(
			'gestion' => "YEAR(Comprobante.fecha)",
		);
		$gestiones = $this->Comprobante->find('list', array(
			'conditions' => array('ISNULL(Comprobante.deleted)','Comprobante.edificio_id' => $idEdificio),
			'fields' => array('Comprobante.gestion', 'Comprobante.gestion'),
			'group' => array('YEAR(Comprobante.fecha)'),
		));
		//debug($gestiones);exit;
		$this->set(compact('gestiones', 'gestion', 'pagos', 'gestion_ini', 'gestion_fin'));
	}

	public function comprobantes() {
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$this->Nomenclatura->virtualFields = array(
			'nombre_completo' => "CONCAT(Nomenclatura.codigo_completo,' - ',Nomenclatura.nombre)",
		);
		$nomenclaturas = $this->Nomenclatura->find('list', array(
			'recursive' => -1,
			'conditions' => array('ISNULL(Nomenclatura.deleted)', 'Nomenclatura.edificio_id' => $idEdificio),
			'fields' => array('Nomenclatura.id', 'Nomenclatura.nombre_completo'),
		));
		if (!empty($this->request->data)) {
			$fecha_ini = $this->request->data['Reporte']['fecha_ini'];
			$fecha_fin = $this->request->data['Reporte']['fecha_fin'];
			$tipo = $this->request->data['Reporte']['tipo'];
			$idNomenclatura = $this->request->data['Reporte']['nomenclatura_id'];

			$condiciones = array();
			$condiciones['Comprobante.fecha >='] = $fecha_ini;
			$condiciones['Comprobante.fecha <='] = $fecha_fin;
			if (!empty($tipo)) {
				$condiciones['Comprobante.tipo'] = $tipo;
			}
			if (!empty($idNomenclatura)) {
				$condiciones['Comprobantescuenta.nomenclatura_id'] = $idNomenclatura;
				$nomenclatura = $this->Nomenclatura->find('first', array(
					'recursive' => -1,
					'conditions' => array('Nomenclatura.id' => $idNomenclatura),
					'fields' => array('Nomenclatura.nombre', 'Nomenclatura.codigo_completo'),
				));
			}

			$comprobantes = $this->Comprobantescuenta->find('all', array(
				'recursive' => 0,
				'conditions' => $condiciones,
				'fields' => array('Comprobante.*', 'Comprobantescuenta.*'),
			));
		}
		//debug($nomenclaturas);exit;
		$this->set(compact('nomenclaturas', 'comprobantes', 'nomenclatura', 'fecha_ini', 'fecha_fin'));
	}

	public function get_detalles_comp($fecha_ini = null, $fecha_fin = null, $idAmbiente = null, $idNomenclatura = null) {
		$this->layout = 'ajax';
		$condiciones = array();
		$condiciones['Comprobante.fecha >='] = $fecha_ini;
		$condiciones['Comprobante.fecha <='] = $fecha_fin;
		$condiciones['Comprobantescuenta.ambiente_id'] = $idAmbiente;
		$condiciones['Comprobantescuenta.nomenclatura_id'] = $idNomenclatura;
		$condiciones['Comprobante.estado LIKE'] = 'Comprobado';
		$condiciones['Comprobante.tipo LIKE'] = 'Ingreso';
		$condiciones['Comprobantescuenta.haber !='] = NULL;

		$this->Comprobantescuenta->virtualFields = array(
			'propietario' => "(SELECT users.nombre FROM users WHERE users.id = Ambiente.user_id)",
			'piso' => "(SELECT pisos.nombre FROM pisos WHERE pisos.id = Ambiente.piso_id)",
		);
		$pagos = $this->Comprobantescuenta->find('all', array(
			'recursive' => 0,
			'conditions' => $condiciones,
			'fields' => array('Comprobantescuenta.*', 'Comprobante.fecha', 'Comprobante.numero', 'Ambiente.lista_inquilinos', 'Ambiente.nombre'),
		));
		/*debug($condiciones);
    debug($pagos);exit;*/
		$this->set(compact('pagos'));
	}

}
