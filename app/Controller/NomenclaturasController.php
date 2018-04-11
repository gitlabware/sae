<?php

App::uses('AppController', 'Controller');
/**
 * @property NomenclaturaHelper $Nomenclatura
 * */
class NomenclaturasController extends AppController {

	public $uses = array('Nomenclatura', 'Concepto', 'Ambiente', 'Piso', 'NomenclaturasAmbiente', 'Subconcepto');
	public $layout = 'monster';

	public function index() {
		$idEdificio = $this->Session->read('Auth.User.edificio_id');

		$nomenclaturas = $this->Nomenclatura->find('all', array(
			'recursive' => -1,
			'conditions' => array('ISNULL(Nomenclatura.deleted)', 'edificio_id' => $idEdificio, 'nomenclatura_id' => 0),
		));

		$this->set(compact('nomenclaturas'));
	}

	public function lista_nomenclaturas() {

		$idEdificio = $this->Session->read('Auth.User.edificio_id');

		$this->Ambiente->unbindModel(array(
			'belongsTo' => array('Edificio', 'User', 'Categoriaspago', 'Categoriasambiente'),
		));
		/*$this->Ambiente->virtualFields = array(
			            'ambiente_completo' => "CONCAT(Ambiente.nombre,' (',Piso.nombre,') ')"
		*/
		$nomenclaturas = $this->Nomenclatura->find('all', array(
			'recursive' => 2,
			'conditions' => array('ISNULL(Nomenclatura.deleted)', 'Nomenclatura.edificio_id' => $idEdificio),
			'order' => array('Nomenclatura.codico_p_orden ASC'),
			'fields' => array('Nomenclatura.*', 'Subconcepto.nombre', 'Edificio.nombre'),
		));
		//debug($nomenclaturas);exit;
		//$nomenclaturas = $this->Nomenclatura->children(null,false,array('Nomenclatura.*','Subconcepto.nombre','Edificio.nombre'),null,null,null,2,array('Nomenclatura.edificio_id' => $idEdificio));
		//debug($nomenclaturas);exit;
		$this->set(compact('nomenclaturas'));
	}

	public function ver() {
		$idEdificio = $this->Session->read('Auth.User.edificio_id');

		$nomenclaturas = $this->Nomenclatura->find('all', array(
			'recursive' => -1,
			'conditions' => array('ISNULL(Nomenclatura.deleted)', 'edificio_id' => $idEdificio, 'nomenclatura_id' => 0),
		));

		$this->set(compact('nomenclaturas'));
	}

	public function nomenclatura($idNomenclatura = null, $id = null) {
		$this->layout = 'ajax';
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		if (empty($idNomenclatura)) {
			$ultimo = $this->Nomenclatura->find('first', array(
				'recursive' => -1,
				'conditions' => array('ISNULL(Nomenclatura.deleted)', 'edificio_id' => $idEdificio, 'nomenclatura_id' => 0),
				'order' => array('codigo DESC'),
				'fields' => array('codigo'),
			));
		} else {
			$ultimo = $this->Nomenclatura->find('first', array(
				'recursive' => -1,
				'conditions' => array('edificio_id' => $idEdificio, 'nomenclatura_id' => $idNomenclatura),
				'order' => array('codigo DESC'),
				'fields' => array('codigo'),
			));
		}

		$codigo = 1;
		if (!empty($ultimo)) {
			$codigo = $ultimo['Nomenclatura']['codigo'] + 1;
		}
		$codigo_padre = $this->get_codigo_com($idNomenclatura, "");

		$this->request->data = $nomenclatura = $this->Nomenclatura->find('first', array(
			'recursive' => -1,
			'conditions' => array('id' => $id),
		));
		if (empty($this->request->data['Nomenclatura']['codigo'])) {
			$this->request->data['Nomenclatura']['codigo'] = $codigo;
		}
		$this->request->data['Nomenclatura']['nomenclatura_id'] = $idNomenclatura;
		$this->request->data['Nomenclatura']['edificio_id'] = $idEdificio;

		$this->Subconcepto->virtualFields = array(
			'nombre_completo' => "CONCAT(codigo,' - ',nombre)",
		);
		$subconceptos = $this->Subconcepto->find('list', array(
			'recursive' => -1,
			'conditions' => array('ISNULL(Subconcepto.deleted)', 'edificio_id' => $idEdificio),
			'fields' => array('id', 'nombre_completo'),
		));

		$this->set(compact('conceptos', 'subconceptos', 'codigo_padre'));
	}

