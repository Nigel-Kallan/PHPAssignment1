<?php
    require_once("database.php");
    
    // get data from the form
    $produce_code = filter_input(INPUT_POST, 'produce_code', FILTER_VALIDATE_INT);

    $queryProduce = '
        SELECT produceCode, itemName, variety, origin, quantity, measure, price FROM produce WHERE produceCode = :produce_code';

    $statement = $db->prepare($queryProduce);
    $statement->bindValue(':produce_code', $produce_code);
    $statement->execute();
    $product = $statement->fetch();
    $statement->closeCursor();

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Produce Manager - Update Produce</title>
        <link rel="stylesheet" type="text/css" href="css/produce.css" />
    </head>

    <body>
        <?php include("header.php"); ?>

        <main>
            <h2>Update Produce</h2>

            <form action="update_produce.php" method="post" id="update_produce_form" enctype="multipart/form-data">
                <input type="hidden" name="produce_code" value="<?php echo $product['produceCode']; ?>" />
                <div id="data">

                    <label>First Name:</label>
                    <input type="text" name="item_name" value="<?php echo $product['itemName']; ?>" /><br />

                    <label>Variety:</label>
                    <input type="text" name="variety" value="<?php echo $product['variety']; ?>" /><br />

                    <label>Origin:</label>
                    <input type="text" name="origin" value="<?php echo $product['origin']; ?>" /><br />

                    <label>Quantity:</label>
                    <input type="text" name="quantity" value="<?php echo $product['quantity']; ?>" /><br />

                    <label>Measure:</label>
                    <input type="text" name="measure" value="<?php echo $product['measure']; ?>" /><br />

                    <label>Price:</label>
                    <input type="text" name="price" value="<?php echo $product['price']; ?>" /><br />

                </div>

                <div id="buttons">
                   <label>&nbsp;</label>
                   <input type="submit" value="Update Produce" /><br /> 
                </div>

            </form>            

            <p><a href="index.php">View Produce List</a></p>

        </main>

        <?php include("footer.php"); ?> 

    </body>
</html>       
