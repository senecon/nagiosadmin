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
}
