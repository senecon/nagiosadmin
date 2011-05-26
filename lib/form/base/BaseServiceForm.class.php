<?php

/**
 * Service form base class.
 *
 * @method Service getObject() Returns the current form's model object
 *
 * @package    nagiosadmin
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseServiceForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'name'                    => new sfWidgetFormInputText(),
      'alias'                   => new sfWidgetFormInputText(),
      'command_id'              => new sfWidgetFormPropelChoice(array('model' => 'Command', 'add_empty' => false)),
      'port'                    => new sfWidgetFormInputText(),
      'special'                 => new sfWidgetFormTextarea(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
      'host_service_param_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Host')),
      'service_to_host_list'    => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Host')),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'                    => new sfValidatorString(array('max_length' => 255)),
      'alias'                   => new sfValidatorString(array('max_length' => 255)),
      'command_id'              => new sfValidatorPropelChoice(array('model' => 'Command', 'column' => 'id')),
      'port'                    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'special'                 => new sfValidatorString(array('required' => false)),
      'created_at'              => new sfValidatorDateTime(array('required' => false)),
      'updated_at'              => new sfValidatorDateTime(array('required' => false)),
      'host_service_param_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Host', 'required' => false)),
      'service_to_host_list'    => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Host', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('service[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Service';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['host_service_param_list']))
    {
      $values = array();
      foreach ($this->object->getHostServiceParams() as $obj)
      {
        $values[] = $obj->getHostId();
      }

      $this->setDefault('host_service_param_list', $values);
    }

    if (isset($this->widgetSchema['service_to_host_list']))
    {
      $values = array();
      foreach ($this->object->getServiceToHosts() as $obj)
      {
        $values[] = $obj->getHostId();
      }

      $this->setDefault('service_to_host_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveHostServiceParamList($con);
    $this->saveServiceToHostList($con);
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

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(HostServiceParamPeer::SERVICE_ID, $this->object->getPrimaryKey());
    HostServiceParamPeer::doDelete($c, $con);

    $values = $this->getValue('host_service_param_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new HostServiceParam();
        $obj->setServiceId($this->object->getPrimaryKey());
        $obj->setHostId($value);
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

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(ServiceToHostPeer::SERVICE_ID, $this->object->getPrimaryKey());
    ServiceToHostPeer::doDelete($c, $con);

    $values = $this->getValue('service_to_host_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new ServiceToHost();
        $obj->setServiceId($this->object->getPrimaryKey());
        $obj->setHostId($value);
        $obj->save();
      }
    }
  }

}
