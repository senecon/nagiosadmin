<?php use_stylesheet('/sf/sf_admin/css/main') ?>
<div id="sf_admin_container">
<h1><?php echo __('Help'); ?></h1>
<div id="sf_admin_content">
<?php echo sprintf('Nagios Administrator Version %s (revision %u)',sfConfig::get('app_version'),sfConfig::get('app_revision')); ?>
</div>
</div>