<?php



class ContactMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ContactMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(ContactPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ContactPeer::TABLE_NAME);
		$tMap->setPhpName('Contact');
		$tMap->setClassname('Contact');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 255);

		$tMap->addColumn('ALIAS', 'Alias', 'VARCHAR', true, 255);

		$tMap->addColumn('EMAIL', 'Email', 'VARCHAR', true, 255);

		$tMap->addColumn('SPECIAL', 'Special', 'LONGVARCHAR', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} 
} 