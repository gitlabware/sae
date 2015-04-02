<?php
App::uses('Retencione', 'Model');

/**
 * Retencione Test Case
 *
 */
class RetencioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.retencione',
		'app.edificio',
		'app.ambiente',
		'app.categoriasambiente',
		'app.categoriaspago',
		'app.piso',
		'app.user',
		'app.ambienteconcepto',
		'app.concepto',
		'app.inquilino',
		'app.pago'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Retencione = ClassRegistry::init('Retencione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Retencione);

		parent::tearDown();
	}

}
