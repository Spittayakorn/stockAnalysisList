<?php
header('Content-type: application/json; charset=UTF-8');

require('connectDB.php');

$dateTime = $_REQUEST['dateTime'];
//$dateTime = '2021-06-20 22:58:55';
function spliteT($dateTime)
{
    $datSplit = str_replace('T', ' ', $dateTime);
    return $datSplit;
}

$dateSpliteT = spliteT($dateTime);

//-----------------------------------------------------------------------
$sqlSelItem = "select * from items order by itemN";
$sqlQSelItem = mysqli_query($con, $sqlSelItem);

if ($sqlQSelItem == null) {
    echo "คำสั่งผิด";
}

$sqlNumRowSelItem = mysqli_num_rows($sqlQSelItem);

$result_json = array();
$i = 0;

if ($sqlNumRowSelItem > 0) {
    $checkSelItem = false;
    while ($sqlFSelItem = mysqli_fetch_array($sqlQSelItem)) {
        $take = 0;
        $exist = 0;
        $used = 0;
        $lefted = 0;
        $added = 0;
        $existN = 0;

        $j = 0;
        $nLefted = 0;

        $itemN = $sqlFSelItem[0];
        $itemName = $sqlFSelItem[1];
        //echo "$itemN$stockN ";
        $sqlSelDateTime = "select * from stockList where stockDate <= '" . $dateSpliteT . "' order by stockDate;";
        $sqlQSelDateTime = mysqli_query($con, $sqlSelDateTime);

        if ($sqlQSelDateTime == null) {
            echo "คำสั่งผิด";
        }

        $sqlNumRowDateTime = mysqli_num_rows($sqlQSelDateTime);
        if ($sqlNumRowDateTime > 0) {

            while ($sqlFDateTime = mysqli_fetch_array($sqlQSelDateTime)) {
                $stockN = $sqlFDateTime[0];

                $sqlSelStockAna = "select * from stockAnalysis where itemN='$itemN' and stockN='$stockN';";
                $sqlQSelStockAna = mysqli_query($con, $sqlSelStockAna);

                if ($sqlQSelStockAna == null) {
                    echo "คำสั่งผิด";
                }

                $sqlNumRowSqlStockAna = mysqli_num_rows($sqlQSelStockAna);

                if ($sqlNumRowSqlStockAna > 0) {
                    while ($sqlFStockAna = mysqli_fetch_array($sqlQSelStockAna)) {

                        if ($itemN == $sqlFStockAna[6]) {
                            $checkSelItem = true;
                            $take = floatval($sqlFStockAna[1]);
                            if ($j == 0) {
                                $exist = floatval($sqlFStockAna[2]);
                            }
                            $used = floatval($sqlFStockAna[3]);

                            $nLefted = floatval(($take + $exist) - $used);
                            $exist = floatval($nLefted);
                            $added = floatval($sqlFStockAna[5]);
                            $existN = floatval($exist + $used - $take);

                            $j++;
                        }
                    }
                }
            }
        } else {
            //< no data in each item
            $exist = 0;
        }

        if ($checkSelItem == true) {

            if ($take == 0 && $existN == 0 && $used == 0 && $exist == 0 && $added == 0) {
            } else {
                $record_json = new stdClass();
                $record_json->take = $take;
                $record_json->exist = $existN;
                $record_json->used = $used;
                $record_json->lefted = $exist;
                $record_json->added = $added;
                $record_json->itemN = $itemN;
                $record_json->itemName = $itemName;

                $result_json[$i] = ($record_json);

                $i++;
            }
        }
        $checkSelItem = false;
    }
}
echo json_encode($result_json);
