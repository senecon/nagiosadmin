<?php

/**
 * Subclass for representing a row from the 'host' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Host extends BaseHost
{
  public function __toString()
  {
    return $this->getAlias().' ('.$this->getName().')';
  }
  
  public function getGroupName()
  {
    return $this->getHostGroup()->getAlias();
  }
  
  public function getServices()
  {
    return $this->getServiceToHostsJoinService();
  }

  public function getContactGroups()
  {
    return $this->getHostToContactGroupsJoinContactGroup();
  }
  
  public function toArray($keyType = BasePeer::TYPE_PHPNAME)
  {
    $result = parent::toArray($keyType);
    
    $result['image'] = $this->getOs() ? $this->getOs()->getImage() : 'default.jpg';
    
    $contactgroups = $this->getContactGroups();
    $ca = array();
    foreach($contactgroups as $g2c)
    {
      $ca[] = $g2c->getContactGroup()->getName();
    }
    $result['contactgroups'] = implode(', ',$ca);

    return $result;
  }
}
