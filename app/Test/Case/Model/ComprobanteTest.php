<?php
App::uses('Comprobante', 'Model');

/**
 * Comprobante Test Case
 *
 */
class ComprobanteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.comprobante'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Comprobante = ClassRegistry::init('Comprobante');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Comprobante);

		parent::tearDown();
	}

}
