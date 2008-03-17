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
 * @subpackage lib.helper
 * @license    http://www.gnu.org/licenses/gpl.html
 * @link       www.nagiosadmin.de
 * @version    $Revision$
 * @author     Henrik Westphal <westphal@secure-net-concepts.de>
 */

function service_input_list($services)
{
  $html = '';
  $index = '<p>'.__('Go to:').' ';
  
  foreach($services as $s2h)
  {
    $index .= '<a href="#service_'.$s2h->getService()->getId().'">'.$s2h->getService()->getName().'</a> ';
    
    $html .= '<fieldset id="sf_fieldset_service_'.$s2h->getService()->getId().'" class="">';
    $html .= '<a name="service_'.$s2h->getService()->getId().'"></a><h2>'.$s2h->getService()->getName().'</h2>';

    $html .= '<div class="form-row">'.label_for('sp['.$s2h->getService()->getId().'][param]', __('Command Parameter:'), '');
    $html .= '<div class="content">';
    $html .= input_tag('sp['.$s2h->getService()->getId().'][param]',$s2h->getParameter(),array('size' => 80));
    $html .= '<br /><div class="sf_admin_edit_help">'.__('Command:').' '.$s2h->getService()->getCommand().'</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="form-row">'.label_for('sp['.$s2h->getService()->getId().'][special]', __('Special:'), '');
    $html .= '<div class="content">';
    $html .= textarea_tag('sp['.$s2h->getService()->getId().'][special]',$s2h->getSpecial(),array('cols' => 80, 'rows' => 10, 'class' => 'fixed'));
    //$html .= '<br /><div class="sf_admin_edit_help">Command: '.$s2h->getService()->getCommand().'</div>';
    $html .= '</div>';
    $html .= '</div>';
    
    $html .= '</fieldset>';
  }
  
  $index .= '</p>';

  return $index.$html;
}
?>