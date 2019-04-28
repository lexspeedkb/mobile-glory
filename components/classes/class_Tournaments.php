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

	public function add($title, $places, $free_places, $datetime, $game, $price, $description, $organizer){
		$SQL = new SQL();

		$SQL->query("INSERT INTO tournaments (title, places, free_places, datetime, game, price, description, organizer, active) VALUES ('$title', '$places', '$free_places', '$datetime', '$game', '$price', '$description', '$organizer', '1')");
		
		return 0;
	}

	public function delete($id){
		$SQL = new SQL();

		$SQL->query("DELETE FROM tournaments WHERE id='$id'");

		return 0;
	}
}
?>	