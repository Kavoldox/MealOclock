<?php $this->layout( 'layout' ) ?>


<!-- Partie intermédiaire -->
<div class="container">
    <?php if ( $user ): ?>
        <h1>Bienvenue <?=$user['firstname']?></h1>
    <?php else:?>
        <h1>A table</h1>
    <?php endif; ?>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</div>

<!-- Liste des communautés -->
<div class="container-fluid">

    <?php foreach ($communities as $community): ?>
        <?php $this->insert( 'partials/community', [ 'community' => $community ]) ?>
    <?php endforeach; ?>

</div>
