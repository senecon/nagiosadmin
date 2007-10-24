<?php

/**
 * Subclass for representing a row from the 'command' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Command extends BaseCommand
{
  public function __toString()
  {
    return $this->getAlias();
  }
  
  public function getCommandSummary()
  {
    return strlen($this->getCommand()) > 60 ? substr($this->getCommand(),0,60).'...' : $this->getCommand();
  }
}
