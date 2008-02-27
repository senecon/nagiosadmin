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
  private static $VALID_DIRECTIVES = array(
    'command_name',
    'command_line'
  );

  public function __toString()
  {
    return $this->getName();
  }
  
  public function getCommandSummary()
  {
    return strlen($this->getCommand()) > 60 ? substr($this->getCommand(),0,60).'...' : $this->getCommand();
  }
  
  public function getValidDirectives()
  {
    return self::$VALID_DIRECTIVES;
  }
}
