<?php


abstract class BaseHost extends BaseObject  implements Persistent {


  const PEER = 'HostPeer';

	
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

	
	private $lastHostServiceParamCriteria = null;

	
	protected $collHostToContactGroups;

	
	private $lastHostToContactGroupCriteria = null;

	
	protected $collServiceToHosts;

	
	private $lastServiceToHostCriteria = null;

	
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
			$this->modifiedColumns[] = HostPeer::ID;
		}

		return $this;
	} 
	
	public function setGroupId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->group_id !== $v) {
			$this->group_id = $v;
			$this->modifiedColumns[] = HostPeer::GROUP_ID;
		}

		if ($this->aHostGroup !== null && $this->aHostGroup->getId() !== $v) {
			$this->aHostGroup = null;
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
			$this->modifiedColumns[] = HostPeer::NAME;
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
			$this->modifiedColumns[] = HostPeer::ALIAS;
		}

		return $this;
	} 
	
	public function setAddress($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->address !== $v) {
			$this->address = $v;
			$this->modifiedColumns[] = HostPeer::ADDRESS;
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
			$this->modifiedColumns[] = HostPeer::SPECIAL;
		}

		return $this;
	} 
	
	public function setOsId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->os_id !== $v) {
			$this->os_id = $v;
			$this->modifiedColumns[] = HostPeer::OS_ID;
		}

		if ($this->aOs !== null && $this->aOs->getId() !== $v) {
			$this->aOs = null;
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
				$this->modifiedColumns[] = HostPeer::CREATED_AT;
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
				$this->modifiedColumns[] = HostPeer::UPDATED_AT;
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
			$this->group_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->alias = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->address = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->special = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->os_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->created_at = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->updated_at = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Host object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aHostGroup !== null && $this->group_id !== $this->aHostGroup->getId()) {
			$this->aHostGroup = null;
		}
		if ($this->aOs !== null && $this->os_id !== $this->aOs->getId()) {
			$this->aOs = null;
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
			$con = Propel::getConnection(HostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = HostPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aHostGroup = null;
			$this->aOs = null;
			$this->collHostServiceParams = null;
			$this->lastHostServiceParamCriteria = null;

			$this->collHostToContactGroups = null;
			$this->lastHostToContactGroupCriteria = null;

			$this->collServiceToHosts = null;
			$this->lastServiceToHostCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HostPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			HostPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public function save(PropelPDO $con = null)
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
			$con = Propel::getConnection(HostPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			HostPeer::addInstanceToPool($this);
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

												
			if ($this->aHostGroup !== null) {
				if ($this->aHostGroup->isModified() || $this->aHostGroup->isNew()) {
					$affectedRows += $this->aHostGroup->save($con);
				}
				$this->setHostGroup($this->aHostGroup);
			}

			if ($this->aOs !== null) {
				if ($this->aOs->isModified() || $this->aOs->isNew()) {
					$affectedRows += $this->aOs->save($con);
				}
				$this->setOs($this->aOs);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = HostPeer::ID;
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
				foreach ($this->collHostServiceParams as $referrerFK) {
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

			if ($this->collServiceToHosts !== null) {
				foreach ($this->collServiceToHosts as $referrerFK) {
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
					foreach ($this->collHostServiceParams as $referrerFK) {
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

				if ($this->collServiceToHosts !== null) {
					foreach ($this->collServiceToHosts as $referrerFK) {
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

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
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

			foreach ($this->getHostServiceParams() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addHostServiceParam($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHostToContactGroups() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addHostToContactGroup($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getServiceToHosts() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addServiceToHost($relObj->copy($deepCopy));
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
			self::$peer = new HostPeer();
		}
		return self::$peer;
	}

	
	public function setHostGroup(HostGroup $v = null)
	{
		if ($v === null) {
			$this->setGroupId(NULL);
		} else {
			$this->setGroupId($v->getId());
		}

		$this->aHostGroup = $v;

						if ($v !== null) {
			$v->addHost($this);
		}

		return $this;
	}


	
	public function getHostGroup(PropelPDO $con = null)
	{
		if ($this->aHostGroup === null && ($this->group_id !== null)) {
			$c = new Criteria(HostGroupPeer::DATABASE_NAME);
			$c->add(HostGroupPeer::ID, $this->group_id);
			$this->aHostGroup = HostGroupPeer::doSelectOne($c, $con);
			
		}
		return $this->aHostGroup;
	}

	
	public function setOs(Os $v = null)
	{
		if ($v === null) {
			$this->setOsId(NULL);
		} else {
			$this->setOsId($v->getId());
		}

		$this->aOs = $v;

						if ($v !== null) {
			$v->addHost($this);
		}

		return $this;
	}


	
	public function getOs(PropelPDO $con = null)
	{
		if ($this->aOs === null && ($this->os_id !== null)) {
			$c = new Criteria(OsPeer::DATABASE_NAME);
			$c->add(OsPeer::ID, $this->os_id);
			$this->aOs = OsPeer::doSelectOne($c, $con);
			
		}
		return $this->aOs;
	}

	
	public function clearHostServiceParams()
	{
		$this->collHostServiceParams = null; 	}

	
	public function initHostServiceParams()
	{
		$this->collHostServiceParams = array();
	}

	
	public function getHostServiceParams($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HostPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHostServiceParams === null) {
			if ($this->isNew()) {
			   $this->collHostServiceParams = array();
			} else {

				$criteria->add(HostServiceParamPeer::HOST_ID, $this->id);

				HostServiceParamPeer::addSelectColumns($criteria);
				$this->collHostServiceParams = HostServiceParamPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HostServiceParamPeer::HOST_ID, $this->id);

				HostServiceParamPeer::addSelectColumns($criteria);
				if (!isset($this->lastHostServiceParamCriteria) || !$this->lastHostServiceParamCriteria->equals($criteria)) {
					$this->collHostServiceParams = HostServiceParamPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHostServiceParamCriteria = $criteria;
		return $this->collHostServiceParams;
	}

	
	public function countHostServiceParams(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HostPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHostServiceParams === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HostServiceParamPeer::HOST_ID, $this->id);

				$count = HostServiceParamPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HostServiceParamPeer::HOST_ID, $this->id);

				if (!isset($this->lastHostServiceParamCriteria) || !$this->lastHostServiceParamCriteria->equals($criteria)) {
					$count = HostServiceParamPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHostServiceParams);
				}
			} else {
				$count = count($this->collHostServiceParams);
			}
		}
		return $count;
	}

	
	public function addHostServiceParam(HostServiceParam $l)
	{
		if ($this->collHostServiceParams === null) {
			$this->initHostServiceParams();
		}
		if (!in_array($l, $this->collHostServiceParams, true)) { 			array_push($this->collHostServiceParams, $l);
			$l->setHost($this);
		}
	}


	
	public function getHostServiceParamsJoinService($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HostPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHostServiceParams === null) {
			if ($this->isNew()) {
				$this->collHostServiceParams = array();
			} else {

				$criteria->add(HostServiceParamPeer::HOST_ID, $this->id);

				$this->collHostServiceParams = HostServiceParamPeer::doSelectJoinService($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HostServiceParamPeer::HOST_ID, $this->id);

			if (!isset($this->lastHostServiceParamCriteria) || !$this->lastHostServiceParamCriteria->equals($criteria)) {
				$this->collHostServiceParams = HostServiceParamPeer::doSelectJoinService($criteria, $con, $join_behavior);
			}
		}
		$this->lastHostServiceParamCriteria = $criteria;

		return $this->collHostServiceParams;
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
			$criteria = new Criteria(HostPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHostToContactGroups === null) {
			if ($this->isNew()) {
			   $this->collHostToContactGroups = array();
			} else {

				$criteria->add(HostToContactGroupPeer::HOST_ID, $this->id);

				HostToContactGroupPeer::addSelectColumns($criteria);
				$this->collHostToContactGroups = HostToContactGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HostToContactGroupPeer::HOST_ID, $this->id);

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
			$criteria = new Criteria(HostPeer::DATABASE_NAME);
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

				$criteria->add(HostToContactGroupPeer::HOST_ID, $this->id);

				$count = HostToContactGroupPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HostToContactGroupPeer::HOST_ID, $this->id);

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
			$l->setHost($this);
		}
	}


	
	public function getHostToContactGroupsJoinContactGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HostPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHostToContactGroups === null) {
			if ($this->isNew()) {
				$this->collHostToContactGroups = array();
			} else {

				$criteria->add(HostToContactGroupPeer::HOST_ID, $this->id);

				$this->collHostToContactGroups = HostToContactGroupPeer::doSelectJoinContactGroup($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HostToContactGroupPeer::HOST_ID, $this->id);

			if (!isset($this->lastHostToContactGroupCriteria) || !$this->lastHostToContactGroupCriteria->equals($criteria)) {
				$this->collHostToContactGroups = HostToContactGroupPeer::doSelectJoinContactGroup($criteria, $con, $join_behavior);
			}
		}
		$this->lastHostToContactGroupCriteria = $criteria;

		return $this->collHostToContactGroups;
	}

	
	public function clearServiceToHosts()
	{
		$this->collServiceToHosts = null; 	}

	
	public function initServiceToHosts()
	{
		$this->collServiceToHosts = array();
	}

	
	public function getServiceToHosts($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HostPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collServiceToHosts === null) {
			if ($this->isNew()) {
			   $this->collServiceToHosts = array();
			} else {

				$criteria->add(ServiceToHostPeer::HOST_ID, $this->id);

				ServiceToHostPeer::addSelectColumns($criteria);
				$this->collServiceToHosts = ServiceToHostPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ServiceToHostPeer::HOST_ID, $this->id);

				ServiceToHostPeer::addSelectColumns($criteria);
				if (!isset($this->lastServiceToHostCriteria) || !$this->lastServiceToHostCriteria->equals($criteria)) {
					$this->collServiceToHosts = ServiceToHostPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastServiceToHostCriteria = $criteria;
		return $this->collServiceToHosts;
	}

	
	public function countServiceToHosts(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HostPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collServiceToHosts === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ServiceToHostPeer::HOST_ID, $this->id);

				$count = ServiceToHostPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ServiceToHostPeer::HOST_ID, $this->id);

				if (!isset($this->lastServiceToHostCriteria) || !$this->lastServiceToHostCriteria->equals($criteria)) {
					$count = ServiceToHostPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collServiceToHosts);
				}
			} else {
				$count = count($this->collServiceToHosts);
			}
		}
		return $count;
	}

	
	public function addServiceToHost(ServiceToHost $l)
	{
		if ($this->collServiceToHosts === null) {
			$this->initServiceToHosts();
		}
		if (!in_array($l, $this->collServiceToHosts, true)) { 			array_push($this->collServiceToHosts, $l);
			$l->setHost($this);
		}
	}


	
	public function getServiceToHostsJoinService($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HostPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collServiceToHosts === null) {
			if ($this->isNew()) {
				$this->collServiceToHosts = array();
			} else {

				$criteria->add(ServiceToHostPeer::HOST_ID, $this->id);

				$this->collServiceToHosts = ServiceToHostPeer::doSelectJoinService($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ServiceToHostPeer::HOST_ID, $this->id);

			if (!isset($this->lastServiceToHostCriteria) || !$this->lastServiceToHostCriteria->equals($criteria)) {
				$this->collServiceToHosts = ServiceToHostPeer::doSelectJoinService($criteria, $con, $join_behavior);
			}
		}
		$this->lastServiceToHostCriteria = $criteria;

		return $this->collServiceToHosts;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collHostServiceParams) {
				foreach ((array) $this->collHostServiceParams as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHostToContactGroups) {
				foreach ((array) $this->collHostToContactGroups as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collServiceToHosts) {
				foreach ((array) $this->collServiceToHosts as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collHostServiceParams = null;
		$this->collHostToContactGroups = null;
		$this->collServiceToHosts = null;
			$this->aHostGroup = null;
			$this->aOs = null;
	}

} 