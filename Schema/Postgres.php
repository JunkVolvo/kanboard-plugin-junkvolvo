<?php

namespace Kanboard\Plugin\JunkVolvo\Schema;

use PDO;

const VERSION = 1;

function version_1(PDO $pdo)
{
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS jv_clients (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255) NOT NULL
        );
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS jv_cars (
            id SERIAL PRIMARY KEY,
            client_id INTEGER,
            name VARCHAR(255) NOT NULL,
            FOREIGN KEY(client_id) REFERENCES jv_clients(id) ON DELETE CASCADE
        );
    ");
}