	public function registra() {
		if (!empty($this->request->data['Nomenclatura'])) {

			$cod_padre = $this->request->data['Nomenclatura']['codigo_padre'];
			$idEdificio = $this->Session->read('Auth.User.edificio_id');
			$nom_cod = $this->Nomenclatura->find('first', array(
				'recursive' => -1,
				'conditions' => array('ISNULL(Nomenclatura.deleted)', 'Nomenclatura.codigo_completo LIKE' => $cod_padre, 'Nomenclatura.edificio_id' => $idEdificio),
				'fields' => array('Nomenclatura.id'),
			));

			if (!empty($nom_cod['Nomenclatura']['id'])) {
				$this->request->data['Nomenclatura']['nomenclatura_id'] = $nom_cod['Nomenclatura']['id'];
				$this->request->data['Nomenclatura']['codigo_aux'] = $cod_padre;
			}

			//debug($this->request->data);exit;
			$this->Nomenclatura->create();
			if (!empty($this->request->data['Nomenclatura']['codigo_aux'])) {
				$this->request->data['Nomenclatura']['codigo_completo'] = $this->request->data['Nomenclatura']['codigo_aux'] . '.' . $this->request->data['Nomenclatura']['codigo'];
			} else {
				$this->request->data['Nomenclatura']['codigo_completo'] = $this->request->data['Nomenclatura']['codigo'];
			}

			$this->request->data['Nomenclatura']['codico_p_orden'] = $this->gen_nu_cod_p($this->request->data['Nomenclatura']['codigo_completo']);

			/* debug($this->request->data);
              exit; */
			if (!empty($this->request->data['Nomenclatura']['subconcepto_id'])) {
				$subconcepto = $this->Subconcepto->findByid($this->request->data['Nomenclatura']['subconcepto_id'], null, null, -1);
				$this->request->data['Nomenclatura']['concepto_id'] = $subconcepto['Subconcepto']['concepto_id'];
			}
			if (!empty($this->request->data['Nomenclatura']['nomenclatura_id'])) {
				$this->request->data['Nomenclatura']['parent_id'] = $this->request->data['Nomenclatura']['nomenclatura_id'];
			}
			$this->Nomenclatura->save($this->request->data['Nomenclatura']);
			$this->Session->setFlash("Se registro correctamente!!", 'msgbueno');
		} else {
			$this->Session->setFlash("No se ha podido registrar, intente nuevamente!!", 'msgerror');
		}
		$this->redirect($this->referer());
	}

	public function ajax_nomenclaturas($idNomenclatura = null) {
		$this->layout = 'ajax';
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$nomenclaturas = $this->Nomenclatura->find('all', array(
			'recursive' => -1,
			'conditions' => array('ISNULL(Nomenclatura.deleted)', 'edificio_id' => $idEdificio, 'nomenclatura_id' => $idNomenclatura),
			'order' => array('codigo ASC'),
		));

		$this->set(compact('nomenclaturas', 'idNomenclatura'));
	}

	public function ver_nomenclaturas($idNomenclatura = null) {
		$this->layout = 'ajax';
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$nomenclaturas = $this->Nomenclatura->find('all', array(
			'recursive' => -1,
			'conditions' => array('ISNULL(Nomenclatura.deleted)', 'edificio_id' => $idEdificio, 'nomenclatura_id' => $idNomenclatura),
			'order' => array('codigo ASC'),
		));

		$this->set(compact('nomenclaturas', 'idNomenclatura'));
	}

	public function get_codigo_com($idNomenclatura = null, $codigo = "") {
		$nomenclatura = $this->Nomenclatura->find('first', array(
			'recursive' => -1,
			'conditions' => array('id' => $idNomenclatura),
			'fields' => array('nomenclatura_id', 'codigo'),
		));
		if (!empty($nomenclatura)) {
			if (!empty($codigo)) {
				$codigo = $nomenclatura['Nomenclatura']['codigo'] . ".$codigo";
			} else {
				$codigo = $nomenclatura['Nomenclatura']['codigo'];
			}
			if (!empty($nomenclatura['Nomenclatura']['nomenclatura_id'])) {
				$codigo = $this->get_codigo_com($nomenclatura['Nomenclatura']['nomenclatura_id'], $codigo);
			}
		}
		//debug($nomenclatura)
		return $codigo;
	}

