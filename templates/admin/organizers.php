<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--primary addOrganizer_fab show-dialog addFab">
  <i class="material-icons">add</i>
</button>

<div style="overflow-x: auto;">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%;">
    <thead>
      <tr>
        <th class="mdl-data-table__cell--non-numeric">#</th>
        <th class="mdl-data-table__cell--non-numeric">Действие</th>
        <th class="mdl-data-table__cell--non-numeric">Логин</th>
        <th class="mdl-data-table__cell--non-numeric">Владелец</th>
        <th class="mdl-data-table__cell--non-numeric">Репутация</th>
        <th class="mdl-data-table__cell--non-numeric">Ссылка</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data['organizersList'] as $organizer): ?>
        <tr>
          <td class="mdl-data-table__cell--non-numeric"><?=$organizer['id']?></td>
          <td class="mdl-data-table__cell--non-numeric">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored edit show-dialog" id="<?=$organizer['id']?>" org_id="<?=$organizer['owner_id']?>" login="<?=$organizer['login']?>" owner_id="<?=$organizer['owner_id']?>" reputation="<?=$organizer['reputation']?>" link="<?=$organizer['link']?>">
              Редактировать
            </button>
          </td>
          <td class="mdl-data-table__cell--non-numeric"><?=$organizer['login']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$organizer['owner_id']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$organizer['reputation']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$organizer['link']?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

<dialog class="mdl-dialog add-tournament">
  <h4 class="mdl-dialog__title" id="addTournament_title">Создать организатора</h4>
  <h4 class="mdl-dialog__title" id="editTournament_title" style="display: none">Редактировать организатора <span id="id_title"></span></h4>
  <div class="mdl-dialog__content">
    <input type="hidden" id="inp_id"><br>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" id="inp_login">
      <label class="mdl-textfield__label" for="inp_login">Логин</label>
    </div>
    <br>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" id="inp_link">
      <label class="mdl-textfield__label" for="inp_link">Ссылка</label>
    </div>
    <br>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="inp_owner">
      <label class="mdl-textfield__label" for="inp_owner">Владелец</label>
      <span class="mdl-textfield__error">Введите число!</span>
    </div>
    <br>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="inp_reputation">
      <label class="mdl-textfield__label" for="inp_reputation">Репутация</label>
      <span class="mdl-textfield__error">Введите число!</span>
    </div>
  </div>
  <div class="mdl-dialog__actions">
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="addOrg">
      Создать организатора
    </a>
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="editOrg" style="display: none">
      Редактировать организатора
    </a>
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect close">
      Отмена
    </a>
  </div>
</dialog>

<script>
  $(document).ready(function() {
    $('body').on('click', '.addOrganizer_fab', function() {
      var inp_login      = $('#inp_login').val('');
      var inp_link       = $('#inp_link').val('');
      var inp_owner      = $('#inp_owner').val('');
      var inp_reputation = $('#inp_reputation').val('');

      $('#addOrg').css('display', 'block');
      $('#editOrg').css('display', 'none');
      $('#addOrg_title').css('display', 'block');
      $('#editOrg_title').css('display', 'none');
    });

    $('body').on('click', '#addOrg', function() {
      var inp_login      = $('#inp_login').val();
      var inp_link       = $('#inp_link').val();
      var inp_owner      = $('#inp_owner').val();
      var inp_reputation = $('#inp_reputation').val();

      $.ajax({
        url: '/admin/api/addOrganizer',
        data: {login: inp_login, link: inp_link, owner: inp_owner, reputation: inp_reputation},
        success: function(){
          location.reload();
        }
      });
    });

    $('body').on('click', '.edit', function() {
      var inp_id         = $('#inp_id').val($(this).attr('id'));
      var inp_login      = $('#inp_login').val($(this).attr('login'));
      var inp_link       = $('#inp_link').val($(this).attr('link'));
      var inp_owner      = $('#inp_owner').val($(this).attr('owner_id'));
      var inp_reputation = $('#inp_reputation').val($(this).attr('reputation'));

      $('#addOrg').css('display', 'none');
      $('#editOrg').css('display', 'block');
      $('#addOrg_title').css('display', 'none');
      $('#editOrg_title').css('display', 'block');
    });

    $('body').on('click', '#editOrg', function() {
      var inp_id         = $('#inp_id').val();
      var inp_login      = $('#inp_login').val();
      var inp_link       = $('#inp_link').val();
      var inp_owner      = $('#inp_owner').val();
      var inp_reputation = $('#inp_reputation').val();

      $.ajax({
        url: '/admin/api/editOrganizer',
        data: {login: inp_login, link: inp_link, owner: inp_owner, reputation: inp_reputation, id: inp_id},
        success: function(){
          location.reload();
        }
      });
    });
  });
</script>