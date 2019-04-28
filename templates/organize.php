<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%;">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">#</th>
      <th>Title</th>
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
        <td><?=$tournament['title']?></td>
        <td><?=$tournament['places']?>/<?=$tournament['free_places']?></td>
        <td><?=$tournament['datetime']?></td>
        <td><?=$tournament['game']?></td>
        <td><?=$tournament['price']?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
<br>
На телефоне прийдётся пока что перевернуть экран в горизонтальное положение, чтобы всё разглядеть) Скоро исправлю
<br>
<br>
<input type="text"   id="inp_title" placeholder="Название турнира"><br>
<textarea id="inp_description" cols="30" rows="10" placeholder="Описание"></textarea><br>
<input type="number" id="inp_places" placeholder="Всего мест"><br>
<input type="number" id="inp_free_places" placeholder="свободных мест"><br>
<input type="datetime-local"   id="inp_datetime" ><br>
<input type="text"   id="inp_game" placeholder="Игра"><br>
<input type="text"   id="inp_price" placeholder="Цена участия РУБ"><br>
<button id="addTournament">Создать турнир</button>

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
  });
</script>