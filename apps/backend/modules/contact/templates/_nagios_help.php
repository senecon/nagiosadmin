<?php
$module = $sf_context->getModuleName();
$url = sprintf('%s#%s',sfConfig::get('app_help_objects'),$sf_context->getModuleName());
echo sprintf('<a href="%1$s" target="_blank">%1$s</a>',$url);
?>