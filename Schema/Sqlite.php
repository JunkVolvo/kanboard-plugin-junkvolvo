<?php

namespace Kanboard\Plugin\JunkVolvo\Schema;

use PDO;

const VERSION = 1;

function version_1(PDO $pdo)
{
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS jv_clients (
            id INTEGER PRIMARY KEY,
            name TEXT
        )
    ");

    $pdo->exec("
        CREATE TABLE jv_cars (
            id INTEGER PRIMARY KEY,
            client_id INTEGER NOT NULL,
            name TEXT,
            FOREIGN KEY(client_id) REFERENCES jv_clients(id) ON DELETE CASCADE
        )
    ");
}