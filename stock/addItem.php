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

    input[type='text'] {
        width: 50%;
        padding: 12px 20px;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 100%;
        padding: 20px 25px;
        background-color: darkcyan;
        color: white;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        font-size: 17px;
    }

    #addItem {
        cursor: pointer;
    }

    #delItem {
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
        border: none;
        border-collapse: collapse;
    }

    table td {
        border: none;
        padding: 10px;
    }
</style>
<script>
    $(document).ready(function() {

        $i = 1;

        $('#addItem').click(function() {
            $('#tbItem').append("<tr id='item" + $i + "'><td><input type='text' name='item[]'>&nbsp;&nbsp;<u id='delItem' style='color:red;' class=" + $i + ">X</u></td></tr>");
            $i++;
        });

        $('#tbItem').on('click', '#delItem', function() {
            $N = $(this).attr('class');
            //alert($N);
            $id = '#item' + $N;
            $($id).remove();
            $i--;
        })

        $('#logout').click(function() {
            window.open('logout.php', '_self');
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
            <div></div>
            <a href="ItemsMenu.php">รายการสินค้า</a>
        </div>

        <form action="addQueryItem.php" method="POST">
            <div class="content">
                <p>เพิ่มสินค้า</p>
                <table id='tbItem'>
                    <tr id='item0'>
                        <td>
                            <input type='text' name='item[]'>&nbsp;&nbsp;<u id='addItem' style='color:green;' class='0'>/</u>
                        </td>
                    </tr>
                </table>
                <input type="submit" value="เพิ่มข้อมูล">
            </div>
        </form>
    </div>
</body>

</html>