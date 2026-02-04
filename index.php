<?php

    require("database.php");

    $queryProduce = '
        SELECT produceCode, itemName, variety, origin, quantity, measure, price FROM produce';

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
                    <th>&nbsp;</th> <!-- for delete -->
                    <th>&nbsp;</th> <!-- for update -->
                </tr>

                <?php foreach ($produce as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['itemName']); ?></td>
                        <td><?php echo htmlspecialchars($product['variety']); ?></td>
                        <td><?php echo htmlspecialchars($product['origin']); ?></td>
                        <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($product['measure']); ?></td>
                        <td><?php echo htmlspecialchars($product['price']); ?></td>
                        <td>
                            <form action="update_produce_form.php" method="post">
                                <input type="hidden" name="produce_code" value="<?php echo $product['produceCode']; ?>" />
                                <input type="submit" value="Update" />
                            </form>
                        </td>
                        <td>
                            <form action="delete_produce.php" method="post">
                                <input type="hidden" name="produce_code" value="<?php echo $product['produceCode']; ?>" />
                                <input type="submit" value="Delete" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>

            <p><a href="add_produce_form.php">Add Produce</a></p>

        </main>

        <?php include("footer.php"); ?> 

    </body>
</html>       
