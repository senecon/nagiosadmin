<?php



class HostServiceParamMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.HostServiceParamMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(HostServiceParamPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(HostServiceParamPeer::TABLE_NAME);
		$tMap->setPhpName('HostServiceParam');
		$tMap->setClassname('HostServiceParam');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('HOST_ID', 'HostId', 'INTEGER' , 'host', 'ID', true, null);

		$tMap->addForeignPrimaryKey('SERVICE_ID', 'ServiceId', 'INTEGER' , 'service', 'ID', true, null);

		$tMap->addColumn('PARAMETER', 'Parameter', 'VARCHAR', false, 255);

		$tMap->addColumn('SPECIAL', 'Special', 'LONGVARCHAR', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} 
} 