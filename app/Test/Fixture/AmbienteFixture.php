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
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'descripcion' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'fecha_ocupacion' => array('type' => 'date', 'null' => true, 'default' => null),
		'lista_inquilinos' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'saldo' => array('type' => 'decimal', 'null' => true, 'default' => '0.00', 'length' => '10,2', 'unsigned' => false),
		'representante_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'estado' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'user_id' => 1,
			'descripcion' => 'Lorem ipsum dolor sit amet',
			'fecha_ocupacion' => '2016-05-19',
			'lista_inquilinos' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'saldo' => '',
			'representante_id' => 1,
			'estado' => 'Lorem ipsum dolor sit amet',
			'created' => '2016-05-19',
			'modified' => '2016-05-19'
		),
	);

}
