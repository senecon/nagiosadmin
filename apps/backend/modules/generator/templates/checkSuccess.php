<?php include_partial('generator_header', array()) ?>
<h2><?php echo __('Error'); ?></h2>
<pre class="fixed">
<?php
echo $result;
?>
</pre>
<?php if($error): ?>
<p><?php echo __($error,array('%1%' => $cfgfile)) ?></p>
<?php endif; ?>
<?php include_partial('generator_footer', array()) ?>