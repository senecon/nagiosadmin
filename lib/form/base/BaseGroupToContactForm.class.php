<?php

/**
 * GroupToContact form base class.
 *
 * @package    nagiosadmin
 * @subpackage form
 * @author     Your name here
 */
class BaseGroupToContactForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'group_id'   => new sfWidgetFormInputHidden(),
      'contact_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'group_id'   => new sfValidatorPropelChoice(array('model' => 'ContactGroup', 'column' => 'id', 'required' => false)),
      'contact_id' => new sfValidatorPropelChoice(array('model' => 'Contact', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('group_to_contact[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GroupToContact';
  }


}
