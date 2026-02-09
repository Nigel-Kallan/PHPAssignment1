<?php
    session_start();

    $item_name = filter_input(INPUT_POST, 'item_name');
    $variety = filter_input(INPUT_POST, 'variety');
    $origin = filter_input(INPUT_POST, 'origin');
    $quantity = filter_input(INPUT_POST, 'quantity');
    $measure = filter_input(INPUT_POST, 'measure');
    $price = filter_input(INPUT_POST, 'price');  
    $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
    $image = $_FILES['file1'];   

    require_once('database.php');
    require_once('image_util.php');

    $base_dir = 'images/';

    $queryProduce = '
    SELECT itemName, variety, origin, quantity, measure, price, imageName FROM produce';

$statement = $db->prepare($queryProduce);
$statement->execute();
$produce = $statement->fetchAll();
$statement->closeCursor();


    if ($item_name == null || $variety == null || $origin == null ||
        $quantity == null || $measure == null || $price == null|| $type_id == null) {
            $_SESSION["add_error"] = "Invalid produce data, Check all fields and try again.";
            $url = "error.php";
            header("Location: " . $url);
            die();
        }  


    $image_name = ''; // default empty

    // ******* Image Upload *******

    if ($image && $image['error'] == UPLOAD_ERR_OK) {
        // process new image
        $original_filename = basename($image['name']);
        $upload_path = $base_dir . $original_filename;
        move_uploaded_file($image['tmp_name'], $upload_path);

        process_image($base_dir, $original_filename);

        // save _100 version in DB
        $dot_pos = strpos($original_filename, '.');
        $name_100 = substr($original_filename, 0, $dot_pos) . '_100' . substr($original_filename, $dot_pos);
        $image_name = $name_100;
    }
    else {
        // Use placeholder
        $placeholder = 'placeholder.jpg';
        $placeholder_100 = 'placeholder_100.jpg';
        $placeholder_400 = 'placeholder_400.jpg';

        if (!file_exists($base_dir . $placeholder_100) || !file_exists($base_dir . $placeholder_400)) {
            process_image($base_dir, $placeholder);
        }

        $image_name = $placeholder_100;
    }

    // Add Produce

    $query = 'INSERT INTO produce (itemName, variety, origin, quantity, measure, price, typeID, imageName) 
        VALUES (:itemName, :variety, :origin, :quantity, :measure, :price, :typeID, :imageName)';

    $statement = $db->prepare($query);
    $statement->bindValue(':itemName', $item_name);
    $statement->bindValue(':variety', $variety);
    $statement->bindValue(':origin', $origin);
    $statement->bindValue(':quantity', $quantity);
    $statement->bindValue(':measure', $measure);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':typeID', $type_id);
    $statement->bindValue(':imageName', $image_name);
    $statement->execute();
    $statement->closeCursor();

    $_SESSION["fullName"] = $item_name . " " . $variety;
    $url = "add_confirmation.php";
    header("Location: " . $url);
    die();

?>
