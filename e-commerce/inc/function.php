<?php
function u_signup(){
    include("inc/db.php");
    if(isset($_POST['u_signup'])){
        $u_name=$_POST['u_name'];
        $u_email=$_POST['u_email'];
        $u_phone=$_POST['u_phone'];
        $u_date=$_POST['u_date'];
        $u_pin=$_POST['u_pin'];

        $u_pass=mt_rand();
        $add_user=$con->prepare("insert into user(u_name,u_email,u_pin,u_phone,u_date,u_pass,u_reg_date) values('$u_name','$u_email','$u_pin','$u_phone','$u_date','$u_pass', NOW())");

        if($add_user->execute()){
            echo "<script>alert('Registration Successfull!! Check your email!')</script>";
            echo "<script>window.open('index.php','_self');</script>";
        }
        else{
            echo "<script>alert('Registration Failed! Please Try Again...')</script>";
        }

    
    }
}
function getIP(){
    $ip =$_SERVER['REMOTE_ADDR'];
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $ip;
}
function add_cart(){
    include("inc/db.php");
    if (isset($_POST['cart_btn'])){
        $pro_id=$_POST['pro_id'];
        $ip=getIP();

        $check_cart=$con->prepare("select * from cart where pro_id='$pro_id' AND ip_add='$ip'");
        $check_cart->execute();

        $row_check=$check_cart->rowCount();

        if($row_check==1){
            echo"<script>alert('This Product is Already Added in the Cart!');</script>";
        }else{
            $add_cart=$con->prepare("insert into cart(pro_id,qty,ip_add)values('$pro_id','1','$ip') ");
            if($add_cart->execute()){
                echo"<script>window.open('index.php','_self');</script>";
            }
            else{
                echo"<script>alert('Try Again!');</script>";
            }
        }
    }
}
function cart_count(){
    include("inc/db.php");
    $ip=getIP();
    $get_cart_item=$con->prepare("select * from cart where ip_add='$ip'");
    $get_cart_item->execute();

    $count_cart=$get_cart_item->rowCount();

    echo $count_cart;
}
function cart_display(){
    include("inc/db.php");
    $ip=getIP();
    $get_cart_item=$con->prepare("select * from cart where ip_add='$ip'");
    $get_cart_item->setFetchMode(PDO:: FETCH_ASSOC);
    $get_cart_item->execute();
    $cart_empty=$get_cart_item->rowCount();

    $net_total=0;

    if($cart_empty==0){
        echo"<center><h2>No product found in the cart! <a href='index.php'>Continue Shopping</a></h2></center>";
    }else{
        if(isset($_POST['up_qty'])){
            $quantitiy=$_POST['qty'];

            foreach($quantitiy as $key=>$value){
                $update_qty=$con->prepare("update cart set qty='$value' where cart_id='$key'");
                if($update_qty->execute()){
                    echo"<script>window.open('cart.php','_self');</script>";

                }

            }
        }
        echo"<table cellpadding='0' cellspacing='0'>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Remove</th>
                <th>Sub Total</th>
            </tr>";

        while($row=$get_cart_item->fetch()):
            $pro_id=$row['pro_id'];

            $get_pro=$con->prepare("select *  from products where pro_id='$pro_id'");
            $get_pro->setFetchMode(PDO:: FETCH_ASSOC);
            $get_pro->execute();
            $row_pro=$get_pro->fetch();
            echo "
                <tr>
                    <td><img src='imgs/pro_img/".$row_pro['pro_img']."'/></td>
                    <td>".$row_pro['pro_name']."</td>
                    <td><input type='text' name='qty[".$row['cart_id']."]' value='".$row['qty']."'/><input type='submit' name='up_qty' value='save'/></td>
                    <td>".$row_pro['pro_price']."</td>
                    <td><a href='delete.php?delete_id=".$row_pro['pro_id']."'>delete</a></td>
                    <td>"; 
                        $qty=$row['qty'];
                        $pro_price=$row_pro['pro_price'];
                        $sub_total=$pro_price*$qty; 
                        echo $sub_total;
                        $net_total=$net_total+$sub_total;
                    echo"</td>
                </tr>";

        endwhile;
        echo"<tr>
            <td></td><td></td><td></td><td></td>
            <td><button id='buy_now'><a href='index.php' >Continue Shopping </a></button></td>
            <td>Total Amount = $net_total</td>
        </tr>";
        echo"<tr>
            <td></td><td></td><td></td><td></td><td></td>
            <td><button id='buy_now'><a href='buy.php' >Purchase</a></button></td>
        </tr>";
    }

}
function cart_display_buy(){
    include("inc/db.php");
    $ip=getIP();
    $get_cart_item=$con->prepare("select * from cart where ip_add='$ip'");
    $get_cart_item->setFetchMode(PDO:: FETCH_ASSOC);
    $get_cart_item->execute();
    $cart_empty=$get_cart_item->rowCount();

    $net_total=0;

    if($cart_empty==0){
        echo"<center><h2>No product found in the cart! <a href='index.php'>Continue Shopping</a></h2></center>";
    }else{
        if(isset($_POST['up_qty'])){
            $quantitiy=$_POST['qty'];

            foreach($quantitiy as $key=>$value){
                $update_qty=$con->prepare("update cart set qty='$value' where cart_id='$key'");
                if($update_qty->execute()){
                    echo"<script>window.open('cart.php','_self');</script>";

                }

            }
        }
        echo"<table cellpadding='0' cellspacing='0'>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Remove</th>
                <th>Sub Total</th>
            </tr>";

        while($row=$get_cart_item->fetch()):
            $pro_id=$row['pro_id'];

            $get_pro=$con->prepare("select *  from products where pro_id='$pro_id'");
            $get_pro->setFetchMode(PDO:: FETCH_ASSOC);
            $get_pro->execute();
            $row_pro=$get_pro->fetch();
            echo "
                <tr>
                    <td><img src='imgs/pro_img/".$row_pro['pro_img']."'/></td>
                    <td>".$row_pro['pro_name']."</td>
                    <td><input type='text' name='qty[".$row['cart_id']."]' value='".$row['qty']."'/><input type='submit' name='up_qty' value='save'/></td>
                    <td>".$row_pro['pro_price']."</td>
                    <td><a href='delete.php?delete_id=".$row_pro['pro_id']."'>delete</a></td>
                    <td>"; 
                        $qty=$row['qty'];
                        $pro_price=$row_pro['pro_price'];
                        $sub_total=$pro_price*$qty; 
                        echo $sub_total;
                        $net_total=$net_total+$sub_total;
                    echo"</td>
                </tr>";

        endwhile;
        echo"<tr>
            <td></td><td></td><td></td><td></td>
            <td><button id='buy_now'><a href='index.php' >Continue Shopping </a></button></td>
            <td>Total Amount = $net_total</td>
        </tr>";
    }

}
function delete_cart_items(){
    include("inc/db.php");
    if(isset($_GET['delete_id'])){
        $pro_id=$_GET['delete_id'];

        $delete_pro=$con->prepare("delete from cart where pro_id='$pro_id'");

        if($delete_pro->execute()){
            echo"<script>alert('Product deleted successfully!');</script>";
            echo"<script>window.open('cart.php','_self');</script>";
        }
    }
}

