<?php
/**
 * AmbienteconceptoFixture
 *
 */
class AmbienteconceptoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'ambiente_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'concepto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'monto' => array('type' => 'decimal', 'null' => false, 'default' => '0.00000', 'length' => '12,5', 'unsigned' => false),
		'created' => array('type' => 'date', 'null' => false, 'default' => null),
		'modified' => array('type' => 'date', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'ambiente_id' => 1,
			'concepto_id' => 1,
			'monto' => '',
			'created' => '2014-12-16',
			'modified' => '2014-12-16'
		),
	);

}
