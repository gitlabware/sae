<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class User extends AppModel {

  public function beforeSave($options = array()) {
    if (!empty($this->data['User']['password'])) {
      $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
    }
    return true;
  }

  public $validate = array(
    'username' => array(
      'limitDuplicates' => array(
        'rule' => array('limitDuplicates', 1)
        , 'message' => 'EL nombre de usuario ya existe!!!!'
      )
    ),
    'nombre' => array(
      'DuplicatesPropietario' => array(
        'rule' => array('DuplicatesPropietario', 1)
        , 'message' => 'EL propietario ya existe!!!!'
      )
    )
  );

  public function limitDuplicates($check, $limit) {

    if (!empty($this->data['User']['id'])) {
      $id = $this->data['User']['id'];
      $check['User.id !='] = $id;
    }
    $existingPromoCount = $this->find('count', array(
      'conditions' => $check,
      'recursive' => -1
    ));
    return $existingPromoCount < $limit;
  }

  public function DuplicatesPropietario($check, $limit) {

    if (!empty($this->data['User']['id'])) {
      $id = $this->data['User']['id'];
      $check['User.id !='] = $id;
    }
    if ($this->data['User']['role'] == 'Propietario') {
      $check['User.ci'] = $this->data['User']['ci'];
      $check['User.role'] = $this->data['User']['role'];
      $check['User.edificio_id'] = $this->data['User']['edificio_id'];
      $existingPromoCount = $this->find('count', array(
        'conditions' => $check,
        'recursive' => -1
      ));
      return $existingPromoCount < $limit;
    }else{
      return TRUE;
    }
  }

  public $belongsTo = array(
    'Edificio' => array(
      'className' => 'Edificio',
      'foreignKey' => 'edificio_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    )
  );

}
