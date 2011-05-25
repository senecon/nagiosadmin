<?php


abstract class BaseHostToContactGroup extends BaseObject  implements Persistent {


  const PEER = 'HostToContactGroupPeer';

	
	protected static $peer;

	
	protected $host_id;

	
	protected $contact_group_id;

	
	protected $aHost;

	
	protected $aContactGroup;

	
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

	
	public function getContactGroupId()
	{
		return $this->contact_group_id;
	}

	
	public function setHostId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->host_id !== $v) {
			$this->host_id = $v;
			$this->modifiedColumns[] = HostToContactGroupPeer::HOST_ID;
		}

		if ($this->aHost !== null && $this->aHost->getId() !== $v) {
			$this->aHost = null;
		}

		return $this;
	} 
	
	public function setContactGroupId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->contact_group_id !== $v) {
			$this->contact_group_id = $v;
			$this->modifiedColumns[] = HostToContactGroupPeer::CONTACT_GROUP_ID;
		}

		if ($this->aContactGroup !== null && $this->aContactGroup->getId() !== $v) {
			$this->aContactGroup = null;
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
			$this->contact_group_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating HostToContactGroup object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aHost !== null && $this->host_id !== $this->aHost->getId()) {
			$this->aHost = null;
		}
		if ($this->aContactGroup !== null && $this->contact_group_id !== $this->aContactGroup->getId()) {
			$this->aContactGroup = null;
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
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = HostToContactGroupPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aHost = null;
			$this->aContactGroup = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			HostToContactGroupPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			HostToContactGroupPeer::addInstanceToPool($this);
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

			if ($this->aContactGroup !== null) {
				if ($this->aContactGroup->isModified() || $this->aContactGroup->isNew()) {
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
				return $this->getContactGroupId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
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

		$copyObj->setHostId($this->host_id);

		$copyObj->setContactGroupId($this->contact_group_id);


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
			self::$peer = new HostToContactGroupPeer();
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
			$v->addHostToContactGroup($this);
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

	
	public function setContactGroup(ContactGroup $v = null)
	{
		if ($v === null) {
			$this->setContactGroupId(NULL);
		} else {
			$this->setContactGroupId($v->getId());
		}

		$this->aContactGroup = $v;

						if ($v !== null) {
			$v->addHostToContactGroup($this);
		}

		return $this;
	}


	
	public function getContactGroup(PropelPDO $con = null)
	{
		if ($this->aContactGroup === null && ($this->contact_group_id !== null)) {
			$c = new Criteria(ContactGroupPeer::DATABASE_NAME);
			$c->add(ContactGroupPeer::ID, $this->contact_group_id);
			$this->aContactGroup = ContactGroupPeer::doSelectOne($c, $con);
			
		}
		return $this->aContactGroup;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aHost = null;
			$this->aContactGroup = null;
	}

} 