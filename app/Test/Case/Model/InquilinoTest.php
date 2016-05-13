<?php
App::uses('Inquilino', 'Model');

/**
 * Inquilino Test Case
 *
 */
class InquilinoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.inquilino',
		'app.user',
		'app.ambiente',
		'app.categoriasambiente',
		'app.edificio',
		'app.piso'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Inquilino = ClassRegistry::init('Inquilino');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Inquilino);

		parent::tearDown();
	}

}
