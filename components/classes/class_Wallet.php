<?php
/**
 * 
 */
class Wallet{
	
	/**
	 * 
	 * Status: 
	 * 1 - OK
	 * 2 - error POST
	 * 3 - error SIGN
	 *
	 *
	 */
	public function addTransaction($currency, $user_id, $summ, $pm_no, $status){
		$SQL = new SQL();

		$datetime = date("Y-m-d H:i:s");

		$SQL->query("INSERT INTO `transactions` (summ, currency, user_id, datetime, status, pm_no) VALUES ('$summ', '$currency', '$user_id', '$datetime', '$status', '$pm_no')");
	}
}
?>