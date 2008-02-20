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