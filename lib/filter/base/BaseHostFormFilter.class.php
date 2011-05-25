<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Host filter form base class.
 *
 * @package    nagiosadmin
 * @subpackage filter
 * @author     Your name here
 */
class BaseHostFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'group_id'                   => new sfWidgetFormPropelChoice(array('model' => 'HostGroup', 'add_empty' => true)),
      'name'                       => new sfWidgetFormFilterInput(),
      'alias'                      => new sfWidgetFormFilterInput(),
      'address'                    => new sfWidgetFormFilterInput(),
      'special'                    => new sfWidgetFormFilterInput(),
      'os_id'                      => new sfWidgetFormPropelChoice(array('model' => 'Os', 'add_empty' => true)),
      'created_at'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'host_to_contact_group_list' => new sfWidgetFormPropelChoice(array('model' => 'ContactGroup', 'add_empty' => true)),
      'host_service_param_list'    => new sfWidgetFormPropelChoice(array('model' => 'Service', 'add_empty' => true)),
      'service_to_host_list'       => new sfWidgetFormPropelChoice(array('model' => 'Service', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'group_id'                   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'HostGroup', 'column' => 'id')),
      'name'                       => new sfValidatorPass(array('required' => false)),
      'alias'                      => new sfValidatorPass(array('required' => false)),
      'address'                    => new sfValidatorPass(array('required' => false)),
      'special'                    => new sfValidatorPass(array('required' => false)),
      'os_id'                      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Os', 'column' => 'id')),
      'created_at'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'host_to_contact_group_list' => new sfValidatorPropelChoice(array('model' => 'ContactGroup', 'required' => false)),
      'host_service_param_list'    => new sfValidatorPropelChoice(array('model' => 'Service', 'required' => false)),
      'service_to_host_list'       => new sfValidatorPropelChoice(array('model' => 'Service', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('host_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addHostToContactGroupListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(HostToContactGroupPeer::HOST_ID, HostPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(HostToContactGroupPeer::CONTACT_GROUP_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(HostToContactGroupPeer::CONTACT_GROUP_ID, $value));
    }

    $criteria->add($criterion);
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

    $criteria->addJoin(HostServiceParamPeer::HOST_ID, HostPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(HostServiceParamPeer::SERVICE_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(HostServiceParamPeer::SERVICE_ID, $value));
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

    $criteria->addJoin(ServiceToHostPeer::HOST_ID, HostPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(ServiceToHostPeer::SERVICE_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(ServiceToHostPeer::SERVICE_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Host';
  }

  public function getFields()
  {
    return array(
      'id'                         => 'Number',
      'group_id'                   => 'ForeignKey',
      'name'                       => 'Text',
      'alias'                      => 'Text',
      'address'                    => 'Text',
      'special'                    => 'Text',
      'os_id'                      => 'ForeignKey',
      'created_at'                 => 'Date',
      'updated_at'                 => 'Date',
      'host_to_contact_group_list' => 'ManyKey',
      'host_service_param_list'    => 'ManyKey',
      'service_to_host_list'       => 'ManyKey',
    );
  }
}
