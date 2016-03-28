<?php
/**
 * IngresoFixture
 *
 */
class IngresoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'presupuesto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'concepto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'subconcepto_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'porcentaje' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '5,2', 'unsigned' => false),
		'ingerso' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'pres_anterior' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'ejec_anterior' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'presupuesto' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'concepto_id' => 1,
			'subconcepto_id' => 1,
			'porcentaje' => '',
			'ingerso' => '',
			'pres_anterior' => '',
			'ejec_anterior' => '',
			'presupuesto' => '',
			'created' => '2015-09-10 20:10:33',
			'modified' => '2015-09-10 20:10:33'
		),
	);

}
