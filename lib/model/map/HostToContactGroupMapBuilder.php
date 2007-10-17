<?php



class HostToContactGroupMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.HostToContactGroupMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('host_to_contact_group');
		$tMap->setPhpName('HostToContactGroup');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('HOST_ID', 'HostId', 'int' , CreoleTypes::INTEGER, 'host', 'ID', true, null);

		$tMap->addForeignPrimaryKey('CONTACT_GROUP_ID', 'ContactGroupId', 'int' , CreoleTypes::INTEGER, 'contact_group', 'ID', true, null);

	} 
} 