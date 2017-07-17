<?php
try{
    // Create a new connection.
    // You'll probably want to replace hostname with localhost in the first parameter.
    // Note how we declare the charset to be utf8mb4.  This alerts the connection that we'll be passing UTF-8 data.  This may not be required depending on your configuration, but it'll save you headaches down the road if you're trying to store Unicode strings in your database.  See "Gotchas".
    // The PDO options we pass do the following:
    // \PDO::ATTR_ERRMODE enables exceptions for errors.  This is optional but can be handy.
    // \PDO::ATTR_PERSISTENT disables persistent connections, which can cause concurrency issues in certain cases.  See "Gotchas".
    $link = new \PDO(   'mysql:host=localhost;dbname=id2197103_users;charset=utf8mb4',
                        'id2197103_usersroot',
                        'usersroot',
                        array(
                            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                    );
}
catch(\PDOException $ex){
    print($ex->getMessage());
}
?>