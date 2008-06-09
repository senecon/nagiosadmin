<?php


abstract class BaseHost extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $group_id;


	
	protected $name;


	
	protected $alias;


	
	protected $address;


	
	protected $special;


	
	protected $os_id;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aHostGroup;

	
	protected $aOs;

	
	protected $collHostServiceParams;

	
	protected $lastHostServiceParamCriteria = null;

	
	protected $collHostToContactGroups;

	
	protected $lastHostToContactGroupCriteria = null;

	
	protected $collServiceToHosts;

	
	protected $lastServiceToHostCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getGroupId()
	{

		return $this->group_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getAlias()
	{

		return $this->alias;
	}

	
	public function getAddress()
	{

		return $this->address;
	}

	
	public function getSpecial()
	{

		return $this->special;
	}

	
	public function getOsId()
	{

		return $this->os_id;
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
			$this->modifiedColumns[] = HostPeer::ID;
		}

	} 
	
	public function setGroupId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->group_id !== $v) {
			$this->group_id = $v;
			$this->modifiedColumns[] = HostPeer::GROUP_ID;
		}

		if ($this->aHostGroup !== null && $this->aHostGroup->getId() !== $v) {
			$this->aHostGroup = null;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = HostPeer::NAME;
		}

	} 
	
	public function setAlias($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->alias !== $v) {
			$this->alias = $v;
			$this->modifiedColumns[] = HostPeer::ALIAS;
		}

	} 
	
	public function setAddress($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address !== $v) {
			$this->address = $v;
			$this->modifiedColumns[] = HostPeer::ADDRESS;
		}

	} 
	
	public function setSpecial($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->special !== $v) {
			$this->special = $v;
			$this->modifiedColumns[] = HostPeer::SPECIAL;
		}

	} 
	
	public function setOsId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->os_id !== $v) {
			$this->os_id = $v;
			$this->modifiedColumns[] = HostPeer::OS_ID;
		}

		if ($this->aOs !== null && $this->aOs->getId() !== $v) {
			$this->aOs = null;
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
			$this->modifiedColumns[] = HostPeer::CREATED_AT;
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
			$this->modifiedColumns[] = HostPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->group_id = $rs->getInt($startcol + 1);

			$this->name = $rs->getString($startcol + 2);

			$this->alias = $rs->getString($startcol + 3);

			$this->address = $rs->getString($startcol + 4);

			$this->special = $rs->getString($startcol + 5);

			$this->os_id = $rs->getInt($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Host object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HostPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			HostPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(HostPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(HostPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HostPeer::DATABASE_NAME);
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

			if ($this->aOs !== null) {
				if ($this->aOs->isModified()) {
					$affectedRows += $this->aOs->save($con);
				}
				$this->setOs($this->aOs);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HostPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += HostPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collHostServiceParams !== null) {
				foreach($this->collHostServiceParams as $referrerFK) {
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

			if ($this->collServiceToHosts !== null) {
				foreach($this->collServiceToHosts as $referrerFK) {
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


												
			if ($this->aHostGroup !== null) {
				if (!$this->aHostGroup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aHostGroup->getValidationFailures());
				}
			}

			if ($this->aOs !== null) {
				if (!$this->aOs->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOs->getValidationFailures());
				}
			}


			if (($retval = HostPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collHostServiceParams !== null) {
					foreach($this->collHostServiceParams as $referrerFK) {
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

				if ($this->collServiceToHosts !== null) {
					foreach($this->collServiceToHosts as $referrerFK) {
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
		$pos = HostPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getGroupId();
				break;
			case 2:
				return $this->getName();
				break;
			case 3:
				return $this->getAlias();
				break;
			case 4:
				return $this->getAddress();
				break;
			case 5:
				return $this->getSpecial();
				break;
			case 6:
				return $this->getOsId();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HostPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getGroupId(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getAlias(),
			$keys[4] => $this->getAddress(),
			$keys[5] => $this->getSpecial(),
			$keys[6] => $this->getOsId(),
			$keys[7] => $this->getCreatedAt(),
			$keys[8] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HostPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setGroupId($value);
				break;
			case 2:
				$this->setName($value);
				break;
			case 3:
				$this->setAlias($value);
				break;
			case 4:
				$this->setAddress($value);
				break;
			case 5:
				$this->setSpecial($value);
				break;
			case 6:
				$this->setOsId($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HostPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setGroupId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAlias($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAddress($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSpecial($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setOsId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(HostPeer::DATABASE_NAME);

		if ($this->isColumnModified(HostPeer::ID)) $criteria->add(HostPeer::ID, $this->id);
		if ($this->isColumnModified(HostPeer::GROUP_ID)) $criteria->add(HostPeer::GROUP_ID, $this->group_id);
		if ($this->isColumnModified(HostPeer::NAME)) $criteria->add(HostPeer::NAME, $this->name);
		if ($this->isColumnModified(HostPeer::ALIAS)) $criteria->add(HostPeer::ALIAS, $this->alias);
		if ($this->isColumnModified(HostPeer::ADDRESS)) $criteria->add(HostPeer::ADDRESS, $this->address);
		if ($this->isColumnModified(HostPeer::SPECIAL)) $criteria->add(HostPeer::SPECIAL, $this->special);
		if ($this->isColumnModified(HostPeer::OS_ID)) $criteria->add(HostPeer::OS_ID, $this->os_id);
		if ($this->isColumnModified(HostPeer::CREATED_AT)) $criteria->add(HostPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(HostPeer::UPDATED_AT)) $criteria->add(HostPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(HostPeer::DATABASE_NAME);

		$criteria->add(HostPeer::ID, $this->id);

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

		$copyObj->setGroupId($this->group_id);

		$copyObj->setName($this->name);

		$copyObj->setAlias($this->alias);

		$copyObj->setAddress($this->address);

		$copyObj->setSpecial($this->special);

		$copyObj->setOsId($this->os_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getHostServiceParams() as $relObj) {
				$copyObj->addHostServiceParam($relObj->copy($deepCopy));
			}

			foreach($this->getHostToContactGroups() as $relObj) {
				$copyObj->addHostToContactGroup($relObj->copy($deepCopy));
			}

			foreach($this->getServiceToHosts() as $relObj) {
				$copyObj->addServiceToHost($relObj->copy($deepCopy));
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
			self::$peer = new HostPeer();
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
		if ($this->aHostGroup === null && ($this->group_id !== null)) {
						include_once 'lib/model/om/BaseHostGroupPeer.php';

			$this->aHostGroup = HostGroupPeer::retrieveByPK($this->group_id, $con);

			
		}
		return $this->aHostGroup;
	}

	
	public function setOs($v)
	{


		if ($v === null) {
			$this->setOsId(NULL);
		} else {
			$this->setOsId($v->getId());
		}


		$this->aOs = $v;
	}


	
	public function getOs($con = null)
	{
		if ($this->aOs === null && ($this->os_id !== null)) {
						include_once 'lib/model/om/BaseOsPeer.php';

			$this->aOs = OsPeer::retrieveByPK($this->os_id, $con);

			
		}
		return $this->aOs;
	}

	
	public function initHostServiceParams()
	{
		if ($this->collHostServiceParams === null) {
			$this->collHostServiceParams = array();
		}
	}

	
	public function getHostServiceParams($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseHostServiceParamPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHostServiceParams === null) {
			if ($this->isNew()) {
			   $this->collHostServiceParams = array();
			} else {

				$criteria->add(HostServiceParamPeer::HOST_ID, $this->getId());

				HostServiceParamPeer::addSelectColumns($criteria);
				$this->collHostServiceParams = HostServiceParamPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HostServiceParamPeer::HOST_ID, $this->getId());

				HostServiceParamPeer::addSelectColumns($criteria);
				if (!isset($this->lastHostServiceParamCriteria) || !$this->lastHostServiceParamCriteria->equals($criteria)) {
					$this->collHostServiceParams = HostServiceParamPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHostServiceParamCriteria = $criteria;
		return $this->collHostServiceParams;
	}

	
	public function countHostServiceParams($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseHostServiceParamPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(HostServiceParamPeer::HOST_ID, $this->getId());

		return HostServiceParamPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addHostServiceParam(HostServiceParam $l)
	{
		$this->collHostServiceParams[] = $l;
		$l->setHost($this);
	}


	
	public function getHostServiceParamsJoinService($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseHostServiceParamPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHostServiceParams === null) {
			if ($this->isNew()) {
				$this->collHostServiceParams = array();
			} else {

				$criteria->add(HostServiceParamPeer::HOST_ID, $this->getId());

				$this->collHostServiceParams = HostServiceParamPeer::doSelectJoinService($criteria, $con);
			}
		} else {
									
			$criteria->add(HostServiceParamPeer::HOST_ID, $this->getId());

			if (!isset($this->lastHostServiceParamCriteria) || !$this->lastHostServiceParamCriteria->equals($criteria)) {
				$this->collHostServiceParams = HostServiceParamPeer::doSelectJoinService($criteria, $con);
			}
		}
		$this->lastHostServiceParamCriteria = $criteria;

		return $this->collHostServiceParams;
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

				$criteria->add(HostToContactGroupPeer::HOST_ID, $this->getId());

				HostToContactGroupPeer::addSelectColumns($criteria);
				$this->collHostToContactGroups = HostToContactGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HostToContactGroupPeer::HOST_ID, $this->getId());

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

		$criteria->add(HostToContactGroupPeer::HOST_ID, $this->getId());

		return HostToContactGroupPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addHostToContactGroup(HostToContactGroup $l)
	{
		$this->collHostToContactGroups[] = $l;
		$l->setHost($this);
	}


	
	public function getHostToContactGroupsJoinContactGroup($criteria = null, $con = null)
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

				$criteria->add(HostToContactGroupPeer::HOST_ID, $this->getId());

				$this->collHostToContactGroups = HostToContactGroupPeer::doSelectJoinContactGroup($criteria, $con);
			}
		} else {
									
			$criteria->add(HostToContactGroupPeer::HOST_ID, $this->getId());

			if (!isset($this->lastHostToContactGroupCriteria) || !$this->lastHostToContactGroupCriteria->equals($criteria)) {
				$this->collHostToContactGroups = HostToContactGroupPeer::doSelectJoinContactGroup($criteria, $con);
			}
		}
		$this->lastHostToContactGroupCriteria = $criteria;

		return $this->collHostToContactGroups;
	}

	
	public function initServiceToHosts()
	{
		if ($this->collServiceToHosts === null) {
			$this->collServiceToHosts = array();
		}
	}

	
	public function getServiceToHosts($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseServiceToHostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collServiceToHosts === null) {
			if ($this->isNew()) {
			   $this->collServiceToHosts = array();
			} else {

				$criteria->add(ServiceToHostPeer::HOST_ID, $this->getId());

				ServiceToHostPeer::addSelectColumns($criteria);
				$this->collServiceToHosts = ServiceToHostPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ServiceToHostPeer::HOST_ID, $this->getId());

				ServiceToHostPeer::addSelectColumns($criteria);
				if (!isset($this->lastServiceToHostCriteria) || !$this->lastServiceToHostCriteria->equals($criteria)) {
					$this->collServiceToHosts = ServiceToHostPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastServiceToHostCriteria = $criteria;
		return $this->collServiceToHosts;
	}

	
	public function countServiceToHosts($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseServiceToHostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ServiceToHostPeer::HOST_ID, $this->getId());

		return ServiceToHostPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addServiceToHost(ServiceToHost $l)
	{
		$this->collServiceToHosts[] = $l;
		$l->setHost($this);
	}


	
	public function getServiceToHostsJoinService($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseServiceToHostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collServiceToHosts === null) {
			if ($this->isNew()) {
				$this->collServiceToHosts = array();
			} else {

				$criteria->add(ServiceToHostPeer::HOST_ID, $this->getId());

				$this->collServiceToHosts = ServiceToHostPeer::doSelectJoinService($criteria, $con);
			}
		} else {
									
			$criteria->add(ServiceToHostPeer::HOST_ID, $this->getId());

			if (!isset($this->lastServiceToHostCriteria) || !$this->lastServiceToHostCriteria->equals($criteria)) {
				$this->collServiceToHosts = ServiceToHostPeer::doSelectJoinService($criteria, $con);
			}
		}
		$this->lastServiceToHostCriteria = $criteria;

		return $this->collServiceToHosts;
	}

} 