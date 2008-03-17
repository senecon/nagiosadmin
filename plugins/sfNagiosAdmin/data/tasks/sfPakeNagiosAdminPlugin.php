<?php
/**
 * $Id$
 *
 * Copyright 2008 secure-net-concepts <info@secure-net-concepts.de>
 *
 * This file is part of Nagios Administrator http://www.nagiosadmin.de.
 *
 * Nagios Administrator is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Nagios Administrator is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Nagios Administrator. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    nagiosadmin
 * @subpackage tasks
 * @license    http://www.gnu.org/licenses/gpl.html
 * @link       www.nagiosadmin.de
 * @version    $Revision$
 * @author     Henrik Westphal <westphal@secure-net-concepts.de>
 */

pake_desc( 'Checks for requirements and file permissions' );
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
  pake_chmod(sfConfig::get('sf_data_dir_name').DIRECTORY_SEPARATOR.'nagios', sfConfig::get('sf_root_dir'), 0777);
}

?>