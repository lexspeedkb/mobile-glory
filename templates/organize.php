<div style=" overflow-x: auto;">
  <?php if (!empty($data['tournamentsList'])): ?>
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%;">
      <thead>
        <tr>
          <th class="mdl-data-table__cell--non-numeric">#</th>
          <th>Действие</th>
          <th>Заголовок</th>
          <th>Мест всего/свободных</th>
          <th>Дата</th>
          <th>Игра</th>
          <th>Цена</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['tournamentsList'] as $tournament): ?>
          <?php
          $tournament['datetime_local'] = datetime_local($tournament['datetime']);
          ?>
          <tr>
            <td class="mdl-data-table__cell--non-numeric"><?=$tournament['id']?></td>
            <td>
              <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent delete" tour_id="<?=$tournament['id']?>">
                Удалить
              </button>
              <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored edit" tour_id="<?=$tournament['id']?>" title="<?=$tournament['title']?>" places="<?=$tournament['places']?>" free_places="<?=$tournament['free_places']?>" game="<?=$tournament['game']?>" description="<?=$tournament['description']?>" datetime="<?=$tournament['datetime_local']?>" price="<?=$tournament['price']?>">
                Редактировать
              </button>
            </td>
            <td><?=$tournament['title']?></td>
            <td><?=$tournament['places']?>/<?=$tournament['free_places']?></td>
            <td><?=$tournament['datetime']?></td>
            <td><?=$tournament['game']?></td>
            <td><?=$tournament['price']?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php else: ?>
    <h3 align="center">Тут пока ничего нет) Создайте свой первый турнир!</h3>
  <?php endif ?>
</div>

<div class="card-container">
<div class="card-wide mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Создать турнир</h2>
      </div>
      <div class="mdl-card__supporting-text">
        <input type="hidden" id="inp_id"><br>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input class="mdl-textfield__input" type="text" id="inp_title">
          <label class="mdl-textfield__label" for="inp_title">Название турнира</label>
        </div>
        <br>
        <div class="mdl-textfield mdl-js-textfield">
          <textarea class="mdl-textfield__input" type="text" cols="30" rows="10" rows= "3" id="inp_description"></textarea>
          <label class="mdl-textfield__label" for="inp_description">Описание</label>
        </div>
        <br>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="inp_places">
          <label class="mdl-textfield__label" for="inp_places">Всего мест</label>
          <span class="mdl-textfield__error">Input is not a number!</span>
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="inp_free_places">
          <label class="mdl-textfield__label" for="inp_free_places">Свободных мест</label>
          <span class="mdl-textfield__error">Input is not a number!</span>
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

        <!-- <input type="text"   id="inp_title" placeholder="Название турнира"><br> -->
        <!-- <textarea id="inp_description" cols="30" rows="10" placeholder="Описание"></textarea><br> -->
        <!-- <input type="number" id="inp_places" placeholder="Всего мест"><br> -->
        <!-- <input type="number" id="inp_free_places" placeholder="свободных мест"><br> -->
        <!-- <input type="datetime-local"   id="inp_datetime" ><br> -->
        <!-- <input type="text"   id="inp_game" placeholder="Игра"><br> -->
        <!-- <input type="number"   id="inp_price" placeholder="Цена участия РУБ"><br> -->
      </div>
      <div class="mdl-card__actions mdl-card--border">
        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?=$organizator['link']?>" id="addTournament">
          Создать турнир
        </a>
        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?=$organizator['link']?>" id="editTournament" style="display: none">
          Редактировать турнир
        </a>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
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

      $('#addTournament').css('display', 'none');
      $('#editTournament').css('display', 'block');

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