<?php
    function add_cat(){
        include("inc/db.php");
        if(isset($_POST['add_cat'])){
            $cat_name=$_POST['cat_name'];
            $add_cat=$con->prepare("insert into main_cat(cat_name)values('$cat_name')");
            if($add_cat->execute()){
                echo "<script>alert('Category Added Successfully!');</script>";
                echo "<script>window.open('index.php?viewall_cat','_self');</script>";
            }
            else{
                echo "<script>alert('Category Not Added Successfully!');</script>";
            }
        }
    }

    function add_pro(){
        include("inc/db.php");
        if(isset($_POST['add_product'])){
            $pro_name=$_POST['pro_name'];
            $cat_id=$_POST['cat_name'];

            $pro_img=$_FILES['pro_img']['name'];
            $pro_img_tmp=$_FILES['pro_img']['tmp_name'];

            move_uploaded_file($pro_img_tmp,"../imgs/pro_img/$pro_img");
            $pro_color=$_POST['pro_color'];
            $pro_feature=$_POST['pro_feature'];
            $pro_price=$_POST['pro_price'];
            $pro_keyword=$_POST['pro_keyword'];

            $add_cat=$con->prepare("insert into products(pro_name,cat_id,pro_img,pro_color,pro_feature,pro_price,pro_keyword,pro_added_date)values('$pro_name','$cat_id','$pro_img','$pro_color','$pro_feature','$pro_price','$pro_keyword',NOW())");
            if($add_cat->execute()){
                echo "<script>alert('Product Added Successfully!');</script>";
            }
            else{
                echo "<script>alert('Product Not Added Successfully!');</script>";
            }
        }
    }

    function viewall_cat(){
        include("inc/db.php");
        $fetch_cat=$con->prepare("select * from main_cat");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();
        

        while($row=$fetch_cat->fetch()):
            echo"<option value='".$row['cat_id']."'>".$row['cat_name']."</option>";
        endwhile;
    }
    function viewall_products(){
        include("inc/db.php");

        $fetch_pro=$con->prepare("select * from products");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();
        $i=1;

        while($row=$fetch_pro->fetch()):
            echo "<tr>
                        <td>".$i++."</td>
                        <td><a href='index.php?edit_pro=".$row['pro_id']."'>Edit</a></td>
                        <td><a href='delete_cat.php?delete_pro=".$row['pro_id']."'>Delete</a></td>
                        <td>".$row['cat_id']."</td>
                        <td>".$row['pro_name']."</td>
                        <td><img src='../imgs/pro_img/".$row['pro_img']."'></td>
                        <td>".$row['pro_color']."</td>
                        <td>".$row['pro_feature']."</td>
                        <td>".$row['pro_price']."</td>
                        <td>".$row['pro_keyword']."</td>
                    </tr>";
        endwhile;
    }
    function viewall_category(){
        include("inc/db.php");
        $fetch_cat=$con->prepare("select * from main_cat");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();
        $i=1;

        while($row=$fetch_cat->fetch()):
            echo "<tr><td>".$i++."</td><td>".$row['cat_name']."</td>
                    <td><a href='index.php?edit_cat=".$row['cat_id']."'>Edit</a></td>
                    <td><a href='delete_cat.php?delete_cat=".$row['cat_id']."'>Delete</a></td></tr>";
        endwhile;
    }

    function edit_cat(){
        include("inc/db.php");
        if(isset($_GET['edit_cat'])){
            $cat_id=$_GET['edit_cat'];

            $fetch_cat_name=$con->prepare("select * from main_cat where cat_id='$cat_id'");
            $fetch_cat_name->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_cat_name->execute();
            $row=$fetch_cat_name->fetch();

            echo "<form method='post'>
                    <table >
                        <tr>
                            <td id='input_name'>Update Category Name : </td>
                            <td id='input_box'><input type='text' name='up_cat_name' value='".$row['cat_name']."'/></td>
                        </tr>
                    </table>
                    <center><button name='update_cat'>Update Category</button></center>
                </form>";
                if(isset($_POST['update_cat'])){
                    $up_cat_name=$_POST['up_cat_name'];
                    $update_cat=$con->prepare("update main_cat set cat_name='$up_cat_name' where cat_id='$cat_id'");
                    if($update_cat->execute()){
                        echo "<script>alert('Category Updated Successfully!');</script>";
                        echo "<script>window.open('index.php?viewall_cat','_self');</script>";
                    }
                }
        }
    }
    function edit_pro(){
        include("inc/db.php");

        if(isset($_GET['edit_pro'])){
            $pro_id=$_GET['edit_pro'];
            $fetch_pro=$con->prepare("select * from products where pro_id='$pro_id'");
            $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_pro->execute();

            $row=$fetch_pro->fetch();
            $cat_id=$row['cat_id'];
            $fetch_cat=$con->prepare("select * from main_cat where cat_id='$cat_id'");
            $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_cat->execute();
            $row_cat=$fetch_cat->fetch();
            $cat_name=$row_cat['cat_name'];
             
            echo"<form method='post' enctype='multipart/form-data'>
                    <table>
                        <tr>
                            <td id='add_label'>Update Product Name : </td>
                            <td><input type='text' name='pro_name' value='".$row['pro_name']."'/></td>
                        </tr>
                        <tr>
                            <td id='add_label'>Update Category Name : </td>
                            <td><select name='cat_name'>
                            <option value='".$row['cat_id']."'> ".$cat_name."</option>
                            "; echo viewall_cat(); echo "</select></td>
                        </tr>
                        <tr>
                            <td id='add_label'>Update Product Image : </td>
                            <td>
                            <input type='file' name='pro_img'/>
                            <img src='../imgs/pro_img/".$row['pro_img']."' />
                            </td>
                        </tr>
                        <tr>
                            <td id='add_label'>Update Color : </td>
                            <td><input type='text' name='pro_color' value='".$row['pro_color']."'/></td>
                        </tr>
                        <tr>
                            <td id='add_label'>Update Feature : </td>
                            <td><input type='text' name='pro_feature' value='".$row['pro_feature']."'/></td>
                        </tr>
                
                        <tr>
                            <td id='add_label'>Update Price : </td>
                            <td><input type='text' name='pro_price' value='".$row['pro_price']."'/></td>
                        </tr>
                        <tr>
                            <td id='add_label'>Update Keyword : </td>
                            <td><input type='text' name='pro_keyword' value='".$row['pro_keyword']."'/></td>
                        </tr>
                
                    </table>
                    <center><button name='up_product'>Update Product</button></center>
                </form>";

                if(isset($_POST['up_product'])){
                    $pro_name=$_POST['pro_name'];
                    $cat_id=$_POST['cat_name'];
        
                    $pro_img=$_FILES['pro_img']['name'];
                    $pro_img_tmp=$_FILES['pro_img']['tmp_name'];
        
                    move_uploaded_file($pro_img_tmp,"../imgs/pro_img/$pro_img");
                    $pro_color=$_POST['pro_color'];
                    $pro_feature=$_POST['pro_feature'];
                    $pro_price=$_POST['pro_price'];
                    $pro_keyword=$_POST['pro_keyword'];

                    $up_pro=$con->prepare("update products set pro_name='$pro_name', cat_id='$cat_name', pro_img='$pro_img',
                                            pro_color='$pro_color', pro_feature='$pro_feature', pro_price='$pro_price', pro_keyword='$pro_keyword'  
                                            where pro_id='$pro_id'");

                    if($up_pro->execute()){
                        echo "<script>alert('Product Updated Successfully!')</script>";
                        echo "<script>window.open('index.php?viewall_products','_self');</script>";
                    }
                }
        }
    }

    function delete_cat(){
        include("inc/db.php");

        $delete_cat_id=$_GET['delete_cat'];
        $delete_cat=$con->prepare("delete from main_cat where cat_id='$delete_cat_id'");

        if($delete_cat->execute()){
            echo "<script>alert('Category Deleted Succcessfully!')</script>";
            echo "<script>window.open('index.php?viewall_cat','_self');</script>";
        }

    }

    function delete_product(){
        include("inc/db.php");

        $delete_product_id=$_GET['delete_pro'];
        $delete_pro=$con->prepare("delete from products where pro_id='$delete_product_id'");

        if($delete_pro->execute()){
            echo "<script>alert('Product Deleted Succcessfully!')</script>";
            echo "<script>window.open('index.php?viewall_products','_self');</script>";
        }


    }

?>