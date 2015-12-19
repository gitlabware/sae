<?php
/**
 * ReciboFixture
 *
 */
class ReciboFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'numero' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'inquilino_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'propietario_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
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
			'numero' => 1,
			'inquilino_id' => 1,
			'propietario_id' => 1,
			'ambiente_id' => 1,
			'created' => '2015-03-24 18:36:56',
			'modified' => '2015-03-24 18:36:56'
		),
	);

}
