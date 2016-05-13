<?php

App::uses('AppModel', 'Model');

/**
 * Categoriaspago Model
 *
 */
class Categoriaspago extends AppModel {

    public $virtualFields = array(
        'nombre_completo' => 'CONCAT(Categoriaspago.nombre, "  (", Categoriaspago.constante,")")'
    );

}
