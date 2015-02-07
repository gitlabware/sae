<?php
App::uses('Pago', 'Model');

/**
 * Pago Test Case
 *
 */
class PagoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.pago',
		'app.ambiento',
		'app.user',
		'app.propietario',
		'app.concepto',
		'app.edificio',
		'app.ambiente',
		'app.categoriasambiente',
		'app.piso'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Pago = ClassRegistry::init('Pago');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Pago);

		parent::tearDown();
	}

}
