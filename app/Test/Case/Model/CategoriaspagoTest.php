<?php
App::uses('Categoriaspago', 'Model');

/**
 * Categoriaspago Test Case
 *
 */
class CategoriaspagoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.categoriaspago'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Categoriaspago = ClassRegistry::init('Categoriaspago');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Categoriaspago);

		parent::tearDown();
	}

}
