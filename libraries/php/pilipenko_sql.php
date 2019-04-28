<?php
function PilSQL_p_select($SQL){
	$mysql = Db::getConnection();

	$result = $mysql->query($SQL);
	$row = $result->fetch_array();

	return $row;
}

function PilSQL_p_select_all($SQL){
	$mysql = Db::getConnection();

	$result = $mysql->query($SQL);
	while ($row = $result->fetch_array()) {
		$row2[$i] = $row;
		$i++;
	}

	return $row2;
}
?>