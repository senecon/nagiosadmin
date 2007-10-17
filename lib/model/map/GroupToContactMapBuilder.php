<?php



class GroupToContactMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.GroupToContactMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('group_to_contact');
		$tMap->setPhpName('GroupToContact');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('GROUP_ID', 'GroupId', 'int' , CreoleTypes::INTEGER, 'contact_group', 'ID', true, null);

		$tMap->addForeignPrimaryKey('CONTACT_ID', 'ContactId', 'int' , CreoleTypes::INTEGER, 'contact', 'ID', true, null);

	} 
} 