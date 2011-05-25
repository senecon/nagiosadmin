<?php



class ServiceMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ServiceMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(ServicePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ServicePeer::TABLE_NAME);
		$tMap->setPhpName('Service');
		$tMap->setClassname('Service');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 255);

		$tMap->addColumn('ALIAS', 'Alias', 'VARCHAR', true, 255);

		$tMap->addForeignKey('COMMAND_ID', 'CommandId', 'INTEGER', 'command', 'ID', true, null);

		$tMap->addColumn('PORT', 'Port', 'INTEGER', false, null);

		$tMap->addColumn('SPECIAL', 'Special', 'LONGVARCHAR', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} 
} 