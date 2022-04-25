<?php

namespace App\Repository;

use App\Database\ConnectionHandler;

class ToppingRepository extends Repository
{
    protected $tableName = 'topping';

    public function readAllByCategorie($categorie)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE categorieId=?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $categorie);

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
}