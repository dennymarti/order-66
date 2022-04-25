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
class OrderToppingRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'order_topping';

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
    public function create($orderId, $toppingId)
    {
        $query = "INSERT INTO $this->tableName (orderId, toppingId) VALUES (?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ii', $orderId, $toppingId);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        return $statement->insert_id;
    }

    public function createMany($orderId, $toppingIds) {
        foreach ($toppingIds as $toppingId) {
            $this->create($orderId, $toppingId);
        }
    }

    public function readByOrderIdResolveNames($orderId)
    {
        // Query erstellen
        $query = "SELECT t.id, t.name as topping
                              FROM {$this->tableName} ot
                              JOIN topping t ON ot.toppingId = t.id
                              WHERE ot.orderId = ?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $orderId);

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
}