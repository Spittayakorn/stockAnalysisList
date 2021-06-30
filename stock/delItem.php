<?php

    require('connectDB.php');
    $itemN = $_REQUEST['itemN'];

    $sqlDelStockAnalysis = "delete from stockAnalysis where itemN ='$itemN';";
    $sqlQDelStockAnalysis = mysqli_query($con,$sqlDelStockAnalysis);

    if($sqlQDelStockAnalysis == null){
        echo "คำสั่งผิด";
    }
    
    $sqlDel = "delete from items where itemN ='$itemN';";
    $sqlQDel = mysqli_query($con,$sqlDel);

    if($sqlQDel == null)
    {
        echo "คำสั่งผิด";
    }else{
        ?>
        <script>
            alert('ลบสำเร็จ');
            window.open('ItemsMenu.php','_self');
        </script>
        <?php
    }

    
?>