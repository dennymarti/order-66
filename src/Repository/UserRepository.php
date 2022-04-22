<?php

namespace App\Repository;

use App\Controller\AuthController;
use App\Controller\UserController;
use App\Database\ConnectionHandler;
use App\Service\AuthenticationService;
use Exception;

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class UserRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'user';

    /**
     * Erstellt einen neuen benutzer mit den gegebenen Werten.
     *
     * Das Passwort wird vor dem ausführen des Queries noch mit dem SHA1
     *  Algorythmus gehashed.
     *
     * @param $firstName Wert für die Spalte firstName
     * @param $lastName Wert für die Spalte lastName
     * @param $email Wert für die Spalte email
     * @param $password Wert für die Spalte password
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function create($firstname, $name, $username, $password)
    {
        $password_hash = hash('sha256', $password);

        $query = "INSERT INTO $this->tableName (firstname, name, username, password) VALUES (?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ssss', $firstname, $name, $username, $password_hash);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    /**
     * Diese Funktion gibt den Datensatz mit der gegebenen USERNAME zurück.
     *
     * @param $username USERNAME des gesuchten Datensatzes
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     *
     * @return Der gesuchte Datensatz oder null, sollte dieser nicht existieren
     */
    public function readByUsername($username)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE username=?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $username);

        $statement->execute();

        $result = $statement->get_result();

        if (!$result) {
            throw new Exception($statement->error);
        }

        $row = $result->fetch_object();

        $result->close();

        return $row;
    }
}
