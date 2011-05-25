<?php



class OsMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.OsMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(OsPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(OsPeer::TABLE_NAME);
		$tMap->setPhpName('Os');
		$tMap->setClassname('Os');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 255);

		$tMap->addColumn('IMAGE', 'Image', 'VARCHAR', true, 255);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} 
} 