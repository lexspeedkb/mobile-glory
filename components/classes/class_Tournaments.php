<?php
class Tournaments{
	public function getAll(){
		$SQL = new SQL();

		$tournamentsList = $SQL->query("SELECT * FROM tournaments");

		return $tournamentsList;
	}
}
?>