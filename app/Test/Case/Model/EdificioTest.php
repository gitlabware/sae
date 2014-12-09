<?php
App::uses('Edificio', 'Model');

/**
 * Edificio Test Case
 *
 */
class EdificioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.edificio',
		'app.ambiente'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Edificio = ClassRegistry::init('Edificio');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Edificio);

		parent::tearDown();
	}

}
