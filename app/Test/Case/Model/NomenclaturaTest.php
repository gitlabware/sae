<?php
App::uses('Nomenclatura', 'Model');

/**
 * Nomenclatura Test Case
 *
 */
class NomenclaturaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.nomenclatura',
		'app.subconcepto',
		'app.edificio',
		'app.ambiente',
		'app.categoriasambiente',
		'app.categoriaspago',
		'app.piso',
		'app.user',
		'app.representante',
		'app.ambienteconcepto',
		'app.concepto',
		'app.comprobantescuenta',
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
		$this->Nomenclatura = ClassRegistry::init('Nomenclatura');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Nomenclatura);

		parent::tearDown();
	}

}
