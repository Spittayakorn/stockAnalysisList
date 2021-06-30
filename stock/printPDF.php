<?php
require_once __DIR__ . '/vendor/autoload.php';
ob_start();

if (empty($_POST['printList'])) {
    $printList = 0;
} else {
    $printList = count($_POST['printList']);

    $arr = array();

    for ($i = ($printList - 1), $j = 0; $i >= 0; $i--, $j++) {
        $arr[$j] = $_POST['printList'][$i];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: sarabun;
        font-size: 100%;
        line-height: 1.5;
    }

    body {
        font-family: sarabun;
    }

    .container {
        width: 100%;
        min-height: 100vh;
        overflow: hidden;
        box-sizing: border-box;

    }

    .header {
        width: 100%;
        height: 3vh;
        text-align: center;
    }

    table {
        width: 100%;
        border: 1px solid black;
        text-align: center;
        border-collapse: collapse;
        overflow: hidden;

    }

    table.tb1 {
        border: hidden;
    }

    table.eachCol td,
    table.eachCol2 td,
    table.eachCol th,
    table.eachCol2 th {
        border: 1px solid black;

    }

    table.eachCol {
        margin-left: -5px;
    }
</style>

<body>
    <div class="container">
        <div class="header">
            <h3><b>รายการของสด</b></h3>
        </div>
        <div class="content">
            <table class='tb1'>
                <?php

                require('connectDB.php');
                $length = 3;
                $row = $printList / $length;
                $row = ceil($row);
                //echo $row;
                $count = 0;
                for ($i = 0; $i < $row; $i++) {

                    $sqlSelItem = "select * from items order by itemN";
                    $sqlQSelItem = mysqli_query($con, $sqlSelItem);

                    if ($sqlQSelItem == null) {
                        echo "คำสั่งผิด";
                    }

                    $sqlNumRowSelItem = mysqli_num_rows($sqlQSelItem);

                    if ($sqlNumRowSelItem > 0) {

                        echo "<tr><td>";

                        for ($j = 0; $j < $length; $j++) {

                            if ($count < $printList) {

                                $dateTime = '';
                                $dateSpliteT = '';
                                $sqlSelStockList = "select * from stockList where stockN='$arr[$count]';";
                                $sqlQSelStockList = mysqli_query($con, $sqlSelStockList);

                                if ($sqlQSelStockList == null) {
                                    echo "คำสั่งผิด";
                                }

                                $sqlNumRowSelStockList = mysqli_num_rows($sqlQSelStockList);

                                if ($sqlNumRowSelStockList > 0) {

                                    while ($sqlFSelStockList = mysqli_fetch_array($sqlQSelStockList)) {
                                        $dateTimeSQL = $sqlFSelStockList[1];
                                        $dateTime = getDateDetail($dateTimeSQL);
                                        $dateSpliteT = spliteT($dateTimeSQL);
                                    }

                                    $sqlSelItem = "select * from items order by itemN";
                                    $sqlQSelItem = mysqli_query($con, $sqlSelItem);

                                    if ($sqlQSelItem == null) {
                                        echo "คำสั่งผิด";
                                    }

                                    if ($j == 0) {
                                        echo "<td><table class='eachCol2'>
                                <tr>
                                    <th width='50%' rowspan='2'>รายการ</th>
                                    <th colspan='5' width='50%' > วันที่ " . $dateTime . "</th>
                                </tr>
                                <tr>
                                    <th width='10%'>รับมา</th>
                                    <th width='10%'>มีอยู่</th>
                                    <th width='10%'>ใช้</th>
                                    <th width='10%'>เหลือ</th>
                                    <th width='10%'>เพิ่ม</th>
                                </tr>";

                                        while ($sqlFSelItem = mysqli_fetch_array($sqlQSelItem)) {

                                            echo "<tr>
                                                <td width='50%'>$sqlFSelItem[1]</td>";

                                            //---
                                            $take = 0;
                                            $exist = 0;
                                            $used = 0;
                                            $lefted = 0;
                                            $added = 0;
                                            $existN = 0;
                                            $nLefted = 0;
                                            $js = 0;

                                            $sqlSelDateTime = "select * from stockList where stockDate <= '" . $dateSpliteT . "' order by stockDate;";
                                            $sqlQSelDateTime = mysqli_query($con, $sqlSelDateTime);

                                            if ($sqlQSelDateTime == null) {
                                                echo "คำสั่งผิด";
                                            }

                                            $sqlNumRowDateTime = mysqli_num_rows($sqlQSelDateTime);
                                            if ($sqlNumRowDateTime > 0) {
                                                while ($sqlFDateTime = mysqli_fetch_array($sqlQSelDateTime)) {
                                                    $stockN = $sqlFDateTime[0];
                                                    $itemN = $sqlFSelItem[0];

                                                    $sqlSelStockAna = "select * from stockAnalysis where itemN='$itemN' and stockN='$stockN';";
                                                    $sqlQSelStockAna = mysqli_query($con, $sqlSelStockAna);

                                                    if ($sqlQSelStockAna == null) {
                                                        echo "คำสั่งผิด";
                                                    }

                                                    $sqlNumRowSqlStockAna = mysqli_num_rows($sqlQSelStockAna);

                                                    if ($sqlNumRowSqlStockAna > 0) {
                                                        while ($sqlFStockAna = mysqli_fetch_array($sqlQSelStockAna)) {


                                                            $take = floatval($sqlFStockAna[1]);
                                                            if ($js == 0) {
                                                                $exist = floatval($sqlFStockAna[2]);
                                                            }
                                                            $used = floatval($sqlFStockAna[3]);

                                                            $nLefted = floatval(($take + $exist) - $used);
                                                            $exist = floatval($nLefted);
                                                            $added = floatval($sqlFStockAna[5]);
                                                            $existN = floatval($exist + $used - $take);

                                                            $js++;
                                                        }
                                                    }
                                                }
                                            }

                                            //--
                                            echo "
                                        <td width='10%'>$take</td>
                                        <td width='10%'>$existN</td>
                                        <td width='10%'>$used</td>
                                        <td width='10%'>$exist</td>
                                        <td width='10%'>$added</td>
                                        </tr>";
                                        }

                                        echo "</table></td>";
                                    } else {
                                        echo "<td><table class='eachCol'>
                                <tr>
                                    <th colspan='5' width='100%' > วันที่ " . $dateTime . "</th>
                                </tr>
                                <tr>
                                    <th width='20%'>รับมา</th>
                                    <th width='20%'>มีอยู่</th>
                                    <th width='20%'>ใช้</th>
                                    <th width='20%'>เหลือ</th>
                                    <th width='20%'>เพิ่ม</th>
                                </tr>";
                                        //----
                                        while ($sqlFSelItem = mysqli_fetch_array($sqlQSelItem)) {

                                            echo "<tr>";

                                            //---
                                            $take = 0;
                                            $exist = 0;
                                            $used = 0;
                                            $lefted = 0;
                                            $added = 0;
                                            $existN = 0;
                                            $nLefted = 0;
                                            $js = 0;

                                            $sqlSelDateTime = "select * from stockList where stockDate <= '" . $dateSpliteT . "' order by stockDate;";
                                            $sqlQSelDateTime = mysqli_query($con, $sqlSelDateTime);

                                            if ($sqlQSelDateTime == null) {
                                                echo "คำสั่งผิด";
                                            }

                                            $sqlNumRowDateTime = mysqli_num_rows($sqlQSelDateTime);
                                            if ($sqlNumRowDateTime > 0) {
                                                while ($sqlFDateTime = mysqli_fetch_array($sqlQSelDateTime)) {
                                                    $stockN = $sqlFDateTime[0];
                                                    $itemN = $sqlFSelItem[0];

                                                    $sqlSelStockAna = "select * from stockAnalysis where itemN='$itemN' and stockN='$stockN';";
                                                    $sqlQSelStockAna = mysqli_query($con, $sqlSelStockAna);

                                                    if ($sqlQSelStockAna == null) {
                                                        echo "คำสั่งผิด";
                                                    }

                                                    $sqlNumRowSqlStockAna = mysqli_num_rows($sqlQSelStockAna);

                                                    if ($sqlNumRowSqlStockAna > 0) {
                                                        while ($sqlFStockAna = mysqli_fetch_array($sqlQSelStockAna)) {


                                                            $take = floatval($sqlFStockAna[1]);
                                                            if ($js == 0) {
                                                                $exist = floatval($sqlFStockAna[2]);
                                                            }
                                                            $used = floatval($sqlFStockAna[3]);

                                                            $nLefted = floatval(($take + $exist) - $used);
                                                            $exist = floatval($nLefted);
                                                            $added = floatval($sqlFStockAna[5]);
                                                            $existN = floatval($exist + $used - $take);

                                                            $js++;
                                                        }
                                                    }
                                                }
                                            }

                                            //--
                                            echo "
                                                <td width='20%'>$take</td>
                                                <td width='20%'>$existN</td>
                                                <td width='20%'>$used</td>
                                                <td width='20%'>$exist</td>
                                                <td width='20%'>$added</td>
                                                </tr>";
                                        }
                                        //-----------
                                        echo "</table></td>";
                                    }
                                }
                            } else {
                                break;
                            }
                            $count++;
                        }
                        echo "</td></tr>";
                    }
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>

<?php
function getDateDetail($dateTime)
{

    $timeStamp = strtotime($dateTime);
    $date = '';

    switch (date('w', $timeStamp)) {
        case '0':
            $date = 'อา.';
            break;
        case '1':
            $date = 'จ.';
            break;
        case '2':
            $date = 'อ.';
            break;
        case '3':
            $date = 'พ.';
            break;
        case '4':
            $date = 'พฤ.';
            break;
        case '5':
            $date = 'ศ.';
            break;
        case '6':
            $date = 'ส.';
            break;
    }

    $date .= " " . date('j/n', $timeStamp);
    $date .= "/" . (int)date('Y', $timeStamp) + 543;
    $date .= "  " . date('H:i:s', $timeStamp);
    return $date;
}

function spliteT($dateTime)
{
    $datSplit = str_replace('T', ' ', $dateTime);
    return $datSplit;
}

?>
<?php

use Mpdf\Mpdf;

$html = ob_get_contents();


$mpdf = new Mpdf();
$mpdf->showImageErrors = true;
//--
$mpdf->shrink_tables_to_fit = 1;
$mpdf->simpleTables = true;
$mpdf->packTableData = true;
$keep_table_proportions = TRUE;

$text = '';
$today = getdate();
//รับวัน-เดือน-ปี
$day = $today["mday"];
$month = $today["mon"];
$year = $today["year"] + 543;
$years = $today["year"];

$hour = $today["hours"];
$minute = $today["minutes"];
$second = $today["seconds"];

$text = $day."_".$month."_".$year."_".$hour."_".$minute."_".$second;

//---
$mpdf->WriteHTML($html);

$fileName = "stock_" . $text . ".pdf";
$mpdf->Output($fileName, 'D');

ob_end_flush();
//chrome://settings/content/pdfDocuments

?>