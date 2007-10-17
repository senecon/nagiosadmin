<?php


abstract class BaseGroupToHost extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $group_id;


	
	protected $host_id;

	
	protected $aHostGroup;

	
	protected $aHost;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getGroupId()
	{

		return $this->group_id;
	}

	
	public function getHostId()
	{

		return $this->host_id;
	}

	
	public function setGroupId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->group_id !== $v) {
			$this->group_id = $v;
			$this->modifiedColumns[] = GroupToHostPeer::GROUP_ID;
		}

		if ($this->aHostGroup !== null && $this->aHostGroup->getId() !== $v) {
			$this->aHostGroup = null;
		}

	} 
	
	public function setHostId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->host_id !== $v) {
			$this->host_id = $v;
			$this->modifiedColumns[] = GroupToHostPeer::HOST_ID;
		}

		if ($this->aHost !== null && $this->aHost->getId() !== $v) {
			$this->aHost = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->group_id = $rs->getInt($startcol + 0);

			$this->host_id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating GroupToHost object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(GroupToHostPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			GroupToHostPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(GroupToHostPeer::DATABASE_NAME);
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


												
			if ($this->aHostGroup !== null) {
				if ($this->aHostGroup->isModified()) {
					$affectedRows += $this->aHostGroup->save($con);
				}
				$this->setHostGroup($this->aHostGroup);
			}

			if ($this->aHost !== null) {
				if ($this->aHost->isModified()) {
					$affectedRows += $this->aHost->save($con);
				}
				$this->setHost($this->aHost);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = GroupToHostPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += GroupToHostPeer::doUpdate($this, $con);
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


												
			if ($this->aHostGroup !== null) {
				if (!$this->aHostGroup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aHostGroup->getValidationFailures());
				}
			}

			if ($this->aHost !== null) {
				if (!$this->aHost->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aHost->getValidationFailures());
				}
			}


			if (($retval = GroupToHostPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GroupToHostPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getGroupId();
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
		$keys = GroupToHostPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getGroupId(),
			$keys[1] => $this->getHostId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GroupToHostPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setGroupId($value);
				break;
			case 1:
				$this->setHostId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GroupToHostPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setGroupId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setHostId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(GroupToHostPeer::DATABASE_NAME);

		if ($this->isColumnModified(GroupToHostPeer::GROUP_ID)) $criteria->add(GroupToHostPeer::GROUP_ID, $this->group_id);
		if ($this->isColumnModified(GroupToHostPeer::HOST_ID)) $criteria->add(GroupToHostPeer::HOST_ID, $this->host_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(GroupToHostPeer::DATABASE_NAME);

		$criteria->add(GroupToHostPeer::GROUP_ID, $this->group_id);
		$criteria->add(GroupToHostPeer::HOST_ID, $this->host_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getGroupId();

		$pks[1] = $this->getHostId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setGroupId($keys[0]);

		$this->setHostId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setGroupId(NULL); 
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
			self::$peer = new GroupToHostPeer();
		}
		return self::$peer;
	}

	
	public function setHostGroup($v)
	{


		if ($v === null) {
			$this->setGroupId(NULL);
		} else {
			$this->setGroupId($v->getId());
		}


		$this->aHostGroup = $v;
	}


	
	public function getHostGroup($con = null)
	{
				include_once 'lib/model/om/BaseHostGroupPeer.php';

		if ($this->aHostGroup === null && ($this->group_id !== null)) {

			$this->aHostGroup = HostGroupPeer::retrieveByPK($this->group_id, $con);

			
		}
		return $this->aHostGroup;
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