<?php
    require_once('database.php');

    // get data from the form
    $produce_code = filter_input(INPUT_POST, 'produce_code', FILTER_VALIDATE_INT);
    
    // code to delete produce from database
    // validate inputs

    if ($produce_code != false) {
        // delete the produce from the database
        $query = 'DELETE FROM produce WHERE produceCode = :produce_code';

        $statement = $db->prepare($query);
        $statement->bindValue(':produce_code', $produce_code);

        $statement->execute();
        $statement->closeCursor();
    }

    // reload the index page
    $url = "index.php";
    header("Location: " . $url);
    die();

?>