	public function eliminar($idNomenclatura = null, $sw = TRUE) {
		$nomenclaturas = $this->Nomenclatura->find('all', array(
			'recursive' => -1,
			'conditions' => array('ISNULL(Nomenclatura.deleted)', 'nomenclatura_id' => $idNomenclatura),
			'fields' => array('id'),
		));
		$d_nom['deleted'] = date("Y-m-d H:i:s");
		$this->Nomenclatura->save($d_nom);

		if (!empty($nomenclaturas)) {
			foreach ($nomenclaturas as $nom) {
				$this->eliminar($nom['Nomenclatura']['id'], FALSE);
			}
		}
		if ($sw) {
			$this->Session->setFlash("Se ha eliminado correctamente!!", 'msgbueno');
			$this->redirect($this->referer());
		}
	}

	public function ambientes($idNomenclatura = null) {
		$this->layout = 'ajax';
		$nomenclatura = $this->Nomenclatura->findByid($idNomenclatura, null, null, -1);
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$pisos = $this->Piso->find('list', array(
			'recursive' => -1,
			'conditions' => array('ISNULL(Piso.deleted)', 'edificio_id' => $idEdificio),
			'fields' => array('id', 'nombre'),
			'order' => array('Piso.orden ASC'),
		));
		$this->NomenclaturasAmbiente->virtualFields = array(
			'piso' => "(SELECT pisos.nombre FROM pisos WHERE pisos.id = Ambiente.piso_id)",
		);
		$ambientes = $this->NomenclaturasAmbiente->find('all', array(
			'recursive' => 0,
			'conditions' => array('NomenclaturasAmbiente.nomenclatura_id' => $idNomenclatura),
			'fields' => array('NomenclaturasAmbiente.id', 'Ambiente.nombre', 'NomenclaturasAmbiente.piso'),
		));
		//debug($ambientes);exit;
		$this->set(compact('idNomenclatura', 'pisos', 'nomenclatura', 'ambientes'));
	}

	public function ajax_ambientes() {
		$this->layout = 'ajax';
		$idEdificio = $this->Session->read('Auth.User.edificio_id');
		$idPiso = $this->request->data['Piso']['id'];
		$idNomenclatura = $this->request->data['Nomenclatura']['id'];
		$ambientes_sel = $this->NomenclaturasAmbiente->find('list', array(
			'recursive' => 0,
			'conditions' => array('NomenclaturasAmbiente.nomenclatura_id' => $idNomenclatura),
			'fields' => array('NomenclaturasAmbiente.id', 'NomenclaturasAmbiente.ambiente_id'),
		));
		if (count($ambientes_sel) == 1) {
			$ambientes_sel = current($ambientes_sel);
		}
		//debug($ambientes_sel);exit;
		$ambientes = $this->Ambiente->find('all', array(
			'recursive' => 0,
			'conditions' => array(
				'Ambiente.piso_id' => $idPiso,
				'Ambiente.id != ' => $ambientes_sel,
				'Ambiente.edificio_id' => $idEdificio,
			),
			'fields' => array('Ambiente.nombre', 'Representante.nombre', 'Ambiente.id'),
		));
		$this->set(compact('ambientes', 'idNomenclatura'));
	}

	public function registra_ambientes() {
		$this->layout = 'ajax';
		$dato_m['nomenclatura_id'] = $this->request->data['Nomenclatura']['id'];
		foreach ($this->request->data['Dato'] as $da) {
			if ($da['marca'] == '1') {
				$dato_m['ambiente_id'] = $da['ambiente_id'];
				$dato_m['codigo'] = $da['codigo'];
				$this->NomenclaturasAmbiente->create();
				$this->NomenclaturasAmbiente->save($dato_m);
			}
		}

		exit;
	}

	public function quita_ambiente($idNomenclatura = NULL, $id = null) {
		$this->NomenclaturasAmbiente->delete($id);
		$this->redirect(array('action' => 'ambientes', $idNomenclatura));
	}
	public function quita_ambiente2($id = null) {
		$this->Session->setFlash("Se ha eliminado correctamente el ambiente de la nomenclatura!!", 'msgbueno');
		$this->NomenclaturasAmbiente->delete($id);
		$this->redirect($this->referer());
	}

