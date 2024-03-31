<?php

require_once 'config.php';

try {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        if(isset($_POST['user']) && !empty($_POST['user'])) {
            $user = $_POST['user'];

            if(isset($_POST['tweetId']) && !empty($_POST['tweetId'])) {
                $tweetId = $_POST['tweetId'];

                $request = $database->prepare(
                    'DELETE FROM tweets WHERE tweets.Id = :tweetId'
                );
                $request->execute([
                    'tweetId' => $tweetId
                ]);








                header('Location: index.php?user=' . $user);
                exit();

            }else {
                die('Unknown tweet Id');
            }

        }else {
            die('Unknown user');
        }


        exit();
    }

    die('Method not allowed'. $_SERVER['REQUEST_METHOD']);

}   catch(PDOException $e) {
    die('Could not connect to the database $dbname :' . $e->getMessage());
}