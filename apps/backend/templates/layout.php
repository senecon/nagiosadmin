<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>

<div id="header">
<ul id="topmenu">
<li><?=link_to('Contacts','contact')?></li>
<li><?=link_to('Contact Groups','contactgroup')?></li>
<li><?=link_to('Operating Systems','os')?></li>
<li><?=link_to('Services','service')?></li>
<li><?=link_to('Host Groups','hostgroup')?></li>
<li><?=link_to('Hosts','host')?></li>
<li><?=link_to('Commands','command')?></li>
<li><?=link_to('Templates','template')?></li>
<li><?=link_to('Generator','generator')?></li>
</ul>
</div>

<?php echo $sf_data->getRaw('sf_content') ?>

</body>
</html>
