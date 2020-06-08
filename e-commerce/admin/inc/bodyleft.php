<div id="bodyleft">
    <h3>Content Management</h3>
    <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="index.php?viewall_cat">View & Add Categories</a></li>
        <li><a href="index.php?viewall_products">View Products</a></li>
        <li><a href="index.php?add_products">Add Products</a></li>
        

    </ul>
</div>
    <!-- end of bodyleft -->


<?php
    if(isset($_GET['viewall_cat'])) {
        include("cat.php");
    }
    if(isset($_GET['viewall_products'])) {
        include("viewall_products.php");
    }
    if(isset($_GET['add_products'])) {
        include("add_products.php");
    }
?>