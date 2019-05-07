<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--primary pursahe show-dialog addFab">
  <i class="material-icons">add</i>
</button>

<div style=" overflow-x: auto;">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%;">
    <thead>
      <tr>
        <th class="mdl-data-table__cell--non-numeric">#</th>
        <th class="mdl-data-table__cell--non-numeric">Код</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data['promoCodesList'] as $promoCode): ?>
        <tr>
          <td class="mdl-data-table__cell--non-numeric"><?=$promoCode['id']?></td>
          <td class="mdl-data-table__cell--non-numeric"><?=$promoCode['code']?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

<dialog class="mdl-dialog add-tournament">
  <h4 class="mdl-dialog__title" id="addTournament_title">Сгенерировать промо коды</h4>
  <div class="mdl-dialog__content">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="inp_count" value="1">
      <label class="mdl-textfield__label" for="inp_count">Количество</label>
      <span class="mdl-textfield__error">Введите число!</span>
    </div>
  </div>
  <div class="mdl-dialog__actions">
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect generate">
      Сгенерировать
    </a>
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect close">
      Отмена
    </a>
  </div>
</dialog>

<script>
  $(document).ready(function() {
    $('body').on('click', '.generate', function() {
      var inp_count = $('#inp_count').val();

      $.ajax({
        url: '/admin/api/generatePromoCodes',
        data: {count: inp_count},
        success: function(){
          location.reload();
        }
      });
    });
  });
</script>