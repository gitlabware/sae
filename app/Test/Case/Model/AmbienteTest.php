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
