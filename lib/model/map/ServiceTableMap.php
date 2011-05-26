<?php


/**
 * This class defines the structure of the 'service' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class ServiceTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ServiceTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('service');
		$this->setPhpName('Service');
		$this->setClassname('Service');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
		$this->addColumn('ALIAS', 'Alias', 'VARCHAR', true, 255, null);
		$this->addForeignKey('COMMAND_ID', 'CommandId', 'INTEGER', 'command', 'ID', true, null, null);
		$this->addColumn('PORT', 'Port', 'INTEGER', false, null, null);
		$this->addColumn('SPECIAL', 'Special', 'LONGVARCHAR', false, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Command', 'Command', RelationMap::MANY_TO_ONE, array('command_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('HostServiceParam', 'HostServiceParam', RelationMap::ONE_TO_MANY, array('id' => 'service_id', ), 'CASCADE', null);
    $this->addRelation('ServiceToHost', 'ServiceToHost', RelationMap::ONE_TO_MANY, array('id' => 'service_id', ), 'CASCADE', null);
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
		);
	} // getBehaviors()

} // ServiceTableMap
