<?php



class TemplateMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TemplateMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TemplatePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TemplatePeer::TABLE_NAME);
		$tMap->setPhpName('Template');
		$tMap->setClassname('Template');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('TYPE', 'Type', 'INTEGER', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 255);

		$tMap->addColumn('ALIAS', 'Alias', 'VARCHAR', true, 255);

		$tMap->addColumn('CONTENT', 'Content', 'LONGVARCHAR', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} 
} 