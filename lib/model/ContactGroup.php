<?php

/**
 * Subclass for representing a row from the 'contact_group' table.
 *
 * @package lib.model
 */ 
class ContactGroup extends BaseContactGroup
{
  private static $VALID_DIRECTIVES = array(
    'contactgroup_name',
    'alias',
    'members',
    'contactgroup_members'
  );

  public function __toString()
  {
    return $this->getAlias().' ('.$this->getName().')';
  }
  
  /**
   * returs all contacts belonging to this group
   *
   * @return array
   */
  public function getContacts()
  {
    return $this->getGroupToContactsJoinContact();
  }
  
  public function toArray($keyType = BasePeer::TYPE_PHPNAME)
  {
    $result = parent::toArray($keyType);
    
    $contacts = $this->getContacts();
    $ca = array();
    foreach($contacts as $g2c)
    {
      $ca[] = $g2c->getContact()->getName();
    }
    $result['contacts'] = implode(', ',$ca);
    
    return $result;
  }
  
  public function getContactsCount()
  {
    return $this->countGroupToContacts();
  }

  public function getHostsCount()
  {
    return $this->countHostToContactGroups();
  }
  
  public function getValidDirectives()
  {
    return self::$VALID_DIRECTIVES;
  }
}
