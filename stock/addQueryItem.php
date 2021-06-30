<?php
    require('connectDB.php');

    $Nitem = count($_REQUEST['item']);
    
    if($Nitem > 0)
    {
        for($i=0 ; $i < $Nitem ; $i++ ){
            if( trim($_REQUEST['item'][$i] !='' )){
                $sqlAddItem = "insert into items (itemName) values ('".$_REQUEST['item'][$i]."');";
                $sqlQAddItem = mysqli_query($con,$sqlAddItem);
                if($sqlQAddItem == null)
                {
                    echo "คำสั่งผิด";
                }
            }
        }
    }
    
    echo "<script>  
            window.open('ItemsMenu.php','_self');
        </script>";


?>