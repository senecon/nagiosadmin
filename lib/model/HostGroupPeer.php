<?php

/**
 * Subclass for performing query and update operations on the 'host_group' table.
 *
 * 
 *
 * @package lib.model
 */ 
class HostGroupPeer extends BaseHostGroupPeer
{
  public static function getConfig()
  {
    require_once('lib/helper/TemplateTokenHelper.php');
    
    $tpl = getTemplate('hostgroup');
    
    $cfg = '';
    
    $c = new Criteria();
    $hostgroups = self::doSelect($c);
    
    foreach($hostgroups as $hostgroup)
    {
      if($hostgroup->countHosts()) $cfg .= replace_template_tokens($tpl->getContent(), $hostgroup->toArray(), '%')."\n\n";
    }
    
    return $cfg;
  }
}
