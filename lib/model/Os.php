<?php

/**
 * Subclass for representing a row from the 'os' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Os extends BaseOs
{
  public function __toString()
  {
    return $this->getName();
  }

  public function getHostsCount()
  {
    return $this->countHosts();
  }
}
