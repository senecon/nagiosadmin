<?php

/**
 * Base class that represents a row from the 'host' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseHost extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        HostPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the group_id field.
	 * @var        int
	 */
	protected $group_id;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the alias field.
	 * @var        string
	 */
	protected $alias;

	/**
	 * The value for the address field.
	 * @var        string
	 */
	protected $address;

	/**
	 * The value for the special field.
	 * @var        string
	 */
	protected $special;

	/**
	 * The value for the os_id field.
	 * @var        int
	 */
	protected $os_id;

	/**
	 * The value for the created_at field.
	 * @var        string
	 */
	protected $created_at;

	/**
	 * The value for the updated_at field.
	 * @var        string
	 */
	protected $updated_at;

	/**
	 * @var        HostGroup
	 */
	protected $aHostGroup;

	/**
	 * @var        Os
	 */
	protected $aOs;

	/**
	 * @var        array HostServiceParam[] Collection to store aggregation of HostServiceParam objects.
	 */
	protected $collHostServiceParams;

	/**
	 * @var        Criteria The criteria used to select the current contents of collHostServiceParams.
	 */
	private $lastHostServiceParamCriteria = null;

	/**
	 * @var        array HostToContactGroup[] Collection to store aggregation of HostToContactGroup objects.
	 */
	protected $collHostToContactGroups;

	/**
	 * @var        Criteria The criteria used to select the current contents of collHostToContactGroups.
	 */
	private $lastHostToContactGroupCriteria = null;

	/**
	 * @var        array ServiceToHost[] Collection to store aggregation of ServiceToHost objects.
	 */
	protected $collServiceToHosts;

	/**
	 * @var        Criteria The criteria used to select the current contents of collServiceToHosts.
	 */
	private $lastServiceToHostCriteria = null;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	// symfony behavior
	
	const PEER = 'HostPeer';

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [group_id] column value.
	 * 
	 * @return     int
	 */
	public function getGroupId()
	{
		return $this->group_id;
	}

	/**
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [alias] column value.
	 * 
	 * @return     string
	 */
	public function getAlias()
	{
		return $this->alias;
	}

	/**
	 * Get the [address] column value.
	 * 
	 * @return     string
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * Get the [special] column value.
	 * 
	 * @return     string
	 */
	public function getSpecial()
	{
		return $this->special;
	}

	/**
	 * Get the [os_id] column value.
	 * 
	 * @return     int
	 */
	public function getOsId()
	{
		return $this->os_id;
	}

	/**
	 * Get the [optionally formatted] temporal [created_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->created_at === null) {
			return null;
		}


		if ($this->created_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->created_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [updated_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->updated_at === null) {
			return null;
		}


		if ($this->updated_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->updated_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Host The current object (for fluent API support)
	 */
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
	} // setId()

	/**
	 * Set the value of [group_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Host The current object (for fluent API support)
	 */
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
	} // setGroupId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     Host The current object (for fluent API support)
	 */
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
	} // setName()

	/**
	 * Set the value of [alias] column.
	 * 
	 * @param      string $v new value
	 * @return     Host The current object (for fluent API support)
	 */
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
	} // setAlias()

	/**
	 * Set the value of [address] column.
	 * 
	 * @param      string $v new value
	 * @return     Host The current object (for fluent API support)
	 */
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
	} // setAddress()

	/**
	 * Set the value of [special] column.
	 * 
	 * @param      string $v new value
	 * @return     Host The current object (for fluent API support)
	 */
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
	} // setSpecial()

	/**
	 * Set the value of [os_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Host The current object (for fluent API support)
	 */
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
	} // setOsId()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Host The current object (for fluent API support)
	 */
	public function setCreatedAt($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->created_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->created_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = HostPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Host The current object (for fluent API support)
	 */
	public function setUpdatedAt($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->updated_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->updated_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = HostPeer::UPDATED_AT;
			}
		} // if either are not null

		return $this;
	} // setUpdatedAt()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
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

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = HostPeer::NUM_COLUMNS - HostPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Host object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aHostGroup !== null && $this->group_id !== $this->aHostGroup->getId()) {
			$this->aHostGroup = null;
		}
		if ($this->aOs !== null && $this->os_id !== $this->aOs->getId()) {
			$this->aOs = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
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

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = HostPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aHostGroup = null;
			$this->aOs = null;
			$this->collHostServiceParams = null;
			$this->lastHostServiceParamCriteria = null;

			$this->collHostToContactGroups = null;
			$this->lastHostToContactGroupCriteria = null;

			$this->collServiceToHosts = null;
			$this->lastServiceToHostCriteria = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
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
			$ret = $this->preDelete($con);
			if ($ret) {
				HostPeer::doDelete($this, $con);
				$this->postDelete($con);
				$this->setDeleted(true);
				$con->commit();
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HostPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_timestampable behavior
			if ($this->isModified() && !$this->isColumnModified(HostPeer::UPDATED_AT))
			{
			  $this->setUpdatedAt(time());
			}

			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
				// symfony_timestampable behavior
				if (!$this->isColumnModified(HostPeer::CREATED_AT))
				{
				  $this->setCreatedAt(time());
				}

			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				HostPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

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

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HostPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += HostPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

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
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
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

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

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

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HostPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
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
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
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

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HostPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
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
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
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

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
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

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(HostPeer::DATABASE_NAME);

		$criteria->add(HostPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Host (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
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
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getHostServiceParams() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addHostServiceParam($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHostToContactGroups() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addHostToContactGroup($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getServiceToHosts() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addServiceToHost($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Host Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     HostPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new HostPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a HostGroup object.
	 *
	 * @param      HostGroup $v
	 * @return     Host The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setHostGroup(HostGroup $v = null)
	{
		if ($v === null) {
			$this->setGroupId(NULL);
		} else {
			$this->setGroupId($v->getId());
		}

		$this->aHostGroup = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the HostGroup object, it will not be re-added.
		if ($v !== null) {
			$v->addHost($this);
		}

		return $this;
	}


	/**
	 * Get the associated HostGroup object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     HostGroup The associated HostGroup object.
	 * @throws     PropelException
	 */
	public function getHostGroup(PropelPDO $con = null)
	{
		if ($this->aHostGroup === null && ($this->group_id !== null)) {
			$this->aHostGroup = HostGroupPeer::retrieveByPk($this->group_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aHostGroup->addHosts($this);
			 */
		}
		return $this->aHostGroup;
	}

	/**
	 * Declares an association between this object and a Os object.
	 *
	 * @param      Os $v
	 * @return     Host The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setOs(Os $v = null)
	{
		if ($v === null) {
			$this->setOsId(NULL);
		} else {
			$this->setOsId($v->getId());
		}

		$this->aOs = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Os object, it will not be re-added.
		if ($v !== null) {
			$v->addHost($this);
		}

		return $this;
	}


	/**
	 * Get the associated Os object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Os The associated Os object.
	 * @throws     PropelException
	 */
	public function getOs(PropelPDO $con = null)
	{
		if ($this->aOs === null && ($this->os_id !== null)) {
			$this->aOs = OsPeer::retrieveByPk($this->os_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aOs->addHosts($this);
			 */
		}
		return $this->aOs;
	}

	/**
	 * Clears out the collHostServiceParams collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addHostServiceParams()
	 */
	public function clearHostServiceParams()
	{
		$this->collHostServiceParams = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collHostServiceParams collection (array).
	 *
	 * By default this just sets the collHostServiceParams collection to an empty array (like clearcollHostServiceParams());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initHostServiceParams()
	{
		$this->collHostServiceParams = array();
	}

	/**
	 * Gets an array of HostServiceParam objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Host has previously been saved, it will retrieve
	 * related HostServiceParams from storage. If this Host is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array HostServiceParam[]
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


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

	/**
	 * Returns the number of related HostServiceParam objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related HostServiceParam objects.
	 * @throws     PropelException
	 */
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

				$count = HostServiceParamPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(HostServiceParamPeer::HOST_ID, $this->id);

				if (!isset($this->lastHostServiceParamCriteria) || !$this->lastHostServiceParamCriteria->equals($criteria)) {
					$count = HostServiceParamPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collHostServiceParams);
				}
			} else {
				$count = count($this->collHostServiceParams);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a HostServiceParam object to this object
	 * through the HostServiceParam foreign key attribute.
	 *
	 * @param      HostServiceParam $l HostServiceParam
	 * @return     void
	 * @throws     PropelException
	 */
	public function addHostServiceParam(HostServiceParam $l)
	{
		if ($this->collHostServiceParams === null) {
			$this->initHostServiceParams();
		}
		if (!in_array($l, $this->collHostServiceParams, true)) { // only add it if the **same** object is not already associated
			array_push($this->collHostServiceParams, $l);
			$l->setHost($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Host is new, it will return
	 * an empty collection; or if this Host has previously
	 * been saved, it will retrieve related HostServiceParams from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Host.
	 */
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
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(HostServiceParamPeer::HOST_ID, $this->id);

			if (!isset($this->lastHostServiceParamCriteria) || !$this->lastHostServiceParamCriteria->equals($criteria)) {
				$this->collHostServiceParams = HostServiceParamPeer::doSelectJoinService($criteria, $con, $join_behavior);
			}
		}
		$this->lastHostServiceParamCriteria = $criteria;

		return $this->collHostServiceParams;
	}

	/**
	 * Clears out the collHostToContactGroups collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addHostToContactGroups()
	 */
	public function clearHostToContactGroups()
	{
		$this->collHostToContactGroups = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collHostToContactGroups collection (array).
	 *
	 * By default this just sets the collHostToContactGroups collection to an empty array (like clearcollHostToContactGroups());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initHostToContactGroups()
	{
		$this->collHostToContactGroups = array();
	}

	/**
	 * Gets an array of HostToContactGroup objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Host has previously been saved, it will retrieve
	 * related HostToContactGroups from storage. If this Host is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array HostToContactGroup[]
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


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

	/**
	 * Returns the number of related HostToContactGroup objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related HostToContactGroup objects.
	 * @throws     PropelException
	 */
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

				$count = HostToContactGroupPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(HostToContactGroupPeer::HOST_ID, $this->id);

				if (!isset($this->lastHostToContactGroupCriteria) || !$this->lastHostToContactGroupCriteria->equals($criteria)) {
					$count = HostToContactGroupPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collHostToContactGroups);
				}
			} else {
				$count = count($this->collHostToContactGroups);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a HostToContactGroup object to this object
	 * through the HostToContactGroup foreign key attribute.
	 *
	 * @param      HostToContactGroup $l HostToContactGroup
	 * @return     void
	 * @throws     PropelException
	 */
	public function addHostToContactGroup(HostToContactGroup $l)
	{
		if ($this->collHostToContactGroups === null) {
			$this->initHostToContactGroups();
		}
		if (!in_array($l, $this->collHostToContactGroups, true)) { // only add it if the **same** object is not already associated
			array_push($this->collHostToContactGroups, $l);
			$l->setHost($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Host is new, it will return
	 * an empty collection; or if this Host has previously
	 * been saved, it will retrieve related HostToContactGroups from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Host.
	 */
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
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(HostToContactGroupPeer::HOST_ID, $this->id);

			if (!isset($this->lastHostToContactGroupCriteria) || !$this->lastHostToContactGroupCriteria->equals($criteria)) {
				$this->collHostToContactGroups = HostToContactGroupPeer::doSelectJoinContactGroup($criteria, $con, $join_behavior);
			}
		}
		$this->lastHostToContactGroupCriteria = $criteria;

		return $this->collHostToContactGroups;
	}

	/**
	 * Clears out the collServiceToHosts collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addServiceToHosts()
	 */
	public function clearServiceToHosts()
	{
		$this->collServiceToHosts = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collServiceToHosts collection (array).
	 *
	 * By default this just sets the collServiceToHosts collection to an empty array (like clearcollServiceToHosts());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initServiceToHosts()
	{
		$this->collServiceToHosts = array();
	}

	/**
	 * Gets an array of ServiceToHost objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Host has previously been saved, it will retrieve
	 * related ServiceToHosts from storage. If this Host is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ServiceToHost[]
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


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

	/**
	 * Returns the number of related ServiceToHost objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ServiceToHost objects.
	 * @throws     PropelException
	 */
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

				$count = ServiceToHostPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ServiceToHostPeer::HOST_ID, $this->id);

				if (!isset($this->lastServiceToHostCriteria) || !$this->lastServiceToHostCriteria->equals($criteria)) {
					$count = ServiceToHostPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collServiceToHosts);
				}
			} else {
				$count = count($this->collServiceToHosts);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ServiceToHost object to this object
	 * through the ServiceToHost foreign key attribute.
	 *
	 * @param      ServiceToHost $l ServiceToHost
	 * @return     void
	 * @throws     PropelException
	 */
	public function addServiceToHost(ServiceToHost $l)
	{
		if ($this->collServiceToHosts === null) {
			$this->initServiceToHosts();
		}
		if (!in_array($l, $this->collServiceToHosts, true)) { // only add it if the **same** object is not already associated
			array_push($this->collServiceToHosts, $l);
			$l->setHost($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Host is new, it will return
	 * an empty collection; or if this Host has previously
	 * been saved, it will retrieve related ServiceToHosts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Host.
	 */
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
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ServiceToHostPeer::HOST_ID, $this->id);

			if (!isset($this->lastServiceToHostCriteria) || !$this->lastServiceToHostCriteria->equals($criteria)) {
				$this->collServiceToHosts = ServiceToHostPeer::doSelectJoinService($criteria, $con, $join_behavior);
			}
		}
		$this->lastServiceToHostCriteria = $criteria;

		return $this->collServiceToHosts;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
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
		} // if ($deep)

		$this->collHostServiceParams = null;
		$this->collHostToContactGroups = null;
		$this->collServiceToHosts = null;
			$this->aHostGroup = null;
			$this->aOs = null;
	}

} // BaseHost
