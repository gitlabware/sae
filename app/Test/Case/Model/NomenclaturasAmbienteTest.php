<?php
App::uses('NomenclaturasAmbiente', 'Model');

/**
 * NomenclaturasAmbiente Test Case
 *
 */
class NomenclaturasAmbienteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.nomenclaturas_ambiente',
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
		$this->NomenclaturasAmbiente = ClassRegistry::init('NomenclaturasAmbiente');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->NomenclaturasAmbiente);

		parent::tearDown();
	}

}
