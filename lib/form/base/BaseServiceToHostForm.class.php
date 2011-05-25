<?php

/**
 * ServiceToHost form base class.
 *
 * @package    nagiosadmin
 * @subpackage form
 * @author     Your name here
 */
class BaseServiceToHostForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'service_id' => new sfWidgetFormInputHidden(),
      'host_id'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'service_id' => new sfValidatorPropelChoice(array('model' => 'Service', 'column' => 'id', 'required' => false)),
      'host_id'    => new sfValidatorPropelChoice(array('model' => 'Host', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('service_to_host[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ServiceToHost';
  }


}
