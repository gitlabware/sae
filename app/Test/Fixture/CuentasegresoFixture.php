<?php
/**
 * CuentasegresoFixture
 *
 */
class CuentasegresoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'monto' => array('type' => 'decimal', 'null' => true, 'default' => '0.00', 'length' => '10,2', 'unsigned' => false),
		'detalle' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 250, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'proveedor' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 250, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'nomenclatura_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'cuenta_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'banco_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'referencia' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'fecha' => array('type' => 'date', 'null' => true, 'default' => null),
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
			'monto' => '',
			'detalle' => 'Lorem ipsum dolor sit amet',
			'proveedor' => 'Lorem ipsum dolor sit amet',
			'nomenclatura_id' => 1,
			'cuenta_id' => 1,
			'banco_id' => 1,
			'referencia' => 'Lorem ipsum dolor sit amet',
			'fecha' => '2015-11-23',
			'created' => '2015-11-23 12:41:35',
			'modified' => '2015-11-23 12:41:35'
		),
	);

}
