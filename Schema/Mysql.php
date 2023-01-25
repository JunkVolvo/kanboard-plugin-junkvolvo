<?php

namespace Kanboard\Plugin\JunkVolvo\Schema;

use PDO;

const VERSION = 1;

function version_1(PDO $pdo)
{
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS jv_clients (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB CHARSET=utf8
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS jv_cars (
            id INT PRIMARY KEY AUTO_INCREMENT,
            client_id INT,
            name VARCHAR(255) NOT NULL,
            FOREIGN KEY (client_id) REFERENCES jv_clients(id) ON DELETE CASCADE
        ) ENGINE=InnoDB CHARSET=utf8
    ");
}