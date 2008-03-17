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
 * @subpackage lib
 * @license    http://www.gnu.org/licenses/gpl.html
 * @link       www.nagiosadmin.de
 * @version    $Revision$
 * @author     Henrik Westphal <westphal@secure-net-concepts.de>
 */

class sfNagiosDirectivesValidator extends sfValidator
{
  public function execute(&$value, &$error)
  {
    $className  = $this->getParameter('class');
    $vd = call_user_func(array($className, 'getValidDirectives'));

    $sl = explode("\n",str_replace("\r\n","\n",$value));
    $ld = array();
    foreach($sl as $line)
    {
      $line = trim($line);
      if(strpos($line,'#') === 0) continue;
      if(preg_match('#^define\s+\S+\s+#',$line) || preg_match('#\s*[\{\}]\s*#',$line))
      {
        $error = $this->getParameter('directive_error').' (define statements not allowed here)';
        return false;
      }
      elseif(preg_match('#(\S+)\s*(.*)#',$line,$matches) && substr($line,0,1) != '_')
      {
        $ld[] = $matches[1];
      }
    }
    $ld = array_diff($ld, $vd);
    if(count($ld) > 0)
    {
      $error = $this->getParameter('directive_error').' ('.implode(', ',$ld).')';
      return false;
    }
    return true;
  }

  public function initialize($context, $parameters = null)
  {
    // Initialize parent
    parent::initialize($context);

    // Set default parameters value
    $this->setParameter('directive_error', 'These directives are invalid');

    // Set parameters
    $this->getParameterHolder()->add($parameters);

    // check parameters
    if (!$this->getParameter('class'))
    {
      throw new sfValidatorException('The "class" parameter is mandatory for the sfNagiosDirectivesValidator validator.');
    }

    return true;
  }
}
?>