<nav>
    <!-- Premier menu -->
    <div class="menu">
        <div class="title">
            <a href="<?=$router->generate( 'home' )?>">
                <img src="<?=$basePath?>/public/images/title.svg" alt="Mealoclock">
            </a>
        </div>
        <!-- Je suis connecté -->
        <div class="p-3 menu-hover">
            <a href="<?=$router->generate('logout')?>">
                Déconnexion
            </a>
        </div>
    </div>
    <!-- Second menu -->
    <div class="menu">
        <div class="menu-hover">
            <a href="<?=$router->generate( 'admin' )?>">Communautés</a>
        </div>
        <div class="menu-hover">
            <a href="<?=$router->generate( 'admin_events' )?>">Evènements</a>
        </div>
        <div class="menu-hover">
            <a href="<?=$router->generate('admin_members')?>">
                Membres
            </a>
        </div>
    </div>
</nav>
