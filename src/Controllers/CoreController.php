<?php

namespace MealOclock\Controllers;

class CoreController {

    public function __construct( $router ) {

        // Test
        // $connexion = \MealOclock\Database::getDb();

        // On enregistre le routeur dans le controller
        $this->router = $router;

        // On enregistre les informations de l'utilisateur connecté
        $this->currentUser = \MealOclock\Models\MemberModel::getUser();

        // On instancie la librairie Plates pour gérer nos templates
        $this->templates = new \League\Plates\Engine( __DIR__ . '/../Views' );

        // On ajoute des données globales
        $this->templates->addData([
            'basePath' => $_SERVER['BASE_URI'] ?? '',
            'router' => $this->router,
            'user' => $this->currentUser
        ]);
    }

    // Permet de faire une redirection
    public function redirect( $routeName, $infos = [] ) {

        header('Location: ' . $this->router->generate( $routeName, $infos ));
        exit();
    }
}
