<?php
/**
 * $Id$
 *
 * Copyright 2008 secure-net-concepts <info@secure-net-concepts.de>
 *
 * This file is part of Nagios Administrator http://www.nagiosadmin.de.
 *
 * Nagios Administrator is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Nagios Administrator is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Nagios Administrator. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    nagiosadmin
 * @subpackage host
 * @license    http://www.gnu.org/licenses/gpl.html
 * @link       www.nagiosadmin.de
 * @version    $Revision$
 * @author     Henrik Westphal <westphal@secure-net-concepts.de>
 */

/**
 * host actions.
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

    return sfView::HEADER_ONLY;
  }

  public function executeServiceparameters()
  {
    $this->host = $this->getHostOrCreate();
    $this->services = $this->host->getServices();
  }

  /*
  public function handleErrorSaveserviceparameters()
  {
    $this->preExecute();
    $this->host = $this->getHostOrCreate();
    $this->updateHostFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }
*/
  
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
