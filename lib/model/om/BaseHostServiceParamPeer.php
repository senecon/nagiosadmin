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

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('HostId', 'ServiceId', 'Parameter', 'Special', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (HostServiceParamPeer::HOST_ID, HostServiceParamPeer::SERVICE_ID, HostServiceParamPeer::PARAMETER, HostServiceParamPeer::SPECIAL, HostServiceParamPeer::CREATED_AT, HostServiceParamPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('host_id', 'service_id', 'parameter', 'special', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('HostId' => 0, 'ServiceId' => 1, 'Parameter' => 2, 'Special' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ),
		BasePeer::TYPE_COLNAME => array (HostServiceParamPeer::HOST_ID => 0, HostServiceParamPeer::SERVICE_ID => 1, HostServiceParamPeer::PARAMETER => 2, HostServiceParamPeer::SPECIAL => 3, HostServiceParamPeer::CREATED_AT => 4, HostServiceParamPeer::UPDATED_AT => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('host_id' => 0, 'service_id' => 1, 'parameter' => 2, 'special' => 3, 'created_at' => 4, 'updated_at' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/HostServiceParamMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.HostServiceParamMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = HostServiceParamPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
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
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
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

	const COUNT = 'COUNT(host_service_param.HOST_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT host_service_param.HOST_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HostServiceParamPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostServiceParamPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = HostServiceParamPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = HostServiceParamPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return HostServiceParamPeer::populateObjects(HostServiceParamPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			HostServiceParamPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = HostServiceParamPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinHost(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HostServiceParamPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostServiceParamPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HostServiceParamPeer::HOST_ID, HostPeer::ID);

		$rs = HostServiceParamPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinService(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HostServiceParamPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostServiceParamPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HostServiceParamPeer::SERVICE_ID, ServicePeer::ID);

		$rs = HostServiceParamPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinHost(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostServiceParamPeer::addSelectColumns($c);
		$startcol = (HostServiceParamPeer::NUM_COLUMNS - HostServiceParamPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		HostPeer::addSelectColumns($c);

		$c->addJoin(HostServiceParamPeer::HOST_ID, HostPeer::ID, Criteria::JOIN);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HostServiceParamPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = HostPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getHost(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addHostServiceParam($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initHostServiceParams();
				$obj2->addHostServiceParam($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinService(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostServiceParamPeer::addSelectColumns($c);
		$startcol = (HostServiceParamPeer::NUM_COLUMNS - HostServiceParamPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ServicePeer::addSelectColumns($c);

		$c->addJoin(HostServiceParamPeer::SERVICE_ID, ServicePeer::ID, Criteria::JOIN);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HostServiceParamPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ServicePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getService(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addHostServiceParam($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initHostServiceParams();
				$obj2->addHostServiceParam($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HostServiceParamPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostServiceParamPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HostServiceParamPeer::HOST_ID, HostPeer::ID);

		$criteria->addJoin(HostServiceParamPeer::SERVICE_ID, ServicePeer::ID);

		$rs = HostServiceParamPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostServiceParamPeer::addSelectColumns($c);
		$startcol2 = (HostServiceParamPeer::NUM_COLUMNS - HostServiceParamPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		HostPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + HostPeer::NUM_COLUMNS;

		ServicePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ServicePeer::NUM_COLUMNS;

		$c->addJoin(HostServiceParamPeer::HOST_ID, HostPeer::ID);

		$c->addJoin(HostServiceParamPeer::SERVICE_ID, ServicePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HostServiceParamPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = HostPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getHost(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addHostServiceParam($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initHostServiceParams();
				$obj2->addHostServiceParam($obj1);
			}


					
			$omClass = ServicePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getService(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addHostServiceParam($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initHostServiceParams();
				$obj3->addHostServiceParam($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptHost(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HostServiceParamPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostServiceParamPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HostServiceParamPeer::SERVICE_ID, ServicePeer::ID);

		$rs = HostServiceParamPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptService(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HostServiceParamPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostServiceParamPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HostServiceParamPeer::HOST_ID, HostPeer::ID);

		$rs = HostServiceParamPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptHost(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostServiceParamPeer::addSelectColumns($c);
		$startcol2 = (HostServiceParamPeer::NUM_COLUMNS - HostServiceParamPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ServicePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ServicePeer::NUM_COLUMNS;

		$c->addJoin(HostServiceParamPeer::SERVICE_ID, ServicePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HostServiceParamPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ServicePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getService(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addHostServiceParam($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initHostServiceParams();
				$obj2->addHostServiceParam($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptService(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostServiceParamPeer::addSelectColumns($c);
		$startcol2 = (HostServiceParamPeer::NUM_COLUMNS - HostServiceParamPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		HostPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + HostPeer::NUM_COLUMNS;

		$c->addJoin(HostServiceParamPeer::HOST_ID, HostPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HostServiceParamPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = HostPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getHost(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addHostServiceParam($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initHostServiceParams();
				$obj2->addHostServiceParam($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return HostServiceParamPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
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
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(HostServiceParamPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(HostServiceParamPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof HostServiceParam) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
												if(count($values) == count($values, COUNT_RECURSIVE))
			{
								$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
			}

			$criteria->add(HostServiceParamPeer::HOST_ID, $vals[0], Criteria::IN);
			$criteria->add(HostServiceParamPeer::SERVICE_ID, $vals[1], Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
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

			foreach($cols as $colName) {
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
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $host_id, $service_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(HostServiceParamPeer::HOST_ID, $host_id);
		$criteria->add(HostServiceParamPeer::SERVICE_ID, $service_id);
		$v = HostServiceParamPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseHostServiceParamPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/HostServiceParamMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.HostServiceParamMapBuilder');
}
