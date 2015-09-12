<?php
App::uses('Egreso', 'Model');

/**
 * Egreso Test Case
 *
 */
class EgresoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.egreso',
		'app.presupuesto',
		'app.edificio',
		'app.ambiente',
		'app.categoriasambiente',
		'app.categoriaspago',
		'app.piso',
		'app.user',
		'app.ambienteconcepto',
		'app.concepto',
		'app.inquilino',
		'app.pago',
		'app.recibo',
		'app.gasto',
		'app.subgasto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Egreso = ClassRegistry::init('Egreso');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Egreso);

		parent::tearDown();
	}

}
