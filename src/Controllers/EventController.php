<?php

namespace MealOclock\Controllers;

class EventController extends CoreController {

    // Permet de rechercher des évènements
    // par leur nom
    public function search() {

        // On récupère la recherche
        $search = $_POST['search'];

        // On récupère les résultats de la recherche
        $list = \MealOclock\Models\EventModel::findByName( $search, '\stdClass' );

        // On répond à la requête AJAX
        echo json_encode( $list );
    }

    public function list() {

        // On récupère la liste des évènements
        // à partir de la BDD
        $list = \MealOclock\Models\EventModel::findAll();

        // On affiche le template
        echo $this->templates->render( 'event/list', ['events' => $list] );
    }

    // Route de création d'un évènement
    // 2 méthodes utilisée dans cette route : GET et POST
    // GET : On demande l'affichage du
    // formulaire de création d'évènement
    // POST : On reçoit les informations de
    // création d'un évènement
    public function create() {

        if (!empty( $_POST )) {

            // On a reçu les informations de création
            // d'un évènement, on crée l'évènement
            // $event = \MealOclock\Models\EventModel::create( $_POST );
            $event = new \MealOclock\Models\EventModel();
            $event->setName( $_POST['name'] );
            $event->setEventDate( $_POST['event_date'] );
            $event->setAddress( $_POST['address'] );
            $event->setEventLimit( $_POST['event_limit'] );
            $event->setCreatorId( 1 );
            $event->setCommunityId( 1 );
            $event->save();

            // L'évènement est correctement créé
            // On redirige l'utilisateur sur la page de l'évènement
            // header('Location: ' . $this->router->generate( 'event_read', ['id' => $event->getId() ] ));
            $this->redirect( 'event_read', ['id' => $event->getId()] );
        }
        else {

            // Aucune information dans "$_POST",
            // du coup, on affiche le template
            echo $this->templates->render( 'event/create' );
        }
    }

    public function read( $params ) {

        // On récupère l'identifiant de
        // l'évènement à afficher
        $eventId = $params['id'];

        // On récupère les données de l'évènement
        // à partir de la BDD
        $event = \MealOclock\Models\EventModel::find( $eventId );

        // On affiche le template
        echo $this->templates->render( 'event/read', [ 'event' => $event ] );
    }
}
