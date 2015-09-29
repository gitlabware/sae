<?php
/**
 * NomenclaturasAmbienteFixture
 *
 */
class NomenclaturasAmbienteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'nomenclatura_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'ambiente_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'ambiente_id' => 1,
			'created' => '2015-09-29 16:16:26',
			'modified' => '2015-09-29 16:16:26'
		),
	);

}
