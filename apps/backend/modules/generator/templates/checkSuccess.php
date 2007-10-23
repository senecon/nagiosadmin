<?php include_partial('generator_header', array()) ?>
<h2>Error</h2>
<pre class="fixed">
<?php
echo $result;
?>
</pre>
<?php if($error): ?>
<p><?php echo $error ?></p>
<?php endif; ?>
<?php include_partial('generator_footer', array()) ?>