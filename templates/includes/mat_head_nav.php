<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title"><?=$template['head']['META']['page_name']?></span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation. We hide it in small screens. -->
      <?php if ($data['pieces']['1']=='myWallet'): ?>
        <i class="material-icons">account_balance_wallet</i> <?=$data['MyAccount']['balance']?> UAH
      <?php elseif($data['pieces']['1']=='list'): ?>
   <!-- <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                  mdl-textfield--floating-label mdl-textfield--align-right">
            <label class="mdl-button mdl-js-button mdl-button--icon"
                   for="fixed-header-drawer-exp">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" name="sample"
                     id="fixed-header-drawer-exp">
            </div>
        </div> -->
      <?php endif ?>

    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title"><?=SITE_NAME?></span>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="/list">Турниры</a>
      <a class="mdl-navigation__link" href="/aboutUs">О нас</a>
        <a class="mdl-navigation__link" href="/myWallet">Кошелёк</a>
      <?php if ($data['MyAccount']['organizer']==1): ?>
        <a class="mdl-navigation__link" href="/organize">Организация</a>
      <?php endif ?>
      <?php if ($data['MyAccount']['admin']==1): ?>
        <a class="mdl-navigation__link" href="/admin/promoCodes">/Промо коды</a>
        <a class="mdl-navigation__link" href="/admin/users">/Пользователи</a>
        <a class="mdl-navigation__link" href="/admin/organizers">/Организаторы</a>
      <?php endif ?>
      <a class="mdl-navigation__link" href="mailto:mglorytournaments@gmail.com" target="__blank">Сотрудничество</a>
      <a class="mdl-navigation__link" href="/exit" target="__blank">Выход</a>
    </nav>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content">