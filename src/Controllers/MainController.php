<?php

namespace MealOclock\Controllers;

class MainController extends CoreController {

    public function home() {

        // On récupère la liste des communautés
        $list = \MealOclock\Models\CommunityModel::findAll();

        // Render a template
        echo $this->templates->render( 'main/home', [ 'communities' => $list ] );
    }

    public function cgu() {

        // Render a template
        echo $this->templates->render( 'main/cgu', ['title' => 'CGU'] );
    }

    public function mentions() {

        echo $this->templates->render( 'main/home', [ 'title' => 'Mentions !' ] );
    }
}
