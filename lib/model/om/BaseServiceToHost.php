<?php


abstract class BaseServiceToHost extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $service_id;


	
	protected $host_id;

	
	protected $aService;

	
	protected $aHost;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
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

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->service_id !== $v) {
			$this->service_id = $v;
			$this->modifiedColumns[] = ServiceToHostPeer::SERVICE_ID;
		}

		if ($this->aService !== null && $this->aService->getId() !== $v) {
			$this->aService = null;
		}

	} 
	
	public function setHostId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->host_id !== $v) {
			$this->host_id = $v;
			$this->modifiedColumns[] = ServiceToHostPeer::HOST_ID;
		}

		if ($this->aHost !== null && $this->aHost->getId() !== $v) {
			$this->aHost = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->service_id = $rs->getInt($startcol + 0);

			$this->host_id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ServiceToHost object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ServiceToHostPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ServiceToHostPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ServiceToHostPeer::DATABASE_NAME);
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


												
			if ($this->aService !== null) {
				if ($this->aService->isModified()) {
					$affectedRows += $this->aService->save($con);
				}
				$this->setService($this->aService);
			}

			if ($this->aHost !== null) {
				if ($this->aHost->isModified()) {
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
		return $this->getByPosition($pos);
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

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
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


		$copyObj->setNew(true);

		$copyObj->setServiceId(NULL); 
		$copyObj->setHostId(NULL); 
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

} 