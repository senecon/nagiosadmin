<?php include_partial('generator_header', array()) ?>
<?php if($changed): ?>
<h2>Changed files found:</h2>
<?=$changed?>
<?php endif; ?>
<h2>Generics</h2>
<pre class="fixed">
<?=$diff['generics']?>
</pre>
<h2>Commands</h2>
<pre class="fixed">
<?=$diff['commands']?>
</pre>
<h2>Contacts</h2>
<pre class="fixed">
<?=$diff['contacts']?>
</pre>
<h2>ContactGroups</h2>
<pre class="fixed">
<?=$diff['contactgroups']?>
</pre>
<h2>Hosts</h2>
<pre class="fixed">
<?=$diff['hosts']?>
</pre>
<h2>HostGroups</h2>
<pre class="fixed">
<?=$diff['hostgroups']?>
</pre>
<?php include_partial('generator_footer', array()) ?>