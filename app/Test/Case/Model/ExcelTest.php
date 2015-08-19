<?php
App::uses('Excel', 'Model');

/**
 * Excel Test Case
 *
 */
class ExcelTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.excel'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Excel = ClassRegistry::init('Excel');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Excel);

		parent::tearDown();
	}

}
