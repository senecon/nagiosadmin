<?php

/**
 * Template form base class.
 *
 * @method Template getObject() Returns the current form's model object
 *
 * @package    nagiosadmin
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTemplateForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'type'       => new sfWidgetFormInputText(),
      'name'       => new sfWidgetFormInputText(),
      'alias'      => new sfWidgetFormInputText(),
      'content'    => new sfWidgetFormTextarea(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'type'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
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
