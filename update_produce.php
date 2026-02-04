<?php
    session_start();

    require_once('database.php');

    $produce_code = filter_input(INPUT_POST, 'produce_code', FILTER_VALIDATE_INT);

    $item_name = filter_input(INPUT_POST, 'item_name');
    $variety = filter_input(INPUT_POST, 'variety');
    $origin = filter_input(INPUT_POST, 'origin');
    $quantity = filter_input(INPUT_POST, 'quantity');
    $measure = filter_input(INPUT_POST, 'measure');
    $price = filter_input(INPUT_POST, 'price');

    
    if ($item_name == null || $variety == null || $origin == null ||
        $quantity == null || $measure == null || $price == null) {
            $_SESSION["add_error"] = "Invalid produce data, Check all fields and try again.";
            $url = "error.php";
            header("Location: " . $url);
            die();  
        }

    // Update Produce

    $query = '
        UPDATE produce
        SET itemName = :itemName,
            variety = :variety,
            origin = :origin,
            quantity = :quantity,
            measure = :measure,
            price = :price
        WHERE produceCode = :produceCode
    ';

    $statement = $db->prepare($query);
    $statement->bindValue(':itemName', $item_name);
    $statement->bindValue(':variety', $variety);
    $statement->bindValue(':origin', $origin);
    $statement->bindValue(':quantity', $quantity);
    $statement->bindValue(':measure', $measure);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':produceCode', $produce_code);
    $statement->execute();
    $statement->closeCursor();

    $_SESSION["fullName"] = $item_name . " " . $variety;
    $url = "update_confirmation.php";
    header("Location: " . $url);
    die();

?>
