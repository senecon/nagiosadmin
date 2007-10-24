<?php

/**
 * Subclass for representing a row from the 'template' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Template extends BaseTemplate
{

  protected $template_names = array(
    'command',
    'contact',
    'contactgroup',
    'generic-contact',
    'generic-host',
    'generic-service',
    'host',
    'hostgroup',
    'service'
  );
  
  public function delete($con = null)
  {
    if (in_array($this->getName(),$this->template_names))
    {
      throw new PropelException("This Template is needed by nagios admin.");
    }
    else
    {
      parent::delete($con);
    }
  }

  public function getContentSummary()
  {
    return strlen($this->getContent()) > 60 ? substr($this->getContent(),0,60).'...' : $this->getContent();
  }

}
