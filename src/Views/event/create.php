<?php $this->layout( 'layout' ) ?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 m-auto">
            <h2>Créer un évènement</h2>

            <form class="mb-5" action="" method="post">

                <div class="form-group">
                    <label>Le nom de l'évènement</label>
                    <input type="text" class="form-control" name="name" value="" placeholder="Repas Vegan pour 4">
                </div>

                <div class="form-group">
                    <label>Date de l'évènement</label>
                    <input type="datetime-local" class="form-control" name="event_date" value="">
                </div>

                <div class="form-group">
                    <label>Adresse de l'évènement</label>
                    <input type="text" class="form-control" name="address" value="" placeholder="5 rue Stark, 75001 Winterfell">
                </div>

                <div class="form-group">
                    <label>Nombre d'invités maximum</label>
                    <input type="text" class="form-control" name="event_limit" value="" placeholder="6">
                </div>

                <button>Créer</button>
            </form>
        </div>
    </div>
</div>
