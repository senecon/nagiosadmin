<?php

/**
 * ContactGroup form base class.
 *
 * @package    nagiosadmin
 * @subpackage form
 * @author     Your name here
 */
class BaseContactGroupForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                         => new sfWidgetFormInputHidden(),
      'name'                       => new sfWidgetFormInput(),
      'alias'                      => new sfWidgetFormInput(),
      'special'                    => new sfWidgetFormTextarea(),
      'created_at'                 => new sfWidgetFormDateTime(),
      'updated_at'                 => new sfWidgetFormDateTime(),
      'host_to_contact_group_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'Host')),
      'group_to_contact_list'      => new sfWidgetFormPropelChoiceMany(array('model' => 'Contact')),
    ));

    $this->setValidators(array(
      'id'                         => new sfValidatorPropelChoice(array('model' => 'ContactGroup', 'column' => 'id', 'required' => false)),
      'name'                       => new sfValidatorString(array('max_length' => 255)),
      'alias'                      => new sfValidatorString(array('max_length' => 255)),
      'special'                    => new sfValidatorString(array('required' => false)),
      'created_at'                 => new sfValidatorDateTime(array('required' => false)),
      'updated_at'                 => new sfValidatorDateTime(array('required' => false)),
      'host_to_contact_group_list' => new sfValidatorPropelChoiceMany(array('model' => 'Host', 'required' => false)),
      'group_to_contact_list'      => new sfValidatorPropelChoiceMany(array('model' => 'Contact', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contact_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContactGroup';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['host_to_contact_group_list']))
    {
      $values = array();
      foreach ($this->object->getHostToContactGroups() as $obj)
      {
        $values[] = $obj->getHostId();
      }

      $this->setDefault('host_to_contact_group_list', $values);
    }

    if (isset($this->widgetSchema['group_to_contact_list']))
    {
      $values = array();
      foreach ($this->object->getGroupToContacts() as $obj)
      {
        $values[] = $obj->getContactId();
      }

      $this->setDefault('group_to_contact_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveHostToContactGroupList($con);
    $this->saveGroupToContactList($con);
  }

  public function saveHostToContactGroupList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['host_to_contact_group_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $this->object->getPrimaryKey());
    HostToContactGroupPeer::doDelete($c, $con);

    $values = $this->getValue('host_to_contact_group_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new HostToContactGroup();
        $obj->setContactGroupId($this->object->getPrimaryKey());
        $obj->setHostId($value);
        $obj->save();
      }
    }
  }

  public function saveGroupToContactList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['group_to_contact_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(GroupToContactPeer::GROUP_ID, $this->object->getPrimaryKey());
    GroupToContactPeer::doDelete($c, $con);

    $values = $this->getValue('group_to_contact_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new GroupToContact();
        $obj->setGroupId($this->object->getPrimaryKey());
        $obj->setContactId($value);
        $obj->save();
      }
    }
  }

}
