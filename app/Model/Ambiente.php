<?php

App::uses('AppModel', 'Model');

/**
 * Ambiente Model
 *
 * @property Categoriasambiente $Categoriasambiente
 * @property Categoriaspago $Categoriaspago
 * @property Edificio $Edificio
 * @property Piso $Piso
 * @property User $User
 * @property Ambienteconcepto $Ambienteconcepto
 * @property Inquilino $Inquilino
 * @property Pago $Pago
 */
class Ambiente extends AppModel {
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Categoriasambiente' => array(
            'className' => 'Categoriasambiente',
            'foreignKey' => 'categoriasambiente_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Categoriaspago' => array(
            'className' => 'Categoriaspago',
            'foreignKey' => 'categoriaspago_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Edificio' => array(
            'className' => 'Edificio',
            'foreignKey' => 'edificio_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Piso' => array(
            'className' => 'Piso',
            'foreignKey' => 'piso_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Representante' => array(
            'className' => 'User',
            'foreignKey' => 'representante_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Nomenclatura' => array(
            'className' => 'Nomenclatura',
            'joinTable' => 'nomenclaturas_ambientes',
            'foreignKey' => 'ambiente_id',
            'associationForeignKey' => 'nomenclatura_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );

}
