<?php



class ServiceToHostMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ServiceToHostMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(ServiceToHostPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ServiceToHostPeer::TABLE_NAME);
		$tMap->setPhpName('ServiceToHost');
		$tMap->setClassname('ServiceToHost');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('SERVICE_ID', 'ServiceId', 'INTEGER' , 'service', 'ID', true, null);

		$tMap->addForeignPrimaryKey('HOST_ID', 'HostId', 'INTEGER' , 'host', 'ID', true, null);

	} 
} 