<?php


abstract class BaseTemplate extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $type = 0;


	
	protected $name;


	
	protected $alias;


	
	protected $content;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getAlias()
	{

		return $this->alias;
	}

	
	public function getContent()
	{

		return $this->content;
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
			$this->modifiedColumns[] = TemplatePeer::ID;
		}

	} 
	
	public function setType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type !== $v || $v === 0) {
			$this->type = $v;
			$this->modifiedColumns[] = TemplatePeer::TYPE;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = TemplatePeer::NAME;
		}

	} 
	
	public function setAlias($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->alias !== $v) {
			$this->alias = $v;
			$this->modifiedColumns[] = TemplatePeer::ALIAS;
		}

	} 
	
	public function setContent($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->content !== $v) {
			$this->content = $v;
			$this->modifiedColumns[] = TemplatePeer::CONTENT;
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
			$this->modifiedColumns[] = TemplatePeer::CREATED_AT;
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
			$this->modifiedColumns[] = TemplatePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->type = $rs->getInt($startcol + 1);

			$this->name = $rs->getString($startcol + 2);

			$this->alias = $rs->getString($startcol + 3);

			$this->content = $rs->getString($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Template object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TemplatePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TemplatePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(TemplatePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(TemplatePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TemplatePeer::DATABASE_NAME);
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
					$pk = TemplatePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TemplatePeer::doUpdate($this, $con);
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


			if (($retval = TemplatePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getType();
				break;
			case 2:
				return $this->getName();
				break;
			case 3:
				return $this->getAlias();
				break;
			case 4:
				return $this->getContent();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TemplatePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getType(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getAlias(),
			$keys[4] => $this->getContent(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setType($value);
				break;
			case 2:
				$this->setName($value);
				break;
			case 3:
				$this->setAlias($value);
				break;
			case 4:
				$this->setContent($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TemplatePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setType($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAlias($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setContent($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TemplatePeer::DATABASE_NAME);

		if ($this->isColumnModified(TemplatePeer::ID)) $criteria->add(TemplatePeer::ID, $this->id);
		if ($this->isColumnModified(TemplatePeer::TYPE)) $criteria->add(TemplatePeer::TYPE, $this->type);
		if ($this->isColumnModified(TemplatePeer::NAME)) $criteria->add(TemplatePeer::NAME, $this->name);
		if ($this->isColumnModified(TemplatePeer::ALIAS)) $criteria->add(TemplatePeer::ALIAS, $this->alias);
		if ($this->isColumnModified(TemplatePeer::CONTENT)) $criteria->add(TemplatePeer::CONTENT, $this->content);
		if ($this->isColumnModified(TemplatePeer::CREATED_AT)) $criteria->add(TemplatePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(TemplatePeer::UPDATED_AT)) $criteria->add(TemplatePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TemplatePeer::DATABASE_NAME);

		$criteria->add(TemplatePeer::ID, $this->id);

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

		$copyObj->setType($this->type);

		$copyObj->setName($this->name);

		$copyObj->setAlias($this->alias);

		$copyObj->setContent($this->content);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


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
			self::$peer = new TemplatePeer();
		}
		return self::$peer;
	}

} 