<?php
App::uses('Presupuesto', 'Model');

/**
 * Presupuesto Test Case
 *
 */
class PresupuestoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.presupuesto',
		'app.edificio',
		'app.ambiente',
		'app.categoriasambiente',
		'app.piso',
		'app.concepto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Presupuesto = ClassRegistry::init('Presupuesto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Presupuesto);

		parent::tearDown();
	}

}
