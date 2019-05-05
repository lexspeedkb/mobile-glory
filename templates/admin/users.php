<div style=" overflow-x: auto;">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%;">
    <thead>
      <tr>
        <th class="mdl-data-table__cell--non-numeric">#</th>
        <th class="mdl-data-table__cell--non-numeric">Действие</th>
        <th class="mdl-data-table__cell--non-numeric">Логин</th>
        <th class="mdl-data-table__cell--non-numeric">ФИО</th>
        <th class="mdl-data-table__cell--non-numeric">E-mail</th>
        <th class="mdl-data-table__cell--non-numeric">Дата регистрации</th>
        <th class="mdl-data-table__cell--non-numeric">Был в сети</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data['usersList'] as $user): ?>
        <tr>
          <td class="mdl-data-table__cell--non-numeric"><?=$user['id']?></td>
          <td class="mdl-data-table__cell--non-numeric">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" id="ban" user_id="<?=$user['id']?>">
              Бан
            </button>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="set_organize" user_id="<?=$user['id']?>">
              Организатор
            </button>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" id="de_ban" user_id="<?=$user['id']?>">
              Разбан
            </button>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="de_set_organize" user_id="<?=$user['id']?>">
              Не организатор
            </button>
            
          </td>
          <td class="mdl-data-table__cell--non-numeric"><?=$user['login']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$user['fio']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$user['email']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$user['date_reg']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$user['date_last_seen']?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

<script>
$(document).ready(function() {
  $('body').on('click', '#ban', function() {
    var user_id = $(this).attr("user_id");

    $.ajax({
      url: '/admin/api/banUser',
      data: {user_id_send: user_id},
      success: function(){
        location.reload();
      }
    });
  });
  $('body').on('click', '#de_ban', function() {
    var user_id = $(this).attr("user_id");

    $.ajax({
      url: '/admin/api/de_banUser',
      data: {user_id_send: user_id},
      success: function(){
        location.reload();
      }
    });
  });
  $('body').on('click', '#set_organize', function() {
    var user_id = $(this).attr("user_id");

    $.ajax({
      url: '/admin/api/setOrganizer',
      data: {user_id_send: user_id},
      success: function(){
        location.reload();
      }
    });
  });
  $('body').on('click', '#de_set_organize', function() {
    var user_id = $(this).attr("user_id");

    $.ajax({
      url: '/admin/api/de_setOrganizer',
      data: {user_id_send: user_id},
      success: function(){
        location.reload();
      }
    });
  });
});
</script>