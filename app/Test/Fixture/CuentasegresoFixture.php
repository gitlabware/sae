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
		'subgasto_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'observacion' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'cuenta_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'banco_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
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
			'subgasto_id' => 1,
			'observacion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'cuenta_id' => 1,
			'banco_id' => 1,
			'fecha' => '2015-11-07',
			'created' => '2015-11-07 16:39:45',
			'modified' => '2015-11-07 16:39:45'
		),
	);

}
