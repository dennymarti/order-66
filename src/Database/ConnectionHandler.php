<?php

namespace App\Database;

use App\Exception\DatabaseConnectionException;
use MySQLi;
use RuntimeException;

/**
 * Der ConnectionHandler ist dafür zuständig, allen Repositories ein und die
 * selbe Verbindung auf die Datenbank zur Verfügung zu stellen.
 *
 * Bevor die Verbindung verwendet werden kann, muss die Datei config.php
 * entsprechend der Beschrebing in der Datei config.php erstellt werden.
 * Danach kann die Verbindung in den repositories folgendermassen aufgerufen
 * werden.
 *
 *   require_once 'ConnectionHandler.php';
 *   // ...
 *   $connection = ConnectionHandler::getConnection();
 */
class ConnectionHandler
{
    /**
     * Beim ersten Aufruf der getConnection Methode wird hier die Verbindung für
     * die weiteren Aufrufe dieser Methode zwischengespeichert. Dadurch muss
     * nicht für jedes Query eine neue Verbindung geöffnet werden.
     */
    private static $connection = null;

    /**
     * Der ConnectionHandler implementiert das sogenannte Singleton
     * Entwurfsmuster. Dieses hat zum Ziel, dass von einer Klasse immer nur eine
     * Instanz existiert. Dies wird erreicht, indem der Konstruktor private ist
     * und die Methode getInstance die Instanzierung verwaltet.
     */
    private function __construct()
    {
        // Privater Konstruktor um die Verwendung von getInstance zu erzwingen.
    }

    /**
     * Prüft ob bereits eine Verbindung auf die Datenbank existiert,
     * initialisiert diese ansonsten und gibt sie dann zurück.
     *
     * @return Die mySQLi Verbindung, welche für den Zugriff aud die Datenbank
     *             verwendet werden kann
     * @throws Exception wenn der Verbindungsaufbau schiefgegeangen ist
     */
    public static function getConnection()
    {
        // Prüfen ob bereits eine Verbindung existiert
        if (null === self::$connection) {
            $configFile = '../config.php';

            if (!file_exists($configFile)) {
                throw new RuntimeException('Database config file not found');
            }

            $config = require '../config.php';
            $host = $config['database']['host'];
            $username = $config['database']['username'];
            $password = $config['database']['password'];
            $database = $config['database']['database'];

            // Verbindung initialisieren
            self::$connection = new MySQLi($host, $username, $password, $database);
            if (self::$connection->connect_error) {
                $error = self::$connection->connect_error;

                throw new DatabaseConnectionException($error);
            }

            self::$connection->set_charset('utf8');
        }

        // Verbindung zurückgeben
        return self::$connection;
    }
}