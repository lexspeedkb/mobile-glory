<div class="card-container">
  <?php foreach ($data['tournaments'] as $tournament): ?>
    <?php
    $Organizers = new Organizers();

    $organizator = $Organizers->getById($tournament['organizer']);
    ?>
    <div class="card-wide mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">#<?=$tournament['id']?> <?=$tournament['title']?></h2>
      </div>
      <div class="mdl-card__supporting-text">
        <span>Игра: <?=$tournament['game']?></span>
        <br>
        <span>Организатор: <?=$organizator['login']?></span>
        <br>
        <span>Участие: <?php if($tournament['price']==0){echo "Бесплатно";}else{echo $tournament['price']." Рублей";}?></span>
        <br>
        <span>Свободно мест: <?=$tournament['places']?>/<?=$tournament['free_places']?></span>
        <br>
        <span>Дата и время: <?=$tournament['datetime']?></span>
        <br>
        <br>
        <?=$tournament['description']?>
      </div>
      <div class="mdl-card__actions mdl-card--border">
        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?=$organizator['link']?>">
          Подать заявку
        </a>
      </div>
    </div>
  <?php endforeach ?>
</div>