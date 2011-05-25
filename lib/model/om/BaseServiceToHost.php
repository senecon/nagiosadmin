<?php


abstract class BaseServiceToHost extends BaseObject  implements Persistent {


  const PEER = 'ServiceToHostPeer';

	
	protected static $peer;

	
	protected $service_id;

	
	protected $host_id;

	
	protected $aService;

	
	protected $aHost;

	
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

	
	public function getServiceId()
	{
		return $this->service_id;
	}

	
	public function getHostId()
	{
		return $this->host_id;
	}

	
	public function setServiceId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->service_id !== $v) {
			$this->service_id = $v;
			$this->modifiedColumns[] = ServiceToHostPeer::SERVICE_ID;
		}

		if ($this->aService !== null && $this->aService->getId() !== $v) {
			$this->aService = null;
		}

		return $this;
	} 
	
	public function setHostId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->host_id !== $v) {
			$this->host_id = $v;
			$this->modifiedColumns[] = ServiceToHostPeer::HOST_ID;
		}

		if ($this->aHost !== null && $this->aHost->getId() !== $v) {
			$this->aHost = null;
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

			$this->service_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->host_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ServiceToHost object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aService !== null && $this->service_id !== $this->aService->getId()) {
			$this->aService = null;
		}
		if ($this->aHost !== null && $this->host_id !== $this->aHost->getId()) {
			$this->aHost = null;
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
			$con = Propel::getConnection(ServiceToHostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = ServiceToHostPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aService = null;
			$this->aHost = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ServiceToHostPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ServiceToHostPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ServiceToHostPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			ServiceToHostPeer::addInstanceToPool($this);
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

												
			if ($this->aService !== null) {
				if ($this->aService->isModified() || $this->aService->isNew()) {
					$affectedRows += $this->aService->save($con);
				}
				$this->setService($this->aService);
			}

			if ($this->aHost !== null) {
				if ($this->aHost->isModified() || $this->aHost->isNew()) {
					$affectedRows += $this->aHost->save($con);
				}
				$this->setHost($this->aHost);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ServiceToHostPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += ServiceToHostPeer::doUpdate($this, $con);
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


												
			if ($this->aService !== null) {
				if (!$this->aService->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aService->getValidationFailures());
				}
			}

			if ($this->aHost !== null) {
				if (!$this->aHost->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aHost->getValidationFailures());
				}
			}


			if (($retval = ServiceToHostPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ServiceToHostPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getServiceId();
				break;
			case 1:
				return $this->getHostId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = ServiceToHostPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getServiceId(),
			$keys[1] => $this->getHostId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ServiceToHostPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setServiceId($value);
				break;
			case 1:
				$this->setHostId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ServiceToHostPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setServiceId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setHostId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ServiceToHostPeer::DATABASE_NAME);

		if ($this->isColumnModified(ServiceToHostPeer::SERVICE_ID)) $criteria->add(ServiceToHostPeer::SERVICE_ID, $this->service_id);
		if ($this->isColumnModified(ServiceToHostPeer::HOST_ID)) $criteria->add(ServiceToHostPeer::HOST_ID, $this->host_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ServiceToHostPeer::DATABASE_NAME);

		$criteria->add(ServiceToHostPeer::SERVICE_ID, $this->service_id);
		$criteria->add(ServiceToHostPeer::HOST_ID, $this->host_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getServiceId();

		$pks[1] = $this->getHostId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setServiceId($keys[0]);

		$this->setHostId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setServiceId($this->service_id);

		$copyObj->setHostId($this->host_id);


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
			self::$peer = new ServiceToHostPeer();
		}
		return self::$peer;
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
			$v->addServiceToHost($this);
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

	
	public function setHost(Host $v = null)
	{
		if ($v === null) {
			$this->setHostId(NULL);
		} else {
			$this->setHostId($v->getId());
		}

		$this->aHost = $v;

						if ($v !== null) {
			$v->addServiceToHost($this);
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

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aService = null;
			$this->aHost = null;
	}

} 