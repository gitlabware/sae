<?php
/**
 * PresupuestoFixture
 *
 */
class PresupuestoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'edificio_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'mes' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 15, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'gestion' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 5, 'unsigned' => false),
		'tipo' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 25, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'monto' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '15,2', 'unsigned' => false),
		'concepto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'date', 'null' => false, 'default' => null),
		'modified' => array('type' => 'date', 'null' => false, 'default' => null),
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
			'edificio_id' => 1,
			'mes' => 'Lorem ipsum d',
			'gestion' => 1,
			'tipo' => 'Lorem ipsum dolor sit a',
			'monto' => '',
			'concepto_id' => 1,
			'created' => '2014-12-20',
			'modified' => '2014-12-20'
		),
	);

}
