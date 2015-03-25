<?php
App::uses('Recibo', 'Model');

/**
 * Recibo Test Case
 *
 */
class ReciboTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.recibo',
		'app.inquilino',
		'app.user',
		'app.ambiente',
		'app.categoriasambiente',
		'app.categoriaspago',
		'app.edificio',
		'app.piso',
		'app.ambienteconcepto',
		'app.concepto',
		'app.pago'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Recibo = ClassRegistry::init('Recibo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Recibo);

		parent::tearDown();
	}

}
