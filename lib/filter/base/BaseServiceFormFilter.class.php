<?php

/**
 * Service filter form base class.
 *
 * @package    nagiosadmin
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseServiceFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'alias'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'command_id'              => new sfWidgetFormPropelChoice(array('model' => 'Command', 'add_empty' => true)),
      'port'                    => new sfWidgetFormFilterInput(),
      'special'                 => new sfWidgetFormFilterInput(),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'host_service_param_list' => new sfWidgetFormPropelChoice(array('model' => 'Host', 'add_empty' => true)),
      'service_to_host_list'    => new sfWidgetFormPropelChoice(array('model' => 'Host', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                    => new sfValidatorPass(array('required' => false)),
      'alias'                   => new sfValidatorPass(array('required' => false)),
      'command_id'              => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Command', 'column' => 'id')),
      'port'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'special'                 => new sfValidatorPass(array('required' => false)),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'host_service_param_list' => new sfValidatorPropelChoice(array('model' => 'Host', 'required' => false)),
      'service_to_host_list'    => new sfValidatorPropelChoice(array('model' => 'Host', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('service_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addHostServiceParamListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(HostServiceParamPeer::SERVICE_ID, ServicePeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(HostServiceParamPeer::HOST_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(HostServiceParamPeer::HOST_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function addServiceToHostListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(ServiceToHostPeer::SERVICE_ID, ServicePeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(ServiceToHostPeer::HOST_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(ServiceToHostPeer::HOST_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Service';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'name'                    => 'Text',
      'alias'                   => 'Text',
      'command_id'              => 'ForeignKey',
      'port'                    => 'Number',
      'special'                 => 'Text',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
      'host_service_param_list' => 'ManyKey',
      'service_to_host_list'    => 'ManyKey',
    );
  }
}
