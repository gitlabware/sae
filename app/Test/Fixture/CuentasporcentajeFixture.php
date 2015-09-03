<?php
/**
 * CuentasporcentajeFixture
 *
 */
class CuentasporcentajeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'concepto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'cuenta_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'porcentaje' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '10,2', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'concepto_id' => 1,
			'cuenta_id' => 1,
			'porcentaje' => '',
			'created' => '2015-09-02 17:01:41',
			'modified' => '2015-09-02 17:01:41'
		),
	);

}
