<?php

/**
 * Subclass for representing a row from the 'service' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Service extends BaseService
{
  public function __toString()
  {
    return $this->getAlias();
  }
  
  public function toArray($keyType = BasePeer::TYPE_PHPNAME)
  {
    $result = parent::toArray($keyType);
    $result['command'] = $this->getCommand()->getName();
    
    return $result;
  }
}
