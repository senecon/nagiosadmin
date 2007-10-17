<?php

/**
 * Subclass for performing query and update operations on the 'contact_group' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ContactGroupPeer extends BaseContactGroupPeer
{
  public static function getConfig()
  {
    require_once('lib/helper/TemplateTokenHelper.php');
    
    $tpl = getTemplate('contactgroup');
    
    $cfg = '';
    
    $c = new Criteria();
    $contactgroups = self::doSelect($c);
    
    foreach($contactgroups as $contactgroup)
    {
      if($contactgroup->countGroupToContacts()) $cfg .= replace_template_tokens($tpl->getContent(), $contactgroup->toArray(), '%')."\n\n";
    }
    
    return $cfg;
  }
}