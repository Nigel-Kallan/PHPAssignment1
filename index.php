<?php
    session_start();

    if (!isset($_SESSION['isLoggedIn'])) {
        header("Location: login_form.php");
        die();
    }

    require("database.php");

    $queryProduce = '
         SELECT p.produceCode, p.itemName, p.variety, p.origin, p.quantity,
            p.measure, p.price, p.typeID, p.imageName, t.produceType 
            FROM produce p LEFT JOIN types t ON p.typeID = t.typeID';

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
            <h2>Produce List (<?php echo "Logged In User: " . $_SESSION['userName']; ?>)</h2>
            <table>
                <tr>
                    <th>Item Name</th>
                    <th>Variety</th>
                    <th>Origin</th>
                    <th>Quantity</th>
                    <th>Measure</th>
                    <th>Price $</th>
                    <th>Produce Type</th>
                    <th>Photo</th>
                    <th>&nbsp;</th> <!-- for update -->
                    <th>&nbsp;</th> <!-- for delete -->
                    <th>&nbsp;</th> <!-- for view details -->
                </tr>

                <?php foreach ($produce as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['itemName']); ?></td>
                        <td><?php echo htmlspecialchars($product['variety']); ?></td>
                        <td><?php echo htmlspecialchars($product['origin']); ?></td>
                        <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($product['measure']); ?></td>
                        <td><?php echo number_format((float)$product['price'], 2); ?></td>
                        <td><?php echo htmlspecialchars($product['produceType']); ?></td>
                        <td>
                            <img src="<?php echo htmlspecialchars('./images/' . $product['imageName']); ?>"
                                alt="<?php echo htmlspecialchars($product['itemName'] . ' ' . $product['variety']); ?>" />
                        </td>
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
                        <td>
                            <form action="produce_details.php" method="post">
                                <input type="hidden" name="produce_code" value="<?php echo $product['produceCode']; ?>" />
                                <input type="submit" value="View Details" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>

            <p><a href="add_produce_form.php">Add Produce</a></p>

            <p><a href="logout.php">Logout</a></p

        </main>

        <?php include("footer.php"); ?> 

    </body>
</html>       
