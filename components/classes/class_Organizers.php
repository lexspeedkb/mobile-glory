<?php
class Organizers {
	public function getById($id){
		$SQL = new SQL();

		$result = $SQL->query("SELECT * FROM organizers WHERE id='$id'");

		return $result;
	}

	public function addOrganizer($id){
		$SQL->query("UPDATE users SET organizer='1' WHERE id='$id'");
		$SQL->query("INSERT INTO organizers (id, login, reputation, password, link) VALUES ('TEST', '100', 'TEST', '$link')");
	}
}
?>