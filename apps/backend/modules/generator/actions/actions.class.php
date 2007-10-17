<?php

/**
 * generator actions.
 *
 * @package    nagiosadmin
 * @subpackage generator
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class generatorActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->config = array();
    $this->diff = array();
    
    $this->config['contacts'] = ContactPeer::getConfig();
    $this->diff['contacts'] = $this->getDifference($this->config['contacts'],file(sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'nagios'.DIRECTORY_SEPARATOR.sfConfig::get('mod_generator_contact_config_name')));
    $this->config['contactgroups'] = ContactGroupPeer::getConfig();
    $this->diff['contactgroups'] = $this->getDifference($this->config['contactgroups'],file(sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'nagios'.DIRECTORY_SEPARATOR.sfConfig::get('mod_generator_contactgroup_config_name')));
    $this->config['hosts'] = HostPeer::getConfig();
    $this->diff['hosts'] = $this->getDifference($this->config['hosts'],file(sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'nagios'.DIRECTORY_SEPARATOR.sfConfig::get('mod_generator_host_config_name')));
    $this->config['hostgroups'] = HostGroupPeer::getConfig();
    $this->diff['hostgroups'] = $this->getDifference($this->config['hostgroups'],file(sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'nagios'.DIRECTORY_SEPARATOR.sfConfig::get('mod_generator_hostgroup_config_name')));
    $this->config['generics'] = TemplatePeer::getConfig();
    $this->diff['generics'] = $this->getDifference($this->config['generics'],file(sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'nagios'.DIRECTORY_SEPARATOR.sfConfig::get('mod_generator_template_config_name')));
    $this->config['commands'] = CommandPeer::getConfig();
    $this->diff['commands'] = $this->getDifference($this->config['commands'],file(sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'nagios'.DIRECTORY_SEPARATOR.sfConfig::get('mod_generator_command_config_name')));
    
    $this->changed = $this->checkFilesModified();
  }
  
  private function getDifference($new, $old)
  {
    require_once('Text/Diff.php');
    require_once('Text/Diff/Renderer.php');
    require_once('Text/Diff/Renderer/inline.php');
    
    if(!is_array($new))
    {
      $new = explode("\n",str_replace("\r\n","\n",$new));
    }
    if(!is_array($old))
    {
      $old = explode("\n",str_replace("\r\n","\n",$old));
    }
    
    $params = array($old, $new);
    $diff = new Text_Diff('auto',$params);

    $diffrender =& new Text_Diff_Renderer_inline();
    return $diffrender->render($diff);
  }
  
  private function checkFilesModified()
  {
    $changed = array();
    foreach($this->getFileNames() as $file)
    {
      if($this->checkMd5($file) === false)
      {
        $changed[] = $file;
      }
    }
    if(count($changed) > 0) return '<ul><li>'.implode('</li><li>',$changed).'</li></ul>';
  }
  
  private function checkMd5($file)
  {
    $target = sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'nagios';
    if(is_readable($target.DIRECTORY_SEPARATOR.$file) && is_readable($target.DIRECTORY_SEPARATOR.$file.'.md5') && md5_file($target.DIRECTORY_SEPARATOR.$file) == file_get_contents($target.DIRECTORY_SEPARATOR.$file.'.md5'))
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  
  public function executeDownload()
  {
    $this->getResponse()->setContentType('application/octet-stream');
    $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename=nagiosadmin.cfg');
    $this->getResponse()->addCacheControlHttpHeader('no-cache');
    $this->config = CommandPeer::getConfig().ContactPeer::getConfig().ContactGroupPeer::getConfig().HostPeer::getConfig().HostGroupPeer::getConfig().TemplatePeer::getConfig();
    $this->setLayout(false);
  }
  
  private function getFileNames()
  {
    return array(
      sfConfig::get('mod_generator_command_config_name'),
      sfConfig::get('mod_generator_contact_config_name'),
      sfConfig::get('mod_generator_contactgroup_config_name'),
      sfConfig::get('mod_generator_template_config_name'),
      sfConfig::get('mod_generator_host_config_name'),
      sfConfig::get('mod_generator_hostgroup_config_name')
    );
  }
  
  public function executeDump()
  {
    $target = sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'nagios';
    $backup = $target.DIRECTORY_SEPARATOR.'backups';
    if(!is_dir($backup))
    {
      mkdir($backup);
    }

    $files = $this->getFileNames();
    
    foreach($files as $file)
    {
      $pre = date('Y-m-d_His-');
      if(is_readable($target.DIRECTORY_SEPARATOR.$file))
      {
        copy($target.DIRECTORY_SEPARATOR.$file,$backup.DIRECTORY_SEPARATOR.$pre.$file.'.bak');
      }
    }
    
    $this->command_cfg = file_put_contents($target.DIRECTORY_SEPARATOR.sfConfig::get('mod_generator_command_config_name'),CommandPeer::getConfig());
    $this->contact_cfg = file_put_contents($target.DIRECTORY_SEPARATOR.sfConfig::get('mod_generator_contact_config_name'),ContactPeer::getConfig());
    $this->contactgroup_cfg = file_put_contents($target.DIRECTORY_SEPARATOR.sfConfig::get('mod_generator_contactgroup_config_name'),ContactGroupPeer::getConfig());
    $this->template_cfg = file_put_contents($target.DIRECTORY_SEPARATOR.sfConfig::get('mod_generator_template_config_name'),TemplatePeer::getConfig());
    $this->host_cfg = file_put_contents($target.DIRECTORY_SEPARATOR.sfConfig::get('mod_generator_host_config_name'),HostPeer::getConfig());
    $this->hostgroup_cfg = file_put_contents($target.DIRECTORY_SEPARATOR.sfConfig::get('mod_generator_hostgroup_config_name'),HostGroupPeer::getConfig());
    $this->result = $this->command_cfg && $this->contact_cfg && $this->contactgroup_cfg && $this->template_cfg && $this->host_cfg && $this->hostgroup_cfg;
    if($this->result)
    {
      foreach($files as $file)
      {
        file_put_contents($target.DIRECTORY_SEPARATOR.$file.'.md5',md5_file($target.DIRECTORY_SEPARATOR.$file));
      }
    }
    $this->forwardIf($this->result,'generator','check');
  }
  
  private function isOk($result)
  {
    if(preg_match('#Total Warnings: +0#',$result) && preg_match('#Total Errors: +0#',$result))
    {
      return (bool) true;
    }
    else
    {
      return (bool) false;
    }
  }
  
  public function executeCheck()
  {
    $this->result = shell_exec(sfConfig::get('mod_generator_config_check_command'));
    $this->ok = $this->isOk($this->result);
    $this->forwardIf($this->ok,'generator','reload');
  }
  
  public function executeReload()
  {
    system(sfConfig::get('mod_generator_reload_nagios_command'),$this->exitcode);
  }
}
