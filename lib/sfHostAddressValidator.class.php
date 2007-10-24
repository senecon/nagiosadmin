<?php
class sfHostAddressValidator extends sfValidator
{
  public function execute(&$value, &$error)
  {
    $re = array(
      '#^(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])$#', // IPv4
      '#^[a-z]+([a-z0-9-]*[a-z0-9]+)?(\.([a-z]+([a-z0-9-]*[a-z0-9]+)?)+)*$#', // domain names (RFC 1035)
      '#^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$#', // RFCs 952, 1123, 1035
    );
    
    foreach($re as $r)
    {
      if(preg_match($r, $value))
      {
        return true;
      }
    }

    $error = $this->getParameter('address_error');

    return false;
  }

  public function initialize($context, $parameters = null)
  {
    // Initialize parent
    parent::initialize($context);

    // Set default parameters value
    $this->setParameter('address_error', 'This host address is invalid');

    // Set parameters
    $this->getParameterHolder()->add($parameters);

    return true;
  }
}
?>