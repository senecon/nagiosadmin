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

  public function render($active = null)
  {
    $result = '';
    sfMixer::callMixins();
    if(count(self::$items) > 0)
    {
      $result .= '<ul id="topmenu">';
      foreach(self::$items as $module => $label)
      {
        $stag = $active == $module ? '<li class="active">' : '<li>';
        $result .= $stag.link_to($label,$module).'</li>';
      }
      $result .= '</ul>';
    }
    return $result;
  }

  public function addItem($label, $module)
  {
    self::$items[$module] = $label;
  }

  public function delItem($module)
  {
    unset(self::$items[$module]);
  }

  public function getItems()
  {
    return self::$items;
  }

  public function setItems(array $items)
  {
    self::$items = $items;
  }

  public function __call($method, $arguments)
  {
    return sfMixer::callMixins();
  }
}
