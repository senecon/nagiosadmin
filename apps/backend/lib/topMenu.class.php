<?php
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
