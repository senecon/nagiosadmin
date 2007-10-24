<?php include_partial('generator_header', array()) ?>
<?php
if($exitcode == 0) echo "Nagios reloaded successfully."; else echo "Error while reloading Nagios. Be sure that the user of the webserver has the permissions for <em>$command</em>.";
?>
<?php include_partial('generator_footer', array()) ?>