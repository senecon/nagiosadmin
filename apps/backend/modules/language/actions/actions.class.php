<?php

/**
 * language actions.
 *
 * @package    nagiosadmin
 * @subpackage language
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class languageActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    if($this->getUser()->getCulture() == 'de')
    {
      $this->forward('language', 'en');
    }
    else
    {
      $this->forward('language', 'de');
    }
  }
  
  public function executeEn()
  {
    $this->getUser()->setCulture('en');
    //$this->getRequest()->getReferer() TODO go to last active module
    $this->redirect('contact', 'index');
  }

  public function executeDe()
  {
    $this->getUser()->setCulture('de');
    $this->redirect('contact', 'index');
  }
}
