<?php

/**
 * ServiceToHost filter form base class.
 *
 * @package    nagiosadmin
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseServiceToHostFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('service_to_host_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ServiceToHost';
  }

  public function getFields()
  {
    return array(
      'service_id' => 'ForeignKey',
      'host_id'    => 'ForeignKey',
    );
  }
}
