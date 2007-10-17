<?php

/**
 * Subclass for representing a row from the 'service_to_host' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ServiceToHost extends BaseServiceToHost
{
  public function getParameter()
  {
    $o = HostServiceParamPeer::retrieveByPK($this->getHostId(),$this->getServiceId());
    return $o != null ? $o->getParameter() : '';
  }
  public function getSpecial()
  {
    $o = HostServiceParamPeer::retrieveByPK($this->getHostId(),$this->getServiceId());
    return $o != null ? $o->getSpecial() : '';
  }
}
