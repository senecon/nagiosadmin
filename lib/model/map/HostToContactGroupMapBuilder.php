<?php



class HostToContactGroupMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.HostToContactGroupMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(HostToContactGroupPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(HostToContactGroupPeer::TABLE_NAME);
		$tMap->setPhpName('HostToContactGroup');
		$tMap->setClassname('HostToContactGroup');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('HOST_ID', 'HostId', 'INTEGER' , 'host', 'ID', true, null);

		$tMap->addForeignPrimaryKey('CONTACT_GROUP_ID', 'ContactGroupId', 'INTEGER' , 'contact_group', 'ID', true, null);

	} 
} 