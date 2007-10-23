<?php

pake_desc( 'Checks for requirements' );
pake_task( 'check', 'project_exists' );

function check_extension_func($ext, $func = null)
{
  $result = is_null($func) ? extension_loaded($ext) : extension_loaded($ext) && function_exists($func);
  $result = $result ? 'found' : 'not found';
  pake_echo_action('check', sprintf('Extension "%s" %s',$ext,$result));
}

function check_class_include($class, $path = null)
{
  if(!is_null($path)) @include_once($path);
  $result = class_exists($class) ? 'found' : 'not found';
  pake_echo_action('check', sprintf('Class "%s" %s',$class,$result));
}

function run_check( $task, $args )
{
  check_extension_func('ctype','ctype_alpha');
  check_extension_func('xml','xml_parser_create');
  check_extension_func('mysql');
  check_extension_func('json','json_encode');
  check_extension_func('gd','imagecreatefromjpeg');
  //check_class_include('PEAR');
  check_class_include('Net_Portscan','Net/Portscan.php');
  //check_class_include('PEAR_Info','PEAR/Info.php');
  check_class_include('Text_Diff','Text/Diff.php');
  check_class_include('Text_Diff_Renderer','Text/Diff/Renderer.php');
  check_class_include('Text_Diff_Renderer_inline','Text/Diff/Renderer/inline.php');
}

?>