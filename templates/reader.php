<?php
foreach($data['newsList']['content']['content'] as $div){
	if($div['type']=='paragraphDiv'){
		echo $div['data'],'<br>';
	}
	if($div['type']=='imageDiv'){
		echo '<img src="',$div['data'],'"><br>';
	}
}
?>