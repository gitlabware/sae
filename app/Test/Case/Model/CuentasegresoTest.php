<?php
App::uses('Cuentasegreso', 'Model');

/**
 * Cuentasegreso Test Case
 *
 */
class CuentasegresoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cuentasegreso',
		'app.subgasto',
		'app.gasto',
		'app.edificio',
		'app.ambiente',
		'app.categoriasambiente',
		'app.categoriaspago',
		'app.piso',
		'app.user',
		'app.egreso',
		'app.presupuesto',
		'app.cuenta',
		'app.banco'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cuentasegreso = ClassRegistry::init('Cuentasegreso');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cuentasegreso);

		parent::tearDown();
	}

}
