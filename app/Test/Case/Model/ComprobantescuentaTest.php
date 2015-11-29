<?php
App::uses('Comprobantescuenta', 'Model');

/**
 * Comprobantescuenta Test Case
 *
 */
class ComprobantescuentaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.comprobantescuenta',
		'app.nomenclatura',
		'app.edificio',
		'app.ambiente',
		'app.categoriasambiente',
		'app.categoriaspago',
		'app.piso',
		'app.user',
		'app.comprobante'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Comprobantescuenta = ClassRegistry::init('Comprobantescuenta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Comprobantescuenta);

		parent::tearDown();
	}

}
