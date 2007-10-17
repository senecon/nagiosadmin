<?php


abstract class BaseHostToContactGroupPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'host_to_contact_group';

	
	const CLASS_DEFAULT = 'lib.model.HostToContactGroup';

	
	const NUM_COLUMNS = 2;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const HOST_ID = 'host_to_contact_group.HOST_ID';

	
	const CONTACT_GROUP_ID = 'host_to_contact_group.CONTACT_GROUP_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('HostId', 'ContactGroupId', ),
		BasePeer::TYPE_COLNAME => array (HostToContactGroupPeer::HOST_ID, HostToContactGroupPeer::CONTACT_GROUP_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('host_id', 'contact_group_id', ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('HostId' => 0, 'ContactGroupId' => 1, ),
		BasePeer::TYPE_COLNAME => array (HostToContactGroupPeer::HOST_ID => 0, HostToContactGroupPeer::CONTACT_GROUP_ID => 1, ),
		BasePeer::TYPE_FIELDNAME => array ('host_id' => 0, 'contact_group_id' => 1, ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/HostToContactGroupMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.HostToContactGroupMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = HostToContactGroupPeer::getTableMap();
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
		return str_replace(HostToContactGroupPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(HostToContactGroupPeer::HOST_ID);

		$criteria->addSelectColumn(HostToContactGroupPeer::CONTACT_GROUP_ID);

	}

	const COUNT = 'COUNT(host_to_contact_group.HOST_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT host_to_contact_group.HOST_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HostToContactGroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostToContactGroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = HostToContactGroupPeer::doSelectRS($criteria, $con);
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
		$objects = HostToContactGroupPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return HostToContactGroupPeer::populateObjects(HostToContactGroupPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			HostToContactGroupPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = HostToContactGroupPeer::getOMClass();
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
			$criteria->addSelectColumn(HostToContactGroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostToContactGroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HostToContactGroupPeer::HOST_ID, HostPeer::ID);

		$rs = HostToContactGroupPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinContactGroup(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HostToContactGroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostToContactGroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HostToContactGroupPeer::CONTACT_GROUP_ID, ContactGroupPeer::ID);

		$rs = HostToContactGroupPeer::doSelectRS($criteria, $con);
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

		HostToContactGroupPeer::addSelectColumns($c);
		$startcol = (HostToContactGroupPeer::NUM_COLUMNS - HostToContactGroupPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		HostPeer::addSelectColumns($c);

		$c->addJoin(HostToContactGroupPeer::HOST_ID, HostPeer::ID, Criteria::JOIN);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HostToContactGroupPeer::getOMClass();

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
										$temp_obj2->addHostToContactGroup($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initHostToContactGroups();
				$obj2->addHostToContactGroup($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinContactGroup(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostToContactGroupPeer::addSelectColumns($c);
		$startcol = (HostToContactGroupPeer::NUM_COLUMNS - HostToContactGroupPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ContactGroupPeer::addSelectColumns($c);

		$c->addJoin(HostToContactGroupPeer::CONTACT_GROUP_ID, ContactGroupPeer::ID, Criteria::JOIN);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HostToContactGroupPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ContactGroupPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getContactGroup(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addHostToContactGroup($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initHostToContactGroups();
				$obj2->addHostToContactGroup($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HostToContactGroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostToContactGroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HostToContactGroupPeer::HOST_ID, HostPeer::ID);

		$criteria->addJoin(HostToContactGroupPeer::CONTACT_GROUP_ID, ContactGroupPeer::ID);

		$rs = HostToContactGroupPeer::doSelectRS($criteria, $con);
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

		HostToContactGroupPeer::addSelectColumns($c);
		$startcol2 = (HostToContactGroupPeer::NUM_COLUMNS - HostToContactGroupPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		HostPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + HostPeer::NUM_COLUMNS;

		ContactGroupPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ContactGroupPeer::NUM_COLUMNS;

		$c->addJoin(HostToContactGroupPeer::HOST_ID, HostPeer::ID);

		$c->addJoin(HostToContactGroupPeer::CONTACT_GROUP_ID, ContactGroupPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HostToContactGroupPeer::getOMClass();


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
					$temp_obj2->addHostToContactGroup($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initHostToContactGroups();
				$obj2->addHostToContactGroup($obj1);
			}


					
			$omClass = ContactGroupPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getContactGroup(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addHostToContactGroup($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initHostToContactGroups();
				$obj3->addHostToContactGroup($obj1);
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
			$criteria->addSelectColumn(HostToContactGroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostToContactGroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HostToContactGroupPeer::CONTACT_GROUP_ID, ContactGroupPeer::ID);

		$rs = HostToContactGroupPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptContactGroup(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HostToContactGroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HostToContactGroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HostToContactGroupPeer::HOST_ID, HostPeer::ID);

		$rs = HostToContactGroupPeer::doSelectRS($criteria, $con);
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

		HostToContactGroupPeer::addSelectColumns($c);
		$startcol2 = (HostToContactGroupPeer::NUM_COLUMNS - HostToContactGroupPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ContactGroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ContactGroupPeer::NUM_COLUMNS;

		$c->addJoin(HostToContactGroupPeer::CONTACT_GROUP_ID, ContactGroupPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HostToContactGroupPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ContactGroupPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getContactGroup(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addHostToContactGroup($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initHostToContactGroups();
				$obj2->addHostToContactGroup($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptContactGroup(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HostToContactGroupPeer::addSelectColumns($c);
		$startcol2 = (HostToContactGroupPeer::NUM_COLUMNS - HostToContactGroupPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		HostPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + HostPeer::NUM_COLUMNS;

		$c->addJoin(HostToContactGroupPeer::HOST_ID, HostPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HostToContactGroupPeer::getOMClass();

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
					$temp_obj2->addHostToContactGroup($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initHostToContactGroups();
				$obj2->addHostToContactGroup($obj1);
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
		return HostToContactGroupPeer::CLASS_DEFAULT;
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
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(HostToContactGroupPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(HostToContactGroupPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof HostToContactGroup) {

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

			$criteria->add(HostToContactGroupPeer::HOST_ID, $vals[0], Criteria::IN);
			$criteria->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(HostToContactGroup $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(HostToContactGroupPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(HostToContactGroupPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(HostToContactGroupPeer::DATABASE_NAME, HostToContactGroupPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = HostToContactGroupPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $host_id, $contact_group_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(HostToContactGroupPeer::HOST_ID, $host_id);
		$criteria->add(HostToContactGroupPeer::CONTACT_GROUP_ID, $contact_group_id);
		$v = HostToContactGroupPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseHostToContactGroupPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/HostToContactGroupMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.HostToContactGroupMapBuilder');
}
