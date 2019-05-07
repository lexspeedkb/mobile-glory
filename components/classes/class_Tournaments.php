<?php
class Tournaments{
	public function getAll(){
		$SQL = new SQL();

		$tournamentsList = $SQL->query("SELECT * FROM tournaments", true);

		return $tournamentsList;
	}

	public function getAllByOrganizer($organizer_id){
		$SQL = new SQL();

		$tournamentsList = $SQL->query("SELECT * FROM tournaments WHERE organizer='$organizer_id'", true);

		return $tournamentsList;
	}

	public function add($title, $places, $free_places, $datetime, $game, $price, $description, $organizer_owner_id){
		$SQL        = new SQL();
		$Organizers = new Organizers();

		$organizer_data = $Organizers->getByOwnerId($organizer_owner_id);

		$organizer = $organizer_data['id'];

		$SQL->query("INSERT INTO tournaments (title, places, free_places, datetime, game, price, description, organizer, active) VALUES ('$title', '$places', '$free_places', '$datetime', '$game', '$price', '$description', '$organizer', '1')");
		
		return 0;
	}

	public function edit($id, $title, $places, $free_places, $datetime, $game, $price, $description){
		$SQL = new SQL();

		print_r_pre(func_get_args());

		$SQL->query("UPDATE tournaments SET title='$title', places='$places', free_places='$free_places', datetime='$datetime', game='$game', price='$price', description='$description' WHERE id='$id'");
		
		return 0;
	}

	public function delete($id){
		$SQL = new SQL();

		$SQL->query("DELETE FROM tournaments WHERE id='$id'");

		return 0;
	}
}
?>