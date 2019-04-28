<?php
class Tournaments{
	public function getAll(){
		$SQL = new SQL();

		$tournamentsList = $SQL->query("SELECT * FROM tournaments");

		return $tournamentsList;
	}

	public function getAllByOrganizer($organizer_id){
		$SQL = new SQL();

		$tournamentsList = $SQL->query("SELECT * FROM tournaments WHERE organizer='$organizer_id'");

		return $tournamentsList;
	}
}
?>