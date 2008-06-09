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
 * Subclass for representing a row from the 'contact' table.
 */ 
class Contact extends BaseContact
{
  private static $VALID_DIRECTIVES = array(
    'contact_name',
    'alias',
    'contactgroups',
    'host_notifications_enabled',
    'service_notifications_enabled',
    'host_notification_period',
    'service_notification_period',
    'host_notification_options',
    'service_notification_options',
    'host_notification_commands',
    'service_notification_commands',
    'email',
    'pager',
    'address1',
    'address2',
    'address3',
    'address4',
    'address5',
    'address6',
    'can_submit_commands',
    'retain_status_information',
    'retain_nonstatus_information',
    'use'
  );

  public function __toString()
  {
    return $this->getAlias();
  }

  public function getContactGroupsCount()
  {
    return $this->countGroupToContacts();
  }
  
  public function getValidDirectives()
  {
    return self::$VALID_DIRECTIVES;
  }
}
