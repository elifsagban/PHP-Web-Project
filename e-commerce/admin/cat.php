<div id="bodyright">
    <h3>View All Categories</h3>
    <form method="post" enctype="multipart/form-data">
        <table id="table">
            <tr>
                <th>Poruct ID</th>
                <th>Category Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            
                <?php include("inc/function.php"); echo viewall_category(); ?>
                
        </table>
    </form>
    <h3  id="add_cat">Add New Category From Here</h3>
    <form method="post">
        <table >
            <tr>
                <td id="input_name">Enter Category Name : </td>
                <td id="input_box"><input type="text" name="cat_name"/></td>
            </tr>
        </table>
       <center><button name="add_cat">Add Category</button></center>
    </form>
</div>

<?php
     echo add_cat();
?>