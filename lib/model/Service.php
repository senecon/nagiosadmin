<?php

/**
 * Subclass for representing a row from the 'service' table.
 *
 * 
 *
 * @package lib.model
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
