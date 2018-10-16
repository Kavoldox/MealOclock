<?php

namespace MealOclock\Models;

class EventModel extends CoreModel {

    protected static $tableName = 'events';

    protected $id;
    protected $name;
    protected $event_date;
    protected $address;
    protected $event_limit;
    protected $creator_id;
    protected $community_id;

    // Retrouve les évènements comportant la
    // recherche dans leur nom
    public static function findByName( $search, $className=self::class ) {

        // On crée la requête SQL
        $sql = 'SELECT * FROM events WHERE name LIKE :search';

        // On récupère la connexion à la BDD
        $conn = \MealOclock\Database::getDb();

        // On exécute la requête
        $stmt = $conn->prepare( $sql );
        $stmt->bindValue(':search', '%'.$search.'%', \PDO::PARAM_STR);
        $stmt->execute();

        // On récupère les résultats
        return $stmt->fetchAll( \PDO::FETCH_CLASS, $className );
    }

    // Crée un nouvel évènement ou le met
    // à jour si il existe déjà
    public function save() {

        // On crée la requête SQL
        $sql = "
            REPLACE INTO events (
                id,
                name,
                event_date,
                address,
                event_limit,
                creator_id,
                community_id
            )
            VALUES (
                :id,
                :name,
                :event_date,
                :address,
                :event_limit,
                :creator_id,
                :community_id
            )";

        // On récupère la connexion à la BDD
        $conn = \MealOclock\Database::getDb();

        // On exécute la requête
        $stmt = $conn->prepare( $sql );
        $stmt->bindValue( ':name', $this->name );
        $stmt->bindValue( ':event_date', $this->event_date );
        $stmt->bindValue( ':address', $this->address );
        $stmt->bindValue( ':event_limit', $this->event_limit );
        $stmt->bindValue( ':creator_id', $this->creator_id );
        $stmt->bindValue( ':community_id', $this->community_id );
        $stmt->bindValue( ':id', $this->id );
        $stmt->execute();

        // On récupère l'ID qui vient d'être généré par MySQL
        $this->id = $conn->lastInsertId();
    }

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of Name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Name
     *
     * @param mixed name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of Event Date
     *
     * @return mixed
     */
    public function getEventDate()
    {
        return $this->event_date;
    }

    /**
     * Set the value of Event Date
     *
     * @param mixed event_date
     *
     * @return self
     */
    public function setEventDate($event_date)
    {
        $this->event_date = $event_date;

        return $this;
    }

    /**
     * Get the value of Address
     *
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of Address
     *
     * @param mixed address
     *
     * @return self
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of Event Limit
     *
     * @return mixed
     */
    public function getEventLimit()
    {
        return $this->event_limit;
    }

    /**
     * Set the value of Event Limit
     *
     * @param mixed event_limit
     *
     * @return self
     */
    public function setEventLimit($event_limit)
    {
        $this->event_limit = $event_limit;

        return $this;
    }

    /**
     * Get the value of Creator Id
     *
     * @return mixed
     */
    public function getCreatorId()
    {
        return $this->creator_id;
    }

    /**
     * Set the value of Creator Id
     *
     * @param mixed creator_id
     *
     * @return self
     */
    public function setCreatorId($creator_id)
    {
        $this->creator_id = $creator_id;

        return $this;
    }

    /**
     * Get the value of Community Id
     *
     * @return mixed
     */
    public function getCommunityId()
    {
        return $this->community_id;
    }

    /**
     * Set the value of Community Id
     *
     * @param mixed community_id
     *
     * @return self
     */
    public function setCommunityId($community_id)
    {
        $this->community_id = $community_id;

        return $this;
    }

}
