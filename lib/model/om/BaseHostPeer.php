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

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'GroupId', 'Name', 'Alias', 'Address', 'Special', 'OsId', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (HostPeer::ID, HostPeer::GROUP_ID, HostPeer::NAME, HostPeer::ALIAS, HostPeer::ADDRESS, HostPeer::SPECIAL, HostPeer::OS_ID, HostPeer::CREATED_AT, HostPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'group_id', 'name', 'alias', 'address', 'special', 'os_id', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'GroupId' => 1, 'Name' => 2, 'Alias' => 3, 'Address' => 4, 'Special' => 5, 'OsId' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
		BasePeer::TYPE_COLNAME => array (HostPeer::ID => 0, HostPeer::GROUP_ID => 1, HostPeer::NAME => 2, HostPeer::ALIAS => 3, HostPeer::ADDRESS => 4, HostPeer::SPECIAL => 5, HostPeer::OS_ID => 6, HostPeer::CREATED_AT => 7, HostPeer::UPDATED_AT => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'group_id' => 1, 'name' => 2, 'alias' => 3, 'address' => 4, 'special' => 5, 'os_id' => 6, 'created_at' => 7, 'updated_at' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/HostMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.HostMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = HostPeer::getTableMap();
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

	const COUNT = 'COUNT(host.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT host.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = HostPeer::doSelectRS($criteria, $con);
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
		$objects = HostPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return HostPeer::populateObjects(HostPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			HostPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = HostPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinHostGroup(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HostPeer::GROUP_ID, HostGroupPeer::ID);

		$rs = HostPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOs(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HostPeer::OS_ID, OsPeer::ID);

		$rs = HostPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinHostGroup(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostPeer::addSelectColumns($c);
		$startcol = (HostPeer::NUM_COLUMNS - HostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		HostGroupPeer::addSelectColumns($c);

		$c->addJoin(HostPeer::GROUP_ID, HostGroupPeer::ID, Criteria::JOIN);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HostPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = HostGroupPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getHostGroup(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addHost($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initHosts();
				$obj2->addHost($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOs(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostPeer::addSelectColumns($c);
		$startcol = (HostPeer::NUM_COLUMNS - HostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OsPeer::addSelectColumns($c);

		$c->addJoin(HostPeer::OS_ID, OsPeer::ID, Criteria::JOIN);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HostPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOs(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addHost($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initHosts();
				$obj2->addHost($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HostPeer::GROUP_ID, HostGroupPeer::ID);

		$criteria->addJoin(HostPeer::OS_ID, OsPeer::ID);

		$rs = HostPeer::doSelectRS($criteria, $con);
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

		HostPeer::addSelectColumns($c);
		$startcol2 = (HostPeer::NUM_COLUMNS - HostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		HostGroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + HostGroupPeer::NUM_COLUMNS;

		OsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OsPeer::NUM_COLUMNS;

		$c->addJoin(HostPeer::GROUP_ID, HostGroupPeer::ID);

		$c->addJoin(HostPeer::OS_ID, OsPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HostPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = HostGroupPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getHostGroup(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addHost($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initHosts();
				$obj2->addHost($obj1);
			}


					
			$omClass = OsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOs(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addHost($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initHosts();
				$obj3->addHost($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptHostGroup(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HostPeer::OS_ID, OsPeer::ID);

		$rs = HostPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOs(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HostPeer::GROUP_ID, HostGroupPeer::ID);

		$rs = HostPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptHostGroup(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostPeer::addSelectColumns($c);
		$startcol2 = (HostPeer::NUM_COLUMNS - HostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OsPeer::NUM_COLUMNS;

		$c->addJoin(HostPeer::OS_ID, OsPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HostPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOs(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addHost($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initHosts();
				$obj2->addHost($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOs(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostPeer::addSelectColumns($c);
		$startcol2 = (HostPeer::NUM_COLUMNS - HostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		HostGroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + HostGroupPeer::NUM_COLUMNS;

		$c->addJoin(HostPeer::GROUP_ID, HostGroupPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HostPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = HostGroupPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getHostGroup(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addHost($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initHosts();
				$obj2->addHost($obj1);
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
		return HostPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(HostPeer::ID); 

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
			$comparison = $criteria->getComparison(HostPeer::ID);
			$selectCriteria->add(HostPeer::ID, $criteria->remove(HostPeer::ID), $comparison);

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
			$affectedRows += HostPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(HostPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(HostPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Host) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(HostPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += HostPeer::doOnDeleteCascade($criteria, $con);
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected static function doOnDeleteCascade(Criteria $criteria, Connection $con)
	{
				$affectedRows = 0;

				$objects = HostPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/HostServiceParam.php';

						$c = new Criteria();
			
			$c->add(HostServiceParamPeer::HOST_ID, $obj->getId());
			$affectedRows += HostServiceParamPeer::doDelete($c, $con);

			include_once 'lib/model/HostToContactGroup.php';

						$c = new Criteria();
			
			$c->add(HostToContactGroupPeer::HOST_ID, $obj->getId());
			$affectedRows += HostToContactGroupPeer::doDelete($c, $con);

			include_once 'lib/model/ServiceToHost.php';

						$c = new Criteria();
			
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

			foreach($cols as $colName) {
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
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(HostPeer::DATABASE_NAME);

		$criteria->add(HostPeer::ID, $pk);


		$v = HostPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(HostPeer::ID, $pks, Criteria::IN);
			$objs = HostPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseHostPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/HostMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.HostMapBuilder');
}
