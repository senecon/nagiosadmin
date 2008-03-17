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
 * @subpackage generator
 * @license    http://www.gnu.org/licenses/gpl.html
 * @link       www.nagiosadmin.de
 * @version    $Revision$
 * @author     Henrik Westphal <westphal@secure-net-concepts.de>
 */
?>
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