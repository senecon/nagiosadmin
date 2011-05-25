<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ContactGroup filter form base class.
 *
 * @package    nagiosadmin
 * @subpackage filter
 * @author     Your name here
 */
class BaseContactGroupFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                       => new sfWidgetFormFilterInput(),
      'alias'                      => new sfWidgetFormFilterInput(),
      'special'                    => new sfWidgetFormFilterInput(),
      'created_at'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'host_to_contact_group_list' => new sfWidgetFormPropelChoice(array('model' => 'Host', 'add_empty' => true)),
      'group_to_contact_list'      => new sfWidgetFormPropelChoice(array('model' => 'Contact', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                       => new sfValidatorPass(array('required' => false)),
      'alias'                      => new sfValidatorPass(array('required' => false)),
      'special'                    => new sfValidatorPass(array('required' => false)),
      'created_at'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'host_to_contact_group_list' => new sfValidatorPropelChoice(array('model' => 'Host', 'required' => false)),
      'group_to_contact_list'      => new sfValidatorPropelChoice(array('model' => 'Contact', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contact_group_filters[%s]');

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

    $criteria->addJoin(HostToContactGroupPeer::CONTACT_GROUP_ID, ContactGroupPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(HostToContactGroupPeer::HOST_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(HostToContactGroupPeer::HOST_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function addGroupToContactListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(GroupToContactPeer::GROUP_ID, ContactGroupPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(GroupToContactPeer::CONTACT_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(GroupToContactPeer::CONTACT_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'ContactGroup';
  }

  public function getFields()
  {
    return array(
      'id'                         => 'Number',
      'name'                       => 'Text',
      'alias'                      => 'Text',
      'special'                    => 'Text',
      'created_at'                 => 'Date',
      'updated_at'                 => 'Date',
      'host_to_contact_group_list' => 'ManyKey',
      'group_to_contact_list'      => 'ManyKey',
    );
  }
}
