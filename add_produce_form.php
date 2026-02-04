<?php
    session_start();

    require("database.php");    

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Produce Manager - Add Produce</title>
        <link rel="stylesheet" type="text/css" href="css/produce.css" />
    </head>

    <body>
        <?php include("header.php"); ?>

        <main>
            <h2>Add Produce</h2>

            <form action="add_produce.php" method="post" id="add_produce_form" enctype="multipart/form-data">

                <div id="data">

                    <label>Item Name:</label>
                    <input type="text" name="item_name" /><br />

                    <label>Variety:</label>
                    <input type="text" name="variety" /><br />

                    <label>Origin:</label>
                    <input type="text" name="origin" /><br />

                    <label>Quantity:</label>
                    <input type="text" name="quantity" /><br />

                    <label>Measure:</label>
                    <input type="text" name="measure" /><br />

                    <label>Price:</label>
                    <input type="text" name="price" /><br />

                    
                </div>

                <div id="buttons">
                   <label>&nbsp;</label>
                   <input type="submit" value="Save Produce" /><br /> 
                </div>

            </form>            

            <p><a href="index.php">View Produce List</a></p>

        </main>

        <?php include("footer.php"); ?> 

    </body>
</html>       
