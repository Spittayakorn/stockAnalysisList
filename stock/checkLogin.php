<?php

$username = $_POST['username'];
$password = $_POST['password'];

//echo $username . " " . $password;

if (empty($username) || empty($password)) {
?>
    <script>
        alert("กรุณากรอกข้อมูลเข้าสู่ระบบให้สมบูรณ์");
        window.open('index.php', '_self');
    </script>
    <?php

} else {
    if ($username == 'admin' && $password == 'admin1234') {
?>
        <script>
            window.open('stockMenu.php', '_self');
        </script>
<?php        
    } else {
    ?>
        <script>
            alert("ไม่พบข้อมูลผู้ใช้");
            window.open('index.php', '_self');
        </script>
<?php
    }
}
?>