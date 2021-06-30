<?php
    require('connectDB.php');
    $itemN = $_REQUEST['itemN'];
    $itemName = $_REQUEST['itemName'];
    //echo $itemN." ".$itemName ;

    $sqlUpItem = "update items set itemName='$itemName' where itemN='$itemN';";
    $sqlQUpItem = mysqli_query($con,$sqlUpItem);

    if($sqlQUpItem== null)
    {
        echo "คำสั่งผิด";
    }
    
    echo "<script>
            window.open('ItemsMenu.php','_self');
    </script>";

?>