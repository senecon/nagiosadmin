<?php

/**
 * GroupToContact filter form base class.
 *
 * @package    nagiosadmin
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseGroupToContactFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('group_to_contact_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GroupToContact';
  }

  public function getFields()
  {
    return array(
      'group_id'   => 'ForeignKey',
      'contact_id' => 'ForeignKey',
    );
  }
}
