<?php
/**
 * ComprobantescuentaFixture
 *
 */
class ComprobantescuentaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'nomenclatura_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'codigo' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'cta_ctable' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'auxiliar' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'debe' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'haber' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'estado' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 80, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'comprobante_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
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
			'nomenclatura_id' => 1,
			'codigo' => 'Lorem ipsum dolor sit amet',
			'cta_ctable' => 'Lorem ipsum dolor sit amet',
			'auxiliar' => 'Lorem ipsum dolor sit amet',
			'debe' => '',
			'haber' => '',
			'estado' => 'Lorem ipsum dolor sit amet',
			'comprobante_id' => 1,
			'created' => '2015-11-27 15:41:46',
			'modified' => '2015-11-27 15:41:46'
		),
	);

}
