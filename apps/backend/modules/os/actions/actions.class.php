<?php

/**
 * os actions.
 *
 * @package    nagiosadmin
 * @subpackage os
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
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
