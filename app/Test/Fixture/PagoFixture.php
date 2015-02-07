<?php
/**
 * PagoFixture
 *
 */
class PagoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'ambiento_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'propietario_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'concepto_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'monto' => array('type' => 'decimal', 'null' => true, 'default' => '0.00', 'length' => '15,2', 'unsigned' => false),
		'mes' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'date', 'null' => false, 'default' => null),
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
			'ambiento_id' => 1,
			'user_id' => 1,
			'propietario_id' => 1,
			'concepto_id' => 1,
			'monto' => '',
			'mes' => 'Lorem ip',
			'created' => '2015-02-05'
		),
	);

}
