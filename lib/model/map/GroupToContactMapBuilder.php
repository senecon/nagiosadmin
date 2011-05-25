<?php



class GroupToContactMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.GroupToContactMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(GroupToContactPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(GroupToContactPeer::TABLE_NAME);
		$tMap->setPhpName('GroupToContact');
		$tMap->setClassname('GroupToContact');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('GROUP_ID', 'GroupId', 'INTEGER' , 'contact_group', 'ID', true, null);

		$tMap->addForeignPrimaryKey('CONTACT_ID', 'ContactId', 'INTEGER' , 'contact', 'ID', true, null);

	} 
} 