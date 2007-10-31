<?php
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