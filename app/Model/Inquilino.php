<?php

App::uses('AppModel', 'Model');

/**
 * Inquilino Model
 *
 * @property User $User
 * @property Ambiente $Ambiente
 */
class Inquilino extends AppModel {
  //The Associations below have been created with all possible keys, those that are not needed can be removed

  /**
   * belongsTo associations
   *
   * @var array
   */
  /*
  public $virtualFields = array(
    'nombre_usuario' => 'CONCAT((SELEC nombre FROM users WHERE (users.id = Inquilino.user_id)))'
  );*/
  public $belongsTo = array(
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    ),
    'Ambiente' => array(
      'className' => 'Ambiente',
      'foreignKey' => 'ambiente_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    )
  );

}
