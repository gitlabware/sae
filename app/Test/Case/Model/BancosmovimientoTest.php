<?php
App::uses('Bancosmovimiento', 'Model');

/**
 * Bancosmovimiento Test Case
 *
 */
class BancosmovimientoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bancosmovimiento',
		'app.desdebanco',
		'app.desdecuenta',
		'app.hastabanco',
		'app.hastacuenta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Bancosmovimiento = ClassRegistry::init('Bancosmovimiento');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Bancosmovimiento);

		parent::tearDown();
	}

}
