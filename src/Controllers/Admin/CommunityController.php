<?php

namespace MealOclock\Controllers\Admin;

// Attention : le parent dont on hérite est bien
// la classe "CoreController" qui se trouve dans "Admin"
class CommunityController extends CoreController {

    public function delete( $params ) {

        // On récupère l'identifiant de la communauté
        $id = $params['id'];

        // On supprime la communauté
        $community = \MealOclock\Models\CommunityModel::find( $id );
        $community->delete();

        // On redirige l'utilisateur
        $this->redirect( 'admin' );
    }
}
