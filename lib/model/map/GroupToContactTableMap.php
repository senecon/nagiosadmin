<?php


/**
 * This class defines the structure of the 'group_to_contact' table.
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
class GroupToContactTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.GroupToContactTableMap';

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
		$this->setName('group_to_contact');
		$this->setPhpName('GroupToContact');
		$this->setClassname('GroupToContact');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('GROUP_ID', 'GroupId', 'INTEGER' , 'contact_group', 'ID', true, null, null);
		$this->addForeignPrimaryKey('CONTACT_ID', 'ContactId', 'INTEGER' , 'contact', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('ContactGroup', 'ContactGroup', RelationMap::MANY_TO_ONE, array('group_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('Contact', 'Contact', RelationMap::MANY_TO_ONE, array('contact_id' => 'id', ), 'CASCADE', null);
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

} // GroupToContactTableMap
