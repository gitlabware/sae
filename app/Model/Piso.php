<?php

App::uses('AppModel', 'Model');

/**
 * Piso Model
 *
 * @property Edificio $Edificio
 */
class Piso extends AppModel {
  //The Associations below have been created with all possible keys, those that are not needed can be removed

  /**
   * belongsTo associations
   *
   * @var array
   */
  public $validate = array(
    'nombre' => array(
      'notEmpty' => array(
        'rule' => array('notEmpty'),
        'message' => 'Es Necesario ingresar el Nombre'
      ),
      'limitDuplicates_nombre' => array(
        'rule' => array('limitDuplicates_nombre', 1),
        'message' => 'El nombre ya existe!!'
      )
    )
  );

  public function limitDuplicates_nombre($check, $limit) {
    // $check will have value: array('promotion_code' => 'some-value')
    // $limit will have value: 25
    if (!empty($this->data['Piso']['id'])) {
      $check['Piso.id !='] = $this->data['Piso']['id'];
    }
    if (!empty($this->data['Piso']['edificio_id'])) {
      $check['Piso.edificio_id'] = $this->data['Piso']['edificio_id'];
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
