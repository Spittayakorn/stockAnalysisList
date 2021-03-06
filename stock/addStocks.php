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
        padding: 4px;
    }

    input[type=number] {
        width: 100%;
        padding: 10px 0px;
        display: inline-block;
        border: none;
        box-sizing: border-box;
        text-align: right;
        font-size: 16px;
    }

    .btn-addStock {
        margin-top: 10px;
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

    input[type="datetime-local"] {
        width: 35%;
        padding: 10px 15px;
        border-radius: 5px;
        font-size: 16px;
    }
</style>
<script>
    $(document).ready(function() {

        $.get('getDate.php', function(data, status) {

            if (status == 'success') {

                if (data.month < 10) {
                    data.month = "0" + data.month;
                }
                if (data.hour < 10) {
                    data.hour = "0" + data.hour;
                }
                if (data.minute < 10) {
                    data.minute = "0" + data.minute;
                }
                if (data.second < 10) {
                    data.second = "0" + data.second;
                }
                var text = data.years + "-" + data.month + "-" + data.day + "T" + data.hour + ":" + data.minute + ":" + data.second;
                //alert(text);
                $('#showDate').val(text);

                //---
                $.get('showDataTable.php', {
                    dateTime: text
                }, function(data, status) {
                    if (status == 'success') {
                        $('#tb > tbody').html('');
                        //alert(data.length);
                        var text = '';
                        var rowColor = 'white';
                        var color = 'black';

                        if (data.length > 0) {
                            for (var j = 0, i = 1; j < data.length; j++, i++) {

                                text += "<tr style='background-color:" + rowColor + ";color:" + color + ";'><td>" + i + "</td><td>" + data[j].itemName + "</td><td><div id='checkRow' class='" + j + "'><input type='number' max='9999999' step='0.01' id='take" + j + "' class='take' name='take[]' style='background-color:" + rowColor + ";color:" + color + ";' value='" + '' + "'></div></td><td style='background-color:white;'><div id='checkRow' class='" + j + "'><input type='number' id='exist" + j + "' class='exist' name='exist[]' style='background-color:#BDBDBD;color:white;' value='" + toFixed(data[j].exist).toFixed(2) + "' readonly ></div></td><td><div id='checkRow' class='" + j + "'><input type='number' max='9999999' step='0.01' id='used" + j + "' class='used' name='used[]' style='background-color:" + rowColor + ";color:" + color + ";' value='" + '' + "'></div></td><td style='background-color:white;'><div id='checkRow' class='" + j + "'><input type='number' id='lefted" + j + "' class='lefted' name='lefted[]' style='background-color:#BDBDBD;color:white;' value='" + toFixed(data[j].lefted).toFixed(2) + "' readonly></div></td><td><input type='number' max='9999999' step='0.01' id='added" + j + "' class='added' name='added[]' style='background-color:" + rowColor + ";color:" + color + ";' value='" + '' + "'></td><input type='hidden' name='itemN[]' value='" + data[j].itemN + "'></tr>";

                            }
                        } else {
                            text += "<tr><td colspan='7' style='color:green;'>????????????????????????????????????????????????</td></tr>";
                        }

                        $('#tb > tbody').html(text + "<input type='hidden' id='length' value='" + data.length + "'>");
                    }
                });
                //--
            }
        });

        $('#tb').on('keypress', '.take', function(e) {
            if ((e.which != 46 || $(this).val().indexOf('.') != -1) && (e.which < 48 || e.which > 57)) {   
                e.preventDefault();
            }            
        });

        $('#tb').on('keypress', '.used', function(e) {
            if ((e.which != 46 || $(this).val().indexOf('.') != -1) && (e.which < 48 || e.which > 57)) {
                e.preventDefault();
            }
        });

        $('#tb').on('keypress', '.added', function(e) {
            if ((e.which != 46 || $(this).val().indexOf('.') != -1) && (e.which < 48 || e.which > 57)) {
                e.preventDefault();
            }
        });

        $('form').submit(function() {
            var date = $('#showDate').val();
            var check = false;
            var length = $('#length').val();
            var textAlert = false;
            //alert(length);
            //alert(date);
            if (date != '') {
                check = true;
            } else {
                alert('???????????????????????????????????????????????????????????????');
            }

            if (length > 0) {
                for (var i = 0; i < length; i++) {
                    var txtTake = '#take' + i;
                    var txtExist = '#exist' + i;
                    var txtUsed = '#used' + i;
                    var txtLefted = '#lefted' + i;

                    var take = $(txtTake).val();
                    var exist = $(txtExist).val();
                    var used = $(txtUsed).val();
                    var lefted = $(txtLefted).val();

                    if (take == '.') {
                        textAlert = true;
                    }
                    if (exist == '.') {
                        textAlert = true;
                    }
                    if (used == '.') {
                        textAlert = true;
                    }
                    if (lefted == '.') {
                        textAlert = true;
                    }
                }

                if (textAlert == true) {
                    check = false;
                    alert('???????????????????????????????????????????????????????????????????????????????????????????????????');
                }
            } else {
                check = false;
                alert('????????????????????????????????????????????????????????????????????????????????????????????????????????????');
                window.open('ItemsMenu.php', '_self');

            }

            return check;
        });

        $('#showDate').change(function() {
            var text = $('#showDate').val();
            //alert(text);
            $.get('showDataTable.php', {
                dateTime: text
            }, function(data, status) {
                if (status == 'success') {
                    $('#tb > tbody').html('');
                    //alert(data.length);
                    var text = '';
                    var rowColor = 'white';
                    var color = 'black';

                    if (data.length > 0) {
                        for (var j = 0, i = 1; j < data.length; j++, i++) {

                            text += "<tr style='background-color:" + rowColor + ";color:" + color + ";'><td>" + i + "</td><td>" + data[j].itemName + "</td><td><div id='checkRow' class='" + j + "'><input type='number' max='9999999' step='0.01' id='take" + j + "' class='take' name='take[]' style='background-color:" + rowColor + ";color:" + color + ";' value='" + '' + "'></div></td><td style='background-color:white;'><div id='checkRow' class='" + j + "'><input type='number' id='exist" + j + "' class='exist' name='exist[]' style='background-color:#BDBDBD;color:white;' value='" + toFixed(data[j].exist).toFixed(2) + "' readonly ></div></td><td><div id='checkRow' class='" + j + "'><input type='number' max='9999999' step='0.01' id='used" + j + "' class='used' name='used[]' style='background-color:" + rowColor + ";color:" + color + ";' value='" + '' + "'></div></td><td style='background-color:white;'><div id='checkRow' class='" + j + "'><input type='number' id='lefted" + j + "' class='lefted' name='lefted[]' style='background-color:#BDBDBD;color:white;' value='" + toFixed(data[j].lefted).toFixed(2) + "' readonly></div></td><td><input type='number' max='9999999' step='0.01' id='added" + j + "' class='added' name='added[]' style='background-color:" + rowColor + ";color:" + color + ";' value='" + '' + "'></td><input type='hidden' name='itemN[]' value='" + data[j].itemN + "'></tr>";

                        }
                    } else {
                        text += "<tr><td colspan='7' style='color:green;'>????????????????????????????????????????????????</td></tr>";
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

        $('#tb > tbody').on('keyup', '#checkRow', function() {
            var text = $(this).attr('class');
            //alert(text);
            var txtTake = '#take' + text;
            var txtExist = '#exist' + text;
            var txtUsed = '#used' + text;
            var txtLefted = '#lefted' + text;

            var take = $(txtTake).val();
            var exist = $(txtExist).val();
            var used = $(txtUsed).val();
            var lefted = 0;
            if (take == '') {
                take = 0;
            } else {
                take = parseFloat(take);
            }

            if (exist == '') {
                exist = 0;
            } else {
                exist = parseFloat(exist);
            }

            if (used == '') {
                used = 0;
            } else {
                used = parseFloat(used);
            }
            lefted = (take + exist) - used;
            //alert(lefted);

            $(txtLefted).val(toFixed(lefted).toFixed(2));

        });

        $('#tb > tbody').on('change', '#checkRow', function() {
            var text = $(this).attr('class');
            //alert(text);
            var txtTake = '#take' + text;
            var txtExist = '#exist' + text;
            var txtUsed = '#used' + text;
            var txtLefted = '#lefted' + text;

            var take = $(txtTake).val();
            var exist = $(txtExist).val();
            var used = $(txtUsed).val();
            var lefted = 0;
            if (take == '') {
                take = 0;
            } else {
                take = parseFloat(take);
            }

            if (exist == '') {
                exist = 0;
            } else {
                exist = parseFloat(exist);
            }

            if (used == '') {
                used = 0;
            } else {
                used = parseFloat(used);
            }
            lefted = (take + exist) - used;
            //alert(lefted);

            $(txtLefted).val(toFixed(lefted).toFixed(2));

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
            <div></div>
            <a href="stockMenu.php">?????????????????????????????????</a>
        </div>

        <form action="addStockQuery.php" method="POST">
            <div class="content">
                <p>????????????????????????????????????????????????</p>
                <table id='tb'>
                    <thead>
                        <tr>
                            <th width='5%' rowspan="2">?????????</th>
                            <th width='35%' rowspan="2">??????????????????</th>
                            <th width='60%' colspan="5">??????????????????&nbsp;&nbsp;<input type="datetime-local" step='1' id='showDate' name='stockDate'></th>
                        </tr>
                        <tr>
                            <th width='12%'>???????????????</th>
                            <th width='12%'>??????????????????</th>
                            <th width='12%'>?????????</th>
                            <th width='12%'>???????????????</th>
                            <th width='12%'>???????????????</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                </table>

                <div class='btn-addStock'>
                    <input type="submit" value='??????????????????????????????'>
                </div>
            </div>
        </form>
    </div>
</body>

</html>