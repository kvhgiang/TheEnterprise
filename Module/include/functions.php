<?php
	function GetEmpPositionByID($id){
		global $dbc;
		$query = "select e.Name from  employee_position e
where e.ID = '$id'";
		$result = $dbc->query($query);
		$row =$result->fetch_array();
		return $row[0];

	}
?>