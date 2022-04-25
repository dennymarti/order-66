<?php

namespace App\Repository;

use App\Controller\AuthController;
use App\Controller\OrderController;
use App\Database\ConnectionHandler;
use App\Service\AuthenticationService;
use Exception;

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class OrderRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = '`order`';

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
    public function create($userId, $breadId, $lengthId)
    {

        $query = "INSERT INTO $this->tableName(`userId`, `breadId`, `lengthId`) VALUES (?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);

        $statement->bind_param('iii', $userId, $breadId, $lengthId);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        return $statement->insert_id;
    }

    public function readByUserId($id)
    {
        // Query erstellen
        $query = "SELECT * FROM {$this->tableName} WHERE userId=?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $id);

        // Das Statement absetzen
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function readByUserIdResolveFKs($userId)
    {
        // Query erstellen
        $query = "SELECT o.id as id, b.name as bread, l.cm as length
                              FROM {$this->tableName} o
                              JOIN bread b ON o.breadId = b.id
                              JOIN length l ON o.lengthId = l.id
                              WHERE o.userId = ?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $userId);

        // Das Statement absetzen
        $statement->execute();

        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function deleteByUserId($id)
    {
        $query = "DELETE FROM {$this->tableName} WHERE userId=?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function update($id, $breadId, $lengthId) {
        $query = "UPDATE $this->tableName SET `breadId` = $breadId, `lengthId` = $lengthId WHERE id=?";

        $statement = ConnectionHandler::getConnection()->prepare($query);

        $statement->bind_param('i', $id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }
}