<div id="bodyright">
    <h3>Add New Product From Here</h3>
    <form method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td id="add_label">Enter Product Name : </td>
                <td><input type="text" name="pro_name"/></td>
            </tr>
            <tr>
                <td id="add_label">Select Category Name : </td>
                <td><select name="cat_name"><?php include("inc/function.php"); echo viewall_cat(); ?> </select></td>
            </tr>
            <tr>
                <td id="add_label">Select Product Image : </td>
                <td><input type="file" name="pro_img"/></td>
            </tr>
            <tr>
                <td id="add_label">Enter Color : </td>
                <td><input type="text" name="pro_color"/></td>
            </tr>
            <tr>
                <td id="add_label">Enter Feature : </td>
                <td><input type="text" name="pro_feature"/></td>
            </tr>

            <tr>
                <td id="add_label">Enter Price : </td>
                <td><input type="text" name="pro_price"/></td>
            </tr>
            <tr>
                <td id="add_label">Enter Keyword : </td>
                <td><input type="text" name="pro_keyword"/></td>
            </tr>

        </table>
       <center><button name="add_product">Add Product</button></center>
    </form>
</div>

<?php
    echo add_pro();
?>