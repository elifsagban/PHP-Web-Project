<div id="header">
    <div id="link">
        <ul>
            <li><a href="#">Signup</a>
                <form method="post" action="" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>Enter your name:</td>
                            <td><input type="text" name="u_name"/></td>
                        </tr>
                        <tr>
                            <td>Enter your e-mail:</td>
                            <td><input type="email" name="u_email"/></td>
                        </tr>
                        <tr>
                            <td>Enter your pin:</td>
                            <td><input type="text" name="u_pin"/></td>
                        </tr>
                        <tr>
                            <td>Enter your phone number:</td>
                            <td><input type="text" name="u_phone"/></td>
                        </tr>
                        <tr>
                            <td>Select your birthdate:</td>
                            <td><input type="date" name="u_date"/></td>
                        </tr>
                    </table>
                    <center>
                        <input type="submit" name="u_signup" value="Signup"/>
                        <input type="reset" name="reset" value="Reset"/>
                    </center>
                </form>
        
            </li>
            <li><a href="#">Login</a>
                <form method="post" action="" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>Enter your e-mail:</td>
                            <td><input type="email" name="u_email"/></td>
                        </tr>
                        <tr>
                            <td>Enter your pin:</td>
                            <td><input type="text" name="u_pin"/></td>
                        </tr>
                    </table>
                    <center>
                        <input type="submit" name="u_login" value="Login"/>
                    </center>
                </form>
            </li>

        </ul>
    </div>
    <div id="search">
        <form action="search.php" method="get" enctype="multipart/form-data">
            <input type="text" name="user_query" placeholder="Search from here...">
            <button name="search" id="search_btn">Search</button>
            <button name="cart" id="cart_btn"><a href="cart.php">Cart <?php echo cart_count();?></a></button>
        </form>
    </div>
</div>