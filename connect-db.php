<?php
    
    $hostname = 'localhost:3306';
    
    $dbname = 'moviefinder';

    $username = 'cs4640';
    $password = 'password';


    $dsn = "mysql:host=$hostname;dbname=$dbname";


    try
    {
        $db = new PDO($dsn, $username, $password);
    }
    catch (PDOException $e)
    {
        $error_message = $e->getMessage();
        echo "<p>An error occurred while connecting to the database: $error_message </p>";
    }
    catch (Exception $e)
    {
        $error_message = $e->getMessage();
        echo "<p>Error message: $error_message </p>";
    }





?>