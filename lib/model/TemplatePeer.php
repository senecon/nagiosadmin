<?php

/**
 * Subclass for performing query and update operations on the 'template' table.
 *
 * 
 *
 * @package lib.model
 */ 
class TemplatePeer extends BaseTemplatePeer
{
  const T_DYNAMIC = 0;
  const T_STATIC = 1;

  public static function getConfig()
  {
    sfLoader::loadHelpers('TemplateToken');
    
    $c = new Criteria();
    $c->add(TemplatePeer::TYPE,TemplatePeer::T_STATIC,Criteria::EQUAL);
    $tpls = TemplatePeer::doSelect($c);
    
    $cfg = '';

    foreach($tpls as $tpl)
    {
      $cfg .= beautyContent($tpl->getContent())."\n\n";
    }
    
    return $cfg;
  }
}
