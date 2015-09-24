<?php
/**
 * EgresoFixture
 *
 */
class EgresoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'presupuesto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'gasto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'subgasto_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'pres_anterior' => array('type' => 'decimal', 'null' => true, 'default' => '0.00', 'length' => '10,2', 'unsigned' => false),
		'ejec_anterior' => array('type' => 'decimal', 'null' => true, 'default' => '0.00', 'length' => '10,2', 'unsigned' => false),
		'presupuesto' => array('type' => 'decimal', 'null' => true, 'default' => '0.00', 'length' => '10,2', 'unsigned' => false),
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
			'presupuesto_id' => 1,
			'gasto_id' => 1,
			'subgasto_id' => 1,
			'pres_anterior' => '',
			'ejec_anterior' => '',
			'presupuesto' => '',
			'created' => '2015-09-11 18:07:48',
			'modified' => '2015-09-11 18:07:48'
		),
	);

}
