<?php
App::uses('Nomenclatura', 'Model');

/**
 * Nomenclatura Test Case
 *
 */
class NomenclaturaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.nomenclatura',
		'app.edificio',
		'app.ambiente',
		'app.categoriasambiente',
		'app.categoriaspago',
		'app.piso',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Nomenclatura = ClassRegistry::init('Nomenclatura');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Nomenclatura);

		parent::tearDown();
	}

}
