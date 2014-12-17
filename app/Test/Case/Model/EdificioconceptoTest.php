<?php
App::uses('Edificioconcepto', 'Model');

/**
 * Edificioconcepto Test Case
 *
 */
class EdificioconceptoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.edificioconcepto',
		'app.edificio',
		'app.ambiente',
		'app.categoriasambiente',
		'app.piso',
		'app.concepto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Edificioconcepto = ClassRegistry::init('Edificioconcepto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Edificioconcepto);

		parent::tearDown();
	}

}
