<?php

/**
 * HostServiceParam form base class.
 *
 * @method HostServiceParam getObject() Returns the current form's model object
 *
 * @package    nagiosadmin
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseHostServiceParamForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'host_id'    => new sfWidgetFormInputHidden(),
      'service_id' => new sfWidgetFormInputHidden(),
      'parameter'  => new sfWidgetFormInputText(),
      'special'    => new sfWidgetFormTextarea(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'host_id'    => new sfValidatorPropelChoice(array('model' => 'Host', 'column' => 'id', 'required' => false)),
      'service_id' => new sfValidatorPropelChoice(array('model' => 'Service', 'column' => 'id', 'required' => false)),
      'parameter'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'special'    => new sfValidatorString(array('required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('host_service_param[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'HostServiceParam';
  }


}