function gift(){
    include("inc/db.php");

    $fetch_cat=$con->prepare("select * from main_cat where cat_id='5'");
    $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_cat->execute();

    $row_cat=$fetch_cat->fetch();
    $cat_id=$row_cat['cat_id'];
    echo "<h3>".$row_cat['cat_name']."</h3>";

    $fetch_pro=$con->prepare("select * from products where cat_id='$cat_id' LIMIT 0,3");
    $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_pro->execute();

    while($row_pro=$fetch_pro->fetch()):
        echo "<li>
                <form method='post' enctype='multipart/form-data'>
                    <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                        <h4>".$row_pro['pro_name']."</h4>
                        <img src='imgs/pro_img/".$row_pro['pro_img']."'/>
                        <center>
                            <button id='pro_btn'><a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>View<a/></button>
                            <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id'/>
                            <button id='pro_btn' name='cart_btn'>+ Cart</button>
                        </center>
                    </a>
                </form>
            </li>";
    endwhile;
}
function bottoms(){
    include("inc/db.php");

    $fetch_cat=$con->prepare("select * from main_cat where cat_id='4'");
    $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_cat->execute();

    $row_cat=$fetch_cat->fetch();
    $cat_id=$row_cat['cat_id'];
    echo "<h3>".$row_cat['cat_name']."</h3>";

    $fetch_pro=$con->prepare("select * from products where cat_id='$cat_id' LIMIT 0,3");
    $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_pro->execute();

    while($row_pro=$fetch_pro->fetch()):
        echo "<li>
                <form method='post' enctype='multipart/form-data'>
                    <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                        <h4>".$row_pro['pro_name']."</h4>
                        <img src='imgs/pro_img/".$row_pro['pro_img']."'/>
                        <center>
                            <button id='pro_btn'><a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>View<a/></button>
                            <button id='pro_btn' name='cart_btn'>+ Cart</button>
                        </center>
                    </a>
                </form>
            </li>";
    endwhile;
}
function tops(){
    include("inc/db.php");

    $fetch_cat=$con->prepare("select * from main_cat where cat_id='14'");
    $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_cat->execute();

    $row_cat=$fetch_cat->fetch();
    $cat_id=$row_cat['cat_id'];
    echo "<h3>".$row_cat['cat_name']."</h3>";

    $fetch_pro=$con->prepare("select * from products where cat_id='$cat_id' LIMIT 0,3");
    $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_pro->execute();

    while($row_pro=$fetch_pro->fetch()):
        echo "<li>
                <form method='post' enctype='multipart/form-data'>
                    <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                        <h4>".$row_pro['pro_name']."</h4>
                        <img src='imgs/pro_img/".$row_pro['pro_img']."'/>
                        <center>
                            <button id='pro_btn'><a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>View<a/></button>
                            <button id='pro_btn' name='cart_btn'>+ Cart</button>
                        </center>
                    </a>
                </form>
            </li>";
    endwhile;
}

