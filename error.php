<?php
    session_start();
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Produce Manager - Error</title>
        <link rel="stylesheet" type="text/css" href="css/produce.css" />
    </head>

    <body>
        <?php include("header.php"); ?>

        <main>
            <h2>Error</h2>
            
            <p>Error Message: <?php echo $_SESSION["add_error"]; ?>

            <p><a href="add_produce_form.php">Add Produce</a></p>
            <p><a href="index.php">View Produce List</a></p>
        </main>

        <?php include("footer.php"); ?> 

    </body>
</html>
