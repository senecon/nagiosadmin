<?php



class HostMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('host');
		$tMap->setPhpName('Host');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('GROUP_ID', 'GroupId', 'int', CreoleTypes::INTEGER, 'host_group', 'ID', true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('ALIAS', 'Alias', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('ADDRESS', 'Address', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('SPECIAL', 'Special', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('OS_ID', 'OsId', 'int', CreoleTypes::INTEGER, 'os', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 