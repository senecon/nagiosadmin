<?php


abstract class BaseGroupToContact extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $group_id;


	
	protected $contact_id;

	
	protected $aContactGroup;

	
	protected $aContact;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getGroupId()
	{

		return $this->group_id;
	}

	
	public function getContactId()
	{

		return $this->contact_id;
	}

	
	public function setGroupId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->group_id !== $v) {
			$this->group_id = $v;
			$this->modifiedColumns[] = GroupToContactPeer::GROUP_ID;
		}

		if ($this->aContactGroup !== null && $this->aContactGroup->getId() !== $v) {
			$this->aContactGroup = null;
		}

	} 
	
	public function setContactId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->contact_id !== $v) {
			$this->contact_id = $v;
			$this->modifiedColumns[] = GroupToContactPeer::CONTACT_ID;
		}

		if ($this->aContact !== null && $this->aContact->getId() !== $v) {
			$this->aContact = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->group_id = $rs->getInt($startcol + 0);

			$this->contact_id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating GroupToContact object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(GroupToContactPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			GroupToContactPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(GroupToContactPeer::DATABASE_NAME);
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


												
			if ($this->aContactGroup !== null) {
				if ($this->aContactGroup->isModified()) {
					$affectedRows += $this->aContactGroup->save($con);
				}
				$this->setContactGroup($this->aContactGroup);
			}

			if ($this->aContact !== null) {
				if ($this->aContact->isModified()) {
					$affectedRows += $this->aContact->save($con);
				}
				$this->setContact($this->aContact);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = GroupToContactPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += GroupToContactPeer::doUpdate($this, $con);
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


												
			if ($this->aContactGroup !== null) {
				if (!$this->aContactGroup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aContactGroup->getValidationFailures());
				}
			}

			if ($this->aContact !== null) {
				if (!$this->aContact->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aContact->getValidationFailures());
				}
			}


			if (($retval = GroupToContactPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GroupToContactPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getGroupId();
				break;
			case 1:
				return $this->getContactId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GroupToContactPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getGroupId(),
			$keys[1] => $this->getContactId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GroupToContactPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setGroupId($value);
				break;
			case 1:
				$this->setContactId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GroupToContactPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setGroupId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setContactId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(GroupToContactPeer::DATABASE_NAME);

		if ($this->isColumnModified(GroupToContactPeer::GROUP_ID)) $criteria->add(GroupToContactPeer::GROUP_ID, $this->group_id);
		if ($this->isColumnModified(GroupToContactPeer::CONTACT_ID)) $criteria->add(GroupToContactPeer::CONTACT_ID, $this->contact_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(GroupToContactPeer::DATABASE_NAME);

		$criteria->add(GroupToContactPeer::GROUP_ID, $this->group_id);
		$criteria->add(GroupToContactPeer::CONTACT_ID, $this->contact_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getGroupId();

		$pks[1] = $this->getContactId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setGroupId($keys[0]);

		$this->setContactId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setGroupId(NULL); 
		$copyObj->setContactId(NULL); 
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
			self::$peer = new GroupToContactPeer();
		}
		return self::$peer;
	}

	
	public function setContactGroup($v)
	{


		if ($v === null) {
			$this->setGroupId(NULL);
		} else {
			$this->setGroupId($v->getId());
		}


		$this->aContactGroup = $v;
	}


	
	public function getContactGroup($con = null)
	{
		if ($this->aContactGroup === null && ($this->group_id !== null)) {
						include_once 'lib/model/om/BaseContactGroupPeer.php';

			$this->aContactGroup = ContactGroupPeer::retrieveByPK($this->group_id, $con);

			
		}
		return $this->aContactGroup;
	}

	
	public function setContact($v)
	{


		if ($v === null) {
			$this->setContactId(NULL);
		} else {
			$this->setContactId($v->getId());
		}


		$this->aContact = $v;
	}


	
	public function getContact($con = null)
	{
		if ($this->aContact === null && ($this->contact_id !== null)) {
						include_once 'lib/model/om/BaseContactPeer.php';

			$this->aContact = ContactPeer::retrieveByPK($this->contact_id, $con);

			
		}
		return $this->aContact;
	}

} 