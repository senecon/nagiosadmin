<?php


abstract class BaseContactGroup extends BaseObject  implements Persistent {


  const PEER = 'ContactGroupPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $name;

	
	protected $alias;

	
	protected $special;

	
	protected $created_at;

	
	protected $updated_at;

	
	protected $collGroupToContacts;

	
	private $lastGroupToContactCriteria = null;

	
	protected $collHostToContactGroups;

	
	private $lastHostToContactGroupCriteria = null;

	
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

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ContactGroupPeer::ID;
		}

		return $this;
	} 
	
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ContactGroupPeer::NAME;
		}

		return $this;
	} 
	
	public function setAlias($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->alias !== $v) {
			$this->alias = $v;
			$this->modifiedColumns[] = ContactGroupPeer::ALIAS;
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
			$this->modifiedColumns[] = ContactGroupPeer::SPECIAL;
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
				$this->modifiedColumns[] = ContactGroupPeer::CREATED_AT;
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
				$this->modifiedColumns[] = ContactGroupPeer::UPDATED_AT;
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

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->alias = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
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
			throw new PropelException("Error populating ContactGroup object", $e);
		}
	}

	
	public function ensureConsistency()
	{

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
			$con = Propel::getConnection(ContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = ContactGroupPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collGroupToContacts = null;
			$this->lastGroupToContactCriteria = null;

			$this->collHostToContactGroups = null;
			$this->lastHostToContactGroupCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ContactGroupPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public function save(PropelPDO $con = null)
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
			$con = Propel::getConnection(ContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			ContactGroupPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ContactGroupPeer::ID;
			}

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
				foreach ($this->collGroupToContacts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHostToContactGroups !== null) {
				foreach ($this->collHostToContactGroups as $referrerFK) {
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
					foreach ($this->collGroupToContacts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHostToContactGroups !== null) {
					foreach ($this->collHostToContactGroups as $referrerFK) {
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
		$field = $this->getByPosition($pos);
		return $field;
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

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
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

			foreach ($this->getGroupToContacts() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addGroupToContact($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHostToContactGroups() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addHostToContactGroup($relObj->copy($deepCopy));
				}
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

	
	public function clearGroupToContacts()
	{
		$this->collGroupToContacts = null; 	}

	
	public function initGroupToContacts()
	{
		$this->collGroupToContacts = array();
	}

	
	public function getGroupToContacts($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ContactGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGroupToContacts === null) {
			if ($this->isNew()) {
			   $this->collGroupToContacts = array();
			} else {

				$criteria->add(GroupToContactPeer::GROUP_ID, $this->id);

				GroupToContactPeer::addSelectColumns($criteria);
				$this->collGroupToContacts = GroupToContactPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(GroupToContactPeer::GROUP_ID, $this->id);

				GroupToContactPeer::addSelectColumns($criteria);
				if (!isset($this->lastGroupToContactCriteria) || !$this->lastGroupToContactCriteria->equals($criteria)) {
					$this->collGroupToContacts = GroupToContactPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGroupToContactCriteria = $criteria;
		return $this->collGroupToContacts;
	}

	
	public function countGroupToContacts(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ContactGroupPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collGroupToContacts === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(GroupToContactPeer::GROUP_ID, $this->id);

				$count = GroupToContactPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(GroupToContactPeer::GROUP_ID, $this->id);

				if (!isset($this->lastGroupToContactCriteria) || !$this->lastGroupToContactCriteria->equals($criteria)) {
					$count = GroupToContactPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collGroupToContacts);
				}
			} else {
				$count = count($this->collGroupToContacts);
			}
		}
		return $count;
	}

	
	public function addGroupToContact(GroupToContact $l)
	{
		if ($this->collGroupToContacts === null) {
			$this->initGroupToContacts();
		}
		if (!in_array($l, $this->collGroupToContacts, true)) { 			array_push($this->collGroupToContacts, $l);
			$l->setContactGroup($this);
		}
	}


	
	public function getGroupToContactsJoinContact($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ContactGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGroupToContacts === null) {
			if ($this->isNew()) {
				$this->collGroupToContacts = array();
			} else {

				$criteria->add(GroupToContactPeer::GROUP_ID, $this->id);

				$this->collGroupToContacts = GroupToContactPeer::doSelectJoinContact($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(GroupToContactPeer::GROUP_ID, $this->id);

			if (!isset($this->lastGroupToContactCriteria) || !$this->lastGroupToContactCriteria->equals($criteria)) {
				$this->collGroupToContacts = GroupToContactPeer::doSelectJoinContact($criteria, $con, $join_behavior);
			}
		}
		$this->lastGroupToContactCriteria = $criteria;

		return $this->collGroupToContacts;
	}

	
	public function clearHostToContactGroups()
	{
		$this->collHostToContactGroups = null; 	}

	
	public function initHostToContactGroups()
	{
		$this->collHostToContactGroups = array();
	}

	
	public function getHostToContactGroups($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ContactGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHostToContactGroups === null) {
			if ($this->isNew()) {
			   $this->collHostToContactGroups = array();
			} else {

				$criteria->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $this->id);

				HostToContactGroupPeer::addSelectColumns($criteria);
				$this->collHostToContactGroups = HostToContactGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $this->id);

				HostToContactGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastHostToContactGroupCriteria) || !$this->lastHostToContactGroupCriteria->equals($criteria)) {
					$this->collHostToContactGroups = HostToContactGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHostToContactGroupCriteria = $criteria;
		return $this->collHostToContactGroups;
	}

	
	public function countHostToContactGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ContactGroupPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHostToContactGroups === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $this->id);

				$count = HostToContactGroupPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $this->id);

				if (!isset($this->lastHostToContactGroupCriteria) || !$this->lastHostToContactGroupCriteria->equals($criteria)) {
					$count = HostToContactGroupPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHostToContactGroups);
				}
			} else {
				$count = count($this->collHostToContactGroups);
			}
		}
		return $count;
	}

	
	public function addHostToContactGroup(HostToContactGroup $l)
	{
		if ($this->collHostToContactGroups === null) {
			$this->initHostToContactGroups();
		}
		if (!in_array($l, $this->collHostToContactGroups, true)) { 			array_push($this->collHostToContactGroups, $l);
			$l->setContactGroup($this);
		}
	}


	
	public function getHostToContactGroupsJoinHost($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ContactGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHostToContactGroups === null) {
			if ($this->isNew()) {
				$this->collHostToContactGroups = array();
			} else {

				$criteria->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $this->id);

				$this->collHostToContactGroups = HostToContactGroupPeer::doSelectJoinHost($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $this->id);

			if (!isset($this->lastHostToContactGroupCriteria) || !$this->lastHostToContactGroupCriteria->equals($criteria)) {
				$this->collHostToContactGroups = HostToContactGroupPeer::doSelectJoinHost($criteria, $con, $join_behavior);
			}
		}
		$this->lastHostToContactGroupCriteria = $criteria;

		return $this->collHostToContactGroups;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collGroupToContacts) {
				foreach ((array) $this->collGroupToContacts as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHostToContactGroups) {
				foreach ((array) $this->collHostToContactGroups as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collGroupToContacts = null;
		$this->collHostToContactGroups = null;
	}

} 