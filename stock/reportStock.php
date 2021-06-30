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
        margin-top: 10px;
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

    .text {
        text-align: center;
    }

    .center {
        display: flex;
        justify-content: center;
    }

    .selectTime {
        width: 50%;
        border: 1px solid black;
        margin-top: 5px;
        padding: 20px;
        border-radius: 5px;
    }

    .startTime {
        height: 6vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .endTime {
        height: 6vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 5px;
    }

    input[type="datetime-local"] {
        width: 35%;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 16px;
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
</style>
<script>
    $(document).ready(function() {

        $('#logout').click(function() {
            window.open('logout.php', '_self');
        });

        $('#btSubmit').click(function() {
            $sdateTime =  $('#stime').val();
            $edateTime =  $('#etime').val();

            $.get('showDataTableReport.php', {
                sdateTime: $sdateTime,
                edateTime: $edateTime
            }, function(data, status) {
                if (status == 'success') {
                    $('#tb > tbody').html('');
                    //alert(data.length);
                    var text = '';
                    var rowColor = 'white';
                    var color = 'black';

                    if (data.length > 0) {
                        for (var j = 0, i = 1; j < data.length; j++, i++) {
                            text += "<tr><td>"+i+"</td><td>"+data[j].itemName+"</td><td>"+toFixed(data[j].take)+"</td><td>"+toFixed(data[j].used)+"</td><td>"+toFixed(data[j].lefted)+"</td></tr>";
                        }
                    } else {
                        
                    }

                    $('#tb > tbody').html(text + "<input type='hidden' id='length' value='" + data.length + "'>");
                }
            });


        });

        function toFixed(x) {
            if (Math.abs(x) < 1.0) {
                var e = parseInt(x.toString().split('e-')[1]);
                if (e) {
                    x *= Math.pow(10, e - 1);
                    x = '0.' + (new Array(e)).join('0') + x.toString().substring(2);
                }
            } else {
                var e = parseInt(x.toString().split('+')[1]);
                if (e > 20) {
                    e -= 20;
                    x /= Math.pow(10, e);
                    x += (new Array(e + 1)).join('0');
                }
            }
            return x;
        }
    });
</script>

<body>
    <div class="container">
        <div class="header">
            <div class="right">
                <input type="button" id='logout' value="ออกจากระบบ">
            </div>
        </div>
        <div class="text">
            <b>กล่องค้นหา</b>
        </div>
        <div class="center">
            <div class="selectTime">
                <div class="startTime">
                    <label for="stime">เริ่มต้น :&nbsp;</label>
                    <input type="datetime-local" step='1' id='stime' >
                </div>
                <div class="endTime">
                    <label for="etime">สิ้นสุด :&nbsp;</label>
                    <input type="datetime-local" step='1' id='etime'>
                </div>

                <div class="search">
                    <input type="submit" id='btSubmit' value='ค้นหา'>
                </div>
            </div>
        </div>
        <div class="spacebetween">
            <div></div>
            <a href="stockMenu.php">รายการสต๊อก</a>
        </div>
        <div class="content">
            <p>รายการสินค้า</p>
            <table id='tb'>
                <thead>
                    <tr>
                        <th width='10%' rowspan='2'>ลำดับที่</th>
                        <th width='40%' rowspan='2'>ชื่อสินค้า</th>
                        <th width='50%' colspan='3'>จัดการ</th>
                    </tr>
                    <tr>
                        <th width='16%'>จำนวนที่รับ</th>
                        <th width='16%'>จำนวนที่ใช้</th>
                        <th width='16%'>จำนวนที่เหลือ</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>