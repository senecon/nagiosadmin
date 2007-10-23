<?php

/**
 * Subclass for performing query and update operations on the 'host' table.
 *
 * 
 *
 * @package lib.model
 */ 
class HostPeer extends BaseHostPeer
{
  public static function getConfig()
  {
    require_once('lib/helper/TemplateTokenHelper.php');
    // may be better via: sfLoader::loadHelpers(array('TemplateToken'));
    
    $tpl = getTemplate('host');
    $tpl_service = getTemplate('service');
    
    $cfg = '';
    
    $c = new Criteria();
    $hosts = self::doSelect($c);
    
    foreach($hosts as $host)
    {
      $ha = $host->toArray();
      $ha['lastupdate'] = $host->getUpdatedAt();
      
      $cfg .= replace_template_tokens($tpl->getContent(), $ha, '%')."\n\n";
      
      foreach($host->getServices() as $s2h)
      {
        $data = $s2h->getService()->toArray();
        $data['hostname'] = $host->getName();
        $data['contactgroups'] = $ha['contactgroups'];

        $params = HostServiceParamPeer::retrieveByPK($host->getId(),$s2h->getService()->getId());
        $data['parameters'] = $params ? $params->getParameter() : '';
        $data['hostspecial'] = $params ? $params->getSpecial() : '';

        $cfg .= replace_template_tokens($tpl_service->getContent(), $data, '%')."\n\n";
      }
    }
    
    return $cfg; //beautyContent($cfg);
  }
}
