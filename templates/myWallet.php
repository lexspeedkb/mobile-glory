<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--primary pursahe show-dialog addFab">
  <i class="material-icons">add</i>
</button>

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
      	<?php
      	if ($transaction['status']==1)
      		$transaction['status_name'] = "Оплачено";
      	if ($transaction['status']==2)
      		$transaction['status_name'] = "Ошибка: пустой запрос";
      	if ($transaction['status']==3)
      		$transaction['status_name'] = "Ошибка: цифровая подпись не совпадает";
      	?>
        <tr>
          <td class="mdl-data-table__cell--non-numeric"><?=$transaction['id']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$transaction['summ']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$transaction['currency']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$transaction['datetime']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$transaction['status_name']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$transaction['pm_no']?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

<dialog class="mdl-dialog add-tournament">
  <form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
    <h4 class="mdl-dialog__title" id="addTournament_title">Создать организатора</h4>
    <h4 class="mdl-dialog__title" id="editTournament_title" style="display: none">Редактировать организатора <span id="id_title"></span></h4>
    <div class="mdl-dialog__content">
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="ik_am" name="ik_am" value="100">
        <label class="mdl-textfield__label" for="inp_reputation">Сумма пополнения (ГРН)</label>
        <span class="mdl-textfield__error">Введите число!</span>
      </div>
      <br>
      Если Вам необходимо пополнить кошелёк рублями - обращайтесь по E-mail: <a href="mailto:mglorytournaments@gmail.com" target="__blank">mglorytournaments@gmail.com</a>, или в директ <a href="https://instagram.com/mobile_glory">Mobile Glory</a>
  		<input type="hidden" name="ik_co_id" value="5cd08d1e3d1eaf34068b456c"><br>
  		<input type="hidden" name="ik_pm_no" value="<?=$data['id_pm_no']?>"><br>
  		<input type="hidden" name="ik_x_id" value="<?=$data['user_id']?>"><br>
  		<input type="hidden" name="ik_cur" value="UAH"><br>
  		<input type="hidden" name="ik_desc" value="Пополнение кошелька Mobile Glory"><br>
    </div>
    <div class="mdl-dialog__actions">
      <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Пополнить</button>
      <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect close">
        Отмена
      </a>
    </div>
  </form>
</dialog>
<script>
  var dialog = document.querySelector('dialog');
  if (! dialog.showModal) {
    dialogPolyfill.registerDialog(dialog);
  }
  $('body').on('click', '.show-dialog', function() {
    dialog.showModal();
  });
  dialog.querySelector('.close').addEventListener('click', function() {
    dialog.close();
  });
</script>

