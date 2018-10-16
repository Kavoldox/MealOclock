<?php

namespace MealOclock;

class Application {

    public function __construct() {

        $this->router = new \AltoRouter();
        $this->router->setBasePath( $_SERVER['BASE_URI'] );
    }

    // Fait un dump des données passées en paramètres
    // mais de façon plutôt cool
    public function dump( $data ) {

        dump($data);
    }

    // Indique les différentes URL de l'application
    // dans l'objet Altorouter
    public function initRoutes() {

        // MainController
        $this->router->map('GET', '/', ['MainController', 'home'], 'home');
        $this->router->map('GET', '/cgu', ['MainController', 'cgu'], 'cgu');
        $this->router->map('GET', '/pages/mentions', ['MainController', 'mentions'], 'mentions');

        // Communautés
        $this->router->map('GET', '/communities/[:slug]', ['CommunityController', 'read'], 'community_read');
        // Rejoindre une communauté
        $this->router->map('GET', '/communities/[i:id]/join', ['CommunityController', 'join'], 'community_join');
        // Quitter une communauté
        $this->router->map('GET', '/communities/[i:id]/leave', ['CommunityController', 'leave'], 'community_leave');

        // Evènements
        $this->router->map('GET', '/events', ['EventController', 'list'], 'event_list');
        $this->router->map('GET', '/events/[i:id]', ['EventController', 'read'], 'event_read');
        $this->router->map('GET|POST', '/events/create', ['EventController', 'create'], 'event_create');
        $this->router->map('GET', '/[admin|profile:domain]/event/[i:id]/update', ['EventController', 'update'], 'event_update');
        $this->router->map('POST', '/events/search', ['EventController', 'search'], 'event_search');

        // Membres
        $this->router->map('GET', '/members', ['MemberController', 'list'], 'member_list');

        // Administration
        $this->router->map('GET', '/admin', ['AdminController', 'home'], 'admin');
        // Route pour supprimer une communauté
        $this->router->map('GET', '/admin/communities/[i:id]/delete', ['Admin\CommunityController', 'delete'], 'admin_community_delete');
        // $this->router->map('GET', '/admin/communities/create', ['AdminController', ''], '');
        // $this->router->map('GET', '/admin/communities/[i:id]/update', ['AdminController', ''], '');
        $this->router->map('GET', '/admin/events', ['Admin\EventController', 'list'], 'admin_events');

        $this->router->map('GET', '/admin/events/[i:id]/delete', ['Admin\EventController', 'delete'], 'admin_event_delete');
        $this->router->map('GET', '/admin/members', ['Admin\MemberController', 'list'], 'admin_members');
        // $this->router->map('GET', '/admin/members/update/status', ['AdminController', ''], '');
        $this->router->map('GET', '/admin/members/[i:id]/delete', ['Admin\MemberController', 'delete'], 'admin_member_delete');
        // $this->router->map('GET', '/admin/members/update/role', ['AdminController', ''], '');

        // Connexion / inscription
        $this->router->map('GET|POST', '/signup', ['MemberController', 'signup'], 'signup');
        $this->router->map('GET|POST', '/login', ['MemberController', 'login'], 'login');
        $this->router->map('GET', '/logout', ['MemberController', 'logout'], 'logout');
        // $this->router->map('GET', '/forgot_password', ['MemberController', ''], '');
        // $this->router->map('GET', '/update_password', ['MemberController', ''], '');

        // Compte utilisateur
        $this->router->map('GET|POST', '/profile', ['MemberController', 'me'], 'profile');
        // $this->router->map('GET', '/profile/update', ['Controller', ''], '');
    }

    // Exécute le controller et la méthode
    // correspondants à l'URL demandée
    public function matching() {

        // On demande à Altorouter si il connait l'URL
        // qui est demandée par le navigateur
        $match = $this->router->match();

        if (!$match) {

            // Altorouter n'a pas trouvé la route,
            // on doit afficher une erreur
            die('Route inconnue');
        }
        else {

            // Altorouter a bien trouvé la route
            // correspondante, on récupère infos
            $data = $match['target'];
            $controllerName = '\MealOclock\Controllers\\' . $data[0];
            $methodName = $data[1];

            // On instancie le controller
            $controller = new $controllerName( $this->router );
            // On exécute la méthode
            $controller->$methodName( $match['params'] );
        }
    }
}
