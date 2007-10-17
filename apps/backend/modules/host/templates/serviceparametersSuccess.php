<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date', 'ServiceParameter') ?>
<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1><?php echo __('customize host services', 
array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('host/serviceparameters_header', array('host' => $host)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('host/serviceparameters_messages', array('host' => $host)) ?>
<?php include_partial('host/serviceparameters_form', array('host' => $host, 'services' => $services)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('host/serviceparameters_footer', array('host' => $host)) ?>
</div>

</div>