<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="css\style.css"/>
    <title>The Simple Boutique</title>
</head>
<body>
    <?php 
        include("inc/function.php");
        include("inc/header.php"); 
        include("inc/navbar.php");
        echo search();
        include("inc/bodyright.php");
        include("inc/footer.php");

    ?>


</body>
</html>