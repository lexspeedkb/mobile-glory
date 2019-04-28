<div style=" overflow-x: auto;">
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
      <?php foreach ($data['tournaments'] as $tournament): ?>
        <tr>
          <td class="mdl-data-table__cell--non-numeric"><?=$tournament['id']?></td>
          <td>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent delete" tour_id="<?=$tournament['id']?>">
              Удалить
            </button>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored edit" tour_id="<?=$tournament['id']?>" title="<?=$tournament['title']?>" places="<?=$tournament['places']?>" free_places="<?=$tournament['free_places']?>" game="<?=$tournament['game']?>" description="<?=$tournament['description']?>" datetime="<?=$tournament['datetime']?>" price="<?=$tournament['price']?>">
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
</div>
<br>
<br>
<input type="hidden"   id="inp_id" placeholder="Название турнира"><br>
<input type="text"   id="inp_title" placeholder="Название турнира"><br>
<textarea id="inp_description" cols="30" rows="10" placeholder="Описание"></textarea><br>
<input type="number" id="inp_places" placeholder="Всего мест"><br>
<input type="number" id="inp_free_places" placeholder="свободных мест"><br>
<input type="datetime-local"   id="inp_datetime" ><br>
<input type="text"   id="inp_game" placeholder="Игра"><br>
<input type="number"   id="inp_price" placeholder="Цена участия РУБ"><br>
<button id="addTournament">Создать турнир</button>
<button id="editTournament" style="display: none">Редактировать турнир</button>
<br>
<br>
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