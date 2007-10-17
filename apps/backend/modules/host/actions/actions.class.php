<?php

/**
 * host actions.
 *
 * @package    nagiosadmin
 * @subpackage host
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class hostActions extends autohostActions
{
  public function executePortscan()
  {
    if($this->getRequestParameter('ip'))
    {
      $ip = $this->getRequestParameter('ip');
    }
    else
    {
      $host = $this->getHostOrCreate();
      $ip = $host->getAddress();
    }
    
    // services with port != null
    $c = new Criteria();
    $c->add(ServicePeer::PORT,0,Criteria::GREATER_THAN);
    $services = ServicePeer::doSelect($c);
    
    require_once 'PEAR/Info.php';
    
    if(PEAR_Info::packageInstalled('Net_Portscan'))
    {
      require_once('Net/Portscan.php');
      $ps = new Net_Portscan();
      
      $this->services = array();
      $ports = array();
      foreach($services as $service)
      {
        if(!array_key_exists($service->getPort(), $ports))
        {
          $ports[$service->getPort()] = $ps->checkPort($ip,$service->getPort(),5);
        }
        if($ports[$service->getPort()])
        {
          $this->services[] = 'associated_services_'.$service->getId();
        }
      }
      $this->getResponse()->setHttpHeader("X-JSON", '('.json_encode(array('services' => $this->services)).')');
    }
    else
    {
      $this->getResponse()->setHttpHeader("X-JSON", '('.json_encode(array('error' => 'PEAR Package Net_Portscan is missing.')).')');
    }
    
    return sfView::HEADER_ONLY;
  }
  
  public function executeServiceparameters()
  {
    $this->host = $this->getHostOrCreate();
    $this->services = $this->host->getServices();
  }
  
  public function executeSaveserviceparameters()
  {
    $host = $this->getHostOrCreate();
    
    foreach($this->getRequestParameter('sp') as $id => $params)
    {
        $s2h = HostServiceParamPeer::retrieveByPK($host->getId(),$id);
        if($s2h == null)
        {
           $s2h = new HostServiceParam();
           $s2h->setHostId($host->getId());
           $s2h->setServiceId($id);
        }
        $s2h->setParameter($params['param']);
        $s2h->setSpecial($params['special']);
        $s2h->save();
    }
    
    $this->setFlash('notice', 'Your modifications have been saved');
    
    if($this->getRequestParameter('save')) $this->redirect('host/serviceparameters?id='.$host->getId());
    if($this->getRequestParameter('save_and_list')) $this->redirect('host/list?id='.$host->getId());
  }
}
