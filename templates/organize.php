<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--primary addTournament_fab show-dialog">
  <i class="material-icons">add</i>
</button>

<div style=" overflow-x: auto;">
  <?php if (!empty($data['tournamentsList'])): ?>
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%;">
      <thead>
        <tr>
          <th class="mdl-data-table__cell--non-numeric">#</th>
          <th class="mdl-data-table__cell--non-numeric">Действие</th>
          <th class="mdl-data-table__cell--non-numeric">Заголовок</th>
          <th class="mdl-data-table__cell--non-numeric">Мест всего/свободных</th>
          <th class="mdl-data-table__cell--non-numeric">Дата</th>
          <th class="mdl-data-table__cell--non-numeric">Игра</th>
          <th class="mdl-data-table__cell--non-numeric">Цена</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['tournamentsList'] as $tournament): ?>
          <?php
          $tournament['datetime_local'] = datetime_local($tournament['datetime']);
          ?>
          <tr>
            <td class="mdl-data-table__cell--non-numeric"><?=$tournament['id']?></td>
            <td class="mdl-data-table__cell--non-numeric">
              <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent delete" tour_id="<?=$tournament['id']?>">
                Удалить
              </button>
              <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored edit show-dialog" tour_id="<?=$tournament['id']?>" title="<?=$tournament['title']?>" places="<?=$tournament['places']?>" free_places="<?=$tournament['free_places']?>" game="<?=$tournament['game']?>" description="<?=$tournament['description']?>" datetime="<?=$tournament['datetime_local']?>" price="<?=$tournament['price']?>">
                Редактировать
              </button>
            </td>
            <td class="mdl-data-table__cell--non-numeric"><?=$tournament['title']?></td>
            <td class="mdl-data-table__cell--non-numeric"><?=$tournament['places']?>/<?=$tournament['free_places']?></td>
            <td class="mdl-data-table__cell--non-numeric"><?=$tournament['datetime']?></td>
            <td class="mdl-data-table__cell--non-numeric"><?=$tournament['game']?></td>
            <td class="mdl-data-table__cell--non-numeric"><?=$tournament['price']?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php else: ?>
    <h3 align="center">Тут пока ничего нет) Создайте свой первый турнир!</h3>
  <?php endif ?>
</div>

<dialog class="mdl-dialog add-tournament">
  <h4 class="mdl-dialog__title" id="addTournament_title">Создать турнир</h4>
  <h4 class="mdl-dialog__title" id="editTournament_title" style="display: none">Редактировать турнир <span id="id_title"></span></h4>
  <div class="mdl-dialog__content">
    <input type="hidden" id="inp_id"><br>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" id="inp_title">
      <label class="mdl-textfield__label" for="inp_title">Заголовок</label>
    </div>
    <br>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <textarea class="mdl-textfield__input" type="text" cols="30" rows="10" rows= "3" id="inp_description"></textarea>
      <label class="mdl-textfield__label" for="inp_description">Описание</label>
    </div>
    <br>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="inp_places">
      <label class="mdl-textfield__label" for="inp_places">Всего мест</label>
      <span class="mdl-textfield__error">Введите число!</span>
    </div>

    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="inp_free_places">
      <label class="mdl-textfield__label" for="inp_free_places">Свободных мест</label>
      <span class="mdl-textfield__error">Введите число!</span>
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="datetime-local" id="inp_datetime" value="<?=$data['datetimeNow']?>">
      <label class="mdl-textfield__label" for="inp_datetime">Дата проведения</label>
    </div>
    <br>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <select class="mdl-textfield__input" id="inp_game">
        <option value="1">PUBG Mobile</option>
      </select>
      <label class="mdl-textfield__label" for="inp_game">Игра</label>
    </div>
    <br>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" id="inp_price">
      <label class="mdl-textfield__label" for="inp_price">Цена участия РУБ</label>
    </div>
  </div>
  <div class="mdl-dialog__actions">
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="addTournament">
      Создать турнир
    </a>
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="editTournament" style="display: none">
      Редактировать турнир
    </a>
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect close">
      Отмена
    </a>
  </div>
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

<script>
  $(document).ready(function() {
    $('body').on('click', '.addTournament_fab', function() {
      var inp_title       = $('#inp_title').val('');
      var inp_description = $('#inp_description').val('');
      var inp_places      = $('#inp_places').val('');
      var inp_free_places = $('#inp_free_places').val('');
      var inp_datetime    = $('#inp_datetime').val('');
      var inp_game        = $('#inp_game').val('');
      var inp_price       = $('#inp_price').val('');

      $('#addTournament').css('display', 'block');
      $('#editTournament').css('display', 'none');
      $('#addTournament_title').css('display', 'block');
      $('#editTournament_title').css('display', 'none');
    });
    
    $('body').on('click', '#addTournament', function() {
      var inp_title       = $('#inp_title').val();
      var inp_description = $('#inp_description').val();
      var inp_places      = $('#inp_places').val();
      var inp_free_places = $('#inp_free_places').val();
      var inp_datetime    = $('#inp_datetime').val();
      var inp_game        = $('#inp_game').val();
      var inp_price       = $('#inp_price').val();

      $.ajax({
        url: '/api/addTournament',
        data: {title: inp_title, places: inp_places, free_places: inp_free_places, datetime: inp_datetime, game: inp_game, price: inp_price, description: inp_description},
        success: function(){
          location.reload();
        }
      });
    });

    $('body').on('click', '.delete', function() {
      var tour_id = $(this).attr("tour_id");

      $.ajax({
        url: '/api/deleteTournament',
        data: {id: tour_id},
        success: function(){
          location.reload();
        }
      });
    });

    $('body').on('click', '.edit', function() {
      var tour_id = $(this).attr("tour_id");

      $('#id_title').text(tour_id);
      $('#addTournament').css('display', 'none');
      $('#editTournament').css('display', 'block');
      $('#addTournament_title').css('display', 'none');
      $('#editTournament_title').css('display', 'block');

      $('#inp_id').val(tour_id);
      $('#inp_title').val($(this).attr('title'));
      $('#inp_description').val($(this).attr('description'));
      $('#inp_places').val($(this).attr('places'));
      $('#inp_free_places').val($(this).attr('free_places'));
      $('#inp_datetime').val($(this).attr('datetime'));
      $('#inp_game').val($(this).attr('game'));
      $('#inp_price').val($(this).attr('price'));
    });

    $('body').on('click', '#editTournament', function() {
      var tour_id         = $(this).attr("tour_id");
      var inp_id          = $('#inp_id').val();
      var inp_title       = $('#inp_title').val();
      var inp_description = $('#inp_description').val();
      var inp_places      = $('#inp_places').val();
      var inp_free_places = $('#inp_free_places').val();
      var inp_datetime    = $('#inp_datetime').val();
      var inp_game        = $('#inp_game').val();
      var inp_price       = $('#inp_price').val();

      $.ajax({
        url: '/api/editTournament',
        data: {id: inp_id, title: inp_title, places: inp_places, free_places: inp_free_places, datetime: inp_datetime, game: inp_game, price: inp_price, description: inp_description},
        success: function(){
          location.reload();
        }
      });
    });

  });
</script>