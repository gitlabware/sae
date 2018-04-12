<?php

App::uses('AppController', 'Controller');
App::import('Vendor', 'PHPExcel', array('file' => 'PHPExcel.php'));
App::import('Vendor', 'PHPExcel_Reader_Excel2007', array('file' => 'PHPExcel/Excel2007.php'));
App::import('Vendor', 'PHPExcel_IOFactory', array('file' => 'PHPExcel/PHPExcel/IOFactory.php'));

App::import('Vendor', 'tcpdf/tcpdf');

class PagosController extends AppController {

	var $components = array('RequestHandler', 'DataTable');
	public $layout = 'monster';
	public $uses = array(
		'Pago', 'Excel', 'Ambiente', 'Concepto', 'Ambienteconcepto',
	);

	public function index() {

	}

	public function excels() {
		$excels = $this->Excel->find('all', array('order' => 'id DESC', 'conditions', 'conditions' => array('Excel.edificio_id' => $this->Session->read('Auth.User.edificio_id'))));
		$this->set(compact('excels'));
	}

	public function registra_excel() {
		/* debug($this->request->data);
          exit; */
		$archivoExcel = $this->request->data['Excel']['excel'];
		$nombreOriginal = $this->request->data['Excel']['excel']['name'];
		App::uses('String', 'Utility');
		if ($archivoExcel['error'] === UPLOAD_ERR_OK) {
			$nombre = string::uuid();
			if (move_uploaded_file($archivoExcel['tmp_name'], WWW_ROOT . 'files' . DS . $nombre . '.xlsx')) {
				$nombreExcel = $nombre . '.xlsx';
				$this->request->data['Excelg']['url'] = $nombreExcel;
				$this->request->data['Excelg']['nombre'] = $nombreOriginal;
				$this->request->data['Excelg']['edificio_id'] = $this->Session->read('Auth.User.edificio_id');
			}
		}
		if ($this->Excel->save($this->data['Excelg'])) {
			$idExcel = $this->Excel->getLastInsertID();
			$excelSubido = $nombreExcel;
			$objLector = new PHPExcel_Reader_Excel2007();
			//debug($objLector);die;
			$objPHPExcel = $objLector->load("../webroot/files/$excelSubido");
			//debug($objPHPExcel);die;
			$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
			$array_data = array();
			foreach ($rowIterator as $row) {
				$cellIterator = $row->getCellIterator();

				$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set

				if (0 == $row->getRowIndex()) //a partir de la 1
				{
					continue;
				}
				//skip first row

				$rowIndex = $row->getRowIndex();
				$array_data[$rowIndex] = array(
					'A' => '',
					'B' => '',
					'C' => '',
					'D' => '',
					'E' => '',
					'F' => '',
					'G' => '',
					'H' => '',
					'I' => '',
					'J' => '',
					'K' => '',
					'L' => '',
					'M' => '',
					'N' => '');
				foreach ($cellIterator as $cell) {
					if ('A' == $cell->getColumn()) {
						$array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
					} elseif ('B' == $cell->getColumn()) {
						$array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
					} elseif ('C' == $cell->getColumn()) {
						$array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
					} elseif ('D' == $cell->getColumn()) {
						$array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
					} elseif ('E' == $cell->getColumn()) {
						$array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
					} elseif ('F' == $cell->getColumn()) {
						$array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
					} elseif ('G' == $cell->getColumn()) {
						$array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
					} elseif ('H' == $cell->getColumn()) {
						$array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
					} elseif ('I' == $cell->getColumn()) {
						$array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
					} elseif ('J' == $cell->getColumn()) {
						$array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
					} elseif ('K' == $cell->getColumn()) {
						$array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
					} elseif ('L' == $cell->getColumn()) {
						$array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
					} elseif ('M' == $cell->getColumn()) {
						$array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
					} elseif ('N' == $cell->getColumn()) {
						$array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
					}
				}
			}

			$datos = array();
			$this->request->data = "";
			$i = 0;

			$primero = $array_data[3];
			unset($array_data[1]);
			unset($array_data[2]);
			unset($array_data[3]);
			unset($array_data[4]);
			unset($array_data[5]);
			/* debug($primero);
				              debug(substr($primero['A'], 8));
				              debug($array_data);
			*/

			foreach ($array_data as $d) {

				$ambiente_a = $this->Ambiente->find('first', array(
					'recursive' => 0,
					'conditions' => array(
						'Ambiente.edificio_id' => $this->Session->read('Auth.User.edificio_id'),
						'Piso.nombre' => $d['A'],
						'Ambiente.nombre' => $d['B'],
					),
					'fields' => array('Ambiente.id', 'Ambiente.user_id'),
				));

				if (empty($ambiente_a)) {
					//debug($d['A']);exit;
					$this->Session->setFlash("No se pudo registrar, el registro " . $d['A'] . "-" . $d['B'] . " no se encontro!!", 'msgerror');
					//$this->Pago->deleteAll(array('Pago.excel_id' => $idExcel));
					$this->redirect(array('action' => 'excels'));
				}

				$dpago['estado'] = 'Debe';
				$dpago['ambiente_id'] = $ambiente_a['Ambiente']['id'];
				$dpago['user_id'] = $this->Session->read('Auth.User.id');
				$dpago['propietario_id'] = $ambiente_a['Ambiente']['user_id'];
				$dpago['concepto_id'] = 10;
				$dpago['excel_id'] = $idExcel;

				if ($d['C'] != '') {
					$dpago['monto'] = $d['C'];
					$dpago['fecha'] = substr($primero['A'], 8) . '-01-01';

					$existe = $this->Pago->find('first', array(
						'recursive' => -1,
						'conditions' => array('ISNULL(Pago.deleted)', 'ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
						'fields' => array('id'),
					));
					if (!empty($existe)) {
						$dpago['id'] = $existe['Pago']['id'];
					} else {
						$dpago['id'] = NULL;
					}
					$this->Pago->create();
					$this->Pago->save($dpago);
				}
				if ($d['D'] != '') {
					$dpago['monto'] = $d['D'];
					$dpago['fecha'] = substr($primero['A'], 8) . '-02-01';

					$existe = $this->Pago->find('first', array(
						'recursive' => -1,
						'conditions' => array('ISNULL(Pago.deleted)', 'ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
						'fields' => array('id'),
					));
					if (!empty($existe)) {
						$dpago['id'] = $existe['Pago']['id'];
					} else {
						$dpago['id'] = NULL;
					}
					$this->Pago->create();
					$this->Pago->save($dpago);
				}
				if ($d['E'] != '') {
					$dpago['monto'] = $d['E'];
					$dpago['fecha'] = substr($primero['A'], 8) . '-03-01';

					$existe = $this->Pago->find('first', array(
						'recursive' => -1,
						'conditions' => array('ISNULL(Pago.deleted)', 'ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
						'fields' => array('id'),
					));
					if (!empty($existe)) {
						$dpago['id'] = $existe['Pago']['id'];
					} else {
						$dpago['id'] = NULL;
					}
					$this->Pago->create();
					$this->Pago->save($dpago);
				}
				if ($d['F'] != '') {
					$dpago['monto'] = $d['F'];
					$dpago['fecha'] = substr($primero['A'], 8) . '-04-01';

					$existe = $this->Pago->find('first', array(
						'recursive' => -1,
						'conditions' => array('ISNULL(Pago.deleted)', 'ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
						'fields' => array('id'),
					));
					if (!empty($existe)) {
						$dpago['id'] = $existe['Pago']['id'];
					} else {
						$dpago['id'] = NULL;
					}
					$this->Pago->create();
					$this->Pago->save($dpago);
				}
				if ($d['G'] != '') {
					$dpago['monto'] = $d['G'];
					$dpago['fecha'] = substr($primero['A'], 8) . '-05-01';

					$existe = $this->Pago->find('first', array(
						'recursive' => -1,
						'conditions' => array('ISNULL(Pago.deleted)', 'ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
						'fields' => array('id'),
					));
					if (!empty($existe)) {
						$dpago['id'] = $existe['Pago']['id'];
					} else {
						$dpago['id'] = NULL;
					}
					$this->Pago->create();
					$this->Pago->save($dpago);
				}
				if ($d['H'] != '') {
					$dpago['monto'] = $d['H'];
					$dpago['fecha'] = substr($primero['A'], 8) . '-06-01';

					$existe = $this->Pago->find('first', array(
						'recursive' => -1,
						'conditions' => array('ISNULL(Pago.deleted)', 'ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
						'fields' => array('id'),
					));
					if (!empty($existe)) {
						$dpago['id'] = $existe['Pago']['id'];
					} else {
						$dpago['id'] = NULL;
					}
					$this->Pago->create();
					$this->Pago->save($dpago);
				}
				if ($d['I'] != '') {
					$dpago['monto'] = $d['I'];
					$dpago['fecha'] = substr($primero['A'], 8) . '-07-01';

					$existe = $this->Pago->find('first', array(
						'recursive' => -1,
						'conditions' => array('ISNULL(Pago.deleted)', 'ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
						'fields' => array('id'),
					));
					if (!empty($existe)) {
						$dpago['id'] = $existe['Pago']['id'];
					} else {
						$dpago['id'] = NULL;
					}
					$this->Pago->create();
					$this->Pago->save($dpago);
				}
				if ($d['J'] != '') {
					$dpago['monto'] = $d['J'];
					$dpago['fecha'] = substr($primero['A'], 8) . '-08-01';

					$existe = $this->Pago->find('first', array(
						'recursive' => -1,
						'conditions' => array('ISNULL(Pago.deleted)', 'ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
						'fields' => array('id'),
					));
					if (!empty($existe)) {
						$dpago['id'] = $existe['Pago']['id'];
					} else {
						$dpago['id'] = NULL;
					}
					$this->Pago->create();
					$this->Pago->save($dpago);
				}
				if ($d['K'] != '') {
					$dpago['monto'] = $d['K'];
					$dpago['fecha'] = substr($primero['A'], 8) . '-09-01';

					$existe = $this->Pago->find('first', array(
						'recursive' => -1,
						'conditions' => array('ISNULL(Pago.deleted)', 'ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
						'fields' => array('id'),
					));
					if (!empty($existe)) {
						$dpago['id'] = $existe['Pago']['id'];
					} else {
						$dpago['id'] = NULL;
					}
					$this->Pago->create();
					$this->Pago->save($dpago);
				}
				if ($d['L'] != '') {
					$dpago['monto'] = $d['L'];
					$dpago['fecha'] = substr($primero['A'], 8) . '-10-01';

					$existe = $this->Pago->find('first', array(
						'recursive' => -1,
						'conditions' => array('ISNULL(Pago.deleted)', 'ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
						'fields' => array('id'),
					));
					if (!empty($existe)) {
						$dpago['id'] = $existe['Pago']['id'];
					} else {
						$dpago['id'] = NULL;
					}
					$this->Pago->create();
					$this->Pago->save($dpago);
				}
				if ($d['M'] != '') {
					$dpago['monto'] = $d['M'];
					$dpago['fecha'] = substr($primero['A'], 8) . '-11-01';

					$existe = $this->Pago->find('first', array(
						'recursive' => -1,
						'conditions' => array('ISNULL(Pago.deleted)', 'ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
						'fields' => array('id'),
					));
					if (!empty($existe)) {
						$dpago['id'] = $existe['Pago']['id'];
					} else {
						$dpago['id'] = NULL;
					}
					$this->Pago->create();
					$this->Pago->save($dpago);
				}
				if ($d['N'] != '') {
					$dpago['monto'] = $d['N'];
					$dpago['fecha'] = substr($primero['A'], 8) . '-12-01';

					$existe = $this->Pago->find('first', array(
						'recursive' => -1,
						'conditions' => array('ISNULL(Pago.deleted)', 'ambiente_id' => $dpago['ambiente_id'], 'fecha' => $dpago['fecha'], 'concepto_id' => 10),
						'fields' => array('id'),
					));
					if (!empty($existe)) {
						$dpago['id'] = $existe['Pago']['id'];
					} else {
						$dpago['id'] = NULL;
					}
					$this->Pago->create();
					$this->Pago->save($dpago);
				}

				$i++;
			}
			$this->Excel->id = $idExcel;
			$dexcel['gestion'] = $primero['H'];
			$this->Excel->save($dexcel);
			$this->Session->setFlash("Se registro correctamente!!", 'msgbueno');
			$this->redirect(array('action' => 'excels'));
		}
	}

	public function det_pagos($idExcel = null) {
		$excel = $this->Excel->findByid($idExcel, null, null, -1);
		$sql = "SELECT pi.nombre FROM pisos pi WHERE pi.id = Ambiente.piso_id";
		$this->Pago->virtualFields = array(
			'piso' => "($sql)",
		);
		$pagos = $this->Pago->find('all', array(
			'recursive' => 0,
			'conditions' => array('ISNULL(Pago.deleted)', 'Pago.excel_id' => $idExcel),
			'fields' => array('Pago.*', 'Ambiente.nombre', 'Pago.piso'),
		));
		$this->set(compact('pagos', 'excel'));
	}

	public function elimina_excel($idExcel = null) {

		$pagos = $this->Pago->find('all', array(
			'recursive' => -1,
			'conditions' => array('ISNULL(Pago.deleted)', 'Pago.excel_id' => $idExcel, 'ISNULL(Pago.deleted)'),
		));
		foreach ($pagos as $mpago) {
			$this->Pago->id = $mpago['Pago']['id'];
			$ddpago['deleted'] = date("Y-m-d H:i:s");
			$this->Pago->save($ddpago);
		}

		$this->Excel->delete($idExcel);
		$this->Session->setFlash("Se elimino correctamente el excel y sus pagos!!!", 'msgbueno');
		$this->redirect(array('action' => 'excels'));
	}

	public function pre_aviso($idAmbiente = null, $idConcepto = null) {
		$this->layout = 'ajax';
		$ambiente = $this->Ambiente->find('first', array(
			'recursive' => 0,
			'conditions' => array('Ambiente.id' => $idAmbiente),
			'fields' => array('Ambiente.nombre', 'Piso.nombre', 'User.nombre', 'Representante.nombre'),
		));
		$this->Pago->virtualFields = array(
			'gestion' => "YEAR(Pago.fecha)",
		);
		$gestiones = $this->Pago->find('all', array(
			'conditions' => array('ISNULL(Pago.deleted)', 'Pago.ambiente_id' => $idAmbiente, 'Pago.concepto_id' => $idConcepto),
			'group' => array('gestion'),
			'fields' => array('gestion'),
		));
		$concepto = $this->Concepto->findByid($idConcepto, null, null, -1);
		$this->set(compact('idAmbiente', 'idConcepto', 'gestiones', 'ambiente', 'concepto'));
	}

	public function get_pag_ges($idAmbiente = null, $idConcepto = null, $gestion = null, $mes = null) {
		$pago = $this->Pago->find('first', array(
			'recursive' => -1,
			'conditions' => array(
				'ISNULL(Pago.deleted)',
				'Pago.ambiente_id' => $idAmbiente,
				'YEAR(Pago.fecha)' => $gestion,
				'MONTH(Pago.fecha)' => $mes,
				'Pago.concepto_id' => $idConcepto,
			),
			'fields' => array('Pago.monto', 'Pago.estado'),
		));
		if (!empty($pago)) {
			return $pago['Pago'];
		} else {
			return array('monto' => '-', 'estado' => NULL);
		}
	}

	public function prueba() {
		$dat['estado'] = 'Prueba';
		$dat['ambiente_id'] = 55;
		$dat['proipietario_id'] = 45;
		$dat['concepto_id'] = 14;
		$dat['monto'] = 100.00;
		$this->Pago->create();
		$this->Pago->save($dat);
		debug('sss');
		exit;
	}

	public function edit_monto($idPago = NULL) {
		$this->layout = 'ajax';
		$this->Pago->id = $idPago;

		if (!empty($this->request->data['Pago'])) {
			$this->Pago->save($this->request->data['Pago']);
			$this->Session->setFlash("Se ha modificado correctamente el pago!!", 'msgbueno');
			$this->redirect($this->referer());
		}
		$this->request->data = $this->Pago->read();
	}

	public function eliminar($idPago = null) {
		$this->Pago->id = $idPago;
		$d_pago['deleted'] = date("Y-m-d H:i:s");
		if ($this->Pago->save($d_pago)) {
			$this->Session->setFlash("Se ha eliminado correctamente el pago!!", 'msgbueno');
		} else {
			$this->Session->setFlash("No se ha podido eliminar el pago", 'msgerror');
		}
		$this->redirect($this->referer());
	}

	public function preavisos() {

		if ($this->RequestHandler->responseType() == 'json') {
			//$inquilinos = '<button class="btn btn-primary" type="button" title="Inquilinos" onclick="inquilinos(' . "',Ambiente.id,'" . ',' . "',Ambiente.piso_id,'" . ')"><i class="gi gi-parents"></i></button>';
			$idEdificio = $this->Session->read('Auth.User.edificio_id');
			$idambiente = "',Ambiente.id,'";
			$checkbox = '<input type="checkbox" name="data[Ambientes][' . $idambiente . '][marcado]" class="form-control" style="width: 20px !important;">';
			$this->Pago->virtualFields = array(
				'deuda_mantenimiento' => "SUM( IF(Pago.concepto_id = 10,Pago.monto,0) )",
				'deuda_alquiler' => "SUM( IF(Pago.concepto_id = 11,Pago.monto,0) )",
				'ambiente' => "CONCAT(Piso.nombre,' - ',Ambiente.nombre)",
				'checkbox' => "CONCAT('$checkbox')",
			);
			$this->paginate = array(
				'recursive' => 0,
				'conditions' => array('Pago.estado LIKE' => 'Debe', 'Ambiente.edificio_id' => $idEdificio, 'Piso.id <>' => null),
				'group' => array('Pago.ambiente_id'),
				'fields' => array('Pago.checkbox', 'Piso.nombre', 'Ambiente.nombre', 'Representante.nombre', 'Pago.deuda_mantenimiento', 'Pago.deuda_alquiler'),
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
			);
			$this->DataTable->fields = array('Pago.checkbox', 'Piso.nombre', 'Ambiente.nombre', 'Representante.nombre', 'Pago.deuda_mantenimiento', 'Pago.deuda_alquiler');
			$this->DataTable->emptyEleget_usuarios_adminments = 1;
			$this->set('ambientes', $this->DataTable->getResponse('Pagos', 'Pago'));
			$this->set('_serialize', 'ambientes');
		}

		$this->set(compact('pagos'));
	}

	public function genera_preavisos($idConcepto = null) {
		//debug(date('m'));exit;
		$ambientes = array();
		$idConcepto = $this->request->data['Pago']['concepto_id'];
		$this->Ambiente->virtualFields = array(
			'nombre_ambiente' => "CONCAT(Piso.nombre,' - ',Ambiente.nombre)",
		);
		$this->Pago->virtualFields = array(
			'mes' => "MONTH(Pago.fecha)",
			'anyo' => "YEAR(Pago.fecha)",
		);
		if ($idConcepto == 10) {
			$nombre_concepto = 'Mantenimiento';
		} else {
			$nombre_concepto = 'Alquiler';
		}
		if (!empty($this->request->data['Ambientes'])) {
			foreach ($this->request->data['Ambientes'] as $key => $am) {

				$ambientes[$key]['ambiente'] = $this->Ambienteconcepto->find('first', array(
					'recursive' => 0,
					'conditions' => array('Ambiente.id' => $key, 'Ambienteconcepto.concepto_id' => $idConcepto),
					'fields' => array('Ambiente.nombre', 'Piso.nombre', 'Ambienteconcepto.monto', 'User.nombre', 'Inquilino.nombre'),
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
							'alias' => 'User',
							'type' => 'LEFT',
							'conditions' => array(
								'User.id = Ambiente.user_id',
							),
						),
						array(
							'table' => 'users',
							'alias' => 'Inquilino',
							'type' => 'LEFT',
							'conditions' => array(
								'Inquilino.id = Ambiente.inquilino_id',
							),
						),
					),
				));

				$ambientes[$key]['pagos'] = $this->Pago->find('list', array(
					'recursive' => -1,
					'conditions' => array('ISNULL(Pago.deleted)', 'Pago.ambiente_id' => $key, 'Pago.concepto_id' => $idConcepto),
					'fields' => array('Pago.mes', 'Pago.monto', 'Pago.anyo'),
					'group' => array('Pago.fecha', 'Pago.concepto_id'),
				));
				if (empty($ambientes[$key]['ambiente'])) {

					unset($ambientes[$key]);
				}
			}
		}

		/* foreach ($ambientes[56]['pagos'] as $ano => $pa){
			          debug($ano);
		*/
		//debug($ambientes[56]['pagos']);exit;
		$this->set(compact('ambientes', 'nombre_concepto'));
		//$this->set(compact('conceptos'));

		$this->layout = '/pdf/default';

		$this->render('/Pagos/genera_preavisos');
	}

}
