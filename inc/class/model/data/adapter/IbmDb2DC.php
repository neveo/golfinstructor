<?php
/*
* The abstract class which defines the methods this class must implement.
*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/data/adapter/DatabaseConnection.php';

/**
* @package    VMS
* @subpackage ModelDataAdapter
* @author     Neveo Harrison <code@neveoo.com>
*/
class IbmDb2DC extends DatabaseConnection {
	
	private $db = null;
	
	public function connect() 
	{
		if (!$this->db) {
			// Database specific implementation.
			
			if ($this->cataloged) {
				$this->db = db2_pconnect($this->name, $this->user, $this->pass);
			} else {
				$dsn = 'DRIVER={IBM DB2 ODBC DRIVER};HOSTNAME=' . $this->host . ';DATABASE=' . $this->name . ';PROTOCOL=TCPIP;PORT=' . $this->port . ';UID=' . $this->user . ';PWD=' . $this->pass . ';';
				$this->db = db2_pconnect($dsn, null, null);
			}
			if (!$this->db) {
				die('Unable to connect: ' . db2_conn_errormsg());
			}
			db2_exec($this->db, 'SET CURRENT SCHEMA ' . $this->schema);
			
			// End specific implementation.
		}
	}
	
	public function close()
	{
		if ($this->db) {
			// Database specific implementation.
			
			db2_close($this->db);
			$this->db = null;
			
			// End specific implementation.
		}
	}
	
	public function select($sql, $params) 
	{
		$rows = array();
		$this->connect();
		
		// Database specific implementation.
		
		db2_autocommit($this->db, DB2_AUTOCOMMIT_ON);	
		$stmt = db2_prepare($this->db, $sql);
		$result = db2_execute($stmt, $params);	
		while ($row = db2_fetch_assoc($stmt)) {
			$rows[] = $row;
		}
		
		// End specific implementation.
		
		$this->close();
		return $rows;
	}
	
	public function insert($sql, $params) 
	{
		$this->connect();
		
		// Database specific implementation.
		
		// Ensure that autocommit is on for this connection.
		db2_autocommit($this->db, DB2_AUTOCOMMIT_ON);
		
		// Prepare the statement with one or more parameter markers.
		$stmt = db2_prepare($this->db, $sql);
		
		echo db2_stmt_errormsg($stmt);
		
		// Execute the query with the array of parameters.
		$result = db2_execute($stmt, $params);
		
		echo db2_stmt_errormsg($stmt);
		
		// End specific implementation.
		
		$this->close();
		return $result;
	}
	
	public function update($sql, $params) 
	{
		return $this->insert($sql, $params);
	}
	
	public function delete($sql, $params) 
	{
		return $this->insert($sql, $params);
	}
	
	/**
	* Issue a transaction with several SQL queries.
	* 
	* @param array $sql An SQL statement with zero or more parameter markers.
	* @param array $params An array of parameters which should be mapped to the markers.
	* @return void
	*/
	public function performTransaction($sql, $params) 
	{
		// Database specific implementation.

		// Turn off autocommit
		db2_autocommit($this->db, DB2_AUTOCOMMIT_OFF);
		
		// Execute array of queries
		
		// Commit / rollback
		
		// Turn on autocommit again
		db2_autocommit($this->db, DB2_AUTOCOMMIT_ON);
		
		// End specific implementation.	
	}		
	
}