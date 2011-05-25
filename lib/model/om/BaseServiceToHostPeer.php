<?php


abstract class BaseServiceToHostPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'service_to_host';

	
	const CLASS_DEFAULT = 'lib.model.ServiceToHost';

	
	const NUM_COLUMNS = 2;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const SERVICE_ID = 'service_to_host.SERVICE_ID';

	
	const HOST_ID = 'service_to_host.HOST_ID';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('ServiceId', 'HostId', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('serviceId', 'hostId', ),
		BasePeer::TYPE_COLNAME => array (self::SERVICE_ID, self::HOST_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('service_id', 'host_id', ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('ServiceId' => 0, 'HostId' => 1, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('serviceId' => 0, 'hostId' => 1, ),
		BasePeer::TYPE_COLNAME => array (self::SERVICE_ID => 0, self::HOST_ID => 1, ),
		BasePeer::TYPE_FIELDNAME => array ('service_id' => 0, 'host_id' => 1, ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new ServiceToHostMapBuilder();
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
		return str_replace(ServiceToHostPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ServiceToHostPeer::SERVICE_ID);

		$criteria->addSelectColumn(ServiceToHostPeer::HOST_ID);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ServiceToHostPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ServiceToHostPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(ServiceToHostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
		$objects = ServiceToHostPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return ServiceToHostPeer::populateObjects(ServiceToHostPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ServiceToHostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			ServiceToHostPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(ServiceToHost $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getServiceId(), (string) $obj->getHostId()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof ServiceToHost) {
				$key = serialize(array((string) $value->getServiceId(), (string) $value->getHostId()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or ServiceToHost object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = ServiceToHostPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = ServiceToHostPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = ServiceToHostPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				ServiceToHostPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinService(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ServiceToHostPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ServiceToHostPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ServiceToHostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ServiceToHostPeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinHost(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ServiceToHostPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ServiceToHostPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ServiceToHostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ServiceToHostPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinService(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ServiceToHostPeer::addSelectColumns($c);
		$startcol = (ServiceToHostPeer::NUM_COLUMNS - ServiceToHostPeer::NUM_LAZY_LOAD_COLUMNS);
		ServicePeer::addSelectColumns($c);

		$c->addJoin(array(ServiceToHostPeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ServiceToHostPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ServiceToHostPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = ServiceToHostPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ServiceToHostPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addServiceToHost($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinHost(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ServiceToHostPeer::addSelectColumns($c);
		$startcol = (ServiceToHostPeer::NUM_COLUMNS - ServiceToHostPeer::NUM_LAZY_LOAD_COLUMNS);
		HostPeer::addSelectColumns($c);

		$c->addJoin(array(ServiceToHostPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ServiceToHostPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ServiceToHostPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = ServiceToHostPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ServiceToHostPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addServiceToHost($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ServiceToHostPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ServiceToHostPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ServiceToHostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ServiceToHostPeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);
		$criteria->addJoin(array(ServiceToHostPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);
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

		ServiceToHostPeer::addSelectColumns($c);
		$startcol2 = (ServiceToHostPeer::NUM_COLUMNS - ServiceToHostPeer::NUM_LAZY_LOAD_COLUMNS);

		ServicePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ServicePeer::NUM_COLUMNS - ServicePeer::NUM_LAZY_LOAD_COLUMNS);

		HostPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (HostPeer::NUM_COLUMNS - HostPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(ServiceToHostPeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);
		$c->addJoin(array(ServiceToHostPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ServiceToHostPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ServiceToHostPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = ServiceToHostPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ServiceToHostPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addServiceToHost($obj1);
			} 
			
			$key3 = HostPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = HostPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = HostPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					HostPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addServiceToHost($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptService(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ServiceToHostPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ServiceToHostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(ServiceToHostPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptHost(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ServiceToHostPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ServiceToHostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(ServiceToHostPeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptService(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ServiceToHostPeer::addSelectColumns($c);
		$startcol2 = (ServiceToHostPeer::NUM_COLUMNS - ServiceToHostPeer::NUM_LAZY_LOAD_COLUMNS);

		HostPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HostPeer::NUM_COLUMNS - HostPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(ServiceToHostPeer::HOST_ID,), array(HostPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ServiceToHostPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ServiceToHostPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = ServiceToHostPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ServiceToHostPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addServiceToHost($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptHost(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ServiceToHostPeer::addSelectColumns($c);
		$startcol2 = (ServiceToHostPeer::NUM_COLUMNS - ServiceToHostPeer::NUM_LAZY_LOAD_COLUMNS);

		ServicePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ServicePeer::NUM_COLUMNS - ServicePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(ServiceToHostPeer::SERVICE_ID,), array(ServicePeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ServiceToHostPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ServiceToHostPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = ServiceToHostPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ServiceToHostPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addServiceToHost($obj1);

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
		return ServiceToHostPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ServiceToHostPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
			$con = Propel::getConnection(ServiceToHostPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(ServiceToHostPeer::SERVICE_ID);
			$selectCriteria->add(ServiceToHostPeer::SERVICE_ID, $criteria->remove(ServiceToHostPeer::SERVICE_ID), $comparison);

			$comparison = $criteria->getComparison(ServiceToHostPeer::HOST_ID);
			$selectCriteria->add(ServiceToHostPeer::HOST_ID, $criteria->remove(ServiceToHostPeer::HOST_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ServiceToHostPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(ServiceToHostPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ServiceToHostPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												ServiceToHostPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof ServiceToHost) {
						ServiceToHostPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(ServiceToHostPeer::SERVICE_ID, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(ServiceToHostPeer::HOST_ID, $value[1]));
				$criteria->addOr($criterion);

								ServiceToHostPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(ServiceToHost $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ServiceToHostPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ServiceToHostPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ServiceToHostPeer::DATABASE_NAME, ServiceToHostPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ServiceToHostPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($service_id, $host_id, PropelPDO $con = null) {
		$key = serialize(array((string) $service_id, (string) $host_id));
 		if (null !== ($obj = ServiceToHostPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(ServiceToHostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(ServiceToHostPeer::DATABASE_NAME);
		$criteria->add(ServiceToHostPeer::SERVICE_ID, $service_id);
		$criteria->add(ServiceToHostPeer::HOST_ID, $host_id);
		$v = ServiceToHostPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseServiceToHostPeer::DATABASE_NAME)->addTableBuilder(BaseServiceToHostPeer::TABLE_NAME, BaseServiceToHostPeer::getMapBuilder());

