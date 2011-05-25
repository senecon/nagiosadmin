<?php


abstract class BaseHostPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'host';

	
	const CLASS_DEFAULT = 'lib.model.Host';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const ID = 'host.ID';

	
	const GROUP_ID = 'host.GROUP_ID';

	
	const NAME = 'host.NAME';

	
	const ALIAS = 'host.ALIAS';

	
	const ADDRESS = 'host.ADDRESS';

	
	const SPECIAL = 'host.SPECIAL';

	
	const OS_ID = 'host.OS_ID';

	
	const CREATED_AT = 'host.CREATED_AT';

	
	const UPDATED_AT = 'host.UPDATED_AT';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'GroupId', 'Name', 'Alias', 'Address', 'Special', 'OsId', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'groupId', 'name', 'alias', 'address', 'special', 'osId', 'createdAt', 'updatedAt', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::GROUP_ID, self::NAME, self::ALIAS, self::ADDRESS, self::SPECIAL, self::OS_ID, self::CREATED_AT, self::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'group_id', 'name', 'alias', 'address', 'special', 'os_id', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'GroupId' => 1, 'Name' => 2, 'Alias' => 3, 'Address' => 4, 'Special' => 5, 'OsId' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'groupId' => 1, 'name' => 2, 'alias' => 3, 'address' => 4, 'special' => 5, 'osId' => 6, 'createdAt' => 7, 'updatedAt' => 8, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::GROUP_ID => 1, self::NAME => 2, self::ALIAS => 3, self::ADDRESS => 4, self::SPECIAL => 5, self::OS_ID => 6, self::CREATED_AT => 7, self::UPDATED_AT => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'group_id' => 1, 'name' => 2, 'alias' => 3, 'address' => 4, 'special' => 5, 'os_id' => 6, 'created_at' => 7, 'updated_at' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new HostMapBuilder();
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
		return str_replace(HostPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(HostPeer::ID);

		$criteria->addSelectColumn(HostPeer::GROUP_ID);

		$criteria->addSelectColumn(HostPeer::NAME);

		$criteria->addSelectColumn(HostPeer::ALIAS);

		$criteria->addSelectColumn(HostPeer::ADDRESS);

		$criteria->addSelectColumn(HostPeer::SPECIAL);

		$criteria->addSelectColumn(HostPeer::OS_ID);

		$criteria->addSelectColumn(HostPeer::CREATED_AT);

		$criteria->addSelectColumn(HostPeer::UPDATED_AT);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HostPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HostPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(HostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
		$objects = HostPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return HostPeer::populateObjects(HostPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			HostPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Host $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Host) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Host object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = HostPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = HostPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = HostPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				HostPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinHostGroup(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HostPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HostPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HostPeer::GROUP_ID,), array(HostGroupPeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinOs(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HostPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HostPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HostPeer::OS_ID,), array(OsPeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinHostGroup(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostPeer::addSelectColumns($c);
		$startcol = (HostPeer::NUM_COLUMNS - HostPeer::NUM_LAZY_LOAD_COLUMNS);
		HostGroupPeer::addSelectColumns($c);

		$c->addJoin(array(HostPeer::GROUP_ID,), array(HostGroupPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HostPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HostPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = HostPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HostPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = HostGroupPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = HostGroupPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = HostGroupPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					HostGroupPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHost($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinOs(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostPeer::addSelectColumns($c);
		$startcol = (HostPeer::NUM_COLUMNS - HostPeer::NUM_LAZY_LOAD_COLUMNS);
		OsPeer::addSelectColumns($c);

		$c->addJoin(array(HostPeer::OS_ID,), array(OsPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HostPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HostPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = HostPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HostPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = OsPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = OsPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = OsPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					OsPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHost($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HostPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HostPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HostPeer::GROUP_ID,), array(HostGroupPeer::ID,), $join_behavior);
		$criteria->addJoin(array(HostPeer::OS_ID,), array(OsPeer::ID,), $join_behavior);
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

		HostPeer::addSelectColumns($c);
		$startcol2 = (HostPeer::NUM_COLUMNS - HostPeer::NUM_LAZY_LOAD_COLUMNS);

		HostGroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HostGroupPeer::NUM_COLUMNS - HostGroupPeer::NUM_LAZY_LOAD_COLUMNS);

		OsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (OsPeer::NUM_COLUMNS - OsPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(HostPeer::GROUP_ID,), array(HostGroupPeer::ID,), $join_behavior);
		$c->addJoin(array(HostPeer::OS_ID,), array(OsPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HostPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HostPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HostPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HostPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = HostGroupPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = HostGroupPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = HostGroupPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					HostGroupPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHost($obj1);
			} 
			
			$key3 = OsPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = OsPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = OsPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					OsPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addHost($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptHostGroup(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HostPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HostPeer::OS_ID,), array(OsPeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptOs(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HostPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HostPeer::GROUP_ID,), array(HostGroupPeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptHostGroup(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostPeer::addSelectColumns($c);
		$startcol2 = (HostPeer::NUM_COLUMNS - HostPeer::NUM_LAZY_LOAD_COLUMNS);

		OsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (OsPeer::NUM_COLUMNS - OsPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HostPeer::OS_ID,), array(OsPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HostPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HostPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HostPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HostPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = OsPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = OsPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = OsPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					OsPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHost($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptOs(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostPeer::addSelectColumns($c);
		$startcol2 = (HostPeer::NUM_COLUMNS - HostPeer::NUM_LAZY_LOAD_COLUMNS);

		HostGroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HostGroupPeer::NUM_COLUMNS - HostGroupPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HostPeer::GROUP_ID,), array(HostGroupPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HostPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HostPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HostPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HostPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = HostGroupPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = HostGroupPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = HostGroupPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					HostGroupPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHost($obj1);

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
		return HostPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HostPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(HostPeer::ID) && $criteria->keyContainsValue(HostPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.HostPeer::ID.')');
		}


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
			$con = Propel::getConnection(HostPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(HostPeer::ID);
			$selectCriteria->add(HostPeer::ID, $criteria->remove(HostPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HostPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += HostPeer::doOnDeleteCascade(new Criteria(HostPeer::DATABASE_NAME), $con);
			$affectedRows += BasePeer::doDeleteAll(HostPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(HostPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												HostPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Host) {
						HostPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(HostPeer::ID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								HostPeer::removeInstanceFromPool($singleval);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			$affectedRows += HostPeer::doOnDeleteCascade($criteria, $con);
			
																if ($values instanceof Criteria) {
					HostPeer::clearInstancePool();
				} else { 					HostPeer::removeInstanceFromPool($values);
				}
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

						HostServiceParamPeer::clearInstancePool();

						HostToContactGroupPeer::clearInstancePool();

						ServiceToHostPeer::clearInstancePool();

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	protected static function doOnDeleteCascade(Criteria $criteria, PropelPDO $con)
	{
				$affectedRows = 0;

				$objects = HostPeer::doSelect($criteria, $con);
		foreach ($objects as $obj) {


						$c = new Criteria(HostServiceParamPeer::DATABASE_NAME);
			
			$c->add(HostServiceParamPeer::HOST_ID, $obj->getId());
			$affectedRows += HostServiceParamPeer::doDelete($c, $con);

						$c = new Criteria(HostToContactGroupPeer::DATABASE_NAME);
			
			$c->add(HostToContactGroupPeer::HOST_ID, $obj->getId());
			$affectedRows += HostToContactGroupPeer::doDelete($c, $con);

						$c = new Criteria(ServiceToHostPeer::DATABASE_NAME);
			
			$c->add(ServiceToHostPeer::HOST_ID, $obj->getId());
			$affectedRows += ServiceToHostPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Host $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(HostPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(HostPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(HostPeer::DATABASE_NAME, HostPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = HostPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = HostPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(HostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(HostPeer::DATABASE_NAME);
		$criteria->add(HostPeer::ID, $pk);

		$v = HostPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(HostPeer::DATABASE_NAME);
			$criteria->add(HostPeer::ID, $pks, Criteria::IN);
			$objs = HostPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseHostPeer::DATABASE_NAME)->addTableBuilder(BaseHostPeer::TABLE_NAME, BaseHostPeer::getMapBuilder());

