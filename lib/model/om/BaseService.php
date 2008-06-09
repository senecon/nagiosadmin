<?php


abstract class BaseService extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $alias;


	
	protected $command_id;


	
	protected $port;


	
	protected $special;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aCommand;

	
	protected $collHostServiceParams;

	
	protected $lastHostServiceParamCriteria = null;

	
	protected $collServiceToHosts;

	
	protected $lastServiceToHostCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getAlias()
	{

		return $this->alias;
	}

	
	public function getCommandId()
	{

		return $this->command_id;
	}

	
	public function getPort()
	{

		return $this->port;
	}

	
	public function getSpecial()
	{

		return $this->special;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ServicePeer::ID;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ServicePeer::NAME;
		}

	} 
	
	public function setAlias($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->alias !== $v) {
			$this->alias = $v;
			$this->modifiedColumns[] = ServicePeer::ALIAS;
		}

	} 
	
	public function setCommandId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->command_id !== $v) {
			$this->command_id = $v;
			$this->modifiedColumns[] = ServicePeer::COMMAND_ID;
		}

		if ($this->aCommand !== null && $this->aCommand->getId() !== $v) {
			$this->aCommand = null;
		}

	} 
	
	public function setPort($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->port !== $v) {
			$this->port = $v;
			$this->modifiedColumns[] = ServicePeer::PORT;
		}

	} 
	
	public function setSpecial($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->special !== $v) {
			$this->special = $v;
			$this->modifiedColumns[] = ServicePeer::SPECIAL;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = ServicePeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = ServicePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->alias = $rs->getString($startcol + 2);

			$this->command_id = $rs->getInt($startcol + 3);

			$this->port = $rs->getInt($startcol + 4);

			$this->special = $rs->getString($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Service object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ServicePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ServicePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ServicePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ServicePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ServicePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aCommand !== null) {
				if ($this->aCommand->isModified()) {
					$affectedRows += $this->aCommand->save($con);
				}
				$this->setCommand($this->aCommand);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ServicePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ServicePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collHostServiceParams !== null) {
				foreach($this->collHostServiceParams as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collServiceToHosts !== null) {
				foreach($this->collServiceToHosts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aCommand !== null) {
				if (!$this->aCommand->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCommand->getValidationFailures());
				}
			}


			if (($retval = ServicePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collHostServiceParams !== null) {
					foreach($this->collHostServiceParams as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collServiceToHosts !== null) {
					foreach($this->collServiceToHosts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ServicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getAlias();
				break;
			case 3:
				return $this->getCommandId();
				break;
			case 4:
				return $this->getPort();
				break;
			case 5:
				return $this->getSpecial();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			case 7:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ServicePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getAlias(),
			$keys[3] => $this->getCommandId(),
			$keys[4] => $this->getPort(),
			$keys[5] => $this->getSpecial(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ServicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setAlias($value);
				break;
			case 3:
				$this->setCommandId($value);
				break;
			case 4:
				$this->setPort($value);
				break;
			case 5:
				$this->setSpecial($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
			case 7:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ServicePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAlias($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCommandId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPort($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSpecial($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ServicePeer::DATABASE_NAME);

		if ($this->isColumnModified(ServicePeer::ID)) $criteria->add(ServicePeer::ID, $this->id);
		if ($this->isColumnModified(ServicePeer::NAME)) $criteria->add(ServicePeer::NAME, $this->name);
		if ($this->isColumnModified(ServicePeer::ALIAS)) $criteria->add(ServicePeer::ALIAS, $this->alias);
		if ($this->isColumnModified(ServicePeer::COMMAND_ID)) $criteria->add(ServicePeer::COMMAND_ID, $this->command_id);
		if ($this->isColumnModified(ServicePeer::PORT)) $criteria->add(ServicePeer::PORT, $this->port);
		if ($this->isColumnModified(ServicePeer::SPECIAL)) $criteria->add(ServicePeer::SPECIAL, $this->special);
		if ($this->isColumnModified(ServicePeer::CREATED_AT)) $criteria->add(ServicePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ServicePeer::UPDATED_AT)) $criteria->add(ServicePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ServicePeer::DATABASE_NAME);

		$criteria->add(ServicePeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setAlias($this->alias);

		$copyObj->setCommandId($this->command_id);

		$copyObj->setPort($this->port);

		$copyObj->setSpecial($this->special);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getHostServiceParams() as $relObj) {
				$copyObj->addHostServiceParam($relObj->copy($deepCopy));
			}

			foreach($this->getServiceToHosts() as $relObj) {
				$copyObj->addServiceToHost($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ServicePeer();
		}
		return self::$peer;
	}

	
	public function setCommand($v)
	{


		if ($v === null) {
			$this->setCommandId(NULL);
		} else {
			$this->setCommandId($v->getId());
		}


		$this->aCommand = $v;
	}


	
	public function getCommand($con = null)
	{
		if ($this->aCommand === null && ($this->command_id !== null)) {
						include_once 'lib/model/om/BaseCommandPeer.php';

			$this->aCommand = CommandPeer::retrieveByPK($this->command_id, $con);

			
		}
		return $this->aCommand;
	}

	
	public function initHostServiceParams()
	{
		if ($this->collHostServiceParams === null) {
			$this->collHostServiceParams = array();
		}
	}

	
	public function getHostServiceParams($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseHostServiceParamPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHostServiceParams === null) {
			if ($this->isNew()) {
			   $this->collHostServiceParams = array();
			} else {

				$criteria->add(HostServiceParamPeer::SERVICE_ID, $this->getId());

				HostServiceParamPeer::addSelectColumns($criteria);
				$this->collHostServiceParams = HostServiceParamPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HostServiceParamPeer::SERVICE_ID, $this->getId());

				HostServiceParamPeer::addSelectColumns($criteria);
				if (!isset($this->lastHostServiceParamCriteria) || !$this->lastHostServiceParamCriteria->equals($criteria)) {
					$this->collHostServiceParams = HostServiceParamPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHostServiceParamCriteria = $criteria;
		return $this->collHostServiceParams;
	}

	
	public function countHostServiceParams($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseHostServiceParamPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(HostServiceParamPeer::SERVICE_ID, $this->getId());

		return HostServiceParamPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addHostServiceParam(HostServiceParam $l)
	{
		$this->collHostServiceParams[] = $l;
		$l->setService($this);
	}


	
	public function getHostServiceParamsJoinHost($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseHostServiceParamPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHostServiceParams === null) {
			if ($this->isNew()) {
				$this->collHostServiceParams = array();
			} else {

				$criteria->add(HostServiceParamPeer::SERVICE_ID, $this->getId());

				$this->collHostServiceParams = HostServiceParamPeer::doSelectJoinHost($criteria, $con);
			}
		} else {
									
			$criteria->add(HostServiceParamPeer::SERVICE_ID, $this->getId());

			if (!isset($this->lastHostServiceParamCriteria) || !$this->lastHostServiceParamCriteria->equals($criteria)) {
				$this->collHostServiceParams = HostServiceParamPeer::doSelectJoinHost($criteria, $con);
			}
		}
		$this->lastHostServiceParamCriteria = $criteria;

		return $this->collHostServiceParams;
	}

	
	public function initServiceToHosts()
	{
		if ($this->collServiceToHosts === null) {
			$this->collServiceToHosts = array();
		}
	}

	
	public function getServiceToHosts($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseServiceToHostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collServiceToHosts === null) {
			if ($this->isNew()) {
			   $this->collServiceToHosts = array();
			} else {

				$criteria->add(ServiceToHostPeer::SERVICE_ID, $this->getId());

				ServiceToHostPeer::addSelectColumns($criteria);
				$this->collServiceToHosts = ServiceToHostPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ServiceToHostPeer::SERVICE_ID, $this->getId());

				ServiceToHostPeer::addSelectColumns($criteria);
				if (!isset($this->lastServiceToHostCriteria) || !$this->lastServiceToHostCriteria->equals($criteria)) {
					$this->collServiceToHosts = ServiceToHostPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastServiceToHostCriteria = $criteria;
		return $this->collServiceToHosts;
	}

	
	public function countServiceToHosts($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseServiceToHostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ServiceToHostPeer::SERVICE_ID, $this->getId());

		return ServiceToHostPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addServiceToHost(ServiceToHost $l)
	{
		$this->collServiceToHosts[] = $l;
		$l->setService($this);
	}


	
	public function getServiceToHostsJoinHost($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseServiceToHostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collServiceToHosts === null) {
			if ($this->isNew()) {
				$this->collServiceToHosts = array();
			} else {

				$criteria->add(ServiceToHostPeer::SERVICE_ID, $this->getId());

				$this->collServiceToHosts = ServiceToHostPeer::doSelectJoinHost($criteria, $con);
			}
		} else {
									
			$criteria->add(ServiceToHostPeer::SERVICE_ID, $this->getId());

			if (!isset($this->lastServiceToHostCriteria) || !$this->lastServiceToHostCriteria->equals($criteria)) {
				$this->collServiceToHosts = ServiceToHostPeer::doSelectJoinHost($criteria, $con);
			}
		}
		$this->lastServiceToHostCriteria = $criteria;

		return $this->collServiceToHosts;
	}

} 