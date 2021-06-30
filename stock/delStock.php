<?php

    $stockN = $_REQUEST['stockN'];
    require('connectDB.php');

    $sqlDelStockAna = "delete from stockAnalysis where stockN='$stockN'";
    $sqlQDelStockAna = mysqli_query($con,$sqlDelStockAna);

    if($sqlQDelStockAna == null)
    {
        echo "คำสั่งผิด";
    }

    $sqlDelStockList = "delete from stockList where stockN='$stockN';";
    $sqlQDelStockList = mysqli_query($con,$sqlDelStockList);

    if($sqlQDelStockList == null)
    {
        echo "คำสั่งผิด";
    }

    echo "<script>
            alert('ลบข้อมูลสำเร็จ');
            window.open('stockMenu.php','_self');
        </script>";

?>