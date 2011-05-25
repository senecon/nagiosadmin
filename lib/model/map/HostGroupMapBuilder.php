<?php



class HostGroupMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.HostGroupMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(HostGroupPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(HostGroupPeer::TABLE_NAME);
		$tMap->setPhpName('HostGroup');
		$tMap->setClassname('HostGroup');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 255);

		$tMap->addColumn('ALIAS', 'Alias', 'VARCHAR', true, 255);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} 
} 