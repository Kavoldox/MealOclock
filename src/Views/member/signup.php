<?php $this->layout( 'layout' ) ?>

<div class="container">
    <div class="row mb-5">
        <div class="col-12 col-md-8 m-auto area">
            <h2 class="text-center">Inscription</h2>

            <div class="errors">
                <?php foreach($errors as $error): ?>
                    <div class="alert alert-danger"><?=$error?></div>
                <?php endforeach; ?>
            </div>

            <form id="signup" class="" action="<?=$router->generate('signup')?>" method="post">
                <div class="form-group">
                    <label>Email</label>
                    <input
                        type="text"
                        class="form-control"
                        name="email"
                        value="<?=($fields['email'] ?? '')?>"
                        placeholder="jon@snow.com"
                        >
                </div>
                <div class="form-group">
                    <label>Mot de passe</label>
                    <input
                        type="password"
                        class="form-control"
                        name="password"
                        value=""
                        placeholder="azerty"
                        >
                </div>
                <div class="form-group">
                    <label>Ressaisissez votre mot de passe</label>
                    <input
                        type="password"
                        class="form-control"
                        name="password_confirm"
                        value=""
                        placeholder="azerty"
                        >
                </div>
                <div class="form-group">
                    <label>Prénom</label>
                    <input
                        type="text"
                        class="form-control"
                        name="firstname"
                        value="<?=($fields['firstname'] ?? '')?>"
                        placeholder="Jon"
                        >
                </div>
                <div class="form-group">
                    <label>Nom</label>
                    <input
                        type="text"
                        class="form-control"
                        name="lastname"
                        value="<?=($fields['lastname'] ?? '')?>"
                        placeholder="Snow"
                        >
                </div>
                <div class="form-group">
                    <label>Adresse</label>
                    <input
                        type="text"
                        class="form-control"
                        name="address"
                        value="<?=($fields['address'] ?? '')?>"
                        placeholder="3 avenue des morts, Winterfell">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea
                        name="description"
                        class="form-control"
                        placeholder="Grand, brun, ne sait rien..."><?=($fields['description'] ?? '')?></textarea>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary">Créer le compte</button>
                </div>
            </form>
        </div>
    </div>
</div>
