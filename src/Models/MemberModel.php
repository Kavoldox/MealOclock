<?php

namespace MealOclock\Models;

class MemberModel extends CoreModel {

    protected static $tableName = 'members';

    protected $id;
    protected $email;
    protected $password;
    protected $firstname;
    protected $lastname;
    protected $photo;
    protected $address;
    protected $description;
    protected $is_admin;

    // Vérifie les données de création de compte
    // et liste les erreurs détectées
    public static function checkData( $data ) {

        // Va contenir la liste des erreurs
        $errors = [];

        // On vérifie tous les champs obligatoires
        // Liste des champs obligatoires
        $mandatoryFields = [
            'email' => "Veuillez saisir une adresse mail",
            'password' => "Veuillez renseigner un mot de passe",
            'password_confirm' => "Vous avez oublié de confirmer le mot de passe",
            'firstname' => "Veuillez saisir un prénom",
            'lastname' => "Veuillez saisir un nom",
        ];

        foreach ($mandatoryFields as $fieldName => $msg) {

            // On vérifie tous les champs obligatoires
            if ( empty($data[ $fieldName ]) ) {

                // Erreur, le champs est vide !
                $errors[] = $msg;
            }
        }

        // On vérifie la double saisie de mot de passe
        if ($data['password'] !== $data['password_confirm']) {

            $errors[] = "Confirmation du mot de passe incorrecte";
        }

        // On vérifie le format de l'email
        if ( !filter_var($data['email'], FILTER_VALIDATE_EMAIL) ) {

            $errors[] = "Votre adresse mail n'est pas au bon format";
        }

        return $errors;
    }

    public static function signup( $data ) {

        // On crée un objet vierge
        $member = new self();

        // On renseigne les informations
        $member->setEmail( $data['email'] );
        $member->setPassword( $data['password'] );
        $member->setFirstname( $data['firstname'] );
        $member->setLastname( $data['lastname'] );
        $member->setAddress( $data['address'] );
        $member->setDescription( $data['description'] );

        // var_dump($member);die;

        // On enregistre le nouveau compte
        $member->save();

        return $member;
    }

    // Retourne l'utilisateur associé à une adresse mail
    public static function findByEmail( $email ) {
        // var_dump($email); die;

        // On construit la requête SQL
        $sql = 'SELECT * FROM members WHERE email LIKE :email';

        // On récupère la connexion à la BDD
        $conn = \MealOclock\Database::getDb();

        // On exécute la requête
        // $stmt = $conn->query( $sql );
        $stmt = $conn->prepare( $sql );
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();

        // On récupère le résultat
        return $stmt->fetchObject( self::class );
    }

    // Inscrit les informations de l'utilisateur en session
    public static function login( $member ) {

        $_SESSION['user'] = [
            'id' => $member->getId(),
            'email' => $member->getEmail(),
            'firstname' => $member->getFirstname(),
            'photo' => $member->getPhoto(),
            'is_admin' => (bool) $member->getIsAdmin(),
            'address' => $member->getAddress()
        ];
    }

    // Indique si l'utilisateur est connecté ou pas
    // public static function isConnected() {
    //
    //     // return !empty( $_SESSION['user'] );
    //     if (!empty($_SESSION['user'])) {
    //
    //         return $_SESSION['user'];
    //     }
    //
    //     return false;
    // }

    // Retourne les informations de l'utilisateur connecté
    public static function getUser() {

        if ( !empty($_SESSION['user']) ) {

            return $_SESSION['user'];
        }

        return false;
    }

    // Crée un nouveau membre ou le met
    // à jour si il existe déjà
    public function save() {

        // On crée la requête SQL
        $sql = "
            REPLACE INTO members (
                id,
                email,
                password,
                firstname,
                lastname,
                photo,
                address,
                description
            )
            VALUES (
                :id,
                :email,
                :password,
                :firstname,
                :lastname,
                :photo,
                :address,
                :description
            )";

        // On récupère la connexion à la BDD
        $conn = \MealOclock\Database::getDb();

        // On exécute la requête
        $stmt = $conn->prepare( $sql );
        $stmt->bindValue( ':id', $this->id );
        $stmt->bindValue( ':email', $this->email );
        $stmt->bindValue( ':password', $this->password );
        $stmt->bindValue( ':firstname', $this->firstname );
        $stmt->bindValue( ':lastname', $this->lastname );
        $stmt->bindValue( ':photo', $this->photo );
        $stmt->bindValue( ':address', $this->address );
        $stmt->bindValue( ':description', $this->description );
        $stmt->execute();

        // echo 'success';die;

        // On affiche les erreurs pour debug
        // var_dump($this);
        // var_dump( $conn->errorInfo() );exit();

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
     * Get the value of Email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of Email
     *
     * @param mixed email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of Password
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of Password
     *
     * @param mixed password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    /**
     * Get the value of Firstname
     *
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of Firstname
     *
     * @param mixed firstname
     *
     * @return self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of Lastname
     *
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of Lastname
     *
     * @param mixed lastname
     *
     * @return self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    // Retourne le prénom et le nom formattés
    public function getName() {

        return ucfirst($this->firstname) . ' ' . strtoupper($this->lastname);
    }

    /**
     * Get the value of Photo
     *
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of Photo
     *
     * @param mixed photo
     *
     * @return self
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

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
     * Get the value of Is Admin
     *
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->is_admin;
    }

    /**
     * Set the value of Is Admin
     *
     * @param mixed is_admin
     *
     * @return self
     */
    public function setIsAdmin($is_admin)
    {
        $this->is_admin = $is_admin;

        return $this;
    }

}
