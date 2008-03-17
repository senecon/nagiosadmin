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
?>
<?php if(function_exists('json_encode')): ?>
<?php echo link_to_remote(__('Scan for open ports'), array(
    'url'    => 'host/portscan?id='.$host->getId(),
    'with'   => "'ip=' + \$F('host_address')",
    'before' => "$('indicator').innerHTML = 'Please wait...'",
    'complete' => "$('indicator').innerHTML = ''",
    'condition' => "\$F('host_address') != ''",
    'success' => "updateJSON(request, json)"
)) ?> 
<span id="indicator"></span>
<?php echo javascript_tag("
function updateJSON(request, json)
{
  json.services.each(function(elementId){
    $(elementId).checked = 'checked';
  });
}
") ?>
<?php else: ?>
<?php echo __('Portscan disabled (JSON extension not found)'); ?>
<?php endif; ?>