function dress(){
    include("inc/db.php");

    $fetch_cat=$con->prepare("select * from main_cat where cat_id='6'");
    $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_cat->execute();

    $row_cat=$fetch_cat->fetch();
    $cat_id=$row_cat['cat_id'];
    echo "<h3>".$row_cat['cat_name']."</h3>";

    $fetch_pro=$con->prepare("select * from products where cat_id='$cat_id' LIMIT 0,3");
    $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_pro->execute();

    while($row_pro=$fetch_pro->fetch()):
        echo "<li>
                <form method='post' enctype='multipart/form-data'>
                    <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                        <h4>".$row_pro['pro_name']."</h4>
                        <img src='imgs/pro_img/".$row_pro['pro_img']."'/>
                        <center>
                            <button id='pro_btn'><a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>View<a/></button>
                            <button id='pro_btn' name='cart_btn'>+ Cart</button>
                        </center>
                    </a>
                </form>
            </li>";
    endwhile;
}


function pro_details(){
    include("inc/db.php");

    if(isset($_GET['pro_id'])){
        $pro_id=$_GET['pro_id'];

        $pro_fetch=$con->prepare("select * from products where pro_id='$pro_id'");
        $pro_fetch->setFetchMode(PDO:: FETCH_ASSOC);
        $pro_fetch->execute();

        $row_pro=$pro_fetch->fetch();
        $cat_id=$row_pro['cat_id'];
        echo "<div id='pro_img'>
                <img src='imgs/pro_img/".$row_pro['pro_img']."'/>
            </div>
            <div id='pro_feature'>
                <h3>".$row_pro['pro_name']."</h3>
                <ul>
                    <li>Feature :".$row_pro['pro_feature']."</li>
                    <li>Color :".$row_pro['pro_color']."</li>
                </ul>
                <center>
                    <h4>Price :".$row_pro['pro_price']."$</h4>
                    <form method='post'>
                        <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id'/>
                        <button id='buy_now' name='buy_now'>Buy Now</button>
                        <button id='buy_now' name='cart_btn'>+ Cart</button>
                    </form>
                </center>
            </div>
            <br clear='all'/>
            <div id='sim_pro'>
                <h4>Recommendation</h4>
                <ul>";
                echo add_cart();
                    $sim_pro=$con->prepare("select * from products where pro_id!='$pro_id' AND cat_id='$cat_id' LIMIT 0,5");
                    $sim_pro->setFetchMode(PDO:: FETCH_ASSOC);
                    $sim_pro->execute();
                    while($row=$sim_pro->fetch()):
                        echo"<li>
                                <a href='pro_detail.php?pro_id=".$row['pro_id']."'>
                                    <img src='imgs/pro_img/".$row['pro_img']."'/>
                                    <p>".$row['pro_name']."</p>
                                    <p>Price:".$row['pro_price']."$</p>
                                </a>
                            </li>";
                    endwhile;
                echo "</ul>
                
            </div>";
    }
}
function all_cat(){
    include("inc/db.php");
    $all_cat=$con->prepare("select * from main_cat");
    $all_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $all_cat->execute();

    while($row=$all_cat->fetch()):
        echo "<li><a href='pro_category.php?cat_id=".$row['cat_id']."'>".$row['cat_name']."</a></li><br>";
    endwhile;

}

function search(){
    include("inc/db.php");
    if(isset($_GET['search'])){
        $user_query=$_GET['user_query'];

        $search=$con->prepare("select * from products where pro_name like '%$user_query%' or pro_keyword like '%$user_query%'");
        $search->setFetchMode(PDO:: FETCH_ASSOC);
        $search->execute();

        echo "<div id='bodyleft'><ul>";
        if($search->rowCount()==0){
            echo "<h2>Product Not Found With This Keyword!</h2>";
        }
        else{
            while($row=$search->fetch()): 
                echo "<li>
                        <a href='#'>
                            <h4>".$row['pro_name']."</h4>
                            <img src='imgs/pro_img/".$row['pro_img']."'/>
                            <center>
                                <button id='pro_btn'><a href='pro_detail.php?pro_id=".$row['pro_id']."'>View<a/></button
                            </center>
                        </a>
                    </li>";
            
            endwhile;
        }
        echo "</div></ul>";
    }

}

?>