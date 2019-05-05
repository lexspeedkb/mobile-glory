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
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="set_organize" user_id="<?=$user['id']?>" title="<?=$tournament['title']?>" places="<?=$tournament['places']?>" free_places="<?=$tournament['free_places']?>" game="<?=$tournament['game']?>" description="<?=$tournament['description']?>" datetime="<?=$tournament['datetime_local']?>" price="<?=$tournament['price']?>">
              Организатор
            </button>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" id="de_ban" user_id="<?=$user['id']?>">
              Разбан
            </button>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="de_set_organize" user_id="<?=$user['id']?>" title="<?=$tournament['title']?>" places="<?=$tournament['places']?>" free_places="<?=$tournament['free_places']?>" game="<?=$tournament['game']?>" description="<?=$tournament['description']?>" datetime="<?=$tournament['datetime_local']?>" price="<?=$tournament['price']?>">
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
      var tour_id = $(this).attr("user_id");

      $.ajax({
        url: '/admin/api/banUser',
        data: {id: inp_id, title: inp_title, places: inp_places, free_places: inp_free_places, datetime: inp_datetime, game: inp_game, price: inp_price, description: inp_description},
        success: function(){
          location.reload();
        }
      });
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