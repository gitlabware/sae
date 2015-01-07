<?php
App::uses('Gestione', 'Model');

/**
 * Gestione Test Case
 *
 */
class GestioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.gestione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Gestione = ClassRegistry::init('Gestione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Gestione);

		parent::tearDown();
	}

}
