<?php

namespace MealOclock\Controllers;

class CommunityController extends CoreController {

    public function read( $params ) {

        // On récupère l'information qui nous
        // permet de savoir quelle est la communauté
        // à afficher
        // var_dump($params);
        $slug = $params['slug'];

        // On fait une requête pour récupérer les
        // informations de la communauté
        $community = \MealOclock\Models\CommunityModel::findBySlug( $slug );
        // $community = \MealOclock\Models\CommunityModel::find( 1 );

        // On vérifie si l'utilisateur est connecté
        $isMember = false;
        if ($this->currentUser) {

            // Il est connecté, on regarde si il fait parti
            // de la communauté
            $isMember = $community->hasMember( $this->currentUser['id'] );
        }

        // On affiche le template d'une communauté
        echo $this->templates->render( 'community/read', [
            'community' => $community,
            'isMember' => $isMember
        ]);
    }

    public function leave( $params ) {

        // On vérifie que l'utilisateur est bien connecté
        if (!$this->currentUser) {

            // On redirige l'utilisateur
            $this->redirect( 'home' );
        }

        // On récupère l'identifiant de la communauté
        $communityId = $params['id'];

        // On récupère la communauté
        $community = \MealOclock\Models\CommunityModel::find( $communityId );

        // On récupère l'ID du membre connecté
        $memberId = $this->currentUser['id'];

        // On supprime le lien entre l'utilisateur à la communauté
        \MealOclock\Models\CommunityModel::leave($communityId, $memberId);

        // On redirige l'utilisateur
        $this->redirect('community_read', ['slug' => $community->getSlug()]);
    }

    // Permet de rejoindre une communauté
    public function join( $params ) {

        // On vérifie que l'utilisateur est bien connecté
        if (!$this->currentUser) {

            // On redirige l'utilisateur
            $this->redirect( 'home' );
        }

        // On récupère l'identifiant de la communauté
        $communityId = $params['id'];

        // On récupère la communauté
        $community = \MealOclock\Models\CommunityModel::find( $communityId );

        // On récupère l'ID du membre connecté
        $memberId = $this->currentUser['id'];

        // On associe l'utilisateur à la communauté
        \MealOclock\Models\CommunityModel::join($communityId, $memberId);

        // On redirige l'utilisateur
        $this->redirect('community_read', ['slug' => $community->getSlug()]);
    }
}
