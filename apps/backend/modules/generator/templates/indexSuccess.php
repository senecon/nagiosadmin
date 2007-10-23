<?php include_partial('generator_header', array()) ?>
<?php if(count($changed) > 0): ?>
<h2>Changed (or new) files found:</h2>
<p><?php echo implode(', ',$changed); ?></p>
<?php endif; ?>
<h2>Generics</h2>
<pre class="fixed"><?php echo $diff['generics']; ?></pre>
<h2>Commands</h2>
<pre class="fixed"><?php echo $diff['commands']; ?></pre>
<h2>Contacts</h2>
<pre class="fixed"><?php echo $diff['contacts']; ?></pre>
<h2>ContactGroups</h2>
<pre class="fixed"><?php echo $diff['contactgroups']; ?></pre>
<h2>Hosts</h2>
<pre class="fixed"><?php echo $diff['hosts']; ?></pre>
<h2>HostGroups</h2>
<pre class="fixed"><?php echo $diff['hostgroups']; ?></pre>
<?php include_partial('generator_footer', array()) ?>