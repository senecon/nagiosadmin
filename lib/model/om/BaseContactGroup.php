<?php


abstract class BaseContactGroup extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $alias;


	
	protected $special;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collGroupToContacts;

	
	protected $lastGroupToContactCriteria = null;

	
	protected $collHostToContactGroups;

	
	protected $lastHostToContactGroupCriteria = null;

	
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
			$this->modifiedColumns[] = ContactGroupPeer::ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ContactGroupPeer::NAME;
		}

	} 
	
	public function setAlias($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->alias !== $v) {
			$this->alias = $v;
			$this->modifiedColumns[] = ContactGroupPeer::ALIAS;
		}

	} 
	
	public function setSpecial($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->special !== $v) {
			$this->special = $v;
			$this->modifiedColumns[] = ContactGroupPeer::SPECIAL;
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
			$this->modifiedColumns[] = ContactGroupPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ContactGroupPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->alias = $rs->getString($startcol + 2);

			$this->special = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ContactGroup object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ContactGroupPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ContactGroupPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ContactGroupPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ContactGroupPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ContactGroupPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ContactGroupPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ContactGroupPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collGroupToContacts !== null) {
				foreach($this->collGroupToContacts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHostToContactGroups !== null) {
				foreach($this->collHostToContactGroups as $referrerFK) {
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


			if (($retval = ContactGroupPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collGroupToContacts !== null) {
					foreach($this->collGroupToContacts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHostToContactGroups !== null) {
					foreach($this->collHostToContactGroups as $referrerFK) {
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
		$pos = ContactGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
		$keys = ContactGroupPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getAlias(),
			$keys[3] => $this->getSpecial(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ContactGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
		$keys = ContactGroupPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAlias($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSpecial($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ContactGroupPeer::DATABASE_NAME);

		if ($this->isColumnModified(ContactGroupPeer::ID)) $criteria->add(ContactGroupPeer::ID, $this->id);
		if ($this->isColumnModified(ContactGroupPeer::NAME)) $criteria->add(ContactGroupPeer::NAME, $this->name);
		if ($this->isColumnModified(ContactGroupPeer::ALIAS)) $criteria->add(ContactGroupPeer::ALIAS, $this->alias);
		if ($this->isColumnModified(ContactGroupPeer::SPECIAL)) $criteria->add(ContactGroupPeer::SPECIAL, $this->special);
		if ($this->isColumnModified(ContactGroupPeer::CREATED_AT)) $criteria->add(ContactGroupPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ContactGroupPeer::UPDATED_AT)) $criteria->add(ContactGroupPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ContactGroupPeer::DATABASE_NAME);

		$criteria->add(ContactGroupPeer::ID, $this->id);

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

		$copyObj->setSpecial($this->special);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getGroupToContacts() as $relObj) {
				$copyObj->addGroupToContact($relObj->copy($deepCopy));
			}

			foreach($this->getHostToContactGroups() as $relObj) {
				$copyObj->addHostToContactGroup($relObj->copy($deepCopy));
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
			self::$peer = new ContactGroupPeer();
		}
		return self::$peer;
	}

	
	public function initGroupToContacts()
	{
		if ($this->collGroupToContacts === null) {
			$this->collGroupToContacts = array();
		}
	}

	
	public function getGroupToContacts($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseGroupToContactPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGroupToContacts === null) {
			if ($this->isNew()) {
			   $this->collGroupToContacts = array();
			} else {

				$criteria->add(GroupToContactPeer::GROUP_ID, $this->getId());

				GroupToContactPeer::addSelectColumns($criteria);
				$this->collGroupToContacts = GroupToContactPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(GroupToContactPeer::GROUP_ID, $this->getId());

				GroupToContactPeer::addSelectColumns($criteria);
				if (!isset($this->lastGroupToContactCriteria) || !$this->lastGroupToContactCriteria->equals($criteria)) {
					$this->collGroupToContacts = GroupToContactPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGroupToContactCriteria = $criteria;
		return $this->collGroupToContacts;
	}

	
	public function countGroupToContacts($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseGroupToContactPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(GroupToContactPeer::GROUP_ID, $this->getId());

		return GroupToContactPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addGroupToContact(GroupToContact $l)
	{
		$this->collGroupToContacts[] = $l;
		$l->setContactGroup($this);
	}


	
	public function getGroupToContactsJoinContact($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseGroupToContactPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGroupToContacts === null) {
			if ($this->isNew()) {
				$this->collGroupToContacts = array();
			} else {

				$criteria->add(GroupToContactPeer::GROUP_ID, $this->getId());

				$this->collGroupToContacts = GroupToContactPeer::doSelectJoinContact($criteria, $con);
			}
		} else {
									
			$criteria->add(GroupToContactPeer::GROUP_ID, $this->getId());

			if (!isset($this->lastGroupToContactCriteria) || !$this->lastGroupToContactCriteria->equals($criteria)) {
				$this->collGroupToContacts = GroupToContactPeer::doSelectJoinContact($criteria, $con);
			}
		}
		$this->lastGroupToContactCriteria = $criteria;

		return $this->collGroupToContacts;
	}

	
	public function initHostToContactGroups()
	{
		if ($this->collHostToContactGroups === null) {
			$this->collHostToContactGroups = array();
		}
	}

	
	public function getHostToContactGroups($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseHostToContactGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHostToContactGroups === null) {
			if ($this->isNew()) {
			   $this->collHostToContactGroups = array();
			} else {

				$criteria->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $this->getId());

				HostToContactGroupPeer::addSelectColumns($criteria);
				$this->collHostToContactGroups = HostToContactGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $this->getId());

				HostToContactGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastHostToContactGroupCriteria) || !$this->lastHostToContactGroupCriteria->equals($criteria)) {
					$this->collHostToContactGroups = HostToContactGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHostToContactGroupCriteria = $criteria;
		return $this->collHostToContactGroups;
	}

	
	public function countHostToContactGroups($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseHostToContactGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $this->getId());

		return HostToContactGroupPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addHostToContactGroup(HostToContactGroup $l)
	{
		$this->collHostToContactGroups[] = $l;
		$l->setContactGroup($this);
	}


	
	public function getHostToContactGroupsJoinHost($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseHostToContactGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHostToContactGroups === null) {
			if ($this->isNew()) {
				$this->collHostToContactGroups = array();
			} else {

				$criteria->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $this->getId());

				$this->collHostToContactGroups = HostToContactGroupPeer::doSelectJoinHost($criteria, $con);
			}
		} else {
									
			$criteria->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $this->getId());

			if (!isset($this->lastHostToContactGroupCriteria) || !$this->lastHostToContactGroupCriteria->equals($criteria)) {
				$this->collHostToContactGroups = HostToContactGroupPeer::doSelectJoinHost($criteria, $con);
			}
		}
		$this->lastHostToContactGroupCriteria = $criteria;

		return $this->collHostToContactGroups;
	}

} 