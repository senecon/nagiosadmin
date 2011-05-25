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
 * @subpackage host
 * @license    http://www.gnu.org/licenses/gpl.html
 * @link       www.nagiosadmin.de
 * @version    $Revision$
 * @author     Henrik Westphal <westphal@secure-net-concepts.de>
 */
?>
<?php if ($sf_request->hasErrors()): ?>
<div class="form-errors">
<h2><?php echo __('There are some errors that prevent the form to validate') ?></h2>
<dl>
<?php foreach ($sf_request->getErrorNames() as $name): ?>
  <dt><?php echo __($labels[$name]) ?></dt>
  <dd><?php echo $sf_request->getError($name) ?></dd>
<?php endforeach; ?>
</dl>
</div>
<?php elseif ($sf_user->hasFlash('notice')): ?>
<div class="save-ok">
<h2><?php echo __($sf_user->getFlash('notice')) ?></h2>
</div>
<?php endif; ?>
