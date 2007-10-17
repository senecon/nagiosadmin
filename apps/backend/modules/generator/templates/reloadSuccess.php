<?php include_partial('generator_header', array()) ?>
<?php
if($exitcode == 0) echo "Nagios reloaded successfully."; else echo "Error while reloading Nagios.";
?>
<?php include_partial('generator_footer', array()) ?>