<?php
    session_start();
    require_once("database.php");
    
    // get produce code
    $produce_code = filter_input(INPUT_POST, 'produce_code', FILTER_VALIDATE_INT);

    if (!$produce_code) {
        header("Location: index.php");
        exit;
    }

    // Fetch produce info
    $query = '
        SELECT p.produceCode, p.itemName, p.variety, p.origin, p.quantity,
            p.measure, p.price, p.typeID, p.imageName, t.produceType 
            FROM produce p LEFT JOIN types t ON p.typeID = t.typeID WHERE produceCode = :produce_code';

    $statement = $db->prepare($query);
    $statement->bindValue(':produce_code', $produce_code);
    $statement->execute();
    $product = $statement->fetch();
    $statement->closeCursor();

    if (!$product) {
        echo "Produce not found.";
        exit;
    }

    // Convert _100 image to _400 version
    $imageName = $product['imageName'];         // example: Mango_100.png
    $dotPosition = strrpos($imageName, '.');    // example: 15 which is the position of the . in $imageName
    $baseName = substr($imageName, 0, $dotPosition); //example: Mango_100 which is the substring in $imageName
                                                     // starting at position 0 and up to but not including position 15
    $extension = substr($imageName, $dotPosition);   // example: .png which is starting at position 15 and taking
                                                     // the rest of the string
    if (str_ends_with($baseName, '_100')) {
        $baseName = substr($baseName, 0, -4);   // removes the last 4 characters which are the _100
    }

    $imageName_400 = $baseName . '_400' . $extension; // example: Mango + _400 + .png or Mango_400.png    
    
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Produce Manager - Produce Details</title>
        <link rel="stylesheet" type="text/css" href="css/produce.css" />
    </head>

    <body>
        <?php include("header.php"); ?>        

        <div class="container">
            <h2>Produce Details</h2>            
                        
            <img class="produce-image" src="<?php echo htmlspecialchars('./images/' . $imageName_400); ?>"
                alt="<?php echo htmlspecialchars($product['itemName'] . ' ' . $product['variety']); ?>" />

            <div class="produce-info">
                <p><strong>Item Name:</strong>  <?php echo htmlspecialchars($product['itemName']); ?></p>
                <p><strong>Variety:</strong>  <?php echo htmlspecialchars($product['variety']); ?></p>
                <p><strong>Origin:</strong>  <?php echo htmlspecialchars($product['origin']); ?></p>
                <p><strong>Quantity:</strong>  <?php echo htmlspecialchars($product['quantity']); ?></p>
                <p><strong>Measure:</strong>  <?php echo htmlspecialchars($product['measure']); ?></p>
                <p><strong>Price:</strong>  <?php echo number_format((float)$product['price'], 2); ?></p>
                <p><strong>Produce Type:</strong>  <?php echo htmlspecialchars($product['produceType']); ?></p>
            </div>

            <p><a class="back-link" href="index.php">Back to Produce List</a></p>

        </div>

        <?php include("footer.php"); ?> 

    </body>
</html>       
