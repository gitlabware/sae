<?php
App::uses('Cuentasporcentaje', 'Model');

/**
 * Cuentasporcentaje Test Case
 *
 */
class CuentasporcentajeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cuentasporcentaje',
		'app.concepto',
		'app.edificio',
		'app.ambiente',
		'app.categoriasambiente',
		'app.categoriaspago',
		'app.piso',
		'app.user',
		'app.ambienteconcepto',
		'app.inquilino',
		'app.pago',
		'app.recibo',
		'app.cuenta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cuentasporcentaje = ClassRegistry::init('Cuentasporcentaje');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cuentasporcentaje);

		parent::tearDown();
	}

}