	public function get_ambientes($idNomenclatura = null) {
		$this->NomenclaturasAmbiente->virtualFields = array(
			'piso' => "(SELECT pisos.nombre FROM pisos WHERE pisos.id = Ambiente.piso_id)",
		);
		$ambientes = $this->NomenclaturasAmbiente->find('all', array(
			'recursive' => 0,
			'conditions' => array('NomenclaturasAmbiente.nomenclatura_id' => $idNomenclatura),
			'fields' => array('NomenclaturasAmbiente.codigo', 'NomenclaturasAmbiente.id', 'Ambiente.nombre', 'NomenclaturasAmbiente.piso'),
		));
		return $ambientes;
	}

	public function ajax_subconceptos($idConcepto = null) {
		$this->layout = 'ajax';
		$subconceptos = $this->Subconcepto->find('list', array(
			'recursive' => -1,
			'conditions' => array('ISNULL(Subconcepto.deleted)', 'concepto_id' => $idConcepto),
			'fields' => array('id', 'nombre'),
		));
		$this->set(compact('subconceptos'));
	}

	public function regulariza_nomen() {

		/*debug(substr("1.1.1",0,-3));
        exit;*/

		$list = $this->Nomenclatura->find('list', array(
			'recursive' => -1,
			'conditions' => array('ISNULL(Nomenclatura.deleted)', 'Nomenclatura.edificio_id' => 8),
			'fields' => array('Nomenclatura.codigo_completo', 'Nomenclatura.id'),
		));
		//debug($list);exit;

		foreach ($list as $codigo => $id_nom) {
			$s_codigo = substr($codigo, 0, -2);

			$s_codigo2 = substr($codigo, 0, -3);

			if ($s_codigo != false) {
				if (isset($list[$s_codigo])) {
					$dnom['nomenclatura_id'] = $list[$s_codigo];
					$dnom['parent_id'] = $list[$s_codigo];
					$this->Nomenclatura->id = $id_nom;
					$this->Nomenclatura->save($dnom);
				}

			}
			if ($s_codigo2 != false) {
				if (isset($list[$s_codigo2])) {
					$dnom['nomenclatura_id'] = $list[$s_codigo2];
					$dnom['parent_id'] = $list[$s_codigo2];
					$this->Nomenclatura->id = $id_nom;
					$this->Nomenclatura->save($dnom);
				}

			}

		}
		debug('si');
		exit;
	}

	public function regulariza_nome_cod() {

		$list = $this->Nomenclatura->find('list', array(
			'recursive' => -1,
			'conditions' => array('ISNULL(Nomenclatura.deleted)', 'Nomenclatura.edificio_id' => 8),
			'fields' => array('Nomenclatura.codigo_completo', 'Nomenclatura.id'),
		));

		foreach ($list as $codigo => $id_nom) {
			$codigo_f = explode(".", $codigo);
			$dnom['codigo'] = end($codigo_f);
			$this->Nomenclatura->id = $id_nom;
			$this->Nomenclatura->save($dnom);

		}
		debug('si');
		exit;
	}

	public function regulariza_nome_cod_2() {

		$list = $this->Nomenclatura->find('list', array(
			'recursive' => -1,
			'conditions' => array('ISNULL(Nomenclatura.deleted)', 'Nomenclatura.edificio_id' => 8),
			'fields' => array('Nomenclatura.codigo_completo', 'Nomenclatura.id'),
		));

		foreach ($list as $codigo => $id_nom) {
			$codigo_f = explode(".", $codigo);
			$nuevo_cod = "";
			for ($i = 0; $i < count($codigo_f); $i++) {
				if (count($codigo_f) - 1 == $i) {
					$nuevo_cod = $nuevo_cod . "" . sprintf('%03d', $codigo_f[$i]);
				} else {
					$nuevo_cod = $nuevo_cod . "" . sprintf('%03d', $codigo_f[$i]) . ".";
				}

			}
			$dnom['codico_p_orden'] = $nuevo_cod;
			$this->Nomenclatura->id = $id_nom;
			$this->Nomenclatura->save($dnom);
		}
		debug('si');
		exit;
	}

	public function gen_nu_cod_p($codigo) {
		$codigo_f = explode(".", $codigo);
		$nuevo_cod = "";
		for ($i = 0; $i < count($codigo_f); $i++) {
			if (count($codigo_f) - 1 == $i) {
				$nuevo_cod = $nuevo_cod . "" . sprintf('%03d', $codigo_f[$i]);
			} else {
				$nuevo_cod = $nuevo_cod . "" . sprintf('%03d', $codigo_f[$i]) . ".";
			}

		}
		return $nuevo_cod;
	}

}
