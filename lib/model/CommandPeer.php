<?php

/**
 * Subclass for performing query and update operations on the 'command' table.
 *
 * 
 *
 * @package lib.model
 */ 
class CommandPeer extends BaseCommandPeer
{
  public static function getConfig()
  {
    require_once('lib/helper/TemplateTokenHelper.php');
    
    $tpl = getTemplate('command');
    
    $cfg = '';
    
    $c = new Criteria();
    $commands = self::doSelect($c);
    
    foreach($commands as $command)
    {
      $cfg .= replace_template_tokens($tpl->getContent(), $command->toArray(), '%')."\n\n";
    }
    
    return $cfg;
  }
}
