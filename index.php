<?php

    require("database.php");

    $queryProduce = '
        SELECT itemName, variety, origin, quantity, measure, price FROM produce';

    $statement = $db->prepare($queryProduce);
    $statement->execute();
    $produce = $statement->fetchAll();
    $statement->closeCursor();

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Produce Manager - Home</title>
        <link rel="stylesheet" type="text/css" href="css/produce.css" />
    </head>

    <body>
        <?php include("header.php"); ?>

        <main>
            <h2>Produce List</h2>
            <table>
                <tr>
                    <th>Item Name</th>
                    <th>Variety</th>
                    <th>Origin</th>
                    <th>Quantity</th>
                    <th>Measure</th>
                    <th>Price</th>
                </tr>

                <?php foreach ($produce as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['itemName']); ?></td>
                        <td><?php echo htmlspecialchars($product['variety']); ?></td>
                        <td><?php echo htmlspecialchars($product['origin']); ?></td>
                        <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($product['measure']); ?></td>
                        <td><?php echo htmlspecialchars($product['price']); ?></td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </main>

        <?php include("footer.php"); ?> 

    </body>
</html>       
