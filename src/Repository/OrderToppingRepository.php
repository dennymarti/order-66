<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "order_topping".
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

    public function createMany($orderId, $toppingIds)
    {
        foreach ($toppingIds as $toppingId) {
            $this->create($orderId, $toppingId);
        }
    }

    /**
     * Erstellt einen neuen benutzer mit den gegebenen Werten.
     *
     *
     * @param $orderId Wert für die Spalte orderId
     * @param $toppingId Wert für die Spalte toppingId
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

    public function deleteByOrderId($id)
    {
        $query = "DELETE FROM {$this->tableName} WHERE orderId=?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }
}