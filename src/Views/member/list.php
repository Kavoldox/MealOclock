<?php $this->layout('layout') ?>

<div class="container">
    <h2>Liste des membres</h2>

    <div class="row p-2">

        <?php foreach ($members as $member): ?>
            <div class="card m-1">
                <img class="card-img-top" src="<?=$basePath?>/public/images/<?=$member->getPhoto()?>" alt="Image de profil">
                <div class="card-body">
                    <h5 class="card-title"><?=$member->getName()?></h5>
                    <p class="card-text"><?=$member->getDescription()?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
