<?php

/**
 * Subclass for representing a row from the 'host' table.
 *
 *
 *
 * @package lib.model
 */
class Host extends BaseHost
{
  private static $VALID_DIRECTIVES = array(
    'host_name',
    'alias',
    'display_name',
    'address',
    'parents',
    'hostgroups',
    'check_command',
    'initial_state',
    'max_check_attempts',
    'check_interval',
    'retry_interval',
    'active_checks_enabled',
    'passive_checks_enabled',
    'check_period',
    'obsess_over_host',
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
    'contacts',
    'contact_groups',
    'notification_interval',
    'first_notification_delay',
    'notification_period',
    'notification_options',
    'notifications_enabled',
    'stalking_options',
    'notes',
    'notes_url',
    'action_url',
    'icon_image',
    'icon_image_alt',
    'vrml_image',
    'statusmap_image',
    '2d_coords',
    '3d_coords'
  );

  public function __toString()
  {
    return $this->getAlias().' ('.$this->getName().')';
  }

  public function getGroupName()
  {
    return $this->getHostGroup()->getAlias();
  }

  public function getServices()
  {
    return $this->getServiceToHostsJoinService();
  }

  public function getContactGroups()
  {
    return $this->getHostToContactGroupsJoinContactGroup();
  }

  public function toArray($keyType = BasePeer::TYPE_PHPNAME)
  {
    $result = parent::toArray($keyType);

    $result['image'] = $this->getOs() ? $this->getOs()->getImage() : 'default.jpg';

    $contactgroups = $this->getContactGroups();
    $ca = array();
    foreach($contactgroups as $g2c)
    {
      $ca[] = $g2c->getContactGroup()->getName();
    }
    $result['contactgroups'] = implode(', ',$ca);

    return $result;
  }
  
  public function getValidDirectives()
  {
    return self::$VALID_DIRECTIVES;
  }
}
