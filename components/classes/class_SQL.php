<?php
class SQL{
	public function query($sql){
		$mysqli = Db::getConnection();

		$action = explode(' ', $sql);

		if($action[0]=='SELECT'){
			//SELECT
			$result = $mysqli->query($sql);
			//Multi select
			if($result->num_rows>1){
				$q=0;
				while ($row = $result->fetch_array()) {
					$i=0;
					foreach($row as $key => $value){
						if($i%2==1){
							$return[$q][$key] = $value;
						}
						++$i;

					}
					++$q;
				}
			}else{
				//Select of one row
				if($result!=""){
					$return = $result->fetch_array(MYSQLI_ASSOC);
				}
			}
		}elseif($action[0]=='INSERT'){
			//INSERT
			$mysqli->query($sql);
			$return = mysqli_insert_id($mysqli);
		}elseif($action[0]=='UPDATE'){
			//UPDATE
			$mysqli->query($sql);
		}elseif($action[0]=='DELETE'){
			//UPDATE
			$mysqli->query($sql);
		}

		if(mysqli_error($mysqli)!=""){
			die(mysqli_error($mysqli));
		}

		return $return;
	}

}
?>