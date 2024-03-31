<?php

    require_once 'config.php';

try {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {


        if(isset($_POST['message']) && !empty($_POST['message'])) {
            $message = $_POST['message'];
            $userId = null;

            if(isset($_POST['user']) && !empty($_POST['user'])) {
                $user = $_POST['user'];

                $request = $database->prepare(
                    'SELECT id FROM users WHERE pseudo = :pseudo'
                );
                $request->execute([
                    'pseudo' => $user
                ]);
                $userId = $request->fetchColumn();
            }
        
            if($userId) {
                $request = $database->prepare(
                    'INSERT INTO tweets (message, author_id) VALUES (:message, :author_id)'
                );
                $request->execute([
                    'message' => $message,
                    'author_id' => $userId
                ]);
            }else {
                $request = $database->prepare(
                    'INSERT INTO tweets (message) VALUES (:message)'
                );
                $request->execute([
                    'message' => $message
                ]);
            }
        
            header('Location: index.php?user=' . $user);
            exit();
        
        
        }else {
            die('Method not allowed');
        }


        exit();
    }

    die('Method not allowed');

}   catch(PDOException $e) {
    die('Could not connect to the database $dbname :' . $e->getMessage());
}