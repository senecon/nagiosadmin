<?php


abstract class BaseHostServiceParam extends BaseObject  implements Persistent {


  const PEER = 'HostServiceParamPeer';

	
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

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
	}

	
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
		if ($this->created_at === null) {
			return null;
		}


		if ($this->created_at === '0000-00-00 00:00:00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->created_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
			}
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->updated_at === null) {
			return null;
		}


		if ($this->updated_at === '0000-00-00 00:00:00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->updated_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
			}
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function setHostId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->host_id !== $v) {
			$this->host_id = $v;
			$this->modifiedColumns[] = HostServiceParamPeer::HOST_ID;
		}

		if ($this->aHost !== null && $this->aHost->getId() !== $v) {
			$this->aHost = null;
		}

		return $this;
	} 
	
	public function setServiceId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->service_id !== $v) {
			$this->service_id = $v;
			$this->modifiedColumns[] = HostServiceParamPeer::SERVICE_ID;
		}

		if ($this->aService !== null && $this->aService->getId() !== $v) {
			$this->aService = null;
		}

		return $this;
	} 
	
	public function setParameter($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->parameter !== $v) {
			$this->parameter = $v;
			$this->modifiedColumns[] = HostServiceParamPeer::PARAMETER;
		}

		return $this;
	} 
	
	public function setSpecial($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->special !== $v) {
			$this->special = $v;
			$this->modifiedColumns[] = HostServiceParamPeer::SPECIAL;
		}

		return $this;
	} 
	
	public function setCreatedAt($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->created_at !== null || $dt !== null ) {
			
			$currNorm = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->created_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = HostServiceParamPeer::CREATED_AT;
			}
		} 
		return $this;
	} 
	
	public function setUpdatedAt($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->updated_at !== null || $dt !== null ) {
			
			$currNorm = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->updated_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = HostServiceParamPeer::UPDATED_AT;
			}
		} 
		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->host_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->service_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->parameter = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->special = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->created_at = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->updated_at = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating HostServiceParam object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aHost !== null && $this->host_id !== $this->aHost->getId()) {
			$this->aHost = null;
		}
		if ($this->aService !== null && $this->service_id !== $this->aService->getId()) {
			$this->aService = null;
		}
	} 
	
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = HostServiceParamPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aHost = null;
			$this->aService = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			HostServiceParamPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public function save(PropelPDO $con = null)
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
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			HostServiceParamPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

												
			if ($this->aHost !== null) {
				if ($this->aHost->isModified() || $this->aHost->isNew()) {
					$affectedRows += $this->aHost->save($con);
				}
				$this->setHost($this->aHost);
			}

			if ($this->aService !== null) {
				if ($this->aService->isModified() || $this->aService->isNew()) {
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
		$field = $this->getByPosition($pos);
		return $field;
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

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
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

		$copyObj->setHostId($this->host_id);

		$copyObj->setServiceId($this->service_id);

		$copyObj->setParameter($this->parameter);

		$copyObj->setSpecial($this->special);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

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

	
	public function setHost(Host $v = null)
	{
		if ($v === null) {
			$this->setHostId(NULL);
		} else {
			$this->setHostId($v->getId());
		}

		$this->aHost = $v;

						if ($v !== null) {
			$v->addHostServiceParam($this);
		}

		return $this;
	}


	
	public function getHost(PropelPDO $con = null)
	{
		if ($this->aHost === null && ($this->host_id !== null)) {
			$c = new Criteria(HostPeer::DATABASE_NAME);
			$c->add(HostPeer::ID, $this->host_id);
			$this->aHost = HostPeer::doSelectOne($c, $con);
			
		}
		return $this->aHost;
	}

	
	public function setService(Service $v = null)
	{
		if ($v === null) {
			$this->setServiceId(NULL);
		} else {
			$this->setServiceId($v->getId());
		}

		$this->aService = $v;

						if ($v !== null) {
			$v->addHostServiceParam($this);
		}

		return $this;
	}


	
	public function getService(PropelPDO $con = null)
	{
		if ($this->aService === null && ($this->service_id !== null)) {
			$c = new Criteria(ServicePeer::DATABASE_NAME);
			$c->add(ServicePeer::ID, $this->service_id);
			$this->aService = ServicePeer::doSelectOne($c, $con);
			
		}
		return $this->aService;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aHost = null;
			$this->aService = null;
	}

} 