<?php

namespace MealOclock\Controllers\Admin;

class EventController extends CoreController {

    // Affiche la liste des évènements
    public function list() {

        // On récupère la liste des évènements
        $list = \MealOclock\Models\EventModel::findAll();

        echo $this->templates->render( 'admin/event/list', ['events' => $list] );
    }

    public function delete( $params ) {

        $id = $params['id'];

        // on supprime l'évènement
        $event = \MealOclock\Models\EventModel::find( $id );
        $event->delete();

        // On redirige l'utilisateur
        $this->redirect( 'admin_events' );
    }
}
