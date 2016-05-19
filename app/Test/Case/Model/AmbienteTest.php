<?php
App::uses('Ambiente', 'Model');

/**
 * Ambiente Test Case
 *
 */
class AmbienteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ambiente',
		'app.categoriasambiente',
		'app.categoriaspago',
		'app.edificio',
		'app.piso',
		'app.user',
		'app.representante',
		'app.ambienteconcepto',
		'app.concepto',
		'app.comprobantescuenta',
		'app.nomenclatura',
		'app.subconcepto',
		'app.comprobante',
		'app.inquilino',
		'app.pago',
		'app.recibo',
		'app.nomenclaturas_ambiente'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Ambiente = ClassRegistry::init('Ambiente');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ambiente);

		parent::tearDown();
	}

}
