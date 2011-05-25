<?php

class backendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
    $this->loadHelpers(array('TemplateToken'));
  }
}
