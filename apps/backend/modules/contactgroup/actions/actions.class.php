<?php

/**
 * contactgroup actions.
 *
 * @package    nagiosadmin
 * @subpackage contactgroup
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class contactgroupActions extends autocontactgroupActions
{
  public function executeDebug()
  {
    $this->grp = $this->getContactGroupOrCreate();
  }
}
