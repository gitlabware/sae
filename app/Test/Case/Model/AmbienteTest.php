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
		'app.edificio'
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
