<?php

namespace MealOclock\Controllers;

class MemberController extends CoreController {

    // Affiche la liste des membres
    public function list() {

        // On récupère la liste des membres
        $list = \MealOclock\Models\MemberModel::findAll();

        // On affiche le template
        echo $this->templates->render( 'member/list', ['members' => $list] );
    }

    // Affiche ma page de profil
    public function me() {

        // On vérifie qu'on est bien connecté
        $user = \MealOclock\Models\MemberModel::getUser();

        if ( !$user ) {

            // On est pas connecté, on redirige
            $this->redirect( 'home' );
        }

        // On récupère toutes les informations de la BDD
        // pour cet utilisateur
        $member = \MealOclock\Models\MemberModel::find( $user['id'] );

        if ( !empty($_FILES) ) {

            // On a bien un upload de fichier en cours
            $storage = new \Upload\Storage\FileSystem(__DIR__ . '/../../public/images/custom/');
            $file = new \Upload\File('photo', $storage);

            // Optionally you can rename the file on upload
            $new_filename = uniqid();
            $file->setName($new_filename);

            // Validate file upload
            // MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
            $file->addValidations(array(
                new \Upload\Validation\Size('5M')
            ));

            $file->upload();

            // On change l'avatar de l'utilisateur
            $member->setPhoto( 'custom/' . $new_filename . '.png' );
            $member->save();
        }

        // On affiche le template de la page
        echo $this->templates->render( 'member/me', [ 'member' => $member ] );
    }

    // Indique si la requête a été faite en AJAX ou pas
    private function isAjax() {

      return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    // Connexion
    public function login() {

        $errors = [];

        // On regarde si on a validé le formulaire
        if ( !empty($_POST) ) {

            // On a bien des données, on essaie
            // d'identifier l'utilisateur
            // On récupère l'utilisateur qui possède
            // l'adresse mail envoyée dans le formulaire
            $email = $_POST['email'];
            $member = \MealOclock\Models\MemberModel::findByEmail( $email );

            if ( $member === false ) {

                // Aucun membre ne possède cette adresse mail
                $errors[] = "Utilisateur inconnu";
            }
            else {

                // L'adresse mail existe bien, on doit
                // dorénavant tester le mot de passe
                $hash = $member->getPassword();
                // $hash = password_hash($hasher, PASSWORD_DEFAULT);
                // var_dump($hash, $_POST['password']);
                $isValid = password_verify( $_POST['password'], $hash );

                if ( $isValid === false ) {

                    // Ce n'est pas le bon mot de passe
                    $errors[] = "mot de passe inconnu";
                }
                else {

                    // C'est le bon mot de passe
                    // On identifie la personne
                    \MealOclock\Models\MemberModel::login( $member );

                    // On redirige l'utilisateur
                    // $this->redirect( 'home' );
                }
            }

            if ( $this->isAjax() ) {

                // C'est bien de l'AJAX
                // On retourne les erreurs éventuelles
                // $errors = [ "blabla", "blabla2", ... ]
                echo json_encode( $errors );
                // => '["Utilisateur ou mot de passe inconnu"]'
                exit();
            }
            else {

                // C'est une requête normale
                // Si tout c'est bien passé
                if (count($errors) === 0) $this->redirect('home');
            }
        }

        echo $this->templates->render( 'member/login', [
            'errors' => $errors,
            'fields' => $_POST
        ]);
    }

    // Détruit la session et déconnecte l'utilisateur
    public function logout() {

        // On vide la session
        unset( $_SESSION['user'] );
        $_SESSION = [];

        // On détruit la session !
        session_destroy();

        // On redirige l'utilisateur
        $this->redirect( 'home' );
    }

    // Création de compte
    public function signup() {

        $errors = [];

        // On regarde si on reçoit des informations
        if (!empty($_POST)) {

            // On a validé le formulaire, le visiteur
            // souhaite créer un compte

            // On vérifie les données du formulaire
            $errors = \MealOclock\Models\MemberModel::checkData( $_POST );
            // var_dump($_POST); die;

            // On regarde si il y a des erreurs
            if ( empty($errors) ) {

                // Pas d'erreur, on peut continuer
                // la création de compte
                $member = \MealOclock\Models\MemberModel::signup( $_POST );

                // On redirige l'utilisateur sur
                // le formulaire de connexion
                header('Location: ' . $this->router->generate( 'login' ));
                exit();
                $this->redirect( 'login' );
            }

            echo json_encode( $errors );
            return;
        }

        // On affiche le formulaire
        echo $this->templates->render( 'member/signup', [
            'errors' => $errors,
            'fields' => $_POST
        ]);
    }
}
