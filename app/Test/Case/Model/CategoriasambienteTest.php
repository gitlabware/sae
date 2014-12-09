<?php
App::uses('Categoriasambiente', 'Model');

/**
 * Categoriasambiente Test Case
 *
 */
class CategoriasambienteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.categoriasambiente',
		'app.ambiente',
		'app.edificio'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Categoriasambiente = ClassRegistry::init('Categoriasambiente');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Categoriasambiente);

		parent::tearDown();
	}

}
