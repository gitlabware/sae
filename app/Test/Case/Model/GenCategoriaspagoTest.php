<?php
App::uses('GenCategoriaspago', 'Model');

/**
 * GenCategoriaspago Test Case
 *
 */
class GenCategoriaspagoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.gen_categoriaspago'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->GenCategoriaspago = ClassRegistry::init('GenCategoriaspago');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GenCategoriaspago);

		parent::tearDown();
	}

}
