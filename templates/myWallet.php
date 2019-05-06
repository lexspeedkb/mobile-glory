<form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
	<input type="text" name="ik_co_id" value="5cd08d1e3d1eaf34068b456c"><br>
	<input type="text" name="ik_pm_no" value="<?=$data['id_pm_no']?>"><br>
	<input type="text" name="ik_am" value="100.00"><br>
	<input type="text" name="ik_x_id" value="<?=$data['user_id']?>"><br>
	<input type="text" name="ik_cur" value="UAH"><br>
	<input type="text" name="ik_desc" value="Пополнение кошелька Mobile Glory"><br>
    <input type="submit" value="Пополнить">
</form>