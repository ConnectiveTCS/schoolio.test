<?php

try {
    $pdo = new PDO('sqlite:database/tenant1');
    $tables = $pdo->query('SELECT name FROM sqlite_master WHERE type="table"')->fetchAll(PDO::FETCH_COLUMN);
    echo "Tables in tenant1: " . implode(', ', $tables) . PHP_EOL;

    // Check migrations that have been run
    if (in_array('migrations', $tables)) {
        echo "\nMigrations that have been run:" . PHP_EOL;
        $migrations = $pdo->query('SELECT migration FROM migrations ORDER BY batch, migration')->fetchAll(PDO::FETCH_COLUMN);
        foreach ($migrations as $migration) {
            echo "  - {$migration}" . PHP_EOL;
        }
    }

    // Check if sessions table exists
    if (in_array('sessions', $tables)) {
        echo "\nSessions table exists in tenant1" . PHP_EOL;
        $columns = $pdo->query('PRAGMA table_info(sessions)')->fetchAll(PDO::FETCH_ASSOC);
        echo "Sessions table structure:" . PHP_EOL;
        foreach ($columns as $column) {
            echo "  - {$column['name']} ({$column['type']})" . PHP_EOL;
        }
    } else {
        echo "\nSessions table does NOT exist in tenant1" . PHP_EOL;
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
