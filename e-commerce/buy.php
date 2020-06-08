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


        echo u_signup();

    ?>
    <div class="cart_buy">
        <form method="post" enctype="multipart/form-data">
                <?php echo cart_display_buy(); ?>
            </table>
        </form>
    </div>
    <div id="buy_form">
        <ul>
            <li ><h3 >For Shipping Please Fill the Form!</h3>
                <form method="post" action="" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>Enter your fullname:</td>
                            <td><input type="text" name="u_name"/></td>
                        </tr>
                        <tr>
                            <td>Enter shipping address:</td>
                            <td><input type="email" name="u_email"/></td>
                        </tr>
                        <tr>
                            <td>Enter a credit card number:</td>
                            <td><input type="text" name="u_pin"/></td>
                        </tr>
                        <tr>
                            <td>Enter a credit card CVC2:</td>
                            <td><input type="text" name="u_pin"/></td>
                        </tr>
                        <tr>
                            <td>Enter a phone number:</td>
                            <td><input type="text" name="u_phone"/></td>
                        </tr>

                    </table>
                    <center>
                        <input type="submit" name="u_signup" value="Purchase"/>
                    </center>
                </form>
        
            </li>
        </ul>
    </div>
    <?php
            include("inc/footer.php");
    ?>
</body>
</html>