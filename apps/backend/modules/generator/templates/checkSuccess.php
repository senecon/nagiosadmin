<?php include_partial('generator_header', array()) ?>
<h2>Error</h2>
<p>The following error occured:</p>
<pre class="fixed">
<?php
echo $result;
echo basename(sfConfig::get('mod_generator_config_check_command'));
?>
</pre>
<?php if($error): ?>
<p><?php echo $error ?></p>
<?php endif; ?>
<?php include_partial('generator_footer', array()) ?>