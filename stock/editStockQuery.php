<?php
$stockDate = $_POST['stockDate'];
$stockN = $_POST['stockN'];

require('connectDB.php');

$sqlSelItem = "select * from items;";
$sqlQSelItem = mysqli_query($con, $sqlSelItem);

if ($sqlQSelItem == null) {
    echo "คำสั่งผิด9";
}

$sqlNumrow = mysqli_num_rows($sqlQSelItem);

if ($sqlNumrow == 0) {
    echo "<script>
        alert('กรุณาเพิ่มสินค้าก่อนเพิ่มสต๊อกสินค้า');
        window.open('ItemsMenu.php','_self');
    </script>";
} else {
    if (empty($_POST['take'])) {
        $take = 0;
        //echo $take;
    } else {
        $take = count($_POST['take']);
        //echo $take;
    }

    if (empty($_POST['exist'])) {
        $exist = 0;
        //echo $exist;
    } else {
        $exist = count($_POST['exist']);
        //echo $exist;
    }

    if (empty($_POST['used'])) {
        $used = 0;
        //echo $used;
    } else {
        $used = count($_POST['used']);
        //echo $used;
    }

    if (empty($_POST['lefted'])) {
        $lefted = 0;
        //echo $lefted;
    } else {
        $lefted = count($_POST['lefted']);
        //echo $lefted;
    }
    if (empty($_POST['added'])) {
        $added = 0;
        //echo $added;
    } else {
        $added = count($_POST['added']);
        //echo $added;
    }
    if (empty($_POST['itemN'])) {
        $itemN = 0;
        //echo $itemN;
    } else {
        $itemN = count($_POST['itemN']);
        //echo $itemN;
    }

    $nTake = 0;
    $nExist = 0;
    $nUsed = 0;
    $nLefted = 0;
    $nAdded = 0;
    $nItemN = 0;

    $sqlAddStockList = "update stockList set stockDate='$stockDate' where stockN='$stockN';";
    $sqlQAddStockList = mysqli_query($con, $sqlAddStockList);

    if ($sqlQAddStockList == null) {
        echo "คำสั่งผิด1";
    }


    if ($take > 0) {
        //echo "<br>" . $stockDate . "<br>" . $take . "<br>";

        for ($i = 0; $i < $take; $i++) {

            if (trim($_POST['take'][$i])) {

                $nTake = $_POST['take'][$i];
            } else {
                $nTake = 0;
            }

            if (trim($_POST['exist'][$i])) {
                $nExist = $_POST['exist'][$i];
            } else {
                $nExist = 0;
            }

            if (trim($_POST['used'][$i])) {
                $nUsed = $_POST['used'][$i];
            } else {
                $nUsed = 0;
            }

            if (trim($_POST['lefted'][$i])) {
                $nLefted = $_POST['lefted'][$i];
            } else {
                $nLefted = 0;
            }

            if (trim($_POST['added'][$i])) {
                $nAdded = $_POST['added'][$i];
            } else {
                $nAdded = 0;
            }

            if (trim($_POST['itemN'][$i])) {
                $nItemN = $_POST['itemN'][$i];
            } else {
                $nItemN = 0;
            }

            /*
                echo $nTake . " " .
                    $nExist . " "
                    . $nUsed . " "
                    . $nLefted . " "
                    . $nAdded . " "
                    . $nItemN . "<br>";
                */

            $sqlSelStockAna = "select * from stockAnalysis where itemN ='$nItemN' and stockN ='$stockN';";
            $sqlQSelStockAna = mysqli_query($con, $sqlSelStockAna);

            if ($sqlQSelStockAna == null) {
                echo "คำสั่งผิด";
            }

            $sqlNumRowSelStockAna = mysqli_num_rows($sqlQSelStockAna);
            if ($sqlNumRowSelStockAna > 0) {

                $sqlinsertItemAna = "update stockAnalysis set take = '$nTake',exist = '0' ,used = '$nUsed',lefted ='0',added ='$nAdded' where itemN ='$nItemN' and stockN ='$stockN';";
                $sqlQinsertItemAna = mysqli_query($con, $sqlinsertItemAna);

                if ($sqlQinsertItemAna == null) {
                    echo "คำสั่งผิด10";
                }

            }else{
                $sqlinsertItemAnaE = "insert  into stockAnalysis (take,exist,used,lefted,added,itemN,stockN) value ($nTake,0,$nUsed,0,$nAdded,$nItemN,$stockN);";
                $sqlQinsertItemAnaE = mysqli_query($con, $sqlinsertItemAnaE);

                if ($sqlQinsertItemAnaE == null) {
                    echo "คำสั่งผิด10";
                }
            }
        }
    }


    echo "<script>
            window.open('editStock.php?stockN=$stockN&stockDate=$stockDate','_self');
        </script>";
}
