<?php

namespace MealOclock\Controllers\Admin;

class CoreController extends \MealOclock\Controllers\CoreController {

    public function __construct( $router ) {

        // On exécute le constructeur du parent
        parent::__construct( $router );

        // $vrai = true;
        // $vrai = !$vrai;

        // On vérifie si l'utilisateur est
        // correctement connecté et si c'est un admin
        if ( !$this->currentUser
            || !$this->currentUser['is_admin'] ) {

            // L'utilisateur n'est pas connecté
            // OU n'est pas administrateur, on le redirige
            $this->redirect( 'home' );
        }
    }
}
