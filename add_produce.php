<?php
    session_start();

    $item_name = filter_input(INPUT_POST, 'item_name');
    $variety = filter_input(INPUT_POST, 'variety');
    $origin = filter_input(INPUT_POST, 'origin');
    $quantity = filter_input(INPUT_POST, 'quantity');
    $measure = filter_input(INPUT_POST, 'measure');
    $price = filter_input(INPUT_POST, 'price');  

    require_once('database.php');

    $queryProduce = '
    SELECT itemName, variety, origin, quantity, measure, price FROM produce';

$statement = $db->prepare($queryProduce);
$statement->execute();
$produce = $statement->fetchAll();
$statement->closeCursor();


    if ($item_name == null || $variety == null || $origin == null ||
        $quantity == null || $measure == null || $price == null) {
            $_SESSION["add_error"] = "Invalid produce data, Check all fields and try again.";
            $url = "error.php";
            header("Location: " . $url);
            die();
        }  

    // Add Produce

    $query = 'INSERT INTO produce (itemName, variety, origin, quantity, measure, price) 
        VALUES (:itemName, :variety, :origin, :quantity, :measure, :price)';

    $statement = $db->prepare($query);
    $statement->bindValue(':itemName', $item_name);
    $statement->bindValue(':variety', $variety);
    $statement->bindValue(':origin', $origin);
    $statement->bindValue(':quantity', $quantity);
    $statement->bindValue(':measure', $measure);
    $statement->bindValue(':price', $price);
    $statement->execute();
    $statement->closeCursor();

    $_SESSION["fullName"] = $item_name . " " . $variety;
    $url = "add_confirmation.php";
    header("Location: " . $url);
    die();

?>
