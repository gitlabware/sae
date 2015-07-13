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
