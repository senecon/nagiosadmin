<?php



class HostMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.HostMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(HostPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(HostPeer::TABLE_NAME);
		$tMap->setPhpName('Host');
		$tMap->setClassname('Host');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('GROUP_ID', 'GroupId', 'INTEGER', 'host_group', 'ID', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 255);

		$tMap->addColumn('ALIAS', 'Alias', 'VARCHAR', true, 255);

		$tMap->addColumn('ADDRESS', 'Address', 'VARCHAR', true, 255);

		$tMap->addColumn('SPECIAL', 'Special', 'LONGVARCHAR', false, null);

		$tMap->addForeignKey('OS_ID', 'OsId', 'INTEGER', 'os', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} 
} 