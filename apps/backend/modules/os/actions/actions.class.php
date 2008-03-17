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
 * @subpackage os
 * @license    http://www.gnu.org/licenses/gpl.html
 * @link       www.nagiosadmin.de
 * @version    $Revision$
 * @author     Henrik Westphal <westphal@secure-net-concepts.de>
 */

/**
 * os actions.
 */
class osActions extends autoosActions
{
  protected function updateOsFromRequest()
  {
    parent::updateOsFromRequest();
    require_once(sfConfig::get('sf_lib_dir').'/upload/class.upload.php');
    if($this->os->getImage())
    {
      $img = new upload(sfConfig::get('sf_upload_dir').'/os_images/'.$this->os->getImage());
      $img->image_resize = true;
      $img->image_x = 20;
      $img->image_y = 20;
      $img->image_ratio_crop = true;
      $img->Process(sfConfig::get('sf_upload_dir').'/os_images/');
      if($img->processed)
      {
        unlink(sfConfig::get('sf_upload_dir').'/os_images/'.$this->os->getImage());
        rename(sfConfig::get('sf_upload_dir').'/os_images/'.$img->file_dst_name, sfConfig::get('sf_upload_dir').'/os_images/'.$this->os->getImage());
      }
      else
      {
        throw new Exception($img->error);
      }
    }
  }
}
