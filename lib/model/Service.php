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
 * Subclass for representing a row from the 'service' table.
 */ 
class Service extends BaseService
{
  private static $VALID_DIRECTIVES = array(
    'host_name',
    'hostgroup_name',
    'service_description',
    'display_name',
    'servicegroups',
    'is_volatile',
    'check_command',
    'initial_state',
    'max_check_attempts',
    'check_interval',
    'retry_interval',
    'active_checks_enabled',
    'passive_checks_enabled',
    'check_period',
    'obsess_over_service',
    'check_freshness',
    'freshness_threshold',
    'event_handler',
    'event_handler_enabled',
    'low_flap_threshold',
    'high_flap_threshold',
    'flap_detection_enabled',
    'flap_detection_options',
    'process_perf_data',
    'retain_status_information',
    'retain_nonstatus_information',
    'notification_interval',
    'first_notification_delay',
    'notification_period',
    'notification_options',
    'notifications_enabled',
    'contacts',
    'contact_groups',
    'stalking_options',
    'notes',
    'notes_url',
    'action_url',
    'icon_image',
    'icon_image_alt'
  );

  public function __toString()
  {
    return $this->getAlias();
  }
  
  public function toArray($keyType = BasePeer::TYPE_PHPNAME)
  {
    $result = parent::toArray($keyType);
    $result['command'] = $this->getCommand()->getName();
    
    return $result;
  }
  
  public function getValidDirectives()
  {
    return self::$VALID_DIRECTIVES;
  }
}
