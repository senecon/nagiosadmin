<?php


abstract class BaseHostServiceParam extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $host_id;


	
	protected $service_id;


	
	protected $parameter;


	
	protected $special;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aHost;

	
	protected $aService;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getHostId()
	{

		return $this->host_id;
	}

	
	public function getServiceId()
	{

		return $this->service_id;
	}

	
	public function getParameter()
	{

		return $this->parameter;
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

	
	public function setHostId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->host_id !== $v) {
			$this->host_id = $v;
			$this->modifiedColumns[] = HostServiceParamPeer::HOST_ID;
		}

		if ($this->aHost !== null && $this->aHost->getId() !== $v) {
			$this->aHost = null;
		}

	} 
	
	public function setServiceId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->service_id !== $v) {
			$this->service_id = $v;
			$this->modifiedColumns[] = HostServiceParamPeer::SERVICE_ID;
		}

		if ($this->aService !== null && $this->aService->getId() !== $v) {
			$this->aService = null;
		}

	} 
	
	public function setParameter($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->parameter !== $v) {
			$this->parameter = $v;
			$this->modifiedColumns[] = HostServiceParamPeer::PARAMETER;
		}

	} 
	
	public function setSpecial($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->special !== $v) {
			$this->special = $v;
			$this->modifiedColumns[] = HostServiceParamPeer::SPECIAL;
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
			$this->modifiedColumns[] = HostServiceParamPeer::CREATED_AT;
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
			$this->modifiedColumns[] = HostServiceParamPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->host_id = $rs->getInt($startcol + 0);

			$this->service_id = $rs->getInt($startcol + 1);

			$this->parameter = $rs->getString($startcol + 2);

			$this->special = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating HostServiceParam object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			HostServiceParamPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(HostServiceParamPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(HostServiceParamPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME);
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


												
			if ($this->aHost !== null) {
				if ($this->aHost->isModified()) {
					$affectedRows += $this->aHost->save($con);
				}
				$this->setHost($this->aHost);
			}

			if ($this->aService !== null) {
				if ($this->aService->isModified()) {
					$affectedRows += $this->aService->save($con);
				}
				$this->setService($this->aService);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HostServiceParamPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += HostServiceParamPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


												
			if ($this->aHost !== null) {
				if (!$this->aHost->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aHost->getValidationFailures());
				}
			}

			if ($this->aService !== null) {
				if (!$this->aService->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aService->getValidationFailures());
				}
			}


			if (($retval = HostServiceParamPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HostServiceParamPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getHostId();
				break;
			case 1:
				return $this->getServiceId();
				break;
			case 2:
				return $this->getParameter();
				break;
			case 3:
				return $this->getSpecial();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HostServiceParamPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getHostId(),
			$keys[1] => $this->getServiceId(),
			$keys[2] => $this->getParameter(),
			$keys[3] => $this->getSpecial(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HostServiceParamPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setHostId($value);
				break;
			case 1:
				$this->setServiceId($value);
				break;
			case 2:
				$this->setParameter($value);
				break;
			case 3:
				$this->setSpecial($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HostServiceParamPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setHostId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setServiceId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setParameter($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSpecial($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(HostServiceParamPeer::DATABASE_NAME);

		if ($this->isColumnModified(HostServiceParamPeer::HOST_ID)) $criteria->add(HostServiceParamPeer::HOST_ID, $this->host_id);
		if ($this->isColumnModified(HostServiceParamPeer::SERVICE_ID)) $criteria->add(HostServiceParamPeer::SERVICE_ID, $this->service_id);
		if ($this->isColumnModified(HostServiceParamPeer::PARAMETER)) $criteria->add(HostServiceParamPeer::PARAMETER, $this->parameter);
		if ($this->isColumnModified(HostServiceParamPeer::SPECIAL)) $criteria->add(HostServiceParamPeer::SPECIAL, $this->special);
		if ($this->isColumnModified(HostServiceParamPeer::CREATED_AT)) $criteria->add(HostServiceParamPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(HostServiceParamPeer::UPDATED_AT)) $criteria->add(HostServiceParamPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(HostServiceParamPeer::DATABASE_NAME);

		$criteria->add(HostServiceParamPeer::HOST_ID, $this->host_id);
		$criteria->add(HostServiceParamPeer::SERVICE_ID, $this->service_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getHostId();

		$pks[1] = $this->getServiceId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setHostId($keys[0]);

		$this->setServiceId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setParameter($this->parameter);

		$copyObj->setSpecial($this->special);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setHostId(NULL); 
		$copyObj->setServiceId(NULL); 
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
			self::$peer = new HostServiceParamPeer();
		}
		return self::$peer;
	}

	
	public function setHost($v)
	{


		if ($v === null) {
			$this->setHostId(NULL);
		} else {
			$this->setHostId($v->getId());
		}


		$this->aHost = $v;
	}


	
	public function getHost($con = null)
	{
				include_once 'lib/model/om/BaseHostPeer.php';

		if ($this->aHost === null && ($this->host_id !== null)) {

			$this->aHost = HostPeer::retrieveByPK($this->host_id, $con);

			
		}
		return $this->aHost;
	}

	
	public function setService($v)
	{


		if ($v === null) {
			$this->setServiceId(NULL);
		} else {
			$this->setServiceId($v->getId());
		}


		$this->aService = $v;
	}


	
	public function getService($con = null)
	{
				include_once 'lib/model/om/BaseServicePeer.php';

		if ($this->aService === null && ($this->service_id !== null)) {

			$this->aService = ServicePeer::retrieveByPK($this->service_id, $con);

			
		}
		return $this->aService;
	}

} 