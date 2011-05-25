<?php
/**
 * $Id$
 *
 * Copyright 2008 secure-net-concepts <info@secure-net-concepts.de>
 *
 * This file is part of Nagios Administrator http://www.nagiosadmin.de.
 *
 * Nagios Administrator is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Nagios Administrator is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Nagios Administrator. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    nagiosadmin
 * @subpackage lib.model
 * @license    http://www.gnu.org/licenses/gpl.html
 * @link       www.nagiosadmin.de
 * @version    $Revision$
 * @author     Henrik Westphal <westphal@secure-net-concepts.de>
 */

/**
 * Subclass for representing a row from the 'contact_group' table.
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
  
  public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
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
