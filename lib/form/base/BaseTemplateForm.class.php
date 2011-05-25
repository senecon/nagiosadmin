<?php

/**
 * Template form base class.
 *
 * @package    nagiosadmin
 * @subpackage form
 * @author     Your name here
 */
class BaseTemplateForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'type'       => new sfWidgetFormInput(),
      'name'       => new sfWidgetFormInput(),
      'alias'      => new sfWidgetFormInput(),
      'content'    => new sfWidgetFormTextarea(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'Template', 'column' => 'id', 'required' => false)),
      'type'       => new sfValidatorInteger(),
      'name'       => new sfValidatorString(array('max_length' => 255)),
      'alias'      => new sfValidatorString(array('max_length' => 255)),
      'content'    => new sfValidatorString(),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('template[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Template';
  }


}
