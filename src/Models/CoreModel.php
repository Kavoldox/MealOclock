<?php

namespace MealOclock\Models;

class CoreModel {

    protected static $tableName;

    public function delete() {

        // On construit la requête SQL
        $sql = 'DELETE FROM ' . static::$tableName . ' WHERE id = :id';

        // On récupère la connexion à la BDD
        $conn = \MealOclock\Database::getDb();

        // On exécute la requête
        $stmt = $conn->prepare( $sql );
        $stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Retourne un seul enregistrement à partir de son ID
    public static function find( $id ) {

        // On construit la requête SQL
        $sql = 'SELECT * FROM '.static::$tableName.' WHERE id = :id';

        // On récupère la connexion à la BDD
        $conn = \MealOclock\Database::getDb();

        // On exécute la requête
        $stmt = $conn->prepare( $sql );
        $stmt->bindValue( ':id', $id, \PDO::PARAM_INT );
        $stmt->execute();

        // On récupère les résultats
        return $stmt->fetchObject( static::class );
    }

    // Retourne la liste de tous les enregistrements
    public static function findAll() {

        // On construit la requête SQL
        $sql = 'SELECT * FROM '.static::$tableName;

        // On récupère la connexion à la BDD
        $conn = \MealOclock\Database::getDb();

        // On exécute la requête SQL
        $stmt = $conn->query( $sql );

        // On retourne les résultats
        return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }
}
