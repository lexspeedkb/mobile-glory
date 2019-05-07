<div style=" overflow-x: auto;">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%;">
    <thead>
      <tr>
        <th class="mdl-data-table__cell--non-numeric">#</th>
        <th class="mdl-data-table__cell--non-numeric">Сумма</th>
        <th class="mdl-data-table__cell--non-numeric">Валюта</th>
        <th class="mdl-data-table__cell--non-numeric">Дата и время</th>
        <th class="mdl-data-table__cell--non-numeric">Статус</th>
        <th class="mdl-data-table__cell--non-numeric">Уникальный номер платежа</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data['transactionsList'] as $transaction): ?>
        <tr>
          <td class="mdl-data-table__cell--non-numeric"><?=$transaction['id']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$transaction['summ']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$transaction['currency']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$transaction['datetime']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$transaction['status']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$transaction['pm_no']?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

<form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
	<input type="text" name="ik_co_id" value="5cd08d1e3d1eaf34068b456c"><br>
	<input type="text" name="ik_pm_no" value="<?=$data['id_pm_no']?>"><br>
	<input type="text" name="ik_am" value="100.00"><br>
	<input type="text" name="ik_x_id" value="<?=$data['user_id']?>"><br>
	<input type="text" name="ik_cur" value="UAH"><br>
	<input type="text" name="ik_desc" value="Пополнение кошелька Mobile Glory"><br>
    <input type="submit" value="Пополнить">
</form>