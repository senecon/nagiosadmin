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
    'addressx',
    'can_submit_commands',
    'retain_status_information',
    'retain_nonstatus_information'
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
