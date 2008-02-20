<?php include_partial('generator_header', array()) ?>
<?php
if($exitcode == 0) echo __('Nagios reloaded successfully.'); else echo __('Error while reloading Nagios. Be sure that the user of the webserver has the permissions for %1%.',array('%1%' => $command));
?>
<?php include_partial('generator_footer', array()) ?>