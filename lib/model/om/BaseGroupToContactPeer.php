<?php


abstract class BaseGroupToContactPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'group_to_contact';

	
	const CLASS_DEFAULT = 'lib.model.GroupToContact';

	
	const NUM_COLUMNS = 2;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const GROUP_ID = 'group_to_contact.GROUP_ID';

	
	const CONTACT_ID = 'group_to_contact.CONTACT_ID';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('GroupId', 'ContactId', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('groupId', 'contactId', ),
		BasePeer::TYPE_COLNAME => array (self::GROUP_ID, self::CONTACT_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('group_id', 'contact_id', ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('GroupId' => 0, 'ContactId' => 1, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('groupId' => 0, 'contactId' => 1, ),
		BasePeer::TYPE_COLNAME => array (self::GROUP_ID => 0, self::CONTACT_ID => 1, ),
		BasePeer::TYPE_FIELDNAME => array ('group_id' => 0, 'contact_id' => 1, ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new GroupToContactMapBuilder();
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
		return str_replace(GroupToContactPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(GroupToContactPeer::GROUP_ID);

		$criteria->addSelectColumn(GroupToContactPeer::CONTACT_ID);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(GroupToContactPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			GroupToContactPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(GroupToContactPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
		$objects = GroupToContactPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return GroupToContactPeer::populateObjects(GroupToContactPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(GroupToContactPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			GroupToContactPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(GroupToContact $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getGroupId(), (string) $obj->getContactId()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof GroupToContact) {
				$key = serialize(array((string) $value->getGroupId(), (string) $value->getContactId()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or GroupToContact object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = GroupToContactPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = GroupToContactPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = GroupToContactPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				GroupToContactPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinContactGroup(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(GroupToContactPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			GroupToContactPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(GroupToContactPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(GroupToContactPeer::GROUP_ID,), array(ContactGroupPeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinContact(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(GroupToContactPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			GroupToContactPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(GroupToContactPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(GroupToContactPeer::CONTACT_ID,), array(ContactPeer::ID,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinContactGroup(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GroupToContactPeer::addSelectColumns($c);
		$startcol = (GroupToContactPeer::NUM_COLUMNS - GroupToContactPeer::NUM_LAZY_LOAD_COLUMNS);
		ContactGroupPeer::addSelectColumns($c);

		$c->addJoin(array(GroupToContactPeer::GROUP_ID,), array(ContactGroupPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = GroupToContactPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = GroupToContactPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = GroupToContactPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				GroupToContactPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addGroupToContact($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinContact(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GroupToContactPeer::addSelectColumns($c);
		$startcol = (GroupToContactPeer::NUM_COLUMNS - GroupToContactPeer::NUM_LAZY_LOAD_COLUMNS);
		ContactPeer::addSelectColumns($c);

		$c->addJoin(array(GroupToContactPeer::CONTACT_ID,), array(ContactPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = GroupToContactPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = GroupToContactPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = GroupToContactPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				GroupToContactPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = ContactPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ContactPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ContactPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ContactPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addGroupToContact($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(GroupToContactPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			GroupToContactPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(GroupToContactPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(GroupToContactPeer::GROUP_ID,), array(ContactGroupPeer::ID,), $join_behavior);
		$criteria->addJoin(array(GroupToContactPeer::CONTACT_ID,), array(ContactPeer::ID,), $join_behavior);
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

		GroupToContactPeer::addSelectColumns($c);
		$startcol2 = (GroupToContactPeer::NUM_COLUMNS - GroupToContactPeer::NUM_LAZY_LOAD_COLUMNS);

		ContactGroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ContactGroupPeer::NUM_COLUMNS - ContactGroupPeer::NUM_LAZY_LOAD_COLUMNS);

		ContactPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ContactPeer::NUM_COLUMNS - ContactPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(GroupToContactPeer::GROUP_ID,), array(ContactGroupPeer::ID,), $join_behavior);
		$c->addJoin(array(GroupToContactPeer::CONTACT_ID,), array(ContactPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = GroupToContactPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = GroupToContactPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = GroupToContactPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				GroupToContactPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addGroupToContact($obj1);
			} 
			
			$key3 = ContactPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = ContactPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = ContactPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ContactPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addGroupToContact($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptContactGroup(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			GroupToContactPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(GroupToContactPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(GroupToContactPeer::CONTACT_ID,), array(ContactPeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptContact(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			GroupToContactPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(GroupToContactPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(GroupToContactPeer::GROUP_ID,), array(ContactGroupPeer::ID,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptContactGroup(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GroupToContactPeer::addSelectColumns($c);
		$startcol2 = (GroupToContactPeer::NUM_COLUMNS - GroupToContactPeer::NUM_LAZY_LOAD_COLUMNS);

		ContactPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ContactPeer::NUM_COLUMNS - ContactPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(GroupToContactPeer::CONTACT_ID,), array(ContactPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = GroupToContactPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = GroupToContactPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = GroupToContactPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				GroupToContactPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = ContactPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ContactPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = ContactPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ContactPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addGroupToContact($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptContact(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GroupToContactPeer::addSelectColumns($c);
		$startcol2 = (GroupToContactPeer::NUM_COLUMNS - GroupToContactPeer::NUM_LAZY_LOAD_COLUMNS);

		ContactGroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ContactGroupPeer::NUM_COLUMNS - ContactGroupPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(GroupToContactPeer::GROUP_ID,), array(ContactGroupPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = GroupToContactPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = GroupToContactPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = GroupToContactPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				GroupToContactPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addGroupToContact($obj1);

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
		return GroupToContactPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(GroupToContactPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
			$con = Propel::getConnection(GroupToContactPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(GroupToContactPeer::GROUP_ID);
			$selectCriteria->add(GroupToContactPeer::GROUP_ID, $criteria->remove(GroupToContactPeer::GROUP_ID), $comparison);

			$comparison = $criteria->getComparison(GroupToContactPeer::CONTACT_ID);
			$selectCriteria->add(GroupToContactPeer::CONTACT_ID, $criteria->remove(GroupToContactPeer::CONTACT_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(GroupToContactPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(GroupToContactPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(GroupToContactPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												GroupToContactPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof GroupToContact) {
						GroupToContactPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(GroupToContactPeer::GROUP_ID, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(GroupToContactPeer::CONTACT_ID, $value[1]));
				$criteria->addOr($criterion);

								GroupToContactPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(GroupToContact $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(GroupToContactPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(GroupToContactPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(GroupToContactPeer::DATABASE_NAME, GroupToContactPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = GroupToContactPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($group_id, $contact_id, PropelPDO $con = null) {
		$key = serialize(array((string) $group_id, (string) $contact_id));
 		if (null !== ($obj = GroupToContactPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(GroupToContactPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(GroupToContactPeer::DATABASE_NAME);
		$criteria->add(GroupToContactPeer::GROUP_ID, $group_id);
		$criteria->add(GroupToContactPeer::CONTACT_ID, $contact_id);
		$v = GroupToContactPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseGroupToContactPeer::DATABASE_NAME)->addTableBuilder(BaseGroupToContactPeer::TABLE_NAME, BaseGroupToContactPeer::getMapBuilder());

