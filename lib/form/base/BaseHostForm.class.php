<?php

/**
 * Host form base class.
 *
 * @package    nagiosadmin
 * @subpackage form
 * @author     Your name here
 */
class BaseHostForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                         => new sfWidgetFormInputHidden(),
      'group_id'                   => new sfWidgetFormPropelChoice(array('model' => 'HostGroup', 'add_empty' => false)),
      'name'                       => new sfWidgetFormInput(),
      'alias'                      => new sfWidgetFormInput(),
      'address'                    => new sfWidgetFormInput(),
      'special'                    => new sfWidgetFormTextarea(),
      'os_id'                      => new sfWidgetFormPropelChoice(array('model' => 'Os', 'add_empty' => true)),
      'created_at'                 => new sfWidgetFormDateTime(),
      'updated_at'                 => new sfWidgetFormDateTime(),
      'host_to_contact_group_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'ContactGroup')),
      'host_service_param_list'    => new sfWidgetFormPropelChoiceMany(array('model' => 'Service')),
      'service_to_host_list'       => new sfWidgetFormPropelChoiceMany(array('model' => 'Service')),
    ));

    $this->setValidators(array(
      'id'                         => new sfValidatorPropelChoice(array('model' => 'Host', 'column' => 'id', 'required' => false)),
      'group_id'                   => new sfValidatorPropelChoice(array('model' => 'HostGroup', 'column' => 'id')),
      'name'                       => new sfValidatorString(array('max_length' => 255)),
      'alias'                      => new sfValidatorString(array('max_length' => 255)),
      'address'                    => new sfValidatorString(array('max_length' => 255)),
      'special'                    => new sfValidatorString(array('required' => false)),
      'os_id'                      => new sfValidatorPropelChoice(array('model' => 'Os', 'column' => 'id', 'required' => false)),
      'created_at'                 => new sfValidatorDateTime(array('required' => false)),
      'updated_at'                 => new sfValidatorDateTime(array('required' => false)),
      'host_to_contact_group_list' => new sfValidatorPropelChoiceMany(array('model' => 'ContactGroup', 'required' => false)),
      'host_service_param_list'    => new sfValidatorPropelChoiceMany(array('model' => 'Service', 'required' => false)),
      'service_to_host_list'       => new sfValidatorPropelChoiceMany(array('model' => 'Service', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('host[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Host';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['host_to_contact_group_list']))
    {
      $values = array();
      foreach ($this->object->getHostToContactGroups() as $obj)
      {
        $values[] = $obj->getContactGroupId();
      }

      $this->setDefault('host_to_contact_group_list', $values);
    }

    if (isset($this->widgetSchema['host_service_param_list']))
    {
      $values = array();
      foreach ($this->object->getHostServiceParams() as $obj)
      {
        $values[] = $obj->getServiceId();
      }

      $this->setDefault('host_service_param_list', $values);
    }

    if (isset($this->widgetSchema['service_to_host_list']))
    {
      $values = array();
      foreach ($this->object->getServiceToHosts() as $obj)
      {
        $values[] = $obj->getServiceId();
      }

      $this->setDefault('service_to_host_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveHostToContactGroupList($con);
    $this->saveHostServiceParamList($con);
    $this->saveServiceToHostList($con);
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
    $c->add(HostToContactGroupPeer::HOST_ID, $this->object->getPrimaryKey());
    HostToContactGroupPeer::doDelete($c, $con);

    $values = $this->getValue('host_to_contact_group_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new HostToContactGroup();
        $obj->setHostId($this->object->getPrimaryKey());
        $obj->setContactGroupId($value);
        $obj->save();
      }
    }
  }

  public function saveHostServiceParamList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['host_service_param_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(HostServiceParamPeer::HOST_ID, $this->object->getPrimaryKey());
    HostServiceParamPeer::doDelete($c, $con);

    $values = $this->getValue('host_service_param_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new HostServiceParam();
        $obj->setHostId($this->object->getPrimaryKey());
        $obj->setServiceId($value);
        $obj->save();
      }
    }
  }

  public function saveServiceToHostList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['service_to_host_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(ServiceToHostPeer::HOST_ID, $this->object->getPrimaryKey());
    ServiceToHostPeer::doDelete($c, $con);

    $values = $this->getValue('service_to_host_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new ServiceToHost();
        $obj->setHostId($this->object->getPrimaryKey());
        $obj->setServiceId($value);
        $obj->save();
      }
    }
  }

}
