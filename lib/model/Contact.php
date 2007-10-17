<?php

/**
 * Subclass for representing a row from the 'contact' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Contact extends BaseContact
{
  public function __toString()
  {
    return $this->getAlias();
  }

  public function getContactGroupsCount()
  {
    return $this->countGroupToContacts();
  }
}
