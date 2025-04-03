<?php

spl_autoload_register(function ($class) {
    $file = __DIR__ . "/" . str_replace("\\", "/", $class) . ".php";
    if (file_exists($file)):
        require_once $file;
    else:
        die("$class is not found!!!");
    endif;
});

use SQL\DriverManager;
use SQL\Statement;
use SQL\PreparedStatement;

try {
    // 1️⃣ Get a database connection
    $dsn = "mysql:host=localhost;port=3306;dbname=school";
    $connection = DriverManager::getConnection($dsn, "root", "MyPassword");

    echo "✅ Successfully connected!\n";

    //  Executing a simple query using Statement
    $statement = new Statement($connection);
    $resultSet = $statement->executeQuery("SELECT * FROM users");
    $users = $resultSet->fetchAll();
    echo json_encode($users, JSON_PRETTY_PRINT);

    // 3️⃣ Executing a parameterized query using PreparedStatement
    $sql = <<<SQL
            INSERT INTO users(username, email, password, role)
            VALUES(?,?,?,?)
          SQL;
    $preparedStatement = new PreparedStatement($connection, $sql);

    if ($preparedStatement->execute([
        'john_kally',
        'jkally@example.com',
        password_hash('securePass', PASSWORD_DEFAULT),
        'user'
    ])
    ) {
        echo "✅ User inserted successfully! Affected rows: " . $preparedStatement->getUpdateCount() . "\n";
    }

    // 4️⃣ Fetching the inserted user
//    $resultSet = $statement->executeQuery("SELECT * FROM users WHERE username = 'john_doe'");
    $resultSet = $statement->executeQuery("SELECT * FROM users");

    $user = $resultSet->fetchAll();
    echo json_encode($user, JSON_PRETTY_PRINT);

    // 5️⃣ Closing the connection
    DriverManager::closeConnection();
} catch (RuntimeException $e) {
    echo "❌ Error: " . $e->getMessage();
}
