<?php

/**
 * Contact filter form base class.
 *
 * @package    nagiosadmin
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseContactFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'alias'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'special'               => new sfWidgetFormFilterInput(),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'group_to_contact_list' => new sfWidgetFormPropelChoice(array('model' => 'ContactGroup', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                  => new sfValidatorPass(array('required' => false)),
      'alias'                 => new sfValidatorPass(array('required' => false)),
      'email'                 => new sfValidatorPass(array('required' => false)),
      'special'               => new sfValidatorPass(array('required' => false)),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'group_to_contact_list' => new sfValidatorPropelChoice(array('model' => 'ContactGroup', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contact_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
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

    $criteria->addJoin(GroupToContactPeer::CONTACT_ID, ContactPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(GroupToContactPeer::GROUP_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(GroupToContactPeer::GROUP_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Contact';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'name'                  => 'Text',
      'alias'                 => 'Text',
      'email'                 => 'Text',
      'special'               => 'Text',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
      'group_to_contact_list' => 'ManyKey',
    );
  }
}
