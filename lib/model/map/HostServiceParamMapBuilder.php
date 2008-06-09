<?php



class HostServiceParamMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('host_service_param');
		$tMap->setPhpName('HostServiceParam');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('HOST_ID', 'HostId', 'int' , CreoleTypes::INTEGER, 'host', 'ID', true, null);

		$tMap->addForeignPrimaryKey('SERVICE_ID', 'ServiceId', 'int' , CreoleTypes::INTEGER, 'service', 'ID', true, null);

		$tMap->addColumn('PARAMETER', 'Parameter', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('SPECIAL', 'Special', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 