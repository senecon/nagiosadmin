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
 * @subpackage lib.helper
 * @license    http://www.gnu.org/licenses/gpl.html
 * @link       www.nagiosadmin.de
 * @version    $Revision$
 * @author     Henrik Westphal <westphal@secure-net-concepts.de>
 */

define('INDENT','  ');
define('COMMENT_HEADER',"#\n# DO NOT REMOVE OR EDIT ANY '*_id_*' COMMENTS IN THIS FILE\n#\n\n");

function getTemplate($name)
{
  $c = new Criteria();
  $c->add(TemplatePeer::NAME,$name,Criteria::LIKE);
  $c->add(TemplatePeer::TYPE,TemplatePeer::T_DYNAMIC,Criteria::EQUAL);
  $tpl = TemplatePeer::doSelectOne($c);
  
  if($tpl == null)
  {
    throw new Exception('Please create a "'.$name.'" template.');
  }
  else
  {
    return $tpl;
  }
}

function replace_template_tokens($tpl, $data, $token)
{
  $replaced = false;
  $content = $tpl;
  foreach ($data as $key => $value)
  {
    $content = str_replace($token.strtoupper($key).$token, $value, $content, $count);
    if ($count) $replaced = true;
  }
  return kill_doubles(beautyContent($content));
}

function before ($this, $inthat)
{
   return substr($inthat, 0, strpos($inthat, $this));
};

function between ($this, $that, $inthat)
{
 return before($that, after($this, $inthat));
};

function after ($this, $inthat)
{
   if (!is_bool(strpos($inthat, $this)))
   return substr($inthat, strpos($inthat,$this)+strlen($this));
};

function kill_doubles($content)
{
  $params = array();

  $tmp = between('{','}',$content);
  $lines = explode("\n",$tmp);
  foreach($lines as $nr => $line)
  {
    if(preg_match('#^([ \t]*)([a-zA-Z-_]+)[ \t]*(.*)$#',$line,$matches))
    {
      if(strpos(trim($line),'#') === 0) continue;
      if(array_key_exists($matches[2], $params))
      {
        unset($lines[$params[$matches[2]]]);
      }
      $lines[$nr] = sprintf("%s% -32s%s",$matches[1],$matches[2],$matches[3]);
      $params[$matches[2]] = $nr;
    }
  }
  return str_replace($tmp,implode("\n",$lines),$content);
}

function beautyContent($content)
{
  $returnValue = (string) '';
    
  $content = str_replace("\r\n","\n",$content);
  $lines = explode("\n",trim($content));
  $indent = '';
  foreach($lines as $key=>$line)
  {
    if(preg_match('/.*}$/',trim($line)))
    {
      $indent=substr($indent,strlen(INDENT));
    }
    $newline = preg_replace('/^[ \t]*/',$indent,$line);
    if(strlen(trim($newline)) > 0)
    {
      $lines[$key] = $newline; //.' #'.strlen(trim($newline));
    }
    else
    {
      unset($lines[$key]);
    }
    if(preg_match('/.*{$/',trim($line)))
    {
      $indent.=INDENT;
    }
    elseif(preg_match('/case.*:$/',trim($line)))
    {
      $indent.=INDENT;
    }
    elseif(preg_match('/default:$/',trim($line)))
    {
      $indent.=INDENT;
    }
    if(preg_match('/.*break;$/',trim($line)))
    {
      $indent=substr($indent,strlen(INDENT));
    }
  }
  $returnValue = implode("\n",$lines);
  
  return (string) $returnValue;
}
?>