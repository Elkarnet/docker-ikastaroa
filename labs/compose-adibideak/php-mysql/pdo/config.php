<?php

/**
 * Configuration for database connection
 *
 */

$host       = "db";
$username   = "root";
$password   = "changeme";
$dbname     = "test";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
