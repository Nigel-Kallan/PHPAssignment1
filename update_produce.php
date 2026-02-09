<?php
    session_start();

    require_once('database.php');
    require_once('image_util.php');

    $produce_code = filter_input(INPUT_POST, 'produce_code', FILTER_VALIDATE_INT);

    $item_name = filter_input(INPUT_POST, 'item_name');
    $variety = filter_input(INPUT_POST, 'variety');
    $origin = filter_input(INPUT_POST, 'origin');
    $quantity = filter_input(INPUT_POST, 'quantity');
    $measure = filter_input(INPUT_POST, 'measure');
    $price = filter_input(INPUT_POST, 'price');

    $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);

    // Get the uploaded image (if any)
    $image = $_FILES['file1'];

    // Get current produce record to check current image name
    $queryProduce = '
        SELECT produceCode, itemName, variety, origin, quantity, measure, price, typeID, imageName FROM produce WHERE produceCode = :produce_code';

    $statement = $db->prepare($queryProduce);
    $statement->bindValue(':produce_code', $produce_code);
    $statement->execute();
    $product = $statement->fetch();
    $statement->closeCursor();

    $old_image_name = $product['imageName'];
    $base_dir = 'images/';
    $image_name = $old_image_name;


    //Validate input

    if ($item_name == null || $variety == null || $origin == null || $quantity == null ||
        $measure == null || $price == null || $type_id == null) {
            $_SESSION["add_error"] = "Invalid produce data, Check all fields and try again.";
            $url = "error.php";
            header("Location: " . $url);
            die();  
        }

    // If new image is uploaded

    

    if ($image && $image['error'] == UPLOAD_ERR_OK) {

        

        // process new image
        $original_filename = basename($image['name']);
        $upload_path = $base_dir . $original_filename;
        move_uploaded_file($image['tmp_name'], $upload_path);        

        process_image($base_dir, $original_filename);        

        // save _100 version in DB
        $dot_pos = strrpos($original_filename, '.');
        $new_image_name = substr($original_filename, 0, $dot_pos) . '_100' . substr($original_filename, $dot_pos);
        $image_name = $new_image_name;



        if($old_image_name != 'placeholder_100.jpg') {
            $old_base = substr($old_image_name, 0, strrpos($old_image_name, '_100'));
            $old_ext = substr($old_image_name,strrpos($old_image_name, '.'));
            $original = $old_base . $old_ext;
            $img100 = $old_base . '_100' . $old_ext;
            $img400 = $old_base . '_400' . $old_ext;

            foreach([$original, $img100, $img400] as $file) {
                $path = $base_dir . $file;
                if(file_exists($path)) {
                    unlink($path);
                }
            }
        }
    }

    // Update Produce

    $query = '
        UPDATE produce
        SET itemName = :itemName,
            variety = :variety,
            origin = :origin,
            quantity = :quantity,
            measure = :measure,
            price = :price,
            typeID = :typeID,
            imageName = :imageName
        WHERE produceCode = :produceCode
    ';

    $statement = $db->prepare($query);
    $statement->bindValue(':itemName', $item_name);
    $statement->bindValue(':variety', $variety);
    $statement->bindValue(':origin', $origin);
    $statement->bindValue(':quantity', $quantity);
    $statement->bindValue(':measure', $measure);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':typeID', $type_id);
    $statement->bindValue(':imageName', $image_name);
    $statement->bindValue(':produceCode', $produce_code);
    $statement->execute();
    $statement->closeCursor();

    $_SESSION["fullName"] = $item_name . " " . $variety;
    $url = "update_confirmation.php";
    header("Location: " . $url);
    die();

?>
