<?php

App::uses('AppModel', 'Model');

/**
 * Categoriasambiente Model
 *
 * @property Ambiente $Ambiente
 */
class Categoriasambiente extends AppModel {

    public $virtualFields = array(
        'nombre_completo' => 'CONCAT(Categoriasambiente.nombre, "  (", Categoriasambiente.constante,")")'
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Ambiente' => array(
            'className' => 'Ambiente',
            'foreignKey' => 'categoriasambiente_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

}
