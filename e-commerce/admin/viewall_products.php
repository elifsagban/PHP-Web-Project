<div id="bodyright">
    <h3>Product List</h3>
    <form id="viewPro" method="post" enctype="multipart/form-data">
        <table >
            <tr>
                <th>Poruct ID</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Category ID</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Color</th>
                <th>Feature</th>
                <th>Price</th>
                <th>Keyword</th>

            </tr>
            <?php include("inc/function.php"); echo viewall_products(); ?>
        </table>

    </form>
</div>

<?php
?>