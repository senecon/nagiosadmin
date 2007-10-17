<?php
/*
function service_input_list($services)
{
  $html = '';
  
  foreach($services as $s2h)
  {
    $html .= '<div class="form-row">'.label_for('sp['.$s2h->getService()->getId().']', $s2h->getService()->getName().':', '');
    $html .= '<div class="content">';
    $html .= input_tag('sp['.$s2h->getService()->getId().']',$s2h->getParameter(),array('size' => 80));
    $html .= '<br /><div class="sf_admin_edit_help">Command: '.$s2h->getService()->getCommand().'</div>';
    $html .= '</div>';
    $html .= '</div>';
  }
  
  //$html .= '<pre>'.print_r($services, true).'</pre>';
  return $html;
}
*/

function service_input_list($services)
{
  $html = '';
  $index = '<p>Jump to: ';
  
  foreach($services as $s2h)
  {
    $index .= '<a href="#service_'.$s2h->getService()->getId().'">'.$s2h->getService()->getName().'</a> ';
    
    $html .= '<fieldset id="sf_fieldset_service_'.$s2h->getService()->getId().'" class="">';
    $html .= '<a name="service_'.$s2h->getService()->getId().'"></a><h2>'.$s2h->getService()->getName().'</h2>';

    $html .= '<div class="form-row">'.label_for('sp['.$s2h->getService()->getId().'][param]', 'Command Parameter:', '');
    $html .= '<div class="content">';
    $html .= input_tag('sp['.$s2h->getService()->getId().'][param]',$s2h->getParameter(),array('size' => 80));
    $html .= '<br /><div class="sf_admin_edit_help">Command: '.$s2h->getService()->getCommand().'</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="form-row">'.label_for('sp['.$s2h->getService()->getId().'][special]', 'Special:', '');
    $html .= '<div class="content">';
    $html .= textarea_tag('sp['.$s2h->getService()->getId().'][special]',$s2h->getSpecial(),array('cols' => 80, 'rows' => 10, 'class' => 'fixed'));
    //$html .= '<br /><div class="sf_admin_edit_help">Command: '.$s2h->getService()->getCommand().'</div>';
    $html .= '</div>';
    $html .= '</div>';
    
    $html .= '</fieldset>';
  }
  
  $index .= '</p>';
  
  //$html .= '<pre>'.print_r($services, true).'</pre>';
  return $index.$html;
}
?>