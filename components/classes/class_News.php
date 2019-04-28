<?php

class News{

	public function getAllNews(){
		$SQL = new SQL();

		$result = $SQL->query("SELECT * FROM `news` ORDER BY id DESC");


		return $newsList;
	}

	public function getLimitNews($limit=5){
		$mysql = Db::getConnection();

		$result = $mysql->query("SELECT * FROM `news` ORDER BY id DESC LIMIT 0, ".$limit);
		while ($row = $result->fetch_array()) {
			$newsList[$i]['id'] 	= $row['id'];
			$newsList[$i]['name'] 	= $row['name'];
			$newsList[$i]['text'] 	= $row['text'];
			$newsList[$i]['photo'] 	= $row['photo'];
			$newsList[$i]['date'] 	= $row['date'];
			$i++;
		}

		return $newsList;
	}

	public function getNewsByURL($url){
		$SQL = new SQL();

		$newsItem = $SQL->query("SELECT * FROM `news` WHERE url='$url'");

		return $newsItem;
	}

	public function editNews($id, $text, $name){
		$mysql = Db::getConnection();

		$mysql->query("UPDATE `news` SET text='$text' WHERE id='$id'");
		$mysql->query("UPDATE `news` SET name='$name' WHERE id='$id'");
	}

	public function addNews($text, $name, $photosNames){
		$mysql = Db::getConnection();

		$date = date("Y-m-d H:i:s");

		//Protection inputs from injections //Защита полей форм от инъекции
		$name = Engine::inputProtection($name);
		$text = Engine::inputProtection($text);

		$photo    = $photosNames[0];

		$mysql->query("INSERT INTO `news` (text, name, date, photo) VALUES ('$text', '$name', '$date', '$photo')");
		
		//find the new good
		$row = pilsql_p_select("SELECT * FROM `news` WHERE name='$name' AND text='$text' AND date='$date'");
		
		return $row['id'];
	}

	public function PilSQL_p_select($id){
		$mysql = Db::getConnection();
		$mysql->query("DELETE FROM `news` WHERE id='$id'");
	}
}

?>