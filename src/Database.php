<?php

namespace MealOclock;

class Database {

    public static $pdo;

    // Retourne les informations de connexion
    public static function getConfig() {

        // On lit le fichier de configuration
        // qui est au format INI
        return parse_ini_file(__DIR__ . '/config.ini');
    }

    // Permet de récupérer la connexion à la BDD
    public static function getDb() {

        // On regarde si on a déjà créé une connexion
        if ( empty(self::$pdo) ) {

            try {

                // On récupère les informations de connexion
                $config = self::getConfig();

                // On n'a pas créé de connexion
                // On crée la connexion à la BDD
                self::$pdo = new \PDO(
                    'mysql:host='.$config['DBHOST'].';dbname='.$config['DBNAME'].';charset=utf8', // Chaine de connexion
                    $config['DBUSER'], // Nom de l'utilisateur
                    $config['DBPASSWORD'] // Mot de passe de l'utilisateur
                );
            }
            catch(\Exception $error) {

                // Il y a une erreur de connexion,
                // on affiche un message d'erreur
                echo "Erreur de connexion à la BDD";
                // var_dump($error);
                exit();
            }
        }

        // On retourne la connexion
        return self::$pdo;
    }
}
