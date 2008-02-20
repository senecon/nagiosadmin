<?php include_partial('generator_header', array()) ?>
<?php if(count($changed) > 0): ?>
<h2><?php echo __('Changed (or new) files found:'); ?></h2>
<p><?php echo implode(', ',$changed); ?></p>
<?php endif; ?>
<h2><?php echo __('Static Templates'); ?></h2>
<pre class="fixed"><?php echo $diff['generics']; ?></pre>
<h2><?php echo __('Commands'); ?></h2>
<pre class="fixed"><?php echo $diff['commands']; ?></pre>
<h2><?php echo __('Contacts'); ?></h2>
<pre class="fixed"><?php echo $diff['contacts']; ?></pre>
<h2><?php echo __('Contact Groups'); ?></h2>
<pre class="fixed"><?php echo $diff['contactgroups']; ?></pre>
<h2><?php echo __('Hosts'); ?></h2>
<pre class="fixed"><?php echo $diff['hosts']; ?></pre>
<h2><?php echo __('Host Groups'); ?></h2>
<pre class="fixed"><?php echo $diff['hostgroups']; ?></pre>
<?php include_partial('generator_footer', array()) ?>