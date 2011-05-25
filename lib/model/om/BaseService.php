<?php


abstract class BaseService extends BaseObject  implements Persistent {


  const PEER = 'ServicePeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $name;

	
	protected $alias;

	
	protected $command_id;

	
	protected $port;

	
	protected $special;

	
	protected $created_at;

	
	protected $updated_at;

	
	protected $aCommand;

	
	protected $collHostServiceParams;

	
	private $lastHostServiceParamCriteria = null;

	
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

	
	public function getName()
	{
		return $this->name;
	}

	
	public function getAlias()
	{
		return $this->alias;
	}

	
	public function getCommandId()
	{
		return $this->command_id;
	}

	
	public function getPort()
	{
		return $this->port;
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
			$this->modifiedColumns[] = ServicePeer::ID;
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
			$this->modifiedColumns[] = ServicePeer::NAME;
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
			$this->modifiedColumns[] = ServicePeer::ALIAS;
		}

		return $this;
	} 
	
	public function setCommandId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->command_id !== $v) {
			$this->command_id = $v;
			$this->modifiedColumns[] = ServicePeer::COMMAND_ID;
		}

		if ($this->aCommand !== null && $this->aCommand->getId() !== $v) {
			$this->aCommand = null;
		}

		return $this;
	} 
	
	public function setPort($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->port !== $v) {
			$this->port = $v;
			$this->modifiedColumns[] = ServicePeer::PORT;
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
			$this->modifiedColumns[] = ServicePeer::SPECIAL;
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
				$this->modifiedColumns[] = ServicePeer::CREATED_AT;
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
				$this->modifiedColumns[] = ServicePeer::UPDATED_AT;
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
			$this->command_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->port = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->special = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->created_at = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->updated_at = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Service object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aCommand !== null && $this->command_id !== $this->aCommand->getId()) {
			$this->aCommand = null;
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
			$con = Propel::getConnection(ServicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = ServicePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aCommand = null;
			$this->collHostServiceParams = null;
			$this->lastHostServiceParamCriteria = null;

			$this->collServiceToHosts = null;
			$this->lastServiceToHostCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ServicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ServicePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public function save(PropelPDO $con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ServicePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ServicePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ServicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			ServicePeer::addInstanceToPool($this);
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

												
			if ($this->aCommand !== null) {
				if ($this->aCommand->isModified() || $this->aCommand->isNew()) {
					$affectedRows += $this->aCommand->save($con);
				}
				$this->setCommand($this->aCommand);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ServicePeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ServicePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ServicePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collHostServiceParams !== null) {
				foreach ($this->collHostServiceParams as $referrerFK) {
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


												
			if ($this->aCommand !== null) {
				if (!$this->aCommand->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCommand->getValidationFailures());
				}
			}


			if (($retval = ServicePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collHostServiceParams !== null) {
					foreach ($this->collHostServiceParams as $referrerFK) {
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
		$pos = ServicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCommandId();
				break;
			case 4:
				return $this->getPort();
				break;
			case 5:
				return $this->getSpecial();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			case 7:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = ServicePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getAlias(),
			$keys[3] => $this->getCommandId(),
			$keys[4] => $this->getPort(),
			$keys[5] => $this->getSpecial(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ServicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCommandId($value);
				break;
			case 4:
				$this->setPort($value);
				break;
			case 5:
				$this->setSpecial($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
			case 7:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ServicePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAlias($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCommandId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPort($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSpecial($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ServicePeer::DATABASE_NAME);

		if ($this->isColumnModified(ServicePeer::ID)) $criteria->add(ServicePeer::ID, $this->id);
		if ($this->isColumnModified(ServicePeer::NAME)) $criteria->add(ServicePeer::NAME, $this->name);
		if ($this->isColumnModified(ServicePeer::ALIAS)) $criteria->add(ServicePeer::ALIAS, $this->alias);
		if ($this->isColumnModified(ServicePeer::COMMAND_ID)) $criteria->add(ServicePeer::COMMAND_ID, $this->command_id);
		if ($this->isColumnModified(ServicePeer::PORT)) $criteria->add(ServicePeer::PORT, $this->port);
		if ($this->isColumnModified(ServicePeer::SPECIAL)) $criteria->add(ServicePeer::SPECIAL, $this->special);
		if ($this->isColumnModified(ServicePeer::CREATED_AT)) $criteria->add(ServicePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ServicePeer::UPDATED_AT)) $criteria->add(ServicePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ServicePeer::DATABASE_NAME);

		$criteria->add(ServicePeer::ID, $this->id);

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

		$copyObj->setCommandId($this->command_id);

		$copyObj->setPort($this->port);

		$copyObj->setSpecial($this->special);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getHostServiceParams() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addHostServiceParam($relObj->copy($deepCopy));
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
			self::$peer = new ServicePeer();
		}
		return self::$peer;
	}

	
	public function setCommand(Command $v = null)
	{
		if ($v === null) {
			$this->setCommandId(NULL);
		} else {
			$this->setCommandId($v->getId());
		}

		$this->aCommand = $v;

						if ($v !== null) {
			$v->addService($this);
		}

		return $this;
	}


	
	public function getCommand(PropelPDO $con = null)
	{
		if ($this->aCommand === null && ($this->command_id !== null)) {
			$c = new Criteria(CommandPeer::DATABASE_NAME);
			$c->add(CommandPeer::ID, $this->command_id);
			$this->aCommand = CommandPeer::doSelectOne($c, $con);
			
		}
		return $this->aCommand;
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
			$criteria = new Criteria(ServicePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHostServiceParams === null) {
			if ($this->isNew()) {
			   $this->collHostServiceParams = array();
			} else {

				$criteria->add(HostServiceParamPeer::SERVICE_ID, $this->id);

				HostServiceParamPeer::addSelectColumns($criteria);
				$this->collHostServiceParams = HostServiceParamPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HostServiceParamPeer::SERVICE_ID, $this->id);

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
			$criteria = new Criteria(ServicePeer::DATABASE_NAME);
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

				$criteria->add(HostServiceParamPeer::SERVICE_ID, $this->id);

				$count = HostServiceParamPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HostServiceParamPeer::SERVICE_ID, $this->id);

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
			$l->setService($this);
		}
	}


	
	public function getHostServiceParamsJoinHost($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ServicePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHostServiceParams === null) {
			if ($this->isNew()) {
				$this->collHostServiceParams = array();
			} else {

				$criteria->add(HostServiceParamPeer::SERVICE_ID, $this->id);

				$this->collHostServiceParams = HostServiceParamPeer::doSelectJoinHost($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HostServiceParamPeer::SERVICE_ID, $this->id);

			if (!isset($this->lastHostServiceParamCriteria) || !$this->lastHostServiceParamCriteria->equals($criteria)) {
				$this->collHostServiceParams = HostServiceParamPeer::doSelectJoinHost($criteria, $con, $join_behavior);
			}
		}
		$this->lastHostServiceParamCriteria = $criteria;

		return $this->collHostServiceParams;
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
			$criteria = new Criteria(ServicePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collServiceToHosts === null) {
			if ($this->isNew()) {
			   $this->collServiceToHosts = array();
			} else {

				$criteria->add(ServiceToHostPeer::SERVICE_ID, $this->id);

				ServiceToHostPeer::addSelectColumns($criteria);
				$this->collServiceToHosts = ServiceToHostPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ServiceToHostPeer::SERVICE_ID, $this->id);

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
			$criteria = new Criteria(ServicePeer::DATABASE_NAME);
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

				$criteria->add(ServiceToHostPeer::SERVICE_ID, $this->id);

				$count = ServiceToHostPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ServiceToHostPeer::SERVICE_ID, $this->id);

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
			$l->setService($this);
		}
	}


	
	public function getServiceToHostsJoinHost($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ServicePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collServiceToHosts === null) {
			if ($this->isNew()) {
				$this->collServiceToHosts = array();
			} else {

				$criteria->add(ServiceToHostPeer::SERVICE_ID, $this->id);

				$this->collServiceToHosts = ServiceToHostPeer::doSelectJoinHost($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ServiceToHostPeer::SERVICE_ID, $this->id);

			if (!isset($this->lastServiceToHostCriteria) || !$this->lastServiceToHostCriteria->equals($criteria)) {
				$this->collServiceToHosts = ServiceToHostPeer::doSelectJoinHost($criteria, $con, $join_behavior);
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
			if ($this->collServiceToHosts) {
				foreach ((array) $this->collServiceToHosts as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collHostServiceParams = null;
		$this->collServiceToHosts = null;
			$this->aCommand = null;
	}

} 