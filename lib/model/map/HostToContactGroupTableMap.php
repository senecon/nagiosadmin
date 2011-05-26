<?php


/**
 * This class defines the structure of the 'host_to_contact_group' table.
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
class HostToContactGroupTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.HostToContactGroupTableMap';

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
		$this->setName('host_to_contact_group');
		$this->setPhpName('HostToContactGroup');
		$this->setClassname('HostToContactGroup');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('HOST_ID', 'HostId', 'INTEGER' , 'host', 'ID', true, null, null);
		$this->addForeignPrimaryKey('CONTACT_GROUP_ID', 'ContactGroupId', 'INTEGER' , 'contact_group', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Host', 'Host', RelationMap::MANY_TO_ONE, array('host_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('ContactGroup', 'ContactGroup', RelationMap::MANY_TO_ONE, array('contact_group_id' => 'id', ), 'CASCADE', null);
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
		);
	} // getBehaviors()

} // HostToContactGroupTableMap
