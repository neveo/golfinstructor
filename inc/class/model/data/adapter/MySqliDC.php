<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/data/adapter/DatabaseConnection.php';

/**
* @package    VMS
* @subpackage ModelDataAdapter
* @author     Neveo Harrison <code@neveoo.com>
*/
class MySqliDC extends DatabaseConnection {
	
	private $db = null;
	
	public function connect() 
	{
		if (!$this->db) {
			try {
				$this->db = new mysqli($this->host, $this->user, $this->pass, $this->name);
			} catch (Exception $e) {
				die('Unable to connect: ' . $e->getMessage());
			}
			if (!$this->db) {
				die('Unable to connect: ' . mysqli_error());
			}
			// End specific implementation.
		}
	}
	
	public function close()
	{
		if ($this->db) {
			$this->db->close();
			$this->db = null;
		}
	}	
	
	public function select($sql, $params) 
	{
		$rows = array();
		$this->connect();
		
		// Database specific implementation.
		// Only prepare if we have some placeholders.
		if (strpos($sql, '?') !== false) {
			$stmt = $this->db->prepare(strtolower($sql));
			//echo 'Prepared SQL ' . $sql;
			
			$size = count($params);
			$paramTypes = '';
			$paramRefs = '';
			for ($i = 0; $i < $size; $i++) {
				$paramTypes .= 's';
				$paramRefs .= "\$params[$i]";
				if ($i != $size - 1) $paramRefs .= ', ';
			}
			$csvParams = '"' . implode('", "', $params) . '"';
			
			if ($size != 0) {
				eval("\$stmt->bind_param(\"$paramTypes\", $paramRefs);");
			}
	
			if ($stmt->execute()) {
				// Bind result
				while ($row = $this->fetch_array($stmt)) {
					//print_r($row);
					$rows[] = $row;
				}
			}
		} else if (stripos($sql, 'LAST_INSERT_ID')) {
			$row['id'] = $this->db->insert_id;
			//echo 'Last insert id call ' . $sql;
       		$rows[] = $row;
		} else {
			$result = $this->db->query($sql);
			//echo 'Non-prepared SQL ' . $sql;
		    while ($row = $result->fetch_assoc()) {
       			$rows[] = $row;
    		}
		}
		// End specific implementation.
		
		$this->close();
		return $rows;
	}
	
	public function insert($sql, $params) 
	{
		$this->connect();
		
		// Database specific implementation.
		$stmt = $this->db->prepare(strtolower($sql));
		
		echo mysqli_error($this->db);
		
		$size = count($params);
		$paramTypes = '';
		$paramRefs = '';
		for ($i = 0; $i < $size; $i++) {
			$paramTypes .= 's';
			$paramRefs .= "\$params[$i]";
			if ($i != $size - 1) $paramRefs .= ', ';
		}
		$csvParams = '"' . implode('", "', $params) . '"';
		
		eval("\$stmt->bind_param(\"$paramTypes\", $paramRefs);");
					
		$result = $stmt->execute();
		// End specific implementation.
		
		$this->close();
		return $result;
		//print_r($result);
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

		// End specific implementation.
	}		

	private function fetch_array($stmt) 
	{
        $data = mysqli_stmt_result_metadata($stmt);
        $count = 1; //start the count from 1. First value has to be a reference to the stmt. because bind_param requires the link to $stmt as the first param.
        $fieldnames[0] = &$stmt;
        while ($field = mysqli_fetch_field($data)) {
            $fieldnames[$count] = &$array[$field->name]; //load the fieldnames into an array.
            $count++;
        }
        call_user_func_array('mysqli_stmt_bind_result', $fieldnames);
        if (mysqli_stmt_fetch($stmt)) {
        	return $array;
        } 
        
       	return false;
    }
	
}