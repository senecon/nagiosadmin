<?php


abstract class BaseHostToContactGroup extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $host_id;


	
	protected $contact_group_id;

	
	protected $aHost;

	
	protected $aContactGroup;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getHostId()
	{

		return $this->host_id;
	}

	
	public function getContactGroupId()
	{

		return $this->contact_group_id;
	}

	
	public function setHostId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->host_id !== $v) {
			$this->host_id = $v;
			$this->modifiedColumns[] = HostToContactGroupPeer::HOST_ID;
		}

		if ($this->aHost !== null && $this->aHost->getId() !== $v) {
			$this->aHost = null;
		}

	} 
	
	public function setContactGroupId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->contact_group_id !== $v) {
			$this->contact_group_id = $v;
			$this->modifiedColumns[] = HostToContactGroupPeer::CONTACT_GROUP_ID;
		}

		if ($this->aContactGroup !== null && $this->aContactGroup->getId() !== $v) {
			$this->aContactGroup = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->host_id = $rs->getInt($startcol + 0);

			$this->contact_group_id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating HostToContactGroup object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			HostToContactGroupPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME);
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

			if ($this->aContactGroup !== null) {
				if ($this->aContactGroup->isModified()) {
					$affectedRows += $this->aContactGroup->save($con);
				}
				$this->setContactGroup($this->aContactGroup);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HostToContactGroupPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += HostToContactGroupPeer::doUpdate($this, $con);
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

			if ($this->aContactGroup !== null) {
				if (!$this->aContactGroup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aContactGroup->getValidationFailures());
				}
			}


			if (($retval = HostToContactGroupPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HostToContactGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getHostId();
				break;
			case 1:
				return $this->getContactGroupId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HostToContactGroupPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getHostId(),
			$keys[1] => $this->getContactGroupId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HostToContactGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setHostId($value);
				break;
			case 1:
				$this->setContactGroupId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HostToContactGroupPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setHostId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setContactGroupId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(HostToContactGroupPeer::DATABASE_NAME);

		if ($this->isColumnModified(HostToContactGroupPeer::HOST_ID)) $criteria->add(HostToContactGroupPeer::HOST_ID, $this->host_id);
		if ($this->isColumnModified(HostToContactGroupPeer::CONTACT_GROUP_ID)) $criteria->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $this->contact_group_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(HostToContactGroupPeer::DATABASE_NAME);

		$criteria->add(HostToContactGroupPeer::HOST_ID, $this->host_id);
		$criteria->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $this->contact_group_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getHostId();

		$pks[1] = $this->getContactGroupId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setHostId($keys[0]);

		$this->setContactGroupId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setHostId(NULL); 
		$copyObj->setContactGroupId(NULL); 
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
			self::$peer = new HostToContactGroupPeer();
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
		if ($this->aHost === null && ($this->host_id !== null)) {
						include_once 'lib/model/om/BaseHostPeer.php';

			$this->aHost = HostPeer::retrieveByPK($this->host_id, $con);

			
		}
		return $this->aHost;
	}

	
	public function setContactGroup($v)
	{


		if ($v === null) {
			$this->setContactGroupId(NULL);
		} else {
			$this->setContactGroupId($v->getId());
		}


		$this->aContactGroup = $v;
	}


	
	public function getContactGroup($con = null)
	{
		if ($this->aContactGroup === null && ($this->contact_group_id !== null)) {
						include_once 'lib/model/om/BaseContactGroupPeer.php';

			$this->aContactGroup = ContactGroupPeer::retrieveByPK($this->contact_group_id, $con);

			
		}
		return $this->aContactGroup;
	}

} 