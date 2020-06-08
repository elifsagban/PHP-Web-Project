
<?php 
    if(!isset($_GET['viewall_cat'])) {
    if(!isset($_GET['add_products'])) { 
    if(!isset($_GET['viewall_products'])) {?>
<div id="bodyright">
    <?php 
        if(isset($_GET['edit_cat'])){
            include("edit_cat.php");
        } 
        if(isset($_GET['edit_pro'])){
            include("edit_pro.php");
        } 


    ?>
</div>
    <!-- end of bodyright -->
<?php } } }?>