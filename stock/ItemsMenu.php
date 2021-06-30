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
</style>
<script>
    $(document).ready(function(){

        $('#tb').on('click','#delItem',function(){
            var check = false;
            var itemN = $(this).attr('class');
            
            check = confirm('คุณต้องการลบสินค้านี้ใช่ไหม');
            if(check == true){
                check = true;
                window.open('delItem.php?itemN='+itemN,'_self');
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
                <input type="button" id='logout' value="ออกจากระบบ">
            </div>
        </div>
        <div class="spacebetween">
            <a href="stockMenu.php">รายการสต๊อก</a>
            <a href="addItem.php">เพิ่มสินค้า</a>
        </div>
        <div class="content">
            <p>รายการสินค้า</p>
            <table id='tb'>
                <tr>
                    <th width='10%'>ลำดับที่</th>
                    <th width='40%'>ชื่อสินค้า</th>
                    <th width='50%'>จัดการ</th>
                </tr>
                <?php
                    require('connectDB.php');

                    $selItem = 'select * from items order by itemN;';
                    $sqlQsel = mysqli_query($con,$selItem);

                    if($sqlQsel==null)
                    {
                        echo "คำสั่งผิด";
                    }

                    $sqlNumRow = mysqli_num_rows($sqlQsel);
                    if($sqlNumRow == 0)
                    {
                        echo "<tr>
                                <td colspan='3' style='color:green';>กรุณาเพิ่มสินค้า</td>    
                        </tr>";
                    }else
                    {
                        $i=1;
                        while($sqlFetchItem = mysqli_fetch_array($sqlQsel)){
                            echo "<tr>
                                <td>$i</td>  
                                <td>$sqlFetchItem[1]</td>
                                <td>
                                    <a href='editItem.php?itemN=$sqlFetchItem[0]'>แก้ไข</a> &nbsp;|&nbsp;
                                    <a href='#' id='delItem' class='$sqlFetchItem[0]'>ลบ</a>
                                </td>    
                            </tr>";
                            $i++;
                        }
                    }
                
                
                ?>
            </table>
        </div>
    </div>
</body>

</html>