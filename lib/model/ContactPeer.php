<?php

/**
 * Subclass for performing query and update operations on the 'contact' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ContactPeer extends BaseContactPeer
{
  public static function getConfig()
  {
    require_once('lib/helper/TemplateTokenHelper.php');
    
    $tpl = getTemplate('contact');
    
    $cfg = '';
    
    $c = new Criteria();
    $contacts = self::doSelect($c);
    
    foreach($contacts as $contact)
    {
      $cfg .= replace_template_tokens($tpl->getContent(), $contact->toArray(), '%')."\n\n";
    }
    
    return $cfg;
  }
}
