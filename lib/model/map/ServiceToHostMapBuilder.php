<?php



class ServiceToHostMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('service_to_host');
		$tMap->setPhpName('ServiceToHost');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('SERVICE_ID', 'ServiceId', 'int' , CreoleTypes::INTEGER, 'service', 'ID', true, null);

		$tMap->addForeignPrimaryKey('HOST_ID', 'HostId', 'int' , CreoleTypes::INTEGER, 'host', 'ID', true, null);

	} 
} 