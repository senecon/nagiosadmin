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
 * Subclass for representing a row from the 'host_group' table.
 */ 
class HostGroup extends BaseHostGroup
{
  private static $VALID_DIRECTIVES = array(
    'hostgroup_name',
    'alias',
    'members',
    'hostgroup_members',
    'notes',
    'notes_url',
    'action_url'
  );

  public function __toString()
  {
    return $this->getAlias();
  }
  
  public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
  {
    $result = parent::toArray($keyType);
    
    $hosts = $this->getHosts();
    $ha = array();
    foreach($hosts as $host)
    {
      $ha[] = $host->getName();
    }
    $result['hosts'] = implode(', ',$ha);
    
    return $result;
  }

  public function getHostsCount()
  {
    return $this->countHosts();
  }
  
  public function getValidDirectives()
  {
    return self::$VALID_DIRECTIVES;
  }
}
