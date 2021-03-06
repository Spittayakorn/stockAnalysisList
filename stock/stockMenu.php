<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }

    .container {
        width: 100%;
        min-height: 100vh;
        box-sizing: border-box;
        overflow: hidden;
        padding-left: 10%;
        padding-right: 10%;

    }

    .header {
        width: 100%;
        height: 10vh;
        margin-top: 20px;
        display: flex;
        align-items: center;
    }

    .right {
        width: 100%;
        text-align: right;
    }

    .spacebetween {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }

    input[type=button] {
        padding: 10px 15px;
        background-color: white;
        border-color: turquoise;
        color: turquoise;
        cursor: pointer;
    }

    .content {
        width: 100%;
        text-align: center;
    }

    .content p {
        color: white;
        background-color: black;
        padding: 10px;
    }

    table {
        width: 100%;
        border: 1px solid black;
        border-collapse: collapse;
    }

    table th,
    table td {
        border: 1px solid black;
        padding: 10px;

    }

    table th:nth-child(4) {
        padding: 0;
    }
    table td:nth-child(4) {
        padding: 0;
    }
    input[type=submit] {
        width: 100%;
        height: 6vh;
        background-color: darkcyan;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 17px;
    }

    input[type=submit]:hover {
        border: 1px solid black;
        color: black;
        background-color: cyan;
    }

    input[type=checkbox] {
        width: 100%;
        cursor: pointer;
    }
</style>
<script>
    $(document).ready(function() {

        $('#tb').on('click', '#delStock', function() {

            var check = false;
            var stockN = $(this).attr('class');
            check = confirm('??????????????????????????????????????????????????????');

            if (check == true) {
                check = true;
                window.open("delStock.php?stockN=" + stockN, '_self');
            }

            return check;
        });

        $('#logout').click(function(){
            window.open('logout.php','_self');
        });
    });
</script>

<body>
    <div class="container">
        <div class="header">
            <div class="right">
                <input type="button" id='logout' value="??????????????????????????????">
            </div>
        </div>
        <div class="spacebetween">
            <a href="ItemsMenu.php">????????????????????????????????????</a>
            <a href="reportStock.php">?????????????????????????????????</a>
            <a href="addStocks.php">????????????????????????????????????????????????</a>
        </div>
        <div class="content">
            <p>?????????????????????????????????</p>

            <form action="printPDF.php" method="POST">
                <table id='tb'>
                    <tr>
                        <th width='10%'>????????????????????????</th>
                        <th width='40%'>?????????/???????????????/??????</th>
                        <th width='40%'>??????????????????</th>
                        <th width='10%'>
                            <input type="submit" value='???????????????'>
                        </th>
                    </tr>
                    <tr>
                        <?php
                        require('connectDB.php');

                        $selItem = 'select * from stockList order by stockDate desc;';
                        $sqlQsel = mysqli_query($con, $selItem);

                        if ($sqlQsel == null) {
                            echo "???????????????????????????";
                        }

                        $sqlNumRow = mysqli_num_rows($sqlQsel);
                        if ($sqlNumRow == 0) {
                            echo "<tr>
                                <td colspan='4' style='color:green';>?????????????????????????????????????????????</td>    
                        </tr>";
                        } else {
                            $i = $sqlNumRow;
                            while ($sqlFetchItem = mysqli_fetch_array($sqlQsel)) {

                                echo "<tr>
                                <td>$i</td>  
                                <td>" . getDateDetail($sqlFetchItem[1]) . "</td>
                                <td>
                                    <a href='showStockMenu.php?stockN=$sqlFetchItem[0]&stockDate=$sqlFetchItem[1]'>?????????????????????</a> &nbsp;|&nbsp;
                                    <a href='editStock.php?stockN=$sqlFetchItem[0]&stockDate=$sqlFetchItem[1]'>???????????????</a> &nbsp;|&nbsp;
                                    <a href='#' id='delStock' class='$sqlFetchItem[0]'>??????</a>
                                </td>
                                <td>
                                    <input type='checkbox' name='printList[]' value='$sqlFetchItem[0]'>
                                </td>    
                                
                            </tr>";
                                $i--;
                            }
                        }

                        function getDateDetail($dateTime)
                        {

                            $timeStamp = strtotime($dateTime);
                            $date = '';

                            switch (date('w', $timeStamp)) {
                                case '0':
                                    $date = '??????.';
                                    break;
                                case '1':
                                    $date = '???.';
                                    break;
                                case '2':
                                    $date = '???.';
                                    break;
                                case '3':
                                    $date = '???.';
                                    break;
                                case '4':
                                    $date = '??????.';
                                    break;
                                case '5':
                                    $date = '???.';
                                    break;
                                case '6':
                                    $date = '???.';
                                    break;
                            }

                            $date .= " " . date('j/n', $timeStamp);
                            $date .= "/" . (int)date('Y', $timeStamp) + 543;
                            $date .= "  " . date('H:i:s', $timeStamp);
                            return $date;
                        }
                        ?>

                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>