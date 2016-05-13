<?php
App::uses('Ambienteconcepto', 'Model');

/**
 * Ambienteconcepto Test Case
 *
 */
class AmbienteconceptoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ambienteconcepto',
		'app.ambiente',
		'app.categoriasambiente',
		'app.edificio',
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
		$this->Ambienteconcepto = ClassRegistry::init('Ambienteconcepto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ambienteconcepto);

		parent::tearDown();
	}

}
