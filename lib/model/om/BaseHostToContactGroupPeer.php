<?php


abstract class BaseHostToContactGroupPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'host_to_contact_group';

	
	const CLASS_DEFAULT = 'lib.model.HostToContactGroup';

	
	const NUM_COLUMNS = 2;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const HOST_ID = 'host_to_contact_group.HOST_ID';

	
	const CONTACT_GROUP_ID = 'host_to_contact_group.CONTACT_GROUP_ID';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('HostId', 'ContactGroupId', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('hostId', 'contactGroupId', ),
		BasePeer::TYPE_COLNAME => array (self::HOST_ID, self::CONTACT_GROUP_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('host_id', 'contact_group_id', ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('HostId' => 0, 'ContactGroupId' => 1, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('hostId' => 0, 'contactGroupId' => 1, ),
		BasePeer::TYPE_COLNAME => array (self::HOST_ID => 0, self::CONTACT_GROUP_ID => 1, ),
		BasePeer::TYPE_FIELDNAME => array ('host_id' => 0, 'contact_group_id' => 1, ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new HostToContactGroupMapBuilder();
		}
		return self::$mapBuilder;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(HostToContactGroupPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(HostToContactGroupPeer::HOST_ID);

		$criteria->addSelectColumn(HostToContactGroupPeer::CONTACT_GROUP_ID);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HostToContactGroupPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HostToContactGroupPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}
	
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = HostToContactGroupPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return HostToContactGroupPeer::populateObjects(HostToContactGroupPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			HostToContactGroupPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(HostToContactGroup $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getHostId(), (string) $obj->getContactGroupId()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof HostToContactGroup) {
				$key = serialize(array((string) $value->getHostId(), (string) $value->getContactGroupId()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or HostToContactGroup object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} 
	
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; 	}
	
	
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
				if ($row[$startcol + 0] === null && $row[$startcol + 1] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = HostToContactGroupPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = HostToContactGroupPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = HostToContactGroupPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				HostToContactGroupPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinHost(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HostToContactGroupPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HostToContactGroupPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HostToContactGroupPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinContactGroup(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HostToContactGroupPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HostToContactGroupPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HostToContactGroupPeer::CONTACT_GROUP_ID,), array(ContactGroupPeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinHost(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostToContactGroupPeer::addSelectColumns($c);
		$startcol = (HostToContactGroupPeer::NUM_COLUMNS - HostToContactGroupPeer::NUM_LAZY_LOAD_COLUMNS);
		HostPeer::addSelectColumns($c);

		$c->addJoin(array(HostToContactGroupPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HostToContactGroupPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HostToContactGroupPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = HostToContactGroupPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HostToContactGroupPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = HostPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = HostPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = HostPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					HostPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHostToContactGroup($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinContactGroup(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostToContactGroupPeer::addSelectColumns($c);
		$startcol = (HostToContactGroupPeer::NUM_COLUMNS - HostToContactGroupPeer::NUM_LAZY_LOAD_COLUMNS);
		ContactGroupPeer::addSelectColumns($c);

		$c->addJoin(array(HostToContactGroupPeer::CONTACT_GROUP_ID,), array(ContactGroupPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HostToContactGroupPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HostToContactGroupPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = HostToContactGroupPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HostToContactGroupPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = ContactGroupPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ContactGroupPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ContactGroupPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ContactGroupPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHostToContactGroup($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HostToContactGroupPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HostToContactGroupPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HostToContactGroupPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);
		$criteria->addJoin(array(HostToContactGroupPeer::CONTACT_GROUP_ID,), array(ContactGroupPeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}

	
	public static function doSelectJoinAll(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostToContactGroupPeer::addSelectColumns($c);
		$startcol2 = (HostToContactGroupPeer::NUM_COLUMNS - HostToContactGroupPeer::NUM_LAZY_LOAD_COLUMNS);

		HostPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HostPeer::NUM_COLUMNS - HostPeer::NUM_LAZY_LOAD_COLUMNS);

		ContactGroupPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ContactGroupPeer::NUM_COLUMNS - ContactGroupPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(HostToContactGroupPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);
		$c->addJoin(array(HostToContactGroupPeer::CONTACT_GROUP_ID,), array(ContactGroupPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HostToContactGroupPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HostToContactGroupPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HostToContactGroupPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HostToContactGroupPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = HostPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = HostPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = HostPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					HostPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHostToContactGroup($obj1);
			} 
			
			$key3 = ContactGroupPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = ContactGroupPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = ContactGroupPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ContactGroupPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addHostToContactGroup($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptHost(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HostToContactGroupPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HostToContactGroupPeer::CONTACT_GROUP_ID,), array(ContactGroupPeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptContactGroup(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HostToContactGroupPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HostToContactGroupPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptHost(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostToContactGroupPeer::addSelectColumns($c);
		$startcol2 = (HostToContactGroupPeer::NUM_COLUMNS - HostToContactGroupPeer::NUM_LAZY_LOAD_COLUMNS);

		ContactGroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ContactGroupPeer::NUM_COLUMNS - ContactGroupPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HostToContactGroupPeer::CONTACT_GROUP_ID,), array(ContactGroupPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HostToContactGroupPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HostToContactGroupPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HostToContactGroupPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HostToContactGroupPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = ContactGroupPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ContactGroupPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = ContactGroupPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ContactGroupPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHostToContactGroup($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptContactGroup(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostToContactGroupPeer::addSelectColumns($c);
		$startcol2 = (HostToContactGroupPeer::NUM_COLUMNS - HostToContactGroupPeer::NUM_LAZY_LOAD_COLUMNS);

		HostPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HostPeer::NUM_COLUMNS - HostPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HostToContactGroupPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HostToContactGroupPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HostToContactGroupPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HostToContactGroupPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HostToContactGroupPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = HostPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = HostPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = HostPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					HostPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHostToContactGroup($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array();
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return HostToContactGroupPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(HostToContactGroupPeer::HOST_ID);
			$selectCriteria->add(HostToContactGroupPeer::HOST_ID, $criteria->remove(HostToContactGroupPeer::HOST_ID), $comparison);

			$comparison = $criteria->getComparison(HostToContactGroupPeer::CONTACT_GROUP_ID);
			$selectCriteria->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $criteria->remove(HostToContactGroupPeer::CONTACT_GROUP_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(HostToContactGroupPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												HostToContactGroupPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof HostToContactGroup) {
						HostToContactGroupPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(HostToContactGroupPeer::HOST_ID, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(HostToContactGroupPeer::CONTACT_GROUP_ID, $value[1]));
				$criteria->addOr($criterion);

								HostToContactGroupPeer::removeInstanceFromPool($value);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public static function doValidate(HostToContactGroup $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(HostToContactGroupPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(HostToContactGroupPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(HostToContactGroupPeer::DATABASE_NAME, HostToContactGroupPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = HostToContactGroupPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($host_id, $contact_group_id, PropelPDO $con = null) {
		$key = serialize(array((string) $host_id, (string) $contact_group_id));
 		if (null !== ($obj = HostToContactGroupPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(HostToContactGroupPeer::DATABASE_NAME);
		$criteria->add(HostToContactGroupPeer::HOST_ID, $host_id);
		$criteria->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $contact_group_id);
		$v = HostToContactGroupPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseHostToContactGroupPeer::DATABASE_NAME)->addTableBuilder(BaseHostToContactGroupPeer::TABLE_NAME, BaseHostToContactGroupPeer::getMapBuilder());

