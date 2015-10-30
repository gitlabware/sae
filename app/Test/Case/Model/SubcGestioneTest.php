<?php
App::uses('SubcGestione', 'Model');

/**
 * SubcGestione Test Case
 *
 */
class SubcGestioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.subc_gestione',
		'app.subconcepto',
		'app.edificio',
		'app.ambiente',
		'app.categoriasambiente',
		'app.categoriaspago',
		'app.piso',
		'app.user',
		'app.concepto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SubcGestione = ClassRegistry::init('SubcGestione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SubcGestione);

		parent::tearDown();
	}

}
