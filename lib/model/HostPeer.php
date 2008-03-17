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
 * @subpackage lib.model
 * @license    http://www.gnu.org/licenses/gpl.html
 * @link       www.nagiosadmin.de
 * @version    $Revision$
 * @author     Henrik Westphal <westphal@secure-net-concepts.de>
 */

/**
 * Subclass for performing query and update operations on the 'host' table.
 */ 
class HostPeer extends BaseHostPeer
{
  public static function getConfig()
  {
    sfLoader::loadHelpers('TemplateToken');
    
    $tpl = getTemplate('host');
    $tpl_service = getTemplate('service');
    
    $cfg = COMMENT_HEADER;
    
    $c = new Criteria();
    $hosts = self::doSelect($c);
    
    foreach($hosts as $host)
    {
      $ha = $host->toArray();
      $ha['lastupdate'] = $host->getUpdatedAt();
      
      $cfg .= '# host_id_'.$host->getId()."\n";
      $cfg .= replace_template_tokens($tpl->getContent(), $ha, '%')."\n\n";
      
      foreach($host->getServices() as $s2h)
      {
        $data = $s2h->getService()->toArray();
        $data['hostname'] = $host->getName();
        $data['contactgroups'] = $ha['contactgroups'];

        $params = HostServiceParamPeer::retrieveByPK($host->getId(),$s2h->getService()->getId());
        $data['parameters'] = $params ? $params->getParameter() : '';
        $data['hostspecial'] = $params ? $params->getSpecial() : '';

        $cfg .= sprintf("# service_id_%u_%u\n",$s2h->getHostId(),$s2h->getServiceId());
        $cfg .= replace_template_tokens($tpl_service->getContent(), $data, '%')."\n\n";
      }
    }
    
    return $cfg; //beautyContent($cfg);
  }
}
