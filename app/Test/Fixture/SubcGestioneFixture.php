<?php
/**
 * SubcGestioneFixture
 *
 */
class SubcGestioneFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'subconcepto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'gestion_ini' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => false),
		'gestion_fin' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => false),
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
			'subconcepto_id' => 1,
			'gestion_ini' => 1,
			'gestion_fin' => 1,
			'created' => '2015-10-29 16:00:45',
			'modified' => '2015-10-29 16:00:45'
		),
	);

}
