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
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }

    .container {
        width: 100%;
        min-height: 100vh;
        box-sizing: border-box;
        overflow: hidden;
        padding-top: 10%;
    }

    .login {
        width: 50%;
        height: 40vh;
        padding: 0;
        border: 1px solid black;
        margin:0 auto;
    }

    .hLog {
        padding: 20px;
        color: blanchedalmond;
        background-color: cadetblue;
        text-align: center;
    }

    .username {
        margin: 20px 20px 0 20px;
    }

    .password {
        margin: 5px 20px;
    }

    .username p,
    .password p {
        display: inline-block;
        width: 20%;
        text-align: right;
    }

    input[type='text'],
    input[type='password'] {
        width: 50%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    input[type=submit] {
        padding: 10px 15px;
        background-color: white;
        border-color: turquoise;
        color: turquoise;
    }

    .right {
        text-align: right;
        margin-right: 20px;
    }
</style>

<body>
    <div class="container">
        <form action="checkLogin.php" method="post">
            <div class="login">
                <div class="hLog">
                    เข้าสู่ระบบสต๊อก
                </div>
                <div class="username">
                    <p>
                        <label for="username">ชื่อผู้ใช้ :</label>
                    </p>
                    <input type="text" name="username">
                </div>

                <div class="password">
                    <p>
                        <label for="password">รหัสผ่าน :</label>
                    </p>
                    <input type="password" name="password">
                </div>
                <div class="right">
                    <input type="submit" value="เข้าสู่ระบบ">
                </div>
            </div>
        </form>
    </div>
</body>

</html>