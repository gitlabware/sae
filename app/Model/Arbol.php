<?php
App::uses('AppModel', 'Model');
/**
 * Arbol Model
 *
 */
class Arbol extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'arbol';
        public $actsAs = array('Tree');

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

}
