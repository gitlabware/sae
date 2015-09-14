<?php
App::uses('Subgasto', 'Model');

/**
 * Subgasto Test Case
 *
 */
class SubgastoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.subgasto',
		'app.gasto',
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
		'app.egreso'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Subgasto = ClassRegistry::init('Subgasto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Subgasto);

		parent::tearDown();
	}

}
