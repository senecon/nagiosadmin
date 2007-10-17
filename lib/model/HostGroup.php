<?php

/**
 * Subclass for representing a row from the 'host_group' table.
 *
 * 
 *
 * @package lib.model
 */ 
class HostGroup extends BaseHostGroup
{
  public function __toString()
  {
    return $this->getAlias();
  }
  
  public function toArray($keyType = BasePeer::TYPE_PHPNAME)
  {
    $result = parent::toArray($keyType);
    
    $hosts = $this->getHosts();
    $ha = array();
    foreach($hosts as $host)
    {
      $ha[] = $host->getName();
    }
    $result['hosts'] = implode(', ',$ha);
    
    return $result;
  }

  public function getHostsCount()
  {
    return $this->countHosts();
  }
}
