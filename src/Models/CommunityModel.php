<?php

namespace MealOclock\Models;

class CommunityModel extends CoreModel {

    protected static $tableName = 'communities';

    protected $id;
    protected $name;
    protected $description;
    protected $picture;
    protected $slug;
    protected $creator_id;

    public function hasMember( $memberId ) {

        $sql = 'SELECT COUNT(*) as nb FROM communities_members WHERE community_id = :communityId AND member_id = :memberId';

        $conn = \MealOclock\Database::getDb();

        $stmt = $conn->prepare( $sql );
        $stmt->bindValue(':communityId', $this->id, \PDO::PARAM_INT);
        $stmt->bindValue(':memberId', $memberId, \PDO::PARAM_INT);
        $stmt->execute();

        $count = $stmt->fetchColumn( 0 );
        return $count > 0;
    }

    // Inscrit un utilisateur dans une communauté
    public static function join( $communityId, $memberId ) {

        // On construit la requête SQL
        $sql = 'INSERT INTO communities_members VALUES (:communityId, :memberId)';

        // On récupère la connexion à la BDD
        $conn = \MealOclock\Database::getDb();

        // On exécute la requête
        $stmt = $conn->prepare( $sql );
        $stmt->bindValue(':communityId', $communityId, \PDO::PARAM_INT);
        $stmt->bindValue(':memberId', $memberId, \PDO::PARAM_INT);
        $stmt->execute();
    }

    // Inscrit un utilisateur dans une communauté
    public static function leave( $communityId, $memberId ) {

        // On construit la requête SQL
        $sql = 'DELETE FROM communities_members WHERE community_id = :communityId AND member_id = :memberId';

        // On récupère la connexion à la BDD
        $conn = \MealOclock\Database::getDb();

        // On exécute la requête
        $stmt = $conn->prepare( $sql );
        $stmt->bindValue(':communityId', $communityId, \PDO::PARAM_INT);
        $stmt->bindValue(':memberId', $memberId, \PDO::PARAM_INT);
        $stmt->execute();
    }

    // Retourne une communauté à partir de
    // son "slug"
    public static function findBySlug( $slug ) {

        // On crée la requête SQL
        $sql = 'SELECT * FROM communities WHERE slug = :slug';

        // On récupère la connexion à la BDD
        $conn = \MealOclock\Database::getDb();

        // On exécute la requête
        $stmt = $conn->prepare( $sql );
        $stmt->bindValue( ':slug', $slug, \PDO::PARAM_STR );
        // $stmt->bindValue( ':name', "trololo", \PDO::PARAM_STR );
        $stmt->execute();

        // On retourne le résultat
        return $stmt->fetchObject( self::class );
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
        // On nettoie le nom de la communauté
        $name = trim($name);
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of Description
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of Description
     *
     * @param mixed description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    private function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Picture
     *
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of Picture
     *
     * @param mixed picture
     *
     * @return self
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get the value of Slug
     *
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the value of Slug
     *
     * @param mixed slug
     *
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

}
