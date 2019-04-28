<?php
class Organizers {
	public function getById($id){
		$SQL = new SQL();

		$result = $SQL->query("SELECT * FROM organizers WHERE id='$id'");

		return $result;
	}
}
?>