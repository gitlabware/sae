<?php
/**
 * AmbienteFixture
 *
 */
class AmbienteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'categoriasambiente_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'categoriaspago_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'edificio_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'piso_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'area_util' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '15,2', 'unsigned' => false),
		'area_comun' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '15,2', 'unsigned' => false),
		'mantenimiento' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '15,2', 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'descripcion' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'categoriasambiente_id' => 1,
			'categoriaspago_id' => 1,
			'edificio_id' => 1,
			'piso_id' => 1,
			'nombre' => 'Lorem ipsum dolor sit amet',
			'area_util' => '',
			'area_comun' => '',
			'mantenimiento' => '',
			'user_id' => 1,
			'descripcion' => 'Lorem ipsum dolor sit amet',
			'created' => '2015-03-04',
			'modified' => '2015-03-04'
		),
	);

}
