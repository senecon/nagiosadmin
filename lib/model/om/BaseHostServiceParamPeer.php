<?php


abstract class BaseHostServiceParamPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'host_service_param';

	
	const CLASS_DEFAULT = 'lib.model.HostServiceParam';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const HOST_ID = 'host_service_param.HOST_ID';

	
	const SERVICE_ID = 'host_service_param.SERVICE_ID';

	
	const PARAMETER = 'host_service_param.PARAMETER';

	
	const SPECIAL = 'host_service_param.SPECIAL';

	
	const CREATED_AT = 'host_service_param.CREATED_AT';

	
	const UPDATED_AT = 'host_service_param.UPDATED_AT';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('HostId', 'ServiceId', 'Parameter', 'Special', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('hostId', 'serviceId', 'parameter', 'special', 'createdAt', 'updatedAt', ),
		BasePeer::TYPE_COLNAME => array (self::HOST_ID, self::SERVICE_ID, self::PARAMETER, self::SPECIAL, self::CREATED_AT, self::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('host_id', 'service_id', 'parameter', 'special', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('HostId' => 0, 'ServiceId' => 1, 'Parameter' => 2, 'Special' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('hostId' => 0, 'serviceId' => 1, 'parameter' => 2, 'special' => 3, 'createdAt' => 4, 'updatedAt' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::HOST_ID => 0, self::SERVICE_ID => 1, self::PARAMETER => 2, self::SPECIAL => 3, self::CREATED_AT => 4, self::UPDATED_AT => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('host_id' => 0, 'service_id' => 1, 'parameter' => 2, 'special' => 3, 'created_at' => 4, 'updated_at' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new HostServiceParamMapBuilder();
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
		return str_replace(HostServiceParamPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(HostServiceParamPeer::HOST_ID);

		$criteria->addSelectColumn(HostServiceParamPeer::SERVICE_ID);

		$criteria->addSelectColumn(HostServiceParamPeer::PARAMETER);

		$criteria->addSelectColumn(HostServiceParamPeer::SPECIAL);

		$criteria->addSelectColumn(HostServiceParamPeer::CREATED_AT);

		$criteria->addSelectColumn(HostServiceParamPeer::UPDATED_AT);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HostServiceParamPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HostServiceParamPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
		$objects = HostServiceParamPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return HostServiceParamPeer::populateObjects(HostServiceParamPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			HostServiceParamPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(HostServiceParam $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getHostId(), (string) $obj->getServiceId()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof HostServiceParam) {
				$key = serialize(array((string) $value->getHostId(), (string) $value->getServiceId()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or HostServiceParam object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = HostServiceParamPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = HostServiceParamPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = HostServiceParamPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				HostServiceParamPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinHost(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HostServiceParamPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HostServiceParamPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HostServiceParamPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinService(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HostServiceParamPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HostServiceParamPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HostServiceParamPeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);

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

		HostServiceParamPeer::addSelectColumns($c);
		$startcol = (HostServiceParamPeer::NUM_COLUMNS - HostServiceParamPeer::NUM_LAZY_LOAD_COLUMNS);
		HostPeer::addSelectColumns($c);

		$c->addJoin(array(HostServiceParamPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HostServiceParamPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HostServiceParamPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = HostServiceParamPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HostServiceParamPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addHostServiceParam($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinService(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostServiceParamPeer::addSelectColumns($c);
		$startcol = (HostServiceParamPeer::NUM_COLUMNS - HostServiceParamPeer::NUM_LAZY_LOAD_COLUMNS);
		ServicePeer::addSelectColumns($c);

		$c->addJoin(array(HostServiceParamPeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HostServiceParamPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HostServiceParamPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = HostServiceParamPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HostServiceParamPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = ServicePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ServicePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ServicePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ServicePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHostServiceParam($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HostServiceParamPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HostServiceParamPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HostServiceParamPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);
		$criteria->addJoin(array(HostServiceParamPeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);
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

		HostServiceParamPeer::addSelectColumns($c);
		$startcol2 = (HostServiceParamPeer::NUM_COLUMNS - HostServiceParamPeer::NUM_LAZY_LOAD_COLUMNS);

		HostPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HostPeer::NUM_COLUMNS - HostPeer::NUM_LAZY_LOAD_COLUMNS);

		ServicePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ServicePeer::NUM_COLUMNS - ServicePeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(HostServiceParamPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);
		$c->addJoin(array(HostServiceParamPeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HostServiceParamPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HostServiceParamPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HostServiceParamPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HostServiceParamPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addHostServiceParam($obj1);
			} 
			
			$key3 = ServicePeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = ServicePeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = ServicePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ServicePeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addHostServiceParam($obj1);
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
			HostServiceParamPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HostServiceParamPeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptService(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HostServiceParamPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HostServiceParamPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);
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

		HostServiceParamPeer::addSelectColumns($c);
		$startcol2 = (HostServiceParamPeer::NUM_COLUMNS - HostServiceParamPeer::NUM_LAZY_LOAD_COLUMNS);

		ServicePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ServicePeer::NUM_COLUMNS - ServicePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HostServiceParamPeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HostServiceParamPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HostServiceParamPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HostServiceParamPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HostServiceParamPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = ServicePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ServicePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = ServicePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ServicePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHostServiceParam($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptService(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostServiceParamPeer::addSelectColumns($c);
		$startcol2 = (HostServiceParamPeer::NUM_COLUMNS - HostServiceParamPeer::NUM_LAZY_LOAD_COLUMNS);

		HostPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HostPeer::NUM_COLUMNS - HostPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HostServiceParamPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HostServiceParamPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HostServiceParamPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HostServiceParamPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HostServiceParamPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addHostServiceParam($obj1);

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
		return HostServiceParamPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(HostServiceParamPeer::HOST_ID);
			$selectCriteria->add(HostServiceParamPeer::HOST_ID, $criteria->remove(HostServiceParamPeer::HOST_ID), $comparison);

			$comparison = $criteria->getComparison(HostServiceParamPeer::SERVICE_ID);
			$selectCriteria->add(HostServiceParamPeer::SERVICE_ID, $criteria->remove(HostServiceParamPeer::SERVICE_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(HostServiceParamPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												HostServiceParamPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof HostServiceParam) {
						HostServiceParamPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(HostServiceParamPeer::HOST_ID, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(HostServiceParamPeer::SERVICE_ID, $value[1]));
				$criteria->addOr($criterion);

								HostServiceParamPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(HostServiceParam $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(HostServiceParamPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(HostServiceParamPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(HostServiceParamPeer::DATABASE_NAME, HostServiceParamPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = HostServiceParamPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($host_id, $service_id, PropelPDO $con = null) {
		$key = serialize(array((string) $host_id, (string) $service_id));
 		if (null !== ($obj = HostServiceParamPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(HostServiceParamPeer::DATABASE_NAME);
		$criteria->add(HostServiceParamPeer::HOST_ID, $host_id);
		$criteria->add(HostServiceParamPeer::SERVICE_ID, $service_id);
		$v = HostServiceParamPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseHostServiceParamPeer::DATABASE_NAME)->addTableBuilder(BaseHostServiceParamPeer::TABLE_NAME, BaseHostServiceParamPeer::getMapBuilder());

