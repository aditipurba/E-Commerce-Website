<?php 
session_start();
if($_SESSION["admin"]=="")
{
?>
<script type="text/javascript">
    window.location = "admin_login.php";
</script>
<?php
}
?>
<?php include "header.php"?>
<?php include "menu.php"?>
<?php

$link = mysqli_connect("localhost","root","");
mysqli_select_db($link,"shopping_app");

?>


        <div class="grid_10">
            <div class="box round first">
                <h2>Add Product</h2>
                <div class="block">
                    <form name="form1" action="" method="post" enctype="multipart/form-data">
                        <table>

                            <tr>
                                <td>Product Name: </td>
                                <td><input type="text" name="pnm"></td>
                            </tr>

                            <tr>
                                <td>Product Price: </td>
                                <td><input type="text" name="pprice"></td>
                            </tr>

                            <tr>
                                <td>Product Quantity: </td>
                                <td><input type="text" name="pqty"></td>
                            </tr>

                            <tr>
                                <td>Product Image: </td>
                                <td><input type="file" name="pimage"></td>
                            </tr>

                            <tr>
                                <td>Product Category: </td>
                                <td>
                                    <select name="pcategory">
                                        <option value="Gents_Clothes">Clothes men</option>
                                        <option value="Ladies_Clothes">Clothes Women</option>
                                        <option value="Gents_Shoes">Shoes Men</option>
                                        <option value="Ladies_Shoes">Shoes Women</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>Product Description: </td>
                                <td>
                                    <textarea cols="15" rows="10" name="pdesc"></textarea></td>
                            </tr>

                            <tr>
                                <td colspan="2" align="center"><input type="submit" name="submit1" value="upload"></td>
                            </tr>
                    

                        </table>
                        
                    </form>

                    <?php 
                    if(isset($_POST["submit1"]))
                    {
                        $v1= rand(1111,9999);
                        $v2= rand(1111,9999);

                        $v3 = $v1.$v2;
                        $v3 = md5($v3);

                        // we want photos to be of a particular kind hence the encrytption
                        $fnm = $_FILES["pimage"]["name"];
                        $dst = "./product_image/".$v3.$fnm; // destination folder
                        $dst1 = "product_image/".$v3.$fnm;  // for inserting image in database, we do not want "./" , so we declare a new variable
                        move_uploaded_file($_FILES["pimage"]["tmp_name"], $dst); // (2 parameters...source , destination)

                        mysqli_query($link, "insert into product values ('','$_POST[pnm]',$_POST[pprice],$_POST[pqty],'$dst1','$_POST[pcategory]','$_POST[pdesc]')");
                    } 
                    ?>
                </div>
            </div>
            
        </div>


<?php include "footer.php"?>
</body>
</html>
