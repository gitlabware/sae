<?php
App::uses('GenCategoriasambiente', 'Model');

/**
 * GenCategoriasambiente Test Case
 *
 */
class GenCategoriasambienteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.gen_categoriasambiente'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->GenCategoriasambiente = ClassRegistry::init('GenCategoriasambiente');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GenCategoriasambiente);

		parent::tearDown();
	}

}
