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
 * @subpackage menu
 * @license    http://www.gnu.org/licenses/gpl.html
 * @link       www.nagiosadmin.de
 * @version    $Revision$
 * @author     Henrik Westphal <westphal@secure-net-concepts.de>
 */

class topMenu
{
  protected static $items = array(
  'contact' => 'Contacts',
  'contactgroup' => 'Contact Groups',
  'os' => 'Operating Systems',
  'service' => 'Services',
  'hostgroup' => 'Host Groups',
  'host' => 'Hosts',
  'command' => 'Commands',
  'template' => 'Templates',
  'generator' => 'Generator'
  );

  protected static $right_items = array(
  'language' => 'Language',
  'help' => 'About'
  );

  public function render($active = null)
  {
    $result = '';
    sfMixer::callMixins();
    switch(sfContext::getInstance()->getUser()->getCulture())
    {
      case 'de':
        self::$right_items['language'] = 'English';
        break;
      case 'en':
        self::$right_items['language'] = 'German';
        break;
    }
    if(count(self::$items) > 0)
    {
      $result .= '<ul id="topmenu">';
      foreach(self::$items as $module => $label)
      {
        $opts = $active == $module ? array('class' => 'selected') : array();
        $result .= '<li class="'.$module.'">'.link_to(__($label),$module,$opts).'</li>';
      }
      $result .= '</ul>';
    }
    if(count(self::$right_items) > 0)
    {
      $result .= '<div id="topright"><ul id="toprightmenu">';
      foreach(self::$right_items as $module => $label)
      {
        $opts = $active == $module ? array('class' => 'selected') : array();
        $result .= '<li class="'.$module.'">'.link_to(__($label),$module,$opts).'</li>';
      }
      $result .= '</ul></div>';
    }
    return $result;
  }

  public function addItem($label, $module, $position = 'left')
  {
    if($position == 'left')
    {
      self::$items[$module] = $label;
    }
    elseif($position == 'right')
    {
      self::$right_items[$module] = $label;
    }
  }

  public function delItem($module, $position = 'left')
  {
    if($position == 'left')
    {
      unset(self::$items[$module]);
    }
    elseif($position == 'right')
    {
      unset(self::$right_items[$module]);
    }
  }

  public function getItems($position = 'left')
  {
    if($position == 'left')
    {
      return self::$items;
    }
    elseif($position == 'right')
    {
      return self::$right_items;
    }
    return false;
  }

  public function setItems(array $items, $position = 'left')
  {
    if($position == 'left')
    {
      self::$items = $items;
    }
    elseif($position == 'right')
    {
      self::$right_items = $items;
    }
  }

  public function __call($method, $arguments)
  {
    return sfMixer::callMixins();
  }
}
