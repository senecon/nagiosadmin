<?php



class ServiceMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('service');
		$tMap->setPhpName('Service');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('ALIAS', 'Alias', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addForeignKey('COMMAND_ID', 'CommandId', 'int', CreoleTypes::INTEGER, 'command', 'ID', true, null);

		$tMap->addColumn('PORT', 'Port', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SPECIAL', 'Special', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 