<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/data/adapter/IbmDb2DC.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/data/adapter/MySqliDC.php';

/**
* This is an abstract class representing an interface for passing commands to a database.  The run time implementation that is returned is determined by the configuration file.
*
* @package    VMS
* @subpackage ModelDataAdapter
* @author     Neveo Harrison <code@neveoo.com>
*/
abstract class DatabaseConnection {
	
	protected $host 		= DB_HOST;
	protected $port 		= DB_PORT;
	protected $name 		= DB_NAME;
	protected $user 		= DB_USER;
	protected $pass 		= DB_PASS;	
	protected $schema 		= DB_SCHEMA;
	protected $cataloged 	= DB_CATALOGED;
	protected $dcType 		= DB_DC_TYPE;
	
	/**
	* Return a concrete implementation of the methods guaranteed by this class.  The implementation is decided in the configuration file.
	*
	* @return DatabaseConnection The implementation of this abstract class through which these methods can be called.
	*/	
	public final static function databaseConnectionFactory() 
	{
		switch (DB_DC_TYPE) {
			case DB_DC_TYPE_IBM_DB2: 			return new IbmDb2DC(); 
			case DB_DC_TYPE_MYSQLI: 			return new MySqliDC(); 
			default: 							return null;
		}
	}
	
	/**
	* Connect to the database.
	* 
	* @return void
	*/	
	public abstract function connect();
	
	/**
	* Close the connection to the database.
	* 
	* @return void
	*/		
	public abstract function close();
	
	/**
	* Issue a read query to the database.
	* 
	* @param string $sql An SQL statement with zero or more parameter markers.
	* @param array $params An array of parameters which should be mapped to the markers.
	* @return void
	*/	
	public abstract function select($sql, $params);
	
	/**
	* Issue an insert to the database.
	* 
	* @param string $sql An SQL statement with zero or more parameter markers.
	* @param array $params An array of parameters which should be mapped to the markers.
	* @return void
	*/	
	public abstract function insert($sql, $params);
	
	/**
	* Issue an update to the database.
	* 
	* @param string $sql An SQL statement with zero or more parameter markers.
	* @param array $params An array of parameters which should be mapped to the markers.
	* @return void
	*/		
	public abstract function update($sql, $params);
	
	/**
	* Issue a delete to the database.
	* 
	* @param string $sql An SQL statement with zero or more parameter markers.
	* @param array $params An array of parameters which should be mapped to the markers.
	* @return void
	*/		
	public abstract function delete($sql, $params);
	
	
	/**
	* Issue a transaction with several SQL queries.
	* 
	* @param array $sql An SQL statement with zero or more parameter markers.
	* @param array $params An array of parameters which should be mapped to the markers.
	* @return void
	*/		
	public abstract function performTransaction($sql, $params);	
	
}