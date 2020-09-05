<?php 
include "header.php";
include "menu.php";
?>
<?php
$link = mysqli_connect("localhost" , "root" , "");
mysqli_select_db($link , "shopping_app");
?>
        <div class="grid_10">
            <div class="box round first">
                <h2>
                    Order Items</h2>
                <div class="block">
                    <?php
                    $id = $_GET["id"];
                    $res = mysqli_query($link , "select * from confirm_order_product where order_id=$id");

                    echo "<table>";
                    while($row = mysqli_fetch_array($res))
                    {
                        echo "<tr>";
                        echo "<td>"; ?> <img src="<?php echo $row["product_image"]; ?>" height="100" width="100" > 
                        <?php echo "</td>";
                        echo "</tr>";

                    }
                    echo "</table>";
                    ?>
                </div>
            </div>
            
        </div>
       
        
        <div class="clear">
        </div>
   
   <?php include "footer.php"?>
</body>
</html>
