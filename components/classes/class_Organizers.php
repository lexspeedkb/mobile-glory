<?php
class Organizers {
	public function getById($id){
		$SQL = new SQL();

		$result = $SQL->query("SELECT * FROM organizers WHERE id='$id'");

		return $result;
	}

	public function getAll(){
		$SQL = new SQL();

		$result = $SQL->query("SELECT * FROM organizers ORDER BY id");

		return $result;
	}

	public function add($owner_id, $login, $link, $reputation){
		$SQL = new SQL();

		$SQL->query("INSERT INTO organizers (owner_id, login, reputation, link) VALUES ('$owner_id', '$login', '$reputation', '$link')");
	}

	public function edit($id, $owner_id, $login, $link, $reputation){
		$SQL = new SQL();

		$SQL->query("UPDATE organizers SET owner_id='$owner_id', login='$login', reputation='$reputation', link='$link' WHERE id='$id'");
	}
}
?>