<?php

/**
 * HostToContactGroup form base class.
 *
 * @method HostToContactGroup getObject() Returns the current form's model object
 *
 * @package    nagiosadmin
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseHostToContactGroupForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'host_id'          => new sfWidgetFormInputHidden(),
      'contact_group_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'host_id'          => new sfValidatorPropelChoice(array('model' => 'Host', 'column' => 'id', 'required' => false)),
      'contact_group_id' => new sfValidatorPropelChoice(array('model' => 'ContactGroup', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('host_to_contact_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'HostToContactGroup';
  }


}
