<nav>
    <!-- Premier menu -->
    <div class="menu">
        <div class="burger p-3 menu-hover">
            <i class="fas fa-bars"></i>
        </div>
        <div class="search">
            <i class="fas fa-search"></i>
            <input type="text" id="search">
            <!-- Liste de résultats -->
            <div class="search-results">
                <ul class="list-group">
                    <!-- <li class="list-group-item">Event 1</li>
                    <li class="list-group-item">Event 2</li>
                    <li class="list-group-item">Event 3</li> -->
                </ul>
            </div>
        </div>
        <div class="title">
            <a href="<?=$router->generate( 'home' )?>">
                <img src="<?=$basePath?>/public/images/title.svg" alt="Mealoclock">
            </a>
        </div>
        <?php if ( $user ): ?>
            <!-- Je suis connecté -->
            <div class="p-3 menu-hover">
                <a href="<?=$router->generate('profile')?>">
                    Mon profil
                </a>
            </div>
            <div class="p-3 menu-hover">
                <a href="<?=$router->generate('logout')?>">
                    Déconnexion
                </a>
            </div>
        <?php else: ?>
            <!-- Je suis déconnecté -->
            <div class="login p-3 menu-hover">
                <a href="<?=$router->generate('login')?>">
                    <i class="fas fa-sign-in-alt"></i>
                    Connexion
                </a>
            </div>
            <div class="inscription p-3 menu-hover">
                <a href="<?=$router->generate('signup')?>">
                    <i class="fas fa-edit"></i>
                    Inscription
                </a>
            </div>
        <?php endif;?>
    </div>
    <!-- Second menu -->
    <div class="menu">
        <div class="menu-hover">
            <a href="<?=$router->generate( 'home' )?>">Communautés</a>
        </div>
        <div class="menu-hover">
            <a href="<?=$router->generate( 'event_list' )?>">Evènements</a>
        </div>
        <div class="menu-hover">
            <a href="<?=$router->generate('member_list')?>">
                Membres
            </a>
        </div>
        <?php if ( $user && $user['is_admin'] ): ?>
            <div class="menu-hover">
                <a href="<?=$router->generate('admin')?>">
                    Admin
                </a>
            </div>
        <?php endif; ?>
        <div class="menu-hover"><i class="fab fa-twitter"></i></div>
        <div class="menu-hover"><i class="fab fa-facebook-f"></i></div>
    </div>
</nav>
