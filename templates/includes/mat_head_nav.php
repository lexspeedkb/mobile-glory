<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title"><?=SITE_NAME?></span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation. We hide it in small screens. -->
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
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title"><?=SITE_NAME?></span>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="">Турниры</a>
      <!-- <a class="mdl-navigation__link" href="">Редактировать профиль</a> -->
      <!-- <a class="mdl-navigation__link" href="">Настройки</a> -->
      <a class="mdl-navigation__link" href="">О Нас</a>
      <a class="mdl-navigation__link" href="mailto:mglorytournaments@gmail.com" target="__blank">Сотрудничество</a>
      <a class="mdl-navigation__link" href="/exit" target="__blank">Выход</a>
    </nav>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